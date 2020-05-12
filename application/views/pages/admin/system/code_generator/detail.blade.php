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
    @component('components.box', ['type' => 'info', 'title' => $subtitle])
        <input type="hidden" name="table_url" value="{{ base_url('admin/system/code_generator') }}">
        <input type="hidden" name="form_url" value="{{ base_url('admin/system/code_generator/form/' . $row->id) }}">
        <div class="col-xs-12">
            <div class="row">
                <label for="name" class="col-xs-2 text-capitalize">name</label>
                <div class="col-xs-10">{{ $row->name }}</div>
            </div>
            <div class="row">
                <label for="table" class="col-xs-2 text-capitalize">table</label>
                <div class="col-xs-10">{{ $row->at_table }}</div>
            </div>
            <div class="row">
                <label for="column" class="col-xs-2 text-capitalize">column</label>
                <div class="col-xs-10">{{ $row->at_column }}</div>
            </div>
            <div class="row">
                <label for="format" class="col-xs-2 text-capitalize">format</label>
                <div class="col-xs-10">{{ $row->format }}</div>
            </div>
            <div class="row">
                <label for="on_reset" class="col-xs-2 text-capitalize">on reset</label>
                <div class="col-xs-10">{{ $row->on_reset }}</div>
            </div>
            <div class="row">
                <label for="code_sample" class="col-xs-2 text-capitalize">sample code</label>
                <div class="col-xs-10">{{ $code_sample }}</div>
            </div>
            <div class="row">
                <label for="created_at" class="col-xs-2 text-capitalize">created at</label>
                <div class="col-xs-10">{{ date('d-m-Y H:i:s', strtotime($row->created_at)) }}</div>
            </div>
            <div class="row">
                <label for="updated_at" class="col-xs-2 text-capitalize">updated at</label>
                <div class="col-xs-10">{{ date('d-m-Y H:i:s', strtotime($row->updated_at)) }}</div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <button class="btn btn-warning btn-flat btn-back" title="Table" data-toggle="tooltip">
                            <i class="fa fa-table"></i> Table
                        </button>
                        <button class="btn btn-info btn-flat btn-update" title="Update" data-toggle="tooltip">
                            <i class="fa fa-pencil"></i> Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endcomponent
@endsection

@section('js-content')
    <script src="{{ base_url('assets/app/admin/system/' . $title . '/detail.js') }}"></script>
@endsection
