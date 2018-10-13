<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="کوتاه کننده و آنالیزور لینک آفبا">
    <meta name="keywords" content="url, url shortener, کوتاه کننده لینک, کوتاه کردن لینک, ">
    <meta name="author" content="Alfa Team">
    <meta name="theme-color" content="#ea5a1b" />
    <meta http-equiv="cleartype" content="on">
    <meta name="MobileOptimized" content="320">
    <meta name="HandheldFriendly" content="True">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    
	<link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/gif" sizes="16x16">
	<title>کوتاه کننده لینک و آنالیز ترافیک آفبا | Affba</title>
	
	{!! Html::style('css/bootstrap.css') !!}
    {!! Html::style('css/style.css') !!}
	
	@yield('head')
	
</head>
<body>
	<nav id="menu">
        <div class="hidden-sm hidden-md hidden-lg">
            @include('layouts.inc.topMenu')
        </div>
        
        @yield('slideout')
        
    </nav>
     
	<div id="panel" class="container-fluid">
  	    <div class="row">
  	        <div id="overlay" class="overlay"></div>
	        @section('navBar')
	            <nav id="topMenu" style="background: #fff; border-bottom: 1px #e5e5e5 solid;">
                    <div class="container">
                        @if (Auth::check())
                            @include('auth.logout')
                        @else
                            @include('layouts.inc.sign')
                        @endif
                  	 	    <span class="hidden-md hidden-lg" style="position: absolute;z-index: 1;"><i id="swapIcon" class="fa fa-bars"></i></span> 
                  	 	    <div class="col-md-9 hidden-xs">
                  	 	        @include('layouts.inc.topMenu')
                  	 	    </div>
                  	 </div>
                </nav>
      		@show
      		
  	  		@yield('header')
  	  		
  	  	    @yield('content')
  	  	    
  	  	   <footer>
  				<div class="container">
  					<div id="footer">
  						<ul class="col-md-6 col-xs-12">
						<?php /*
						  <li><a href="/">خانه</a></li>
						  <!--<li><a href="">وبلاگ</a></li>-->
						  <li><a href="{{ URL('/faq') }}">سوالات متداول</a></li>
						  <li><a href="{{ URL('/terms') }}">قوانین</a></li>
						  <li><a href="{{ URL('/about-us') }}">درباره ما</a></li>
						  <li><a href="{{ URL('/contact') }}">تماس با ما</a></li>
 						*/ ?>
						  <li><a href="http://aparat.com/affba" target="_blank"><i class="fa fa-film"></i></a></li>
						  <li><a href="https://twitter.com/affba_ir" target="_blank"><i class="fa fa-twitter"></i></a></li>
						  <li><a href="https://instagram.com/affba_ir" target="_blank"><i class="fa fa-instagram"></i></a></li>
						  <li><a href="https://t.me/affba_ir"target="_blank"><i class="fa fa-paper-plane-o"></i></a></li>
  	  				    </ul>

  	  					<div class="col-md-6 col-sm-12"><p style="line-height: 40px;">تمامی حقوق مادی و معنوی این وبسایت برای دارندگان آن محفوظ می باشد</p></div>
  					</div>
  				</div>
  			</footer>
  		</div>
    </div>
	
@section('float-url')
	<!-- Float Button -->
	<button id="shortenerFloat" type="button" data-toggle="modal" data-target="#shortener"><i class="fa fa-link"></i></button>
	<div id="shortener" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close pull-left" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">کوتاه کننده لینک آفبا</h4>
				</div>
				<div class="modal-body">
					<div class="row hdrTitle">
						<div class="col-md-12">
							<h1>همه جا در دسترس شماییم!</h1>
							<p>آفبا، بزرگترین سرویس دهنده کوتاه کردن لینک و آنالیز ترافیک آماده خدمات رسانی به شماست. چشم انداز ما رضایت شماست.</p>
						</div>
					</div>
					<div id="linkAlert" class="margin-top-30">
						<div class="alert alert-danger" id="linkAlertHidden" hidden>
							<strong id="errorLinkText"> </strong>
						</div>
					</div>
					<div>
						{{ csrf_field() }}
						<div class="form-group" style="position: relative; margin-top: 30px;">
							<input type="text" name="longLink" id="urlInput" autofocus placeholder="آدرس موردنظر را وارد کنید"/>
							<button id="btnUrlInput" style="color: #fff;">کوتاه کن</button>
						</div>
					</div>
		
					<div id="linkTitleBar" class="row">
    					<div class="col-xs-12"></div>
					</div>
		
				</div>
		    	<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">بستن</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End Of Float Button -->
@show
		    
    @yield('foot')
    
	{{-- <script type="text/javascript" src="{{ URL('js/popper.js') }}"></script> --}}
	<script type="text/javascript" src="{{ URL('js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL('js/bootstrap.js') }}"></script>
	<script src="{{ URL('js/slideout.js') }}"></script>
	<script>
        var slideout = new Slideout({
            'panel': document.getElementById('panel'),
            'menu': document.getElementById('menu'),
            'padding': 256,
            'tolerance': 70,
            'side': 'right',
            'touch': false
        });
        // Then, use the slideout `open` and `close` events
        slideout.once('open', slideout._initTouchEvents);
        slideout.on('open', slideout.enableTouch);
        slideout.on('close', slideout.disableTouch);
    </script> 
    <script type="text/javascript" src="{{ URL('js/script.js') }}"></script>
</body>
</html>
