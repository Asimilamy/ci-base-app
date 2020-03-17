@extends('layouts.login.index')
@section('css-content')
	<link rel="stylesheet" href="{{ base_url('node_modules/jquery-toast-plugin/dist/jquery.toast.min.css') }}">
@endsection
@section('content')
	<div class="login-logo">
		<a href="{{ base_url() }}"><b>{{ APPTITLE }}</b></a>
	</div><!-- /.login-logo -->
	<div class="box box-solid">
		<div class="login-box-body box-body">
			<p class="login-box-msg">Sign in to start your session</p>
			<form action="{{ base_url() }}" method="post" id="form">
				<input type="hidden" name="{{ $csrf_name }}" value="{{ $csrf_hash }}">
				<input type="hidden" name="submit_url" value="{{ base_url('admin/auth/do_login') }}">
				<div class="form-group has-feedback">
					<input type="text" name="username" class="form-control" placeholder="Username" autofocus>
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" name="password" class="form-control" placeholder="Password">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="row">
					<div class="col-xs-4 col-xs-offset-8">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
					</div><!-- /.col -->
				</div>
			</form>
		</div>
		<div class="overlay">
			<i class="fa fa-spinner fa-pulse fa-spin fa-2x text-light-blue"></i>
		</div>
	</div><!-- /.box -->
@endsection
@section('js-content')
	<script src="{{ base_url('node_modules/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
	<script src="{{ base_url('assets/app/base.js') }}"></script>
	<script src="{{ base_url('assets/app/admin/auth/login/form.js') }}"></script>
@endsection
