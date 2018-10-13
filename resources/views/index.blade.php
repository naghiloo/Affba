@extends('base')


@section('header')
        @section('navBar')
        @endsection
        
        <nav id="navbar">
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
        
        
        <header id="header">
            <div class="container">
              <div class="col-md-8 col-md-push-2">
                <div class="row hdrTitle">
                  <div>
                    <h1>با استفاده از کوتاه کننده لینک آفبا، آدرس های خود را هوشمندانه به اشتراک بگذارید</h1>
                    <p class="hidden-xs">آفبا، بزرگترین سرویس دهنده کوتاه کردن لینک و آنالیز ترافیک آماده خدمات رسانی به شماست. چشم انداز ما رضایت شماست.</p>
                  </div>
                </div>

                <div id="linkAlert">
                  <div class="alert alert-danger" id="linkAlertHidden" hidden>
                    <strong id="errorLinkText"> </strong>
                  </div>
                </div>

                <div class="row">
                  {{ csrf_field() }}
                  <div class="form-group" style="position: relative; margin-top: 30px;">
                    <input type="text" name="longLink" id="urlInput" autofocus placeholder="آدرس موردنظر را وارد کنید"/>
                    <button id="btnUrlInput">کوتاه کن</button>
                  </div>
                </div>

                <div id="linkTitleBar" class="row">
                  <div class="col-xs-12">

                  </div>
                </div>

                @if (!Auth::check())
                <form action="{{ asset('register') }}/" method="get">
                  <div id="hdrSignup" class="row">
                    <div class="col-md-6 col-md-push-3">
                      <div class="registerForm"></div>
                      <p>جهت استفاده از امکانات آنالیز ترافیک ورودی عضو شوید</p>
                      <button type="submit" class="btn btn-primary" style="padding: 10px 30px;">ثبت نام</button>
                    </div>
                  </div>
                </form>
                @else
                <div id="hdrSignup" class="row">
                  <div class="col-md-6 col-md-push-3">
                    <p>همه چیز محیاست! ما بهترین ها را برای شما خلق می کنیم.</p>
                    <a href="{{ asset('/about-us') }}" class="btn btn-primary" style="padding: 10px 30px;">بیشتر بدانید</a>
                  </div>
                </div>
                @endif

              </div>
            </div>
        </header>
@endsection


@section('content')
        <div id="wrapper">
          <section class="container">
            <div id="feature">
              <div class="row hdrTitle">
                  <div class="col-md-12">
                    <h2>ویژگی منحصر به فردی که آفبا را از همکاران متمایز می کند، نگریستن از جانب مشتریان است.</h2>
                    <p>ما معتقدیم شما لایق دریافت بهترین خدمات هستید، از این رو تیم توسعه و پشتیبانی آفبا آماده هرگونه خدمات رسانی به کاربران می باشد.</p>
                  </div>
                </div>

                <div class="row features">
                  <div class="col-md-4">
                    <div><img src="img/broken-link.png"></div>
                    <div><h2>کوتاه و سریع</h2></div>
                    <div><p>بهینه سازی در روند توسعه و پیاده سازی باعث شده است تا کاربران در کمترین زمان ممکن به لینک های مقصد انتقال یابند.</p></div>
                  </div>

                  <div class="col-md-4">
                    <div><img src="img/analytics.png"></div>
                    <div><h2>آنالیز ترافیک</h2></div>
                    <div><p>ما از ارائه هیچ خدماتی به شما دریغ نخواهیم کرد. با استفاده از سیستم آنالیز ترافیک آفبا، همه چیز تحت کنترل شماست.</p></div>
                  </div>

                  <div class="col-md-4">
                    <div><img src="img/free.png"></div>
                    <div><h2>رایگان</h2></div>
                    <div><p>گستره ی وسیعی از خدمات آفبا رایگان می باشد تا کاربران علاوه بر رفع نیازهای خود فرصت ارتباط با تیم آفبا را داشته باشند.</p></div>
                  </div>
                </div>
              </div>
              <?php /*
              <div id="media">
                <div class="col-md-8 col-md-push-2">
                  <img src="img/media.png" class="img-responsive" style="margin: 50px auto;">
                </div>
              </div>
              */ ?>
          </section>
        </div>

        <div id="linkCounter">
          <div class="overlay"></div>

          <div class="col-md-4 col-md-push-4" style="margin: 30px 0;">
            <div>
              <div id="cntrNo" class="row">
                <div style="display: inline-block;">
                  @for($i = 0; $i < count($linkNumbers); $i++)
                    @if($i+1 % 3 == 0 && $i < count($linkNumbers))
                      <span style="margin: 0 10px;">,</span>
                    @endif
                  <span class="pull-left">{{ $linkNumbers[$i] }}</span>
                  @endfor
                </div>
              </div>
              <div class="row"><h2>پیوند ساخته شده توسط ما</h2></div>
              <div class="row"><a href="{{ URL('/register') }}" class="btn btnSignup">ساخت حساب کاربری جدید</a></div>
            </div>
          </div>
        </div>
@endsection

@section('float-url')
@endsection
