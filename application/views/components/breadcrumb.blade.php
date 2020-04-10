<section class="content-header">
	<h1 class="text-capitalize">
		{{ ucwords(str_replace('_', ' ', $slot)) }}
		<small class="text-capitalize">{{ $subtitle }}</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="{{ base_url('admin/dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
		@foreach ($breadcrumbs as $links)
			@foreach ($links as $link => $name)
				@if (empty($link))
					<li class="text-capitalize active">
						{{ $name }}
					</li>
				@else
					<li class="text-capitalize">
						<a href="{{ base_url($link) }}">
							{{ $name }}
						</a>
					</li>
				@endif
			@endforeach
		@endforeach
	</ol>
</section>
