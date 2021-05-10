<?php

namespace rohsyl\OmegaCore\Http\Controllers\Admin\UserManagement;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use rohsyl\OmegaCore\Http\Requests\Admin\UserManagement\User\CreateUserRequest;
use rohsyl\OmegaCore\Http\Requests\Admin\UserManagement\User\UpdateUserRequest;
use rohsyl\OmegaCore\Models\Group;
use rohsyl\OmegaCore\Models\User;

class UserController extends Controller
{

    public function index(){
        return view('omega::admin.user-management.user.index', ['users' => User::all()]);
    }

    public function create() {
        return view('omega::admin.user-management.user.create');
    }

    public function store(CreateUserRequest $request) {
        $inputs = $request->validated();
        $inputs['is_disabled'] = !($inputs['is_enabled'] ?? true);
        $user = new User($inputs);
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('omega.admin.users.show', $user);
    }

    public function show(User $user) {
        $permissions = acl_permissions();
        return view('omega::admin.user-management.user.show', compact('user', 'permissions'));
    }

    public function edit(User $user) {
        $permissions = acl_permissions();
        $groups = Group::all()->pluck('name', 'id')->toArray();
        return view('omega::admin.user-management.user.edit', compact('user', 'permissions', 'groups'));
    }

    public function update(UpdateUserRequest $request, User $user) {
        $inputs = $request->validated();
        $inputs['is_disabled'] = !($inputs['is_enabled'] ?? true);
        $user->update();

        $user->acl = acl_empty();
        $user->grantPermissions($request->input('permissions'));
        $user->save();

        $user->groups()->detach();
        if ($request->has('groups')) {
            $user->groups()->attach($request->input('groups'));
        }

        return redirect()->route('omega.admin.users.show', $user);
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('omega.admin.users.index');
    }
}
