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
                        <a href="{{ base_url('admin/system/' . $title . '/detail/' . $row->id) }}" class="btn btn-info btn-flat" title="View Detail">
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
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $row->name }}" placeholder="Name" autofocus>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="{{ $row->username }}" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $row->email }}" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="privilege_select">Privilege</label>
                    <input type="hidden" name="search_privilege_url" value="{{ base_url('admin/system/privilege/search') }}">
                    <input type="hidden" name="privilege_id" value="{{ $row->privilege_id }}">
                    <select name="privilege_select" id="privilege_select" class="form-control privilege-select2">
                        @if (!empty($row->privilege_id))
                            <option value="{{ $row->privilege_id }}">{{ $row->privilege }}</option>
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea name="notes" id="notes" class="form-control" cols="30" rows="10" placeholder="Notes" style="resize: none;">{{ $row->notes }}</textarea>
                </div>
            </div>
            <div class="col-xs-12">
                <hr>
            </div>
            <div class="col-md-6">
                @if (!empty($row->id))
                    @component('components.callouts')
                        @slot('title')
                            Warning!
                        @endslot
                        Leave password field blank, if password unchanged!
                    @endcomponent
                @endif
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="confPassword">Confirm Password</label>
                    <input type="password" name="confPassword" id="confPassword" class="form-control" placeholder="Confirm Password">
                </div>
            </div>
        </div>
    @endcomponent
@endsection

@section('css-content')
    <link rel="stylesheet" href="{{ base_url('node_modules/jquery-toast-plugin/dist/jquery.toast.min.css') }}">
    <link rel="stylesheet" href="{{ base_url('assets/AdminLTE-2.3.0/plugins/select2-4.0.13/dist/css/select2.min.css') }}">
@endsection

@section('js-content')
    <script src="{{ base_url('node_modules/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
    <script src="{{ base_url('assets/AdminLTE-2.3.0/plugins/select2-4.0.13/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ base_url('assets/app/admin/system/' . $title . '/form.js') }}"></script>
@endsection
