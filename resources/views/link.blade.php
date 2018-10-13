@extends('base')

@section('head')
    <!-- Only In This Page -->
    <!-- <script type="text/javascript" src="js/chart_min.js"></script> -->
    <script src="{{ URL('js/moment.js') }}"></script>
    <script src="{{ URL('js/Chart.min.js') }}"></script>
    <script type="text/javascript">
    var barCountryCfg = {
        type: 'bar',
        data: {
            labels: <?php echo $Country['name']; ?>,
            datasets: [{
                backgroundColor: <?php echo $Country['colors']; ?>,
                data: <?php echo $Country['count']; ?>
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Country'
            },
            legend: {
                display: false
            },
            cutoutPercentage: 70,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                    }
                }]
            }
        }

    };
    var pieOSCfg = {
        type: 'pie',
        data: {
            labels: <?php echo $OS['name']; ?>,
            datasets: [{
                backgroundColor: <?php echo $OS['colors']; ?>,
                data: <?php echo  $OS['count']; ?>
            }]
        },
        options: {
            title: {
                display: true,
                text: 'OS'
            }
        }

    };
    
    var pieBrowserCfg = {
        type: 'pie',
        data: {
            labels: <?php echo $browser['name']; ?>,
            datasets: [{
                backgroundColor: <?php echo $browser['colors']; ?>,
                data: <?php echo  $browser['count']; ?>
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Browser'
            }
        }

    };

    var doughnutCityCfg = {
        type: 'doughnut',
        data: {
            labels: <?php echo $City['name']; ?>,
            datasets: [{
                backgroundColor: <?php echo $City['colors']; ?>,
                data: <?php echo  $City['count']; ?>
            }]
        },
        options: {
            title: {
                display: true,
                text: 'City'
            },
            cutoutPercentage: 70
        }

    };
    
    var doughnutCountryCfg = {
        type: 'doughnut',
        data: {
            labels: <?php echo $Country['name']; ?>,
            datasets: [{
                backgroundColor: <?php echo $Country['colors']; ?>,
                data: <?php echo $Country['count']; ?>
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Country'
            },
            cutoutPercentage: 70
        }

    };

    var pieIspCfg = {
        type: 'pie',
        data: {
            labels: <?php echo $isp['name']; ?>,
            datasets: [{
                backgroundColor: <?php echo $isp['colors']; ?>,
                data: <?php echo  $isp['count']; ?>
            }]
        },
        options: {
            title: {
                display: true,
                text: 'ISP'
            }
        }

    };
    
    var doughnutDeviceCfg = {
        type: 'doughnut',
        data: {
            labels: <?php echo $Device['name']; ?>,
            datasets: [{
                backgroundColor: <?php echo $Device['colors']; ?>,
                data: <?php echo $Device['count']; ?>
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Device'
            },
            cutoutPercentage: 70
        }

    };
    
    var barDeviceCfg = {
        type: 'bar',
        data: {
            labels: <?php echo $Device['name']; ?>,
            datasets: [{
                backgroundColor: <?php echo $Device['colors']; ?>,
                data: <?php echo  $Device['count']; ?>
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Device'
            },
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            cutoutPercentage: 70,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                    }
                }]
            }
        }
    };
    </script>
@endsection


@section('header')
            <header id="header" class="linkHeader">
                <div class="overlay"></div>
                <h1>آنالیز ترافیک</h1>
            </header>
@endsection

