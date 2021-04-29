@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Pages') }}
@endsection

@section('actions')
    <a href="{{ route('omega.admin.content.pages.create') }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-plus"></i> {{ __('Create page') }}</a>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Pages') }}
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Model') }}</th>
                    <th>{{ __('Edited by') }}</th>
                    <th>{{ __('Edited at') }}</th>
                    <th>{{ __('Published at') }}</th>
                    <th></th>
                </tr>
                @forelse($pages as $page)
                    <tr>
                        <td>
                            <a href="{{ route('omega.admin.content.pages.edit', $page) }}">{{ $page->title }}</a>
                        </td>
                        <td>
                            @if(isset($page->model))
                                {{ ucfirst(without_ext(without_ext($page->model))) }}
                            @else
                                Default
                            @endif
                        </td>
                        <td>
                            @if(isset($page->author))
                                {{ $page->author->fullname }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <span class="small">
                            {{ $page->updated_at->format(DATETIMEFORMAT) }}
                            </span>
                        </td>
                        <td>
                            @if(isset($page->published_at))
                                <span class="small @if($page->is_published) text-success @else text-muted @endif">
                                    @if($page->is_published) <i class="fas fa-globe"></i> @else <i class="fas fa-eye-slash"></i> @endif
                                    {{ $page->published_at->format(DATETIMEFORMAT) }}
                                </span>
                            @else
                                <span class="small text-muted">
                                    <i class="fas fa-eye-slash"></i>
                                    {{ __('Not published') }}
                                </span>
                            @endif
                        </td>
                        <td class="text-right">
                            <a href="{{ route('omega.admin.content.pages.edit', $page) }}"><i class="fas fa-edit"></i></a>
                            &nbsp;|&nbsp;
                            @if($page->is_published)
                                <a href="{{ route('omega.admin.content.pages.unpublish', $page) }}" class="text-muted"><i class="fas fa-eye-slash"></i></a>
                            @else
                                <a href="{{ route('omega.admin.content.pages.publish', $page) }}" class="text-success"><i class="fas fa-globe"></i></a>
                            @endif
                            &nbsp;|&nbsp;
                            {{ Form::odelete(route('omega.admin.content.pages.destroy', $page), ['class' => 'btn btn-link m-0 pt-0 px-0 pb-1 color-red', 'icon' => 'fas fa-trash']) }}
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

