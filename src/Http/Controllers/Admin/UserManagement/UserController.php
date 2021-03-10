<?php

namespace rohsyl\OmegaCore\Http\Controllers\Admin\UserManagement;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use rohsyl\OmegaCore\Models\Group;
use rohsyl\OmegaCore\Models\User;

class UserController extends Controller
{

    public function index(){
        return view('omega::admin.user-management.index', ['users' => User::all(), 'groups' => Group::all()]);
    }

    public function create() {
        return view('omega::admin.user-management.user.create');
    }

    public function store(Request $request) {
        $user = new User();
        $user->email = $request->input('email');
        $user->fullname = $request->input('fullname');
        $user->password = $request->input('password');
        $user->is_disabled = !$request->input('is-enabled');
        $user->save();

        return $this->show($user);
    }

    public function show(User $user) {
        return view('omega::admin.user-management.user.show',['user' => User::find($user->id)]);
    }

    public function edit(User $user) {
        return view('omega::admin.user-management.user.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user) {
        $user->email = $request->input('email');
        $user->fullname = $request->input('fullname');
        $user->is_disabled = !$request->input('is-enabled');
        $user->save();
        return $this->show($user);
    }

    public function destroy(User $user) {
        //$user->destroy();
    }
}
