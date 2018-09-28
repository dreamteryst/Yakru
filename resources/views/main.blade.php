<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<!-- <base href="http://yakru.test"> -->
	<meta charset="utf-8" />
	<title>Home | Yakru</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="แหล่งเรียนรู้ออนไลน์ การเขียนโปรแกรม การสร้างเว็บไซต์ แอปพลิเคชันต่าง ๆ รวมอยู่ที่นี่แล้ว" name="description" />
    <meta content="DreaMTeryST" name="author" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png') }}">
	<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png') }}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png') }}">
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png') }}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
	<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
	<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
	<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">
	<link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicon/android-icon-192x192.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
	<link rel="manifest" href="{{ asset('favicon/manifest.json') }}">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
	<meta name="theme-color" content="#ffffff">
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link href="{{ asset('assets/plugins/bootstrap3/css/bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/animate/animate.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('vue/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vue/css/app.css') }}" rel="stylesheet" type="text/css">
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{ asset('assets/plugins/pace/pace.min.js') }}"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
    <!-- BEGIN #page-container -->
    <div id="page-container" class="fade">
		<div id="app"></div>
	</div>
    <!-- END #page-container -->
	<script src="https://cdn.bootcss.com/flv.js/1.4.0/flv.min.js"></script>
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{ asset('vue/js/app.js') }}"></script>
	{{-- <script src="{{ asset('assets/plugins/jquery/jquery-3.2.1.min.js') }}"></script> --}}
	<script src="{{ asset('assets/plugins/bootstrap3/js/bootstrap.min.js') }}"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="{{ asset('assets/plugins/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('assets/js/e-commerce/apps.min.js') }}"></script>
	<!-- ================== END BASE JS ================== -->
	
	<script>
	    $(document).ready(function() {
	        App.init();
	    });
	</script>
</body>
</html>
