<table class="table">
    <thead>
    <tr>
        <th scope="col" width="10"></th>
        <th scope="col">{{ __('Name') }}</th>
        <th scope="col">{{ __('Users') }}</th>
        <th scope="col" class="text-center">{{ __('Enabled') }}</th>
        <th scope="col" class="text-right">{{ __('Actions') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($groups as $group)
        <tr>
            <td scope="row">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="groups-select-{{ $group->id }}">
                    <label class="custom-control-label" for="group-select-{{ $group->id }}"></label>
                </div>
            </td>
            <td>{{ $group->name}}</td>
            <td>{{ $group->users->count()}}</td>
            <td class="text-center">
                @if ($group->is_enabled)
                    <i class="fas fa-check-circle color-green"></i>
                @else
                    <i class="fas fa-times-circle color-red-light"></i>
                @endif
            </td>
            <td class="text-right">
                <a href="{{ route('omega.admin.groups.show', $group) }}"><i class="fas fa-eye"></i></a>
                &nbsp;|&nbsp;
                <a href="{{ route('omega.admin.groups.edit', $group) }}"><i class="fas fa-edit"></i></a>
                &nbsp;|&nbsp;
                {{ Form::odelete(route('omega.admin.groups.destroy', $group), ['class' => 'btn btn-link m-0 pt-0 px-0 pb-1 color-red', 'icon' => 'fas fa-trash']) }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
