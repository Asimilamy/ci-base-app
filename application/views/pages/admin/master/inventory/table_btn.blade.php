<div class="btn-group">
	<button type="button" class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		Option <span class="caret"></span>
	</button>
	<ul class="dropdown-menu">
		<li>
			<a href="javascript:void(0);" title="View Data" onclick="viewData('{{ $id }}')">
				<i class="fa fa-eye"></i> View Data
			</a>
		</li>
		<li>
			<a href="javascript:void(0);" title="Edit Data" onclick="editData('{{ $id }}')">
				<i class="fa fa-pencil"></i> Edit Data
			</a>
		</li>
		<li class="divider"></li>
		<li>
			<form action="{{ base_url() }}" method="post">
				<input type="hidden" name="{{ $csrf_name }}" value="{{ $csrf_hash }}">
				<input type="hidden" name="id" value="{{ $id }}">
			</form>
			<a href="javascript:void(0);" title="Delete Data" onclick="return confirm('Are you sure to delete data?') ? deleteData(this, '{{ $id }}') : false ;">
				<i class="fa fa-trash"></i> Delete Data
			</a>
		</li>
	</ul>
</div>
