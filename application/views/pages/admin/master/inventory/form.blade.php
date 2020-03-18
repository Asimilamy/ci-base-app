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
    @component('components.form_box', ['title' => $subtitle])
        <input type="hidden" name="{{ $csrf_name }}" value="{{ $csrf_hash }}">
        <input type="hidden" name="submit_url" value="{{ base_url('admin/master/' . $title . '/submit') }}">
        <input type="hidden" name="id" value="{{ $row->id }}">
        <div class="row" style="margin-bottom: 15px;">
            <div class="pull-right">
                <div class="col-xs-12">
                    @if (!empty($row->id))
                        <a href="{{ base_url('admin/master/' . $title . '/detail/' . $row->id) }}" class="btn btn-info btn-flat"
                            title="View Detail">
                            <i class="fa fa-eye"></i> View Detail
                        </a>
                    @endif
                    <a href="{{ base_url('admin/master/' . $title) }}" class="btn btn-primary btn-flat" title="Show Table">
                        <i class="fa fa-table"></i> Show Table
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" id="code" name="code" class="form-control" value="{{ $row->code }}" placeholder="Code">
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $row->name }}" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="brand">Brand</label>
                    <input type="text" id="brand" name="brand" class="form-control" value="{{ $row->brand }}" placeholder="Brand">
                </div>
                <div class="form-group">
                    <label for="unit">Unit</label>
                    <input type="text" id="unit" name="unit" class="form-control" value="{{ $row->unit }}" placeholder="Unit">
                </div>
                <div class="form-group">
                    <label for="qty">Qty</label>
                    <input type="number" id="qty" name="qty" class="form-control" value="{{ $row->qty }}" placeholder="Qty">
                </div>
                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea name="notes" id="notes" cols="30" rows="10" class="form-control" placeholder="Notes">{{ $row->notes }}</textarea>
                </div>
            </div>
        </div>
    @endcomponent
@endsection

@section('css-content')
    <link rel="stylesheet" href="{{ base_url('node_modules/jquery-toast-plugin/dist/jquery.toast.min.css') }}">
    <link rel="stylesheet" href="{{ base_url('assets/AdminLTE-2.3.0/plugins/select2-4.0.13/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ base_url('assets/AdminLTE-2.3.0/plugins/iCheck/all.css') }}">
@endsection

@section('js-content')
    <script src="{{ base_url('node_modules/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
    <script src="{{ base_url('assets/AdminLTE-2.3.0/plugins/select2-4.0.13/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ base_url('assets/AdminLTE-2.3.0/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ base_url('assets/app/admin/master/' . $title . '/form.js') }}"></script>
@endsection
