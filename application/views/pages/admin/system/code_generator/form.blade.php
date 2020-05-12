@extends('layouts.admin.index')

@section('breadcrumb')
    @component('components.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        @slot('subtitle')
            {{ $subtitle }}
        @endslot
        {{ $title }}
    @endcomponent
@endsection

@section('content')
    @component('components.box', ['type' => 'info', 'title' => $subtitle, 'overlay' => true])
        <form method="post" id="form">
            <input type="hidden" name="{{ $csrf_name }}" value="{{ $csrf_hash }}">
            <input type="hidden" name="table_url" value="{{ base_url('admin/system/' . $title) }}">
            <input type="hidden" name="submit_url" value="{{ base_url('admin/system/' . $title . '/submit') }}">
            <input type="hidden" name="id" value="{{ $row->id }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $row->name }}" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="at_table">Table</label>
                        <input type="text" name="at_table" id="at_table" class="form-control" value="{{ $row->at_table }}" placeholder="Table">
                    </div>
                    <div class="form-group">
                        <label for="at_column">Column</label>
                        <input type="text" name="at_column" id="at_column" class="form-control" value="{{ $row->at_column }}" placeholder="Column">
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
            <div class="row">
                <div class="col-xs-12">
                    <label for="code_parts">Code Format</label>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12">
                    <input type="hidden" name="code_parts" value="{{ $code_parts }}">
                    <input type="hidden" name="list_part" value="{{ $parts }}">
                    <input type="hidden" name="list_separator" value="{{ $separators }}">
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
            <div data-bind="foreach: parts">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-md-4">
                                <select class="form-control code-part" data-bind="options: ListPart, optionsValue: 'key', optionsText: 'value', optionsCaption: 'Choose...', value: part, event: {change: toggleCodeValue}"></select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Code Value" data-bind="visible: hasValue, value: value">
                            </div>
                            <div class="col-md-3">
                                <select class="form-control code-separator" data-bind="options: ListSeparator, optionsValue: 'key', optionsText: 'value', optionsCaption: 'Choose...', value: separator"></select>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-success btn-flat btn-add-code-part" title="Add Code Part" data-toggle="tooltip" data-bind="visible: $index() < 1, click: addPart">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-flat btn-remove-code-part" title="Remove Code Part" data-toggle="tooltip" data-bind="visible: $index() > 1, click: removePart">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="parts" data-bind="value: ko.toJSON(parts())">
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <button type="button" class="btn btn-default btn-flat btn-back" title="Back" data-toggle="tooltip">
                            <i class="fa fa-arrow-left"></i> Back
                        </button>
                        <button type="submit" class="btn btn-primary btn-flat" title="Submit" data-toggle="tooltip">
                            <i class="fa fa-save"></i> Submit
                        </button>
                    </div>
                </div>
            </div>
        </form>
    @endcomponent
@endsection

@section('css-content')
    <link rel="stylesheet" href="{{ base_url('node_modules/jquery-toast-plugin/dist/jquery.toast.min.css') }}">
@endsection

@section('js-content')
    <script src="{{ base_url('node_modules/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
    <script src="{{ base_url('node_modules/knockout/build/output/knockout-latest.js') }}"></script>
    <script src="{{ base_url('assets/app/admin/system/' . $title . '/knockout.js') }}"></script>
    <script src="{{ base_url('assets/app/admin/system/' . $title . '/form.js') }}"></script>
@endsection