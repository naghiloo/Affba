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