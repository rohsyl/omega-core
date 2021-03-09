
<div class="row">
    <div class="col-12 col-lg-8 ord-2 order-lg-1">
        <table class="table">
            <caption>List of users</caption>
            <thead>
            <tr>
                <th scope="col"><i class="far fa-square"></i></th>
                <th scope="col">{{ __('Fullname') }}</th>
                <th scope="col">{{ __('Email') }}</th>
                <th scope="col">{{ __('Enabled') }}</th>
                <th scope="col">{{ __('Actions') }}</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row">
                        <input class="form-check-input" type="checkbox" id="users-check-USERID">
                        <label class="form-check-label" for="users-check-USERID"></label>
                    </td>
                    <td>Michel</td>
                    <td>Palaref</td>
                    <td><i class="far fa-check-square"></i>
                    </td>
                    <td>
                        <button><i class="far fa-edit"></i></button>
                    </td>
                    <td>
                        <i class="far fa-eye"></i>
                        <i class="far fa-edit"></i>
                        <i class="far fa-trash"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <hr class="d-lg-block d-none order-1 order-lg-1">
    <div class="col-12 col-lg-4 order-0 order-lg-2">
        Spec menu
    </div>
</div>

