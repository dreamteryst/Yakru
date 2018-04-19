<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Color Admin | Dashboard v2</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/bootstrap/4.0.0/css/bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/font-awesome/5.0/css/fontawesome-all.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/animate/animate.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/css/default/style.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/css/default/style-responsive.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_admin/css/default/theme/default.css') }}" rel="stylesheet" id="theme" />
    <link href="{{ mix('vue/css/app.css') }}" rel="stylesheet" type="text/css">
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
    <link href="{{ asset('assets_admin/plugins/jquery-jvectormap/jquery-jvectormap.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_admin/plugins/bootstrap-calendar/css/bootstrap_calendar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_admin/plugins/gritter/css/jquery.gritter.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_admin/plugins/nvd3/build/nv.d3.css') }}" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{ asset('assets_admin/plugins/pace/pace.min.js') }}"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
    <!-- end #page-loader -->
    
    <!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">admin</div>
    <!-- end page container -->
    	
	<!-- ================== BEGIN BASE JS ================== -->
    <script src="{{ asset('assets_admin/plugins/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ mix('vue/js/app.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/bootstrap/4.0.0/js/bootstrap.bundle.min.js') }}"></script>
	<!--[if lt IE 9]>
		<script src="{{ asset('assets_admin/crossbrowserjs/html5shiv.js') }}"></script>
		<script src="{{ asset('assets_admin/crossbrowserjs/respond.min.js') }}"></script>
		<script src="{{ asset('assets_admin/crossbrowserjs/excanvas.min.js') }}"></script>
	<![endif]-->
	<script src="{{ asset('assets_admin/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/js-cookie/js.cookie.js') }}"></script>
	<script src="{{ asset('assets_admin/js/theme/default.min.js') }}"></script>
	<script src="{{ asset('assets_admin/js/apps.min.js') }}"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.2/d3.min.js"></script>
    <script src="{{ asset('assets_admin/plugins/nvd3/build/nv.d3.js') }}"></script>
    <script src="{{ asset('assets_admin/plugins/jquery-jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('assets_admin/plugins/jquery-jvectormap/jquery-jvectormap-world-merc-en.js') }}"></script>
    <script src="{{ asset('assets_admin/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/gritter/js/jquery.gritter.js') }}"></script>
    <script src="{{ asset('assets_admin/js/demo/dashboard-v2.min.js') }}"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			DashboardV2.init();
		});
	</script>
	
</body>
</html>
