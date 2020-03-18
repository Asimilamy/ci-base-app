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
                    <a href="{{ base_url('admin/master/' . $title . '/form/' . $row->id) }}" class="btn btn-info btn-flat"
                        title="Edit Data">
                        <i class="fa fa-pencil"></i> Edit Data
                    </a>
                    <a href="{{ base_url('admin/master/' . $title) }}" class="btn btn-primary btn-flat" title="Show Table">
                        <i class="fa fa-table"></i> Show Table
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <dl class="dl-horizontal text-capitalize">
                    <dt>code :</dt>
                    <dd>{{ $row->code }}</dd>
                    <dt>name :</dt>
                    <dd>{{ $row->name }}</dd>
                    <dt>brand :</dt>
                    <dd>{{ $row->brand }}</dd>
                    <dt>qty :</dt>
                    <dd>{{ $row->qty }}</dd>
                    <dt>unit :</dt>
                    <dd>{{ $row->unit }}</dd>
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
