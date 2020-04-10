<form method="post" id="form">
    <input type="hidden" name="{{ $csrf_name }}" value="{{ $csrf_hash }}">
    <input type="hidden" name="submit_url" value="{{ base_url('admin/system/' . $title . '/submit') }}">
    <input type="hidden" name="id" value="{{ $row->id }}">
    <input type="hidden" name="table" value="{{ $module }}">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $row->name }}" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="column">Column</label>
                <input type="text" name="column" id="column" class="form-control" value="{{ $row->column }}" placeholder="Column">
            </div>
            <div class="form-group">
                <label for="on_reset">On Reset</label>
                <select name="on_reset" id="on_reset" class="form-control">
                    <option value="">-- Choose --</option>
                    @foreach ($on_reset_options as $option)
                        @php
                            $selected = $option->key == $row->on_reset ? 'selected' : '' ;
                        @endphp
                        <option value={{ $option->key }} {{ $selected }}>{{ $option->value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-12">
            <label for="code_parts">Code Format</label>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-4">
                <label for="code_part">Code Part</label>
            </div>
            <div class="col-xs-4">
                <label for="code_part">Code Value</label>
            </div>
            <div class="col-xs-4">
                <label for="code_part">Code Separator</label>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button type="button" class="btn btn-default btn-flat btn-back" title="Back" data-toggle="tooltip">
                    <i class="fa fa-arrow-left"></i> Back
                </button>
            </div>
        </div>
    </div>
</form>