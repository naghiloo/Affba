@extends('base')

@section('content')
<div id="wrapper" style="margin-top: 0px;">
    <section id="singlePage" class="container">
    	<div id="singlePageTitle"><h1>تماس با ما</h1></div>

    	<div class="row">
    		<div class="col-md-6">
    			<h4>با ما در ارتباط باشید!</h4>
    			<p>
    				در صورت وجود هرگونه سوال در مورد نحوه استفاده، پیشنهادات، انتقادات و شکایات، مارا از طریق درگاه های ارتباطی این صفحه مطلع سازید.	
    			</p>

    			<hr class="fadeLine">

    			<h4>اطلاعات تماس</h4>

    			<ul id="contactsLst">
    				<?php /*
					<li>
    					<i class="fa fa-phone"></i>
    					<span>شماره تماس: </span>
    					<span>09129389350</span>
    				</li>
 					*/ ?>

    				<li>
    					<i class="fa fa-envelope"></i>
    					<span>آدرس ایمیل: </span>
    					<span>info[at]Affba.ir</span>
    				</li>

					<li>
						<i class="fa fa-film"></i>
						<span>آپارات: </span>
						<span><a href="http://aparat.com/affba/">Affba</a> </span>
					</li>
					<li>
						<i class="fa fa-twitter"></i>
						<span>توئیتر: </span>
						<span><a href="https://twitter.com/affba_ir/">Affba_ir</a> </span>
					</li>

					<li>
						<i class="fa fa-paper-plane-o"></i>
						<span>تلگرام: </span>
						<span><a href="https://t.me/affba_ir/">Affba_ir</a> </span>
					</li>

					<li>
						<i class="fa fa-instagram"></i>
						<span>اینستاگرام: </span>
						<span><a href="https://instagram.com/affba_ir/">Affba_ir</a> </span>
					</li>
    			</ul>
    			<hr class="fadeLine">
    		</div>

    		<div class="col-md-6">
				<div class="flash-message">
					@foreach (['danger', 'warning', 'success', 'info'] as $msg)
						@if(Session::has('alert-' . $msg))

							<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
						@endif
					@endforeach
				</div> <!-- end .flash-message -->

	    		<form method="POST" action="{{ URL('contact') }}" id="contactForm">
					{{ csrf_field() }}
					<div class="row">
						<div class="form-group">

							<div class="col-md-12">
								<input type="text" name="subject" placeholder="عنوان پیام" class="form-control" value="{{ old('subject') }}" required>
							</div>
						</div>
					</div>

					<div class="row">
	    				<div class="form-group">
							<div class="col-md-6">
								<input type="text" name="phone" placeholder="شماره تماس" class="form-control" value="{{ old('phone') }}" required>
							</div>

	    					<div class="col-md-6">
	    						<input type="text" name="email" placeholder="آدرس ایمیل" class="form-control" value="{{ old('email') }}" required>
	    					</div>
	    				</div>
	    			</div>

	    			<div class="row">
	    				<div class="form-group">
	    					<div class="col-md-12">
	    						<textarea name="message" class="form-control">{{ old('message') }}</textarea>
	    					</div>
	    				</div>
	    			</div>

	    			<div class="row">
	    				<div class="form-group">
	    					<div class="col-md-12">
	    						<input type="submit" name="sendMsg" value="ارسال پیام" class="btn btn-primary form-control" />
	    					</div>
	    				</div>
	    			</div>
	    		</form>		
    		</div>
    	</div>
	</section>
</div>
@endsection