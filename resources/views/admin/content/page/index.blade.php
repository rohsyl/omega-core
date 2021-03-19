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
                            <a href="{{ route('omega.admin.content.pages.edit', $page) }}">{{ $page->title }}</a>
                        </td>
                        <td>
                            @if(isset($page->author))
                                {{ $page->author->fullname }}
                            @else
                                -
                            @endif
                        </td>
                        <td></td>
                        <td></td>
                        <td class="text-right">
                            <a href="{{ route('omega.admin.content.pages.edit', $page) }}"><i class="fas fa-edit"></i></a>
                        </td>
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
        <div class="card-footer">
            {{ $pages->links() }}
        </div>
    </div>


@endsection

