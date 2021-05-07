<?php

namespace rohsyl\OmegaCore\Http\Controllers\Admin\UserManagement;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use rohsyl\OmegaCore\Http\Requests\Admin\UserManagement\Group\CreateGroupRequest;
use rohsyl\OmegaCore\Http\Requests\Admin\UserManagement\Group\UpdateGroupRequest;
use rohsyl\OmegaCore\Models\Group;
use rohsyl\OmegaCore\Models\User;

class GroupController extends Controller
{
    public function index(){
        return view('omega::admin.user-management.group.index', ['groups' => Group::all()]);
    }

    public function create() {
        return view('omega::admin.user-management.group.create');
    }

    public function store(CreateGroupRequest $request) {
        $group = Group::create($request->validated());
        return redirect()->route('omega.admin.groups.show', $group);
    }

    public function show(Group $group) {
        $permissions = acl_permissions();
        return view('omega::admin.user-management.group.show', compact('group', 'permissions'));
    }

    public function edit(Group $group) {
        $permissions = acl_permissions();
        $users = User::all()->pluck('fullname', 'id')->toArray();
        return view('omega::admin.user-management.group.edit', compact('group', 'users', 'permissions'));
    }

    public function update(UpdateGroupRequest $request, Group $group) {
        $group->update($request->validated());

        $group->acl = acl_empty();
        $group->grantPermissions($request->input('permissions'));
        $group->save();

        $group->users()->detach();
        if ($request->has('users')) {
            $group->users()->attach($request->input('users'));
        }

        return redirect()->route('omega.admin.groups.show', $group);
    }

    public function destroy(Group $group) {
        if ($group->is_system) {
            return redirect()->route('omega.admin.groups.index');
        }

        $group->delete();
        return redirect()->route('omega.admin.groups.index');
    }
}
