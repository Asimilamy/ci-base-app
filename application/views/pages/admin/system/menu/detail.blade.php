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
        <div class="row" style="margin-bottom: 15px;">
            <div class="pull-right">
                <div class="col-xs-12">
                    <a href="{{ base_url('admin/system/' . $title . '/form/' . $row->id) }}" class="btn btn-info btn-flat"
                        title="Edit Data">
                        <i class="fa fa-pencil"></i> Edit Data
                    </a>
                    <a href="{{ base_url('admin/system/' . $title) }}" class="btn btn-primary btn-flat" title="Show Table">
                        <i class="fa fa-table"></i> Show Table
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <dl class="dl-horizontal text-capitalize">
                    <dt>name :</dt>
                    <dd>{{ $row->name }}</dd>
                    <dt>parent name :</dt>
                    <dd>{{ empty($row->parent_name) ? '-' : $row->parent_name }}</dd>
                    <dt>link :</dt>
                    <dd>{{ $row->link }}</dd>
                    <dt>title :</dt>
                    <dd>{{ $row->title }}</dd>
                    <dt>icon :</dt>
                    <dd><i class="{{ empty($row->icon) ? 'fa fa-circle-o' : $row->icon }}"></i> = {{ empty($row->icon) ? 'fa fa-circle-o' : $row->icon }}</dd>
                    <dt>level :</dt>
                    <dd>{{ $row->level }}</dd>
                    <dt>order :</dt>
                    <dd>{{ $row->order }}</dd>
                    <dt>is active :</dt>
                    <dd>{{ $row->is_active == '1' ? 'active' : 'unactive' }}</dd>
                    <dt>is global :</dt>
                    <dd>{{ $row->is_global == '1' ? 'yes' : 'no' }}</dd>
                    <dt>notes :</dt>
                    <dd>{{ empty($row->notes) ? '-' : $row->notes }}</dd>
                    <dt>created at :</dt>
                    <dd>{{ date('d-m-Y H:i:s', strtotime($row->created_at)) }}</dd>
                    <dt>updated at :</dt>
                    <dd>{{ date('d-m-Y H:i:s', strtotime($row->updated_at)) }}</dd>
                </dl>
            </div>
        </div>
    @endcomponent
@endsection

@section('css-content')
    <style>
        dt {
            text-align: left !important;
            white-space: inherit !important;
        }
    </style>
@endsection
