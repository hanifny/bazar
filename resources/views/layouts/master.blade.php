<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
    <title>Persari Raharja</title>
	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="{{asset('bazar/images/logo.svg')}}">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	
	<!-- StyleSheet -->
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{asset('bazar/css/bootstrap.css')}}">
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="{{asset('bazar/css/magnific-popup.min.css')}}">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bazar/css/font-awesome.css')}}">
	<!-- Fancybox -->
	<link rel="stylesheet" href="{{asset('bazar/css/jquery.fancybox.min.css')}}">
	<!-- Themify Icons -->
    <link rel="stylesheet" href="{{asset('bazar/css/themify-icons.css')}}">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{asset('bazar/css/niceselect.css')}}">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('bazar/css/animate.css')}}">
	<!-- Flex Slider CSS -->
    <link rel="stylesheet" href="{{asset('bazar/css/flex-slider.min.css')}}">
	<!-- Owl Carousel -->
    <link rel="stylesheet" href="{{asset('bazar/css/owl-carousel.css')}}">
	<!-- Slicknav -->
    <link rel="stylesheet" href="{{asset('bazar/css/slicknav.min.css')}}">
	
	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="{{asset('bazar/css/reset.css')}}">
	<link rel="stylesheet" href="{{asset('bazar/style.css')}}">
    <link rel="stylesheet" href="{{asset('bazar/css/responsive.css')}}">	
	
</head>
<body class="js">
	
	<!-- Preloader -->
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- End Preloader -->

    @include('layouts.partials.header')
    @include('layouts.partials.slider')
    @yield('content')
    @include('layouts.partials.footer')

	<!-- Jquery -->
    <script src="{{asset('bazar/js/jquery.min.js')}}"></script>
    <script src="{{asset('bazar/js/jquery-migrate-3.0.0.js')}}"></script>
	<script src="{{asset('bazar/js/jquery-ui.min.js')}}"></script>
	<!-- Popper JS -->
	<script src="{{asset('bazar/js/popper.min.js')}}"></script>
	<!-- Bootstrap JS -->
	<script src="{{asset('bazar/js/bootstrap.min.js')}}"></script>
	<!-- Color JS -->
	<script src="{{asset('bazar/js/colors.js')}}"></script>
	<!-- Slicknav JS -->
	<script src="{{asset('bazar/js/slicknav.min.js')}}"></script>
	<!-- Owl Carousel JS -->
	<script src="{{asset('bazar/js/owl-carousel.js')}}"></script>
	<!-- Magnific Popup JS -->
	<script src="{{asset('bazar/js/magnific-popup.js')}}"></script>
	<!-- Waypoints JS -->
	<script src="{{asset('bazar/js/waypoints.min.js')}}"></script>
	<!-- Countdown JS -->
	<script src="{{asset('bazar/js/finalcountdown.min.js')}}"></script>
	<!-- Nice Select JS -->
	<script src="{{asset('bazar/js/nicesellect.js')}}"></script>
	<!-- Flex Slider JS -->
	<script src="{{asset('bazar/js/flex-slider.js')}}"></script>
	<!-- ScrollUp JS -->
	<script src="{{asset('bazar/js/scrollup.js')}}"></script>
	<!-- Onepage Nav JS -->
	<script src="{{asset('bazar/js/onepage-nav.min.js')}}"></script>
	<!-- Easing JS -->
	<script src="{{asset('bazar/js/easing.js')}}"></script>
	<!-- Active JS -->
	<script src="{{asset('bazar/js/active.js')}}"></script>
    @stack('scripts')
</body>
</html>