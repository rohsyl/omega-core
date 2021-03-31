@extends('omega::admin.layouts.admin')

@section('page-header')
    {{ __('Menus') }}
@endsection

@section('left-small-card-content')
@endsection


@php
    $overflow = 150;
@endphp

@section('large-card-content')

    <div class="row">
        <div class="col-lg-8 col-md-12">

            <livewire:omega_edit-menu :menu="$menu" />

        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Informations') }}
                </div>
                <div class="card-body">
                    {{ Form::open(['url' => route('omega.admin.appearance.menus.update', $menu), 'method' => 'put']) }}

                    {{ Form::otext('name', old('name') ?? $menu->name, ['label' => __('Title')]) }}
                    {{ Form::otextarea('description', old('description') ?? $menu->description, ['label' => __('Description')]) }}
                    {{ Form::ocheckbox('is_main', old('is_main') ?? $menu->is_main, ['label' => __('Is Main Menu')]) }}
                    {{ Form::oselect('member_group_id', $member_groups, old('member_group_id') ?? $menu->member_group_id, ['label' => __('Member group')]) }}

                    {{ Form::oback() }}
                    {{ Form::osubmit() }}

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>




@endsection

@push('js')
    <script>

    </script>
@endpush