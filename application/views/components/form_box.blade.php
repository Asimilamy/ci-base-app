<!-- form start -->
<form action="{{ isset($action) ? $action : base_url() }}"
	method="{{ isset($method) ? $method : 'post' }}"
	id="{{ isset($id) ? $id : 'form' }}"
	>
	<div class="box box-{{ isset($type) ? $type : 'primary' }}">
	<div class="box-header with-border">
		<h3 class="box-title text-capitalize">{{ isset($title) ? $title : 'form' }}</h3>
	</div><!-- /.box-header -->
		<div class="box-body">
			{{ $slot }}
		</div><!-- /.box-body -->
		<div class="box-footer">
			<div class="pull-right">
				<button type="reset" class="btn btn-warning">Reset</button>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>
		<div class="overlay">
			<i class="fa fa-spinner fa-pulse fa-spin fa-2x text-light-blue"></i>
		</div>
	</div>
</form>
