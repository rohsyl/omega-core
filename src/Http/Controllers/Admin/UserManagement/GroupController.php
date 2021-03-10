<?php

namespace rohsyl\OmegaCore\Http\Controllers\Admin\UserManagement;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use rohsyl\OmegaCore\Models\Group;

class GroupController extends Controller
{

    public function index(){
        return (new UserController)->index();
    }

    public function create() {
        return view('omega::admin.user-management.group.create');
    }

    public function store(Request $request) {
        $group = new Group();
        $group->name = $request->input('name');
        $group->description = $request->input('description');
        $group->is_enabled = (bool)$request->input('is-enabled');
        $group->save();

        return $this->show($group);
    }

    public function show(Group $group) {
        return view('omega::admin.user-management.group.show',['group' => Group::find($group->id)]);
    }

    public function edit(Group $group) {
        return view('omega::admin.user-management.group.edit', ['group' => $group]);
    }

    public function update(Request $request, Group $group) {
        $group->name = $request->input('name');
        $group->description = $request->input('description');
        $group->is_enabled = (bool)$request->input('is-enabled');
        $group->save();
        return $this->show($group);
    }

    public function destroy(Group $group) {
        //$group->destroy();
    }
}
