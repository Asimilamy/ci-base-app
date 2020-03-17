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
    @component('components.form_box')
        @slot('title')
            Profile Form
        @endslot
        @slot('action')
            {{ base_url() }}
        @endslot
        <input type="hidden" name="{{ $csrf_name }}" value="{{ $csrf_hash }}">
        <input type="hidden" name="submit_url" value="{{ base_url('admin/' . $title . '/update') }}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $_SESSION['auth']['name'] }}">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="{{ $_SESSION['auth']['username'] }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $_SESSION['auth']['email'] }}">
                </div>
            </div>
            <div class="col-xs-12">
                <hr>
            </div>
            <div class="col-md-6">
                @component('components.callouts')
                    @slot('title')
                        Warning!
                    @endslot
                    Leave password field blank, if password unchanged!
                @endcomponent
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="confPassword">Confirm Password</label>
                    <input type="password" name="confPassword" id="confPassword" class="form-control">
                </div>
            </div>
        </div>
    @endcomponent
@endsection

@section('css-content')
    <link rel="stylesheet" href="{{ base_url('node_modules/jquery-toast-plugin/dist/jquery.toast.min.css') }}">
@endsection

@section('js-content')
    <script src="{{ base_url('node_modules/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
    <script src="{{ base_url('assets/app/admin/' . $title . '/form.js') }}"></script>
@endsection
