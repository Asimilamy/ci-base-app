<div class="col-xs-12">
    <div class="row">
        <label for="name" class="col-xs-2 text-capitalize">name</label>
        <div class="col-xs-10"><?php echo empty_string($row->name, '-'); ?></div>
    </div>
    <div class="row">
        <label for="table" class="col-xs-2 text-capitalize">table</label>
        <div class="col-xs-10"><?php echo empty_string($row->table, '-'); ?></div>
    </div>
    <div class="row">
        <label for="column" class="col-xs-2 text-capitalize">column</label>
        <div class="col-xs-10"><?php echo empty_string($row->column, '-'); ?></div>
    </div>
    <div class="row">
        <label for="format" class="col-xs-2 text-capitalize">format</label>
        <div class="col-xs-10"><?php echo empty_string($row->format, '-'); ?></div>
    </div>
    <div class="row">
        <label for="on_reset" class="col-xs-2 text-capitalize">on reset</label>
        <div class="col-xs-10"><?php echo empty_string(ucwords($row->on_reset), '-'); ?></div>
    </div>
    <div class="row">
        <label for="code_sample" class="col-xs-2 text-capitalize">sample code</label>
        <div class="col-xs-10"><?php echo empty_string($code_sample, '-'); ?></div>
    </div>
    <div class="row">
        <label for="created_at" class="col-xs-2 text-capitalize">created at</label>
        <div class="col-xs-10"><?php echo empty_string($row->created_at, '-'); ?></div>
    </div>
    <div class="row">
        <label for="updated_at" class="col-xs-2 text-capitalize">updated at</label>
        <div class="col-xs-10"><?php echo empty_string($row->updated_at, '-'); ?></div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button class="btn btn-info btn-flat btn-update" title="Change Format" data-toggle="tooltip">
                    <i class="fa fa-pencil"></i> Change Format
                </button>
            </div>
        </div>
    </div>
</div>
