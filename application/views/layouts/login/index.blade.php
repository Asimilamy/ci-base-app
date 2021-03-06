<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ APPTITLE }} | Log in</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="{{ base_url('assets/AdminLTE-2.3.0/bootstrap/css/bootstrap.min.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet"
		href="{{ base_url('assets/AdminLTE-2.3.0/bootstrap/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	@yield('css-content')
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ base_url('assets/AdminLTE-2.3.0/dist/css/AdminLTE.min.css') }}">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		@yield('content')
	</div><!-- /.login-box -->

	<!-- jQuery 2.1.4 -->
	<script src="{{ base_url('assets/AdminLTE-2.3.0/plugins/jQuery/jQuery-3.3.1.min.js') }}"></script>
	<!-- Bootstrap 3.3.5 -->
	<script src="{{ base_url('assets/AdminLTE-2.3.0/bootstrap/js/bootstrap.min.js') }}"></script>
	@yield('js-content')
</body>

</html>