@section('content')
  			<div id="wrapper" style="margin-top: 0; padding: 0;">
            <?php
                $countryIsEmpty = empty(json_decode($Country['name']));
                $cityIsEmpty = empty(json_decode($City['name']));
                $ispIsEmpty = empty(json_decode($isp['name']));
                $browserIsEmpty = empty(json_decode($browser['name']));
                $osIsEmpty = empty(json_decode($OS['name']));
                $deviceIsEmpty = empty(json_decode($Device['name']));
            ?>
                @if (isset($stats) && !empty($shortUrl))
                @foreach ($stats as $link)
                @if ($link->shortLink == $shortUrl)

                <?php
                    $jmonth = [];
                    for($i=1; $i <= sizeof($statMonthArray); $i++){
                        array_push($jmonth, $statMonthArray[$i]['month'].'-'.$statMonthArray[$i]['year']);
                    }
                    $jmonth = json_encode($jmonth);
                ?>
                <script type="text/javascript">
                var lineCfg = {
                    type: 'line',
                    data: {
                        labels: <?php echo $jmonth; ?>,
                        datasets: [{
                            label: 'Total',
                            data: <?php echo $allLinkViewsPerMonth; ?>,
                            backgroundColor: "rgba(153,255,51,0.4)",
                            borderColor: '#06db5e',
                            fill:false
                        }, {
                            label: 'This',
                            data: <?php echo $currentLinkViewsPerMonth; ?>,
                            backgroundColor: "rgba(255,153,0,0.4)",
                            borderColor: '#f1c40f'
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'View/Month'
                        }
                    }
                }
                </script>
                <div class="col-md-9 col-xs-12">
	  			    <div class="row">
		                <div id="statsLinkTitleBar">
  			                <div class="row">
                                <div class="col-xs-12">
                                    <div class="row"><h2 class="linkTitle">{{ $link->title }}</h2></div>
  			                        <div><h3>{{ substr($link->longLink, 0, 100) }}</h3></div>
                                </div>
                            </div>
		                    <div class="row">
		                        <div class="col-md-7 col-xs-10">
		                            <span class="shortUrl">
		                                <h2><a href="{{ URL($link->shortLink) }}" target="_blank">{{ Config::get('app.domain') ."/". $link->shortLink }}</a></h2>
		                                <button class="btn-primary" onclick="copyShortLink(this)" clipboard="{{ Config::get('app.domain') ."/". $link->shortLink }}">Copy</button>
		                                <button class="btn-primary" onclick="location.href='{{ URL('link/'. $link->shortLink .'/edit') }}'">Edit</button>
		                                <button id="shareBtn" class="btn-primary">Share
		                                    <ul id="socialShareList" class="row">
                                                <div class="arrow-top"></div>
                                                <li>
                                                    <a href="https://telegram.me/share/url?url={{ Config::get('app.domain') ."/". $link->shortLink }}&text={{ $link->title }}" target="_blank">
                                                        <span class="fa fa-paper-plane-o" style="line-height:30px; margin-left: 5px;"></span>
                                                        <span>تلگرام</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://twitter.com/home?status={{ Config::get('app.domain') ."/". $link->shortLink }}" target="_blank">
                                                        <span class="fa fa-twitter" style="line-height:30px; margin-left: 5px;"></span>
                                                        <span>توئیتر</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ Config::get('app.domain') ."/". $link->shortLink }}&title={{ $link->title }}&summary=&source=" target="_blank">
                                                        <span class="fa fa-twitter" style="line-height:30px; margin-left: 5px;"></span>
                                                        <span>لینکدین</span>
                                                    </a>
                                                </li>
                                            </ul>
		                                </button>
		                            </span>
		                        </div>
		                        <div class="col-md-5 col-xs-2">
		                            <span>
		                                <span><img src="{{ URL('img/statistics.png') }}" alt=""> </span>
                                        <span>{{ $link->views->count() }}</span>
	                                </span>
		                        </div>
	  	                    </div>
	  	                </div>
	  			                
	  	                <!-- Primary Charts -->
                        <div class="">
                            <div class="col-xs-12">
                                <div id="linkPrimaryChart" class="chart-container">
                                    <h3>بازدید از لینک</h3>
                                    <div class="table-responsive">
                                        <table>
                                            <tr><td><canvas id="id0" width="980" height="300"></canvas></td></tr>
                                        </table>
                                    </div>
                                    <script>
                                        var id0 = document.getElementById('id0').getContext('2d');
                                        new Chart(id0, lineCfg);
                                    </script>
                                </div>
                            </div>
                        </div>
		                <!-- Doughnut Charts -->
		                <div class="col-md-12 col-xs-12">
		                    <div class="row">
                            @if(!$osIsEmpty)
			                    <div class="col-md-4 col-xs-12 margin-top-30 padding-top-30">
		                            <h3>سیستم عامل</h3>
                                    <canvas id="id1" width="300" height="300" class="img-responsive" style="margin:auto;"></canvas>
                                    <script>
                                        var id1 = document.getElementById('id1').getContext('2d');
                                        new Chart(id1, pieOSCfg);
                                    </script>
		                        </div>
                            @endif
                            @if(!$browserIsEmpty)
    		                    <div class="col-md-4 col-xs-12 margin-top-30 padding-top-30">
		                            <h3>مرورگر</h3>
                                    <canvas id="id2" width="300" height="300" class="img-responsive" style="margin:auto;"></canvas>
                                    <script>
                                        var id2 = document.getElementById('id2').getContext('2d');
                                        new Chart(id2, pieBrowserCfg);
                                    </script>
                                </div>
                            @endif
                            @if(!$ispIsEmpty)
                                <div class="col-md-4 col-xs-12 margin-top-30 padding-top-30">
                                    <h3>ارائه دهنده سرویس اینترنت</h3>
                                    <canvas id="id6" width="300" height="300" class="img-responsive" style="margin:auto;"></canvas>
                                    <script>
                                        var id6 = document.getElementById('id6').getContext('2d');
                                        new Chart(id6, pieIspCfg);
                                    </script>
                                </div>
                            @endif
                            </div>
                            <div class="row">
                            @if(!$cityIsEmpty)
  			                    <div class="col-md-4 col-xs-12 margin-top-30 padding-top-30">
                                    <h3>شهر</h3>
                                    <canvas id="id3" width="300" height="300" class="img-responsive" style="margin:auto;"></canvas>
                                    <script>
                                        var id3 = document.getElementById('id3').getContext('2d');
                                        new Chart(id3, doughnutCityCfg);
                                    </script>
		                        </div>
                            @endif
                            @if(!$countryIsEmpty)
                                <div class="col-md-4 col-xs-12 margin-top-30 padding-top-30">
                                    <h3>کشور</h3>
                                    <canvas id="id4" width="300" height="300" class="img-responsive" style="margin:auto;"></canvas>
                                    <script>
                                        var id4 = document.getElementById('id4').getContext('2d');
                                        new Chart(id4, doughnutCountryCfg);
                                    </script>
                                </div>
                            @endif
                            @if(!$deviceIsEmpty)
                                <div class="col-md-4 col-xs-12 margin-top-30 padding-top-30">
                                    <h3>دستگاه ها</h3>
                                    <canvas id="id5" width="300" height="300" class="img-responsive" style="margin:auto;"></canvas>
                                    <script>
                                        var id5 = document.getElementById('id5').getContext('2d');
                                        new Chart(id5, doughnutDeviceCfg);
                                    </script>
                                </div>
                            @endif
                            </div>
		                </div>
	  			    </div>
	  			</div>
                @endif
                @endforeach
                @else
                    <div class="col-md-9" style="padding-right: 0;"></div>
                @endif

	  			<div id="linkSidebar" class="col-md-3 hidden-xs">
	  			    <div>
	  			        <ul>
                            @foreach ($stats as $link)
                            <li style="{{ ($link->shortLink == $shortUrl)?'background: #fff;':'' }}">
                                <a href="{{ URL('/link/'. $link->shortLink) }}">
                                    <p>{{ Verta($link->created_at) }}</p>
                                    <h2>{{ $link->title }}</h2>
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-md-8">
                                            <span class="shortUrl">
                                                <h3>{{ Config::get('app.domain') ."/". $link->shortLink }}</h3>
                                            </span>
                                        </div>
                                        <div class="col-md-4">
                                            <span>
                                                <span><img src="{{ URL('img/statistics.png') }}" alt=""> </span>
                                                <span>{{ $link->views->count() }}</span>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
	  			        </ul>
	  			    </div>
	  			</div>
                <div class="col-md-9" style="padding-right: 0;"></div>
	  			<div class="clear"></div>
  			</div>
@endsection

@section('slideout')
<ul class="hidden-sm hidden-md- hidden-lg">
    <div class="row">
        @foreach ($stats as $link)
            <li style="{{ ($link->shortLink == $shortUrl)?'background: #555;':'' }}">
                <a href="{{ URL('/link/'. $link->shortLink) }}">
                    <p>{{ Verta($link->created_at) }}</p>
                    @if (!empty($link->title))
                        <h2>{{ $link->title }}</h2>
                    @endif
                    <div class="row">
                        <div class="col-xs-8">
                            <span class="shortUrl">
                                <h3>{{ Config::get('app.domain') ."/". $link->shortLink }}</h3>
                            </span>
                        </div>
                        <div class="col-xs-4">
                            <span style="line-height: 20px;">
                                <span><img src="{{ URL('img/statistics.png') }}" alt=""> </span>
                                <span>{{ $link->views->count() }}</span>
                            </span>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
    </div>
</ul>
@endsection