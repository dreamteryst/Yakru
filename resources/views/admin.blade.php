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
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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

	<link href="{{ asset('assets_admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/ionRangeSlider/css/ion.rangeSlider.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/password-indicator/css/password-indicator.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/bootstrap-combobox/css/bootstrap-combobox.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/jquery-tag-it/css/jquery.tagit.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets_admin/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css') }}" rel="stylesheet" />

	<link href="{{ asset('assets_admin/plugins/fullcalendar/fullcalendar.print.css') }}" rel="stylesheet" media='print' />
	<link href="{{ asset('assets_admin/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" />
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

	<script src="{{ asset('assets_admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/masked-input/masked-input.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/password-indicator/js/password-indicator.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/bootstrap-combobox/js/bootstrap-combobox.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/jquery-tag-it/js/tag-it.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/bootstrap-daterangepicker/moment.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/select2/dist/js/select2.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/bootstrap-show-password/bootstrap-show-password.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/clipboard/clipboard.min.js') }}"></script>
	<script src="{{ asset('assets_admin/plugins/fullcalendar/fullcalendar.min.js') }}"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
	
</body>
</html>
