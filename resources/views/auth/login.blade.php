@extends('base')

@section('content')
    <div id="wrapper" style="margin-top: 40px;">
        <section class="container">
            <div class="col-md-4 col-md-push-4">
                <div id="signPage">
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group hdrTitle"><h1>ورود به حساب کاربری</h1></div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" style="direction:ltr;" placeholder="پست الکترونیکی" autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input id="password" type="password" class="form-control" name="password" style="direction:ltr;" placeholder="رمز عبور">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    <!--
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> مرا به یاد داشته باش
                                </label>
                            </div>
                        </div>
                    </div>
                    -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary form-control">ورود</button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                رمز خود را فراموش کرده اید؟
                            </a>
                        </div>
                    </form>
                    <hr>

                    <div style="padding: 20px 0;">
                        <div class="form-group hdrTitle"><h1>ساخت حساب کاربری</h1></div>
                        <div class="form-group" style="text-align: center;"><h1>عضو شوید و از امکانات استفاده کنید</h1></div>
                        <span><a class="btn btnSignup col-xs-6 col-xs-push-3" href="<?php echo Url('register'); ?>">ثبت نام</a></span>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
