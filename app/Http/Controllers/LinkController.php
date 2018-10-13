<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EditLinkRequest as EditRequest;
use App\Http\Requests\CreateLinkRequest as CreateRequest;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\View;
use Hekmatinasser\Verta\Verta;
use App\Link;
use Jenssegers\Agent\Agent;

class LinkController extends Controller
{
    public function create(CreateRequest $request)
    {
    	if(\Auth::check()){
            $user_id = \Auth::user()->id;
            $shortLink = $this->getRand(62, 6);
            $shortLinkForGuestUsers = false;
        }else{
            $user_id = null;
            $shortLink = $this->getRand(62);
            $shortLinkForGuestUsers = $shortLink;
        }
        
        $link = Link::where([['longLink', $this->addHttp($request->longLink)], ['user_id', $user_id]])->get()->first();

        if (is_null($link)) {
            $link = new Link;

            $link->longLink = $this->addHttp($request->longLink);
            $link->shortLink = $shortLink;
            $link->user_id = $user_id;
            $link->save();
        } else {
            $shortLink = $link->shortLink;
        }

        $shortLinkHtml = "<div class=\"row\"><h3>". $request->longLink ."</h3></div>";
        $shortLinkHtml .= "<div class=\"row shortUrl\"><button onclick=\"copyShortLink(this)\" clipboard=\"Affba.ir/". $shortLink ."\">Copy</button>";
        $shortLinkHtml .= "<form action=".(is_null($user_id) ? '/register' : '/link/'.$shortLink)." method='get'><div class='registerForm'></div><button type='submit'>Analysis</button></form><h2><a href=\"". URL('/'.$shortLink) ."\" target=\"_blank\">Affba.ir/". $shortLink ."</a></h2></div>";
        return ['shortLinkHtml' => $shortLinkHtml, 'shortLinkValue' => $shortLink];
        /*
        $response = array(
            'status'    => 'success',
            'longLink'  => $request->longLink,
            'shortLink' => URL('/'. $shortLink), 
        );
        return response()->json($response); 
        */
    }

    public function stats($shortUrl = null)
    {
        $user_id = \Auth::user()->id;
        $stats = Link::with('views')->where('user_id', $user_id)->orderBy('created_at', 'Desc')->get();

        $now = Verta::now();

        $month = [
            '1' => 'فروردین',
            '2' => 'اردیبهشت',
            '3' => 'خرداد',
            '4' => 'تیر',
            '5' => 'مرداد',
            '6' => 'شهریور',
            '7' => 'مهر',
            '8' => 'آبان',
            '9' => 'آذر',
            '10' => 'دی',
            '11' => 'بهمن',
            '0' => 'اسفند',
        ];

        $statMonthArray = [];
        $counMonth = 12;
        $var = $now->month + 1;
        $j = floor($counMonth/12); // Count Of Prev Years
        $monthDiff = 13 - $var ; // How many month shoud start with least year number

        $viewsAllLinks = [];
        $currentLinkViewsPerMonth = [];
        $allLinkViewsPerMonth = [];

        $viewsCurrentLink = View::where('link_shortLink', $shortUrl)->get()->pluck('created_at');
        $linkUserId = Link::where('shortLink', $shortUrl)->get()->pluck('user_id')->first();
        if ($linkUserId) {
            $shortLinks = Link::where('user_id', $linkUserId)->get()->pluck('shortLink');
            foreach ($shortLinks as $shortLink) {
                $viewsAllLinks[] = View::where('link_shortLink', $shortLink)->get()->pluck('created_at')->toArray();
            }
            $viewsAllLinks = array_flatten($viewsAllLinks);
        }

        for($i=1; $i <= $counMonth; $i++){
            $monthNumber = ($var+$i-1)%12;
            $statMonthArray[$i]['month'] = $month[$monthNumber];

            // Go to next Year
            if($monthDiff == 0){
                $monthDiff = 12;
                $j--;
            }
            $year = intval($now->year - $j);
            $statMonthArray[$i]['year'] = $year;
            $monthDiff--;

            if ($viewsCurrentLink) {
                $currentLinkViewsPerMonth[$monthNumber] = $this->getViewsCount($viewsCurrentLink, $year, $monthNumber);
            }
            if ($viewsAllLinks) {
                $allLinkViewsPerMonth[$monthNumber] = $this->getViewsCount($viewsAllLinks, $year, $monthNumber);
            }
        }

        /*
        $stats = "select link.longLink as longLink, link.shortLink as shortLink, COUNT(v.id) from (
                select * from links where user_id='$user_id'
            ) as link left join views as v on link.shortLink=v.link 
            GROUP By shortLink";
        */

        $browser = $this->getObjectDataForChart('browserName', $shortUrl);
        $OS = $this->getObjectDataForChart('OsName', $shortUrl);
        $isp = $this->getObjectDataForChart('isp', $shortUrl);
        $City = $this->getObjectDataForChart('city', $shortUrl);
        $Country = $this->getObjectDataForChart('country', $shortUrl);
        $device = $this->getObjectDataForChart('device', $shortUrl);

        $currentLinkViewsPerMonth = array_values($currentLinkViewsPerMonth);
        $currentLinkViewsPerMonth = json_encode($currentLinkViewsPerMonth, true);

        $allLinkViewsPerMonth = array_values($allLinkViewsPerMonth);
        $allLinkViewsPerMonth = json_encode($allLinkViewsPerMonth, true);

        $data = ['shortUrl' => $shortUrl, 'stats' => $stats, 'statMonthArray' => $statMonthArray, 'browser' => $browser,
            'OS' => $OS, 'City' => $City, 'isp' => $isp, 'Country' => $Country, 'Device' => $device,
            'allLinkViewsPerMonth' => $allLinkViewsPerMonth, 'currentLinkViewsPerMonth' => $currentLinkViewsPerMonth
            ];

        return view('link', $data);
        
    }

