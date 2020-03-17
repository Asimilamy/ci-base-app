<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ APPTITLE }} | Dashboard</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="{{ base_url('assets/AdminLTE-2.3.0/bootstrap/css/bootstrap.min.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ base_url('assets/AdminLTE-2.3.0/bootstrap/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="{{ base_url('assets/AdminLTE-2.3.0/bootstrap/fonts/ionicons-2.0.1/css/ionicons.min.css') }}">
	@yield('css-content')
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ base_url('assets/AdminLTE-2.3.0/dist/css/AdminLTE.min.css') }}">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="{{ base_url('assets/AdminLTE-2.3.0/dist/css/skins/_all-skins.min.css') }}">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<input type="hidden" name="get_user_menu_url" value="{{ base_url('admin/system/menu/get_user_menu') }}">
	<div class="wrapper">
		@include('layouts.admin.main_header')
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="{{ base_url('assets/AdminLTE-2.3.0/dist/img/user2-160x160.jpg') }}" class="img-circle"
							alt="User Image">
					</div>
					<div class="pull-left info">
						<p>{{ $_SESSION['auth']['name'] }}</p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu text-capitalize"></ul>
			</section>
		</aside>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			@yield('breadcrumb')

			<!-- Main content -->
			<section class="content">
				@yield('content')
			</section><!-- /.content -->
		</div><!-- /.content-wrapper -->
		@include('layouts.admin.main_footer')
		@include('layouts.admin.control_sidebar')
		<!-- Control Sidebar -->
	</div><!-- ./wrapper -->

	<!-- jQuery 3.3.1 -->
	<script src="{{ base_url('assets/AdminLTE-2.3.0/plugins/jQuery/jQuery-3.3.1.min.js') }}"></script>
	<!-- Bootstrap 3.3.5 -->
	<script src="{{ base_url('assets/AdminLTE-2.3.0/bootstrap/js/bootstrap.min.js') }}"></script>
	<!-- Slimscroll -->
	<script src="{{ base_url('assets/AdminLTE-2.3.0/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
	<!-- FastClick -->
	<script src="{{ base_url('assets/AdminLTE-2.3.0/plugins/fastclick/fastclick.min.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ base_url('assets/AdminLTE-2.3.0/dist/js/app.min.js') }}"></script>
	<!-- POS APP BASE JS -->
	<script src="{{ base_url('assets/app/base.js') }}"></script>
	@yield('js-content')
</body>

</html>
