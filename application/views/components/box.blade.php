<div class="box box-{{ isset($type) ? $type : 'primary' }}">
    <div class="box-header with-border">
        <h3 class="box-title text-capitalize">
            {{ isset($title) ? $title : 'box' }}
        </h3>
    </div>
    <div class="box-body">
        {{ $slot }}
    </div>
    @if (isset($overlay))
        <div class="overlay">
            <i class="fa fa-spinner fa-pulse fa-spin fa-2x text-light-blue"></i>
        </div>
    @endif
</div>
