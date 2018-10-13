@extends('base')

@section('content')
<div id="wrapper" style="margin-top: 0px;">
    <section id="singlePage" class="container">
	    <div id="singlePageTitle"><h1>سوالات متداول</h1></div>

	    <div class="row">
	    	<div class="col-md-4">
	    		<div>
	    			<div class="featuredBox">
	    				<div class="boxContent">
	    					<h4>سوال دیگری دارید ؟ بپرسید!</h4>

	    					@if ($errors->any())
	    					<ul>
	    						@foreach ($errors->all() as $error)
	    						<li>{{ $error }}</li>
	    						@endforeach
	    					</ul>
	    					@endif

							<div class="row flash-message">
								@foreach (['danger', 'warning', 'success', 'info'] as $msg)
									@if(Session::has('alert-' . $msg))

										<p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
									@endif
								@endforeach
							</div> <!-- end .flash-message -->

	    					<form method="POST" action="{{ URL('faq') }}">
	    						{{ csrf_field() }}
	    						<input type="hidden" name="subject" value="faq">

	    						<div class="row">
	    							<div class="form-group">
	    								<input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="آدرس ایمیل" />
	    							</div>
	    						</div>

	    						<div class="row">
	  		  						<div class="form-group">
	    								<input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="شماره تماس" />
	    							</div>
	    						</div>

	    						<div class="row">
	    							<div class="form-group">
	    								<textarea class="form-control" name="message">{{ old('message') }}</textarea>
	    							</div>
	    						</div>

	    						<div class="row">
	    							<div class="form-group">
	    								<input type="submit" name="sendFAQ" class="btn btn-primary form-control" value="ارسال" />
	    							</div>
	    						</div>
	    					</form>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
	    	<div class="col-md-8">
	    		<div>
	    			<div class="faqQuestion">
	    				<h2>آفبا چیست؟</h2>
	    				<div class="faqAnswer">
	    					<p>آفبا سرویس کوتاه سازی لینک می باشد که امکان اشتراک گذاری، مدیریت و آنالیز پیوندهای دلخواهتان را می دهد.</p>
	    					<p>در صورت تمایل به مدیریت و آنالیز لینک های خود ثبت نام کنید. با ثبت نام امکان مشاهده تعداد کلیک ها و اطلاعات جامع دیگری را برای هر پیوند خواهید داشت.</p>
	    				</div>
	    			</div>

	    			<div class="faqQuestion">
	    				<h2>برای استفاده نیاز به ثبت نام دارم؟</h2>
	    				<div class="faqAnswer">
	    					<p>استفاده از خدمات کوتاه سازی لینک به صورت رایگان در اختیار میهمانان قرار گرفته است. آفبا به شما پیشنهاد میک ند جهت برخورداری از سایر امکانات و آنالیز ترافیک ورودی لینک های خود حتما ثبت نام نموده تا علاوه بر مشاهده لیست آدرس های کوتاه شده و آنالیز آنها، از سایر خدمات نیز بهره مند گردید.</p>
	    				</div>
	    			</div>

	    			<div class="faqQuestion">
	    				<h2>آفبا چگونه کار می کند؟</h2>
	    				<div class="faqAnswer">
	    					<p>ما با ارائه یک آدرس کوتاه اختصاصی در ازای هر لینک امکان انتقال کاربران به مقاصد از پیش تعریف شده را مهیا می سازیم. با ورود کاربر به لینک کوتاه شما، آدرس مقصد متناظر با آن لینک از پایگاه داده واکشی شده و کاربر به مقصد انتقال(ریدایرکت) می یابد.</p>
	    				</div>
	    			</div>

	    			<div class="faqQuestion">
	    				<h2>تاثیر آفبا روی سئوی لینک ها چیست؟</h2>
	    				<div class="faqAnswer">
	    					<p>از آنجاییکه تمامی انتقال های کاربران با ریدایرکت 301 انجام می شود، لذا استفاده از خدمات آفبا هیچ تاثیر منفی روی سئوی سایت شما نخواهد داشت.</p>
	    				</div>
	    			</div>

					<div class="faqQuestion">
	    				<h2>چه اطلاعاتی از بازدیدکنندگان ذخیره می شود؟</h2>
	    				<div class="faqAnswer">
	    					<p>آفبا خود را موظف می داند تا تمام روندها و سیاست های برخورد با کاربران را به ایشان اطلاع رسانی کند. از این رو به اطلاع می رساند با بازدید مخاطبین شما، اطلاعاتی چون شهر، کشور، مرورگر، سرویس دهنده اینترنت و ... در پایگاه داده ما ذخیره می شوند. آفبا از این اطلاعات جهت ارائه آنالیز استفاده آماری جهت افزایش سطح خدمات استفاده می کند. بدیهی است که آفبا در حد توان سخت افزاری و نرم افزاری خود در راستای حفاظت از اطلاعات شما می کوشد و تمام سعی خود را جهت بروزرسانی مداوم سیستم به عمل می آورد.</p>
	    				</div>
	    			</div>

					<div class="faqQuestion">
	    				<h2>آیا اطلاعات شخصی مخاطبین هم ذخیره می شود؟</h2>
	    				<div class="faqAnswer">
	    					<p>آفبا هیچگونه دسترسی به اطلاعات شخصی مخاطبین شما اعم از پسوردها، تاریخچه بازدید سایت ها، فایل های روی سیستم ایشان، ایمیل ها و ... نداشته و تنها اطلاعات مذکور که جنبه ی استفاده ی آماری دارند را ذخیره سازی می کند.</p>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
	    </div>

	</section>
</div>
@endsection