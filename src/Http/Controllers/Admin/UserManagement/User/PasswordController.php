<?php
namespace rohsyl\OmegaCore\Http\Controllers\Admin\UserManagement\User;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use rohsyl\OmegaCore\Http\Requests\Admin\UserManagement\User\Password\UpdateUserPasswordRequest;
use rohsyl\OmegaCore\Models\User;

class PasswordController extends Controller
{
    public function edit(User $user) {
        return view('omega::admin.user-management.user.password.edit', compact('user'));
    }

    public function update(UpdateUserPasswordRequest $request, User $user) {

        $newPassword = $request->input('password');
        $user->password = Hash::make($newPassword);
        $user->save();

        return redirect()->route('omega.admin.users.show', $user);
    }
}