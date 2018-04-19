<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Auth | Yakru</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="/assets_admin/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="/assets_admin/plugins/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" />
	<link href="/assets_admin/plugins/font-awesome/5.0/css/fontawesome-all.min.css" rel="stylesheet" />
	<link href="/assets_admin/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="/assets_admin/css/default/style.min.css" rel="stylesheet" />
	<link href="/assets_admin/css/default/style-responsive.min.css" rel="stylesheet" />
	<link href="/assets_admin/css/default/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="/assets_admin/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body class="pace-top">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<div class="login-cover">
	    <div class="login-cover-image" style="background-image: url(/assets_admin/img/login-bg/login-bg-17.jpg)" data-id="login-cover-image"></div>
	    <div class="login-cover-bg"></div>
	</div>
	<!-- begin #page-container -->
	<div id="page-container" class="fade"></div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
    <script src="/assets_admin/plugins/jquery/jquery-3.2.1.min.js"></script>
    <script src="{{ mix('vue/js/app.js') }}"></script>
	<script src="/assets_admin/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="/assets_admin/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
	<!--[if lt IE 9]>
		<script src="/assets_admin/crossbrowserjs/html5shiv.js"></script>
		<script src="/assets_admin/crossbrowserjs/respond.min.js"></script>
		<script src="/assets_admin/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="/assets_admin/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="/assets_admin/plugins/js-cookie/js.cookie.js"></script>
	<script src="/assets_admin/js/theme/default.min.js"></script>
    <script src="/assets_admin/js/apps.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="/assets_admin/js/demo/login-v2.demo.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
			LoginV2.init();
		});
	</script>
</body>
</html>
