<table class="table">
    <caption>List of users</caption>
    <thead>
    <tr>
        <th scope="col">{{ __('Select') }}</i></th>
        <th scope="col">{{ __('Fullname') }}</th>
        <th scope="col">{{ __('Email') }}</th>
        <th scope="col" class="text-center">{{ __('Enabled') }}</th>
        <th scope="col" class="text-right">{{ __('Actions') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td scope="row">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="user-select-{{ $user->id }}">
                    <label class="custom-control-label" for="user-select-{{ $user->id }}"></label>
                </div>
            </td>
            <td>{{ $user->fullname }}</td>
            <td>{{ $user->email }}</td>
            <td  class="text-center">
                @if ($user->is_disabled)
                <i class="far fa-times-circle color-red-light"></i>
                @else
                <i class="far fa-check-circle color-green"></i>
                @endif
            </td>
            <td class="text-right">
                <a href="{{ route('omega.admin.users.show', $user) }}"><i class="far fa-eye color-green-dark"></i></a>
                <a href="{{ route('omega.admin.users.edit', $user) }}"><i class="far fa-edit color-blue"></i></a>
                {{ Form::odelete(route('omega.admin.users.destroy', $user), ['class' => 'btn btn-link m-0 pt-0 px-0 pb-1 color-red', 'icon' => 'far fa-trash-alt']) }}
            </td>
        </tr>
    @endforeach

    </tbody>
</table>