    public function redirect(Request $request, $shortLink){
        $redirect = DB::table('links')->where('shortLink', $shortLink)->first();
        if(!empty($redirect->longLink)){
            $ip = $_SERVER['REMOTE_ADDR'];
            // for production environment develop, please comment the below code
            //$ip = "46.224.1.220";
            //$details = json_decode(file_get_contents("https://ipapi.co/{$ip}/json"));
            //$detailes = json_decode();
            
            if($details = file_get_contents("http://ip-api.com/json/{$ip}")){
                $details = json_decode($details);
                $agent = new Agent();
                $view = new View();
                $view->link_shortLink   = $shortLink;
                $view->referer          = request()->headers->get('referer')?request()->headers->get('referer'):"direct";
                $view->ip               = $_SERVER['REMOTE_ADDR'];
                $view->isp              = $details->org;
                $view->osName           = $agent->platform();
                $view->osVersion        = $agent->version($agent->platform());
                $view->browserName      = $agent->browser();
                $view->browserVersion   = intval($agent->version($agent->browser()));
                //$view->country          = $details->country_name; this is for first API url
                $view->country          = $details->country;
                $view->city             = $details->city;
                $view->device           = $this->detectDevice();
                $view->save();
            }
            return redirect($redirect->longLink, 301);
        }
    }

    private function getRand($base, $length = 7){
        $shortCode = array();
        $timestamp = floor((microtime(true)*($length==7?100:1)));
        $repo = array('R','Y','8','Q','n','s','I','0','J','A','e','G','h','r','F','P','9','a','o','X','y','i','v','E','f','z','1','7','4','W','p','b','T','g','k','x','D','l','6','K','N','u','j','V','d','2','t','L','w','C','m','Z','B','c','U','O','H','3','M','S','5','q');
        while ($timestamp > 0){
            $reminder = ($timestamp % $base)<0?($timestamp % $base)+$base:($timestamp % $base);
            $timestamp = floor($timestamp / $base);
            array_push($shortCode, $repo[$reminder]);
        }
        return implode(array_reverse($shortCode));
    }

    public function edit($shortLink)
    {
        $link = Link::all()->where('shortLink', '=', $shortLink)->first();
        return view('edit-link', ['link' => $link, 'shortLink' => $shortLink]);
    }

    public function updateLink(EditRequest $request)
    {
        $input = $request->input();

        Link::where('id', '=', $input['id'])
            ->update(['shortLink' => $input['shortLink'], 'title' => $input['title']]);

        return redirect('/link');

    }

    /**
     * @param $object
     * @param $shortUrl
     * @return array
     */
    public function getObjectDataForChart($object, $shortUrl)
    {
        $objectsData = DB::table('views')
        ->select($object, DB::raw('count(*) as total'))
        ->groupBy($object)
        ->where('link_shortLink', $shortUrl)
        ->get()
        ->toArray();

        $objectCount = [];
        $objectName = [];

        foreach ($objectsData as $objectData) {
            $objectCount[] = $objectData->total;
            $objectName[] = $objectData->$object;
        }


        $objectSize = sizeof($objectCount);
        $objectCount = json_encode($objectCount, true);
        $objectName = json_encode($objectName, true);
        $data = ['count' => $objectCount, 'name' => $objectName, 'colors' => $this->rand_color($objectSize)];

        return $data;
    }

    public function getViewsCount($views, $year, $mm)
    {
        $viewCount = 0;
        foreach ($views as $view) {
            $viewTime = Verta::getJalali($view->year, $view->month, $view->day);
            if ($viewTime[0] == $year && $viewTime[1] == $mm) {
                $viewCount++;
            }
        }
        return $viewCount;
    }

    public function rand_color($count) {
        $colors = array();
        for($i=0; $i<$count; $i++){
            array_push($colors, sprintf('#%06X', mt_rand(0, 0xFFFFFF)));
        }
        return json_encode($colors);
    }
    
    public function detectDevice(){
	$userAgent = $_SERVER["HTTP_USER_AGENT"];
	$devicesTypes = array(
        "computer" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*firefox", "opera"),
        "tablet"   => array("tablet", "android", "ipad", "tablet.*firefox"),
        "mobile"   => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini"),
        "bot"      => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis")
    );
 	foreach($devicesTypes as $deviceType => $devices) {           
        foreach($devices as $device) {
            if(preg_match("/" . $device . "/i", $userAgent)) {
                $deviceName = $deviceType;
            }
        }
    }
    return ucfirst($deviceName);
 	}
 	
 	public function addHttp($url) {
        // Check http Or https
        if (substr($url, 0, 7) == "http://"){
            $res = "http";
        }elseif (substr($url, 0, 8) == "https://"){
            $res = "https";
        }else{
            $url = "http://". $url;
        }
        return $url;
    }
}
