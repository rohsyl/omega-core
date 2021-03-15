@extends('omega::admin.default')

@section('page-header')
    {{ __('Pages') }}
@endsection

@section('actions')
    <a href="{{ route('omega.admin.content.pages.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> {{ __('Create page') }}</a>
@endsection

@section('content')

    <div class="card">
        <div class="card-body p-0">
            <table class="table">
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Edited by') }}</th>
                    <th>{{ __('Edited at') }}</th>
                    <th>{{ __('Model') }}</th>
                    <th></th>
                </tr>
                @forelse($pages as $page)
                    <tr>
                        <td>
                            {{ $page->title }}
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            {{ __('No pages ...') }}
                        </td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>


@endsection

