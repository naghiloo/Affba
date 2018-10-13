<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function main()
    {
        $linkCount = Link::all()->count();
        $linkNumbers = [];

        $linkCountLength = strlen($linkCount);
        for ($i = 0; $i < $linkCountLength; $i++) {
            $linkNumbers[] = substr($linkCount,$i,1);
        }

        return view('index', ['linkNumbers' => $linkNumbers]);
    }
}
