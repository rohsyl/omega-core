@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Plugins') }}
@endsection


@section('content')

    <div class="card">
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Plugin</th>
                    <th>Installed</th>
                    <th></th>
                </tr>
                @foreach($plugins as $plugin)
                    <tr>
                        <td>
                            {{ $plugin->name() }}
                        </td>
                        <td>
                            {{ $plugin->isInstalled() ? __('Yes') : __('No') }}
                        </td>
                        <td></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>


@endsection

