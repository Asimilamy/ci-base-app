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
        <input type="hidden" name="datatables_url" value="{{ base_url('admin/master/' . $title . '/datatables') }}">
        <input type="hidden" name="view_url" value="{{ base_url('admin/master/' . $title . '/detail') }}">
        <input type="hidden" name="edit_url" value="{{ base_url('admin/master/' . $title . '/form') }}">
        <input type="hidden" name="delete_url" value="{{ base_url('admin/master/' . $title . '/delete') }}">
        <div class="row" style="margin-bottom: 15px;">
            <div class="pull-right">
                <div class="col-xs-12">
                    <a href="javascript:void(0);" class="btn btn-warning btn-flat" title="Refresh" onclick="window.location.reload();">
                        <i class="fa fa-refresh"></i> Refresh
                    </a>
                    <a href="{{ base_url('admin/master/' . $title . '/form') }}" class="btn btn-primary btn-flat" title="Add Data">
                        <i class="fa fa-plus"></i> Add Data
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table id="datatables" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Action</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Created At</th>
                            <th>Update At</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    @endcomponent
@endsection

@section('css-content')
    <link rel="stylesheet" href="{{ base_url('node_modules/jquery-toast-plugin/dist/jquery.toast.min.css') }}">
    <link rel="stylesheet" href="{{ base_url('assets/AdminLTE-2.3.0/plugins/datatables-1.10.15/media/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('js-content')
    <script src="{{ base_url('node_modules/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
    <script src="{{ base_url('assets/AdminLTE-2.3.0/plugins/datatables-1.10.15/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ base_url('assets/AdminLTE-2.3.0/plugins/datatables-1.10.15/media/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ base_url('assets/app/admin/master/' . $title . '/datatables.js') }}"></script>
    <script src="{{ base_url('assets/app/admin/master/' . $title . '/table.js') }}"></script>
@endsection
