<table class="table">
    <caption>List of users</caption>
    <thead>
    <tr>
        <th scope="col"><i class="far fa-square"></i></th>
        <th scope="col">{{ __('Fullname') }}</th>
        <th scope="col">{{ __('Email') }}</th>
        <th scope="col">{{ __('Enabled') }}</th>
        <th scope="col">{{ __('Actions') }}</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="row">
                <label class="form-check-label" for="users-check-USERID">
                </label>
                <input class="form-check-input" type="checkbox" id="users-check-USERID">
            </td>
            <td>Michel</td>
            <td>Palaref</td>
            <td><i class="far fa-check-square"></i></td>
            <td>
                <i class="far fa-edit"></i>
                <i class="far fa-trash"></i>
            </td>
        </tr>
    </tbody>
</table>