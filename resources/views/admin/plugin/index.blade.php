@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Plugins') }}
@endsection


@section('content')

    <x-oix-card>
        <table class="table">
            <tr>
                <th>{{__('Plugin')}}</th>
                <th>{{ __('Installed') }}</th>
                <th></th>
            </tr>
            @foreach($plugins as $plugin)
                <tr>
                    <td>

                        @if($plugin->adminIndex() !== null)
                            <a href="{{ $plugin->adminIndex() }}">
                                {{ \Illuminate\Support\Str::title($plugin->name()) }}
                            </a>
                        @else
                            {{ \Illuminate\Support\Str::title($plugin->name()) }}
                        @endif
                    </td>
                    <td>
                        @if($plugin->isInstalled())
                            <i class="fa fa-check text-success"></i>
                        @else
                            <i class="fa fa-times text-muted"></i>
                        @endif
                    </td>
                    <td class="text-right">
                        @if(!$plugin->isInstalled())
                            <a href="{{ route('omega.admin.plugins.install', $plugin->name()) }}">{{ __('Install') }}</a>
                        @endif
                        @if($plugin->adminIndex() !== null)
                            <a href="{{ $plugin->adminIndex() }}">{{ __('Open') }}</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </x-oix-card>


@endsection

