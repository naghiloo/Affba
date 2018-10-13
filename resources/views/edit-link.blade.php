@extends('base')

@section('head')
    <!-- Only In This Page -->
    <!-- <script type="text/javascript" src="js/chart_min.js"></script> -->
@endsection


@section('header')
    <header id="header" class="linkHeader">
        <div class="overlay"></div>
        <h1>ویرایش لینک</h1>
    </header>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-push-3 margin-top-30">
                <form action="{{ route('updateLink') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title"> عنوان </label>
                        <input id="title" type="text" class="form-control" name="title" value="{{ (old('title')) ? old('title') : $link->title }}" placeholder="عنوان">
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('shortLink') ? ' has-error' : '' }}">
                        <label for="shortLink"> لینک کوتاه </label>
                        <input readonly id="shortLink" type="text" class="form-control" name="shortLink" value="{{ (old('shortLink')) ? old('shortLink') : $link->shortLink }}" placeholder=" لینک کوتاه">
                        @if ($errors->has('shortLink'))
                            <span class="help-block">
                                <strong>{{ $errors->first('shortLink') }}</strong>
                            </span>
                        @endif
                    </div>
                    <input type="text" name="id" value="{{ $link->id }}" hidden>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-left edit-button">ثبت</button>
                        <a class="btn btn-default pull-left" href="{{ asset('link') }}/{{ $shortLink }}"> لغو </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection