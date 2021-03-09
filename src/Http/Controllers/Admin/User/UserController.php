<?php

namespace rohsyl\OmegaCore\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use rohsyl\OmegaCore\Models\User;

class UserController extends Controller
{

    public function index(){

        return view('omega::admin.user.index');
    }

    public function create() {

    }

    public function store(Request $request) {

    }

    public function show(User $user) {

    }

    public function edit(User $user) {

    }

    public function update(Request $request, User $user) {

    }

    public function destroy(User $user) {

    }
}
