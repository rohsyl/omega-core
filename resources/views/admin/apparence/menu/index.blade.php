@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Menus') }}
@endsection

@section('actions')
    <a href="{{ route('omega.admin.appearance.menus.create') }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-plus"></i> {{ __('Create menu') }}</a>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('Menus') }}
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Description') }}</th>
                    <th>{{ __('Member group') }}</th>
                    <th></th>
                </tr>
                @forelse($menus as $menu)
                    <tr>
                        <td>
                            <a href="{{ route('omega.admin.appearance.menus.edit', $menu) }}">{{ $menu->name }}</a>
                        </td>
                        <td>
                            {{ $menu->description ?? '-' }}
                        </td>
                        <td>
                            @if(isset($menu->member_group))
                                {{ $menu->member_group->name }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-right">
                            <a href="{{ route('omega.admin.appearance.menus.edit', $menu) }}"><i class="fas fa-edit"></i></a>
                            &nbsp;|&nbsp;
                            {{ Form::odelete(route('omega.admin.appearance.menus.destroy', $menu), ['class' => 'btn btn-link m-0 pt-0 px-0 pb-1 color-red', 'icon' => 'fas fa-trash']) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            {{ __('No menus ...') }}
                        </td>
                    </tr>
                @endforelse
            </table>
        </div>
        <div class="card-footer">
            {{ $menus->links() }}
        </div>
    </div>

@endsection

