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
        <input type="hidden" name="submit_url" value="{{ base_url('admin/system/' . $title . '/submit_menu') }}">
        <input type="hidden" name="id" value="{{ $row->id }}">
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
        <div class="row" style="margin-bottom: 15px;">
            <div class="col-xs-12">
                <dl class="dl-horizontal text-capitalize">
                    <dt>name :</dt>
                    <dd>{{ $row->name }}</dd>
                    <dt>is active :</dt>
                    <dd>{{ $row->is_active == '1' ? 'active' : 'unactive' }}</dd>
                    <dt>notes :</dt>
                    <dd>{{ empty($row->notes) ? '-' : $row->notes }}</dd>
                    <dt>created at :</dt>
                    <dd>{{ date('d-m-Y H:i:s', strtotime($row->created_at)) }}</dd>
                    <dt>updated at :</dt>
                    <dd>{{ date('d-m-Y H:i:s', strtotime($row->updated_at)) }}</dd>
                </dl>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover" style="text-align: center;">
            <thead>
                <tr>
                    <th style="text-align: center; vertical-align: middle;">No</th>
                    <th style="vertical-align: middle">Name</th>
                    <th style="text-align: center;">
                        Can Create
                        <hr>
                        <label>
                            <input type="checkbox" class="flat-blue chk-all-create">
                        </label>
                    </th>
                    <th style="text-align: center;">
                        Can Read
                        <hr>
                        <label>
                            <input type="checkbox" class="flat-blue chk-all-read">
                        </label>
                    </th>
                    <th style="text-align: center;">
                        Can Update
                        <hr>
                        <label>
                            <input type="checkbox" class="flat-blue chk-all-update">
                        </label>
                    </th>
                    <th style="text-align: center;">
                        Can Delete
                        <hr>
                        <label>
                            <input type="checkbox" class="flat-blue chk-all-delete">
                        </label>
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 0;
                @endphp
                @foreach ($menus as $menu)
                    @if ($menu->level == '0')
                        @php
                            $no++
                        @endphp
                        <tr>
                            <td>{{ $no }}</td>
                            <td style="text-align: left;">
                                {{ $menu->name }}
                                <input type="hidden" name="menu_id[]" value="{{ $menu->id }}">
                            </td>
                            @if ($menu->link == 'javascript:void(0);')
                                <td colspan="4"></td>
                            @else
                                <td>
                                    <label>
                                        <input type="checkbox" name="can_create[{{ $menu->id }}]" class="flat-blue chk-create" value="1" {{ !empty($privilege[$menu->id]['can_create']) ? 'checked' : '' }}>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" name="can_read[{{ $menu->id }}]" class="flat-blue chk-read" value="1" {{ !empty($privilege[$menu->id]['can_create']) ? 'checked' : '' }}>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" name="can_update[{{ $menu->id }}]" class="flat-blue chk-update" value="1" {{ !empty($privilege[$menu->id]['can_create']) ? 'checked' : '' }}>
                                    </label>
                                </td>
                                <td>
                                    <label>
                                        <input type="checkbox" name="can_delete[{{ $menu->id }}]" class="flat-blue chk-delete" value="1" {{ !empty($privilege[$menu->id]['can_create']) ? 'checked' : '' }}>
                                    </label>
                                </td>
                            @endif
                        </tr>
                        @foreach ($menus as $menu_child)
                            @if ($menu_child->level == '1' && $menu_child->parent_id == $menu->id)
                                @php
                                    $no++;
                                @endphp
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td style="text-align: left;">
                                        <div class="col-xs-2"></div>{{ $menu_child->name }}
                                        <input type="hidden" name="menu_id[]" value="{{ $menu_child->id }}">
                                    </td>
                                    @if ($menu_child->link == 'javascript:void(0);')
                                        <td colspan="4"></td>
                                    @else
                                        <td>
                                            <label>
                                                <input type="checkbox" name="can_create[{{ $menu_child->id }}][{{ $menu->id }}]" class="flat-blue chk-create" value="1" {{ !empty($privilege[$menu_child->id]['can_create']) ? 'checked' : '' }}>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="can_read[{{ $menu_child->id }}][{{ $menu->id }}]" class="flat-blue chk-read" value="1" {{ !empty($privilege[$menu_child->id]['can_read']) ? 'checked' : '' }}>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="can_update[{{ $menu_child->id }}][{{ $menu->id }}]" class="flat-blue chk-update" value="1" {{ !empty($privilege[$menu_child->id]['can_update']) ? 'checked' : '' }}>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="can_delete[{{ $menu_child->id }}][{{ $menu->id }}]" class="flat-blue chk-delete" value="1" {{ !empty($privilege[$menu_child->id]['can_delete']) ? 'checked' : '' }}>
                                            </label>
                                        </td>
                                    @endif
                                </tr>
                                @foreach ($menus as $menu_grandchild)
                                    @if ($menu_grandchild->level == '2' && $menu_grandchild->parent_id == $menu_child->id)
                                        @php
                                            $no++;
                                        @endphp
                                        <tr>
                                            <td>{{ $no }}</td>
                                            <td style="text-align: left;">
                                                <div class="col-xs-4"></div>{{ $menu_grandchild->name }}
                                                <input type="hidden" name="menu_id[]" value="{{ $menu_grandchild->id }}">
                                            </td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" name="can_create[{{ $menu_grandchild->id }}][{{ $menu_child->id }}][{{ $menu->id }}]" class="flat-blue chk-create" value="1" {{ !empty($privilege[$menu_grandchild->id]['can_create']) ? 'checked' : '' }}>
                                                </label>
                                            </td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" name="can_read[{{ $menu_grandchild->id }}][{{ $menu_child->id }}][{{ $menu->id }}]" class="flat-blue chk-read" value="1" {{ !empty($privilege[$menu_grandchild->id]['can_read']) ? 'checked' : '' }}>
                                                </label>
                                            </td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" name="can_update[{{ $menu_grandchild->id }}][{{ $menu_child->id }}][{{ $menu->id }}]" class="flat-blue chk-update" value="1" {{ !empty($privilege[$menu_grandchild->id]['can_update']) ? 'checked' : '' }}>
                                                </label>
                                            </td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" name="can_delete[{{ $menu_grandchild->id }}][{{ $menu_child->id }}][{{ $menu->id }}]" class="flat-blue chk-delete" value="1" {{ !empty($privilege[$menu_grandchild->id]['can_delete']) ? 'checked' : '' }}>
                                                </label>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </tbody>
        </table>
    @endcomponent
@endsection

@section('css-content')
    <link rel="stylesheet" href="{{ base_url('node_modules/jquery-toast-plugin/dist/jquery.toast.min.css') }}">
    <link rel="stylesheet" href="{{ base_url('assets/AdminLTE-2.3.0/plugins/iCheck/all.css') }}">
    <style>
        dt {
            text-align: left !important;
            white-space: inherit !important;
        }
    </style>
@endsection

@section('js-content')
    <script src="{{ base_url('node_modules/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
    <script src="{{ base_url('assets/AdminLTE-2.3.0/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ base_url('assets/app/admin/system/' . $title . '/menu.js') }}"></script>
@endsection
