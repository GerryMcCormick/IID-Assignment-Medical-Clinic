<?php $currenturl = Request::url(); $url = Request::root(); ?>
<!DOCTYPE html>
<html lang="en" id="top" class="css-preload">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="description" content="">

		<?php
			$encrypter = app('Illuminate\Encryption\Encrypter');
			$encrypted_token = $encrypter->encrypt(csrf_token());
		?>
		<input id="token" type="hidden" value="{{$encrypted_token}}">

		<link rel="prerender" href="{{$currenturl}}">

		<title>@if(isset($page))Ballydale Medical Clinic | {{ $page }}@else Ballydale Medical Clinic @endif</title>

		<link rel="stylesheet" href="{{$url}}/css/app.css" type="text/css">
		<link rel="stylesheet" href="{{$url}}/css/jquery-ui.min.css" type="text/css">
		<link rel="stylesheet" href="{{$url}}/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="{{$url}}/css/animate.css" type="text/css">
		<link rel="stylesheet" href="{{$url}}/css/carousel.css" type="text/css">

		<link rel="canonical" href="{{$currenturl}}">
	</head>

	@if(isset($bodyid))
		@if(isset($bodyid) && $bodyid == "home")
	<body id="{{$bodyid}}">
		@else
	<body id="{{$bodyid}}" class="header-active">
		@endif
	@else
	<body>
	@endif

	{{--<div class="mask active"></div>--}}
    <div class="wrapper">
		@if(isset($bodyid) && $bodyid == "home")
		<header class="row site-header">
		@else
		<header class="row site-header fixed">
		@endif
			{{--<div class="logo"><!--<a class="icon-home radial-btn" href="/"></a>--><a href="/"><img class="light" src="/img/wia-logo-wht.svg" alt="wia-logo-white-small"><img class="dark" src="/img/wia-logo-blk.svg" alt="wia-logo-black-small"></a></div>--}}
			<div class="container nav-container">
				<div class="column _2 r">
					<ul class="site-nav">
						@include('navlist')
					</ul>
				</div>
			</div>
			{{--<div class="contact"><a href="/contact"><img class="light" src="/img/info-icon-light.png" /> <img class="dark" src="/img/info-icon.png" /></a></div>--}}
			<div class="nav-open icon-menu radial-btn"></div>

			<div class="nav-close radial-btn long"><span class="icon-back"></span><div class="label">Back</div></div>
		</header>

		<div class="content-div">
			<div class="bg-overlay">
				<div class="heading">
					@include('flash::message')
					<h1>Ballydale Medical Clinic</h1>
					@if(isset($page))
						<h3>{{ $page }}</h3>
					@endif
					<hr class="home-divider">
				</div>

				<div class="container">
					<div class="row">
						<div id="loading-spinner" class="col-md-12"></div>
					</div>
				</div>

				<div id="yield-content">
					@yield('content')
				</div>

			</div>
		</div>

		<footer>
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<p>21 Ballydale Street</p>
						<p>Ballydale</p>
						<p>BT48 123</p>
						{{--<li><a href="https://www.google.co.uk/maps/dir/''/21+Talbot+St,+Belfast+BT1+2LD/@54.6024588,-5.9323151,16z/data=!3m1!4b1!4m8!4m7!1m0!1m5!1m1!1s0x48610853e2cd47c1:0x29492448e8f10728!2m2!1d-5.9279377!2d54.6024589">Find us on Google Maps</a></li>--}}
					</div>
					<div class="col-lg-6">
						<p>+44 (0) 28 7131 9526</p>
						<p>+44 (0) 28 7131 9532</p>
						<p><a href="mailto:admin@ballydale.com">Send us an email</a></p>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<span>Copyright &copy; <?php echo date("Y"); ?> Ballydale Medical Clinic. All rights reserved.</span>
					</div>
				</div>
			</div>
		</footer>

	</div>

    {{--<a class="scroll-top radial-btn long" href="#top"><!--<span class="title">Back to top</span>--><span class="icon-up"></span></a>--}}

    {{--<script src="{{$url}}/js/vendor.js" type="text/javascript"></script>--}}
    <script src="{{$url}}/js/jquery2.2.1.min.js" type="text/javascript"></script>
    <script src="{{$url}}/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{$url}}/js/jquery-ui.min.js" type="text/javascript"></script>

	<script src="{{$url}}/js/app.js" type="text/javascript"></script>
	<script src="{{$url}}/js/carousel.js" type="text/javascript"></script>

	<script>
		$(function() {
			$( "#datepicker" ).datepicker({
				changeMonth: true,
				changeYear: true,
				maxDate: 0,
				yearRange: "1940:2016",
				dateFormat: "DD, d MM, yy"
			});
		});
	</script>
	{{--</div>--}}
    </body>
</html>