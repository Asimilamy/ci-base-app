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
        <input type="hidden" name="submit_url" value="{{ base_url('admin/system/' . $title . '/submit') }}">
        <input type="hidden" name="id" value="{{ $row->id }}">
        <div class="row" style="margin-bottom: 15px;">
            <div class="pull-right">
                <div class="col-xs-12">
                    @if (!empty($row->id))
                        <a href="{{ base_url('admin/system/' . $title . '/detail/' . $row->id) }}" class="btn btn-info btn-flat"
                            title="View Detail">
                            <i class="fa fa-eye"></i> View Detail
                        </a>
                    @endif
                    <a href="{{ base_url('admin/system/' . $title) }}" class="btn btn-primary btn-flat" title="Show Table">
                        <i class="fa fa-table"></i> Show Table
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <label for="is_global" class="col-xs-4">Is Global</label>
                    <label>
                        <input type="checkbox" id="is_global" name="is_global" class="flat-blue" value="1" {{ $row->is_global == '1' ? 'checked' : '' }}>
                    </label>
                </div>
                <div class="row">
                    <label for="is_active" class="col-xs-4">Is Active</label>
                    <label>
                        <input type="checkbox" id="is_active" name="is_active" class="flat-blue" value="1" {{ $row->is_active == '1' ? 'checked' : '' }}>
                    </label>
                </div>
            </div>
            <div class="col-xs-12">
                <hr>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="parent_id">Parent Menu</label>
                    @component('components.callouts')
                        @slot('title')
                            Warning!
                        @endslot
                        Clear parent menu to create a root menu!
                    @endcomponent
                    <input type="hidden" name="search_menu_url" value="{{ base_url('admin/system/menu/search') }}">
                    <select name="parent_id" id="parent_id" class="form-control menu-select2">
                        @if (!empty($row->parent_id))
                            <option value="{{ $row->parent_id }}">{{ $row->parent_name }}</option>
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Menu Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $row->name }}"
                        placeholder="Menu Name">
                </div>
                <div class="form-group">
                    <label for="link">Link</label>
                    <input type="text" name="link" id="link" class="form-control" value="{{ $row->link }}" placeholder="Link">
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $row->title }}"
                        placeholder="Title">
                </div>
                <div class="form-group">
                    <label for="icon">Icon</label>
                    <input type="text" name="icon" id="icon" class="form-control" value="{{ $row->icon }}" placeholder="icon">
                </div>
                <div class="form-group">
                    <label for="order">Order</label>
                    <input type="number" name="order" id="order" class="form-control" value="{{ $row->order }}"
                        placeholder="Order">
                </div>
                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea name="notes" id="notes" cols="30" rows="10" class="form-control" placeholder="Notes" style="resize: none;">{{ $row->notes }}</textarea>
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
    <script src="{{ base_url('assets/app/admin/system/' . $title . '/form.js') }}"></script>
@endsection
