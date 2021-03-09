<?php

namespace rohsyl\OmegaCore\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use rohsyl\OmegaCore\Models\Group;

class GroupController extends Controller
{

    public function index(){

        return view('omega::admin.group.index');
    }

    public function create() {

    }

    public function store(Request $request) {

    }

    public function show(Group $group) {

    }

    public function edit(Group $group) {

    }

    public function update(Request $request, Group $group) {

    }

    public function destroy(Group $group) {

    }
}
