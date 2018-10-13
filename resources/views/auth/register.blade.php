
@extends('base')

@section('content')
    <div id="wrapper" style="margin-top: 40px;">
        <section class="container">
            <div class="col-md-4 col-md-push-4">
                <div id="signPage">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group hdrTitle"><h1>ساخت حساب کاربری</h1></div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="نام و نام خانوادگی">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" style="direction:ltr;" placeholder="پست الکترونیکی">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" class="form-control" name="password" style="direction:ltr;" placeholder="رمز عبور" >
                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>

                        @if($shortLinks)
                            @foreach($shortLinks as $shortLink)
                            <input hidden name="shortLink[]" value="{{ $shortLink }}">
                            @endforeach
                        @endif

                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" style="direction:ltr;" placeholder="تکرار رمز عبور">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary form-control">ثبت نام</button>
                        </div>
                    </form>
                    <hr>

                    <div style="padding: 20px 0;">
                        <div class="form-group hdrTitle"><h1>ورود به حساب کاربری</h1></div>
                        <div class="form-group" style="text-align: center;"><h1>جهت مشاهده و آنالیز لینک های خود وارد شوید</h1></div>
                        <span><a class="btn btnSignup col-md-6 col-md-push-3" href="<?php echo Url('login'); ?>">ورود</a></span>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
