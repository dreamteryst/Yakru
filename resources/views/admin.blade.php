<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Admin | Yakru</title>
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

	<link href="{{ asset('assets_admin/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
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
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<div id="app"></div>
	</div>
    <!-- end page container -->
    	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{ mix('vue/js/app.js') }}"></script>
    {{-- <script src="{{ asset('assets_admin/plugins/jquery/jquery-3.2.1.min.js') }}"></script> --}}
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
	
	<script src="{{ asset('assets_admin/plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/DataTables/extensions/Buttons/js/jszip.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
	
</body>
</html>
