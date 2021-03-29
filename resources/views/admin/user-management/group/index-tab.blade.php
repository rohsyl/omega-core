<table class="table">
    <caption>List of groups</caption>
    <thead>
    <tr>
        <th scope="col">{{ __('Select') }}</th>
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
                    <i class="far fa-check-circle color-green"></i>
                @else
                    <i class="far fa-times-circle color-red-light"></i>
                @endif
            </td>
            <td class="text-right">
                <a href="{{ route('omega.admin.groups.show', $group) }}"><i class="far fa-eye color-green-dark"></i></a>
                <a href="{{ route('omega.admin.groups.edit', $group) }}"><i class="far fa-edit color-blue"></i></a>
                {{ Form::odelete(route('omega.admin.groups.destroy', $group), ['class' => 'btn btn-link m-0 pt-0 px-0 pb-1 color-red', 'icon' => 'far fa-trash-alt']) }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
