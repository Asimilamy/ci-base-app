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
    @component('components.box', ['title' => $subtitle])
        <input type="hidden" name="detail_url" value="{{ base_url('admin/system/' . $title . '/detail') }}">
        <input type="hidden" name="form_url" value="{{ base_url('admin/system/' . $title . '/form') }}">
        <input type="hidden" name="module" value="{{ $module }}">
        <div class="code-generator-view">
            @include('pages.admin.system.' . $title . '.detail', ['row' => $row, 'code_sample' => $code_sample])
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
    <script src="{{ base_url('assets/app/admin/system/' . $title . '/detail.js') }}"></script>
@endsection