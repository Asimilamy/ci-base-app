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
		<ul class="sidebar-menu text-capitalize">
			<li class="header">MAIN NAVIGATION</li>
			<li>
				<a href="{{ base_url('admin/dashboard') }}">
					<i class="fa fa-dashboard"></i> <span>dashboard</span>
				</a>
			</li>
			<li>
				<a href="{{ base_url('admin/profile') }}">
					<i class="fa fa-user"></i> profile
				</a>
			</li>
			<li class="treeview">
				<a href="javascript:void(0);">
					<i class="fa fa-gears"></i>
					<span>system</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li>
						<a href="{{ base_url('admin/system/user') }}">
							<i class="fa fa-circle-o"></i> user
						</a>
					</li>
					<li>
						<a href="{{ base_url('admin/system/menu') }}">
							<i class="fa fa-circle-o"></i> app menu
						</a>
					</li>
					<li>
						<a href="{{ base_url('admin/system/privilege') }}">
							<i class="fa fa-circle-o"></i> privilege
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
