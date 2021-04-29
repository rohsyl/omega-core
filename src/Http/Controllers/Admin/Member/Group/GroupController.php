<?php


namespace rohsyl\OmegaCore\Http\Controllers\Admin\Member\Group;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use rohsyl\OmegaCore\Http\Requests\Admin\Member\Group\CreateMemberGroupRequest;
use rohsyl\OmegaCore\Models\Member;
use rohsyl\OmegaCore\Models\MemberGroup;

class GroupController extends Controller
{

    public function index() {

        $groups = MemberGroup::all();

        return view('omega::admin.member.group.index', compact('groups'));
    }

    public function create() {
        return view('omega::admin.member.group.create');
    }

    public function store(CreateMemberGroupRequest $request) {
        MemberGroup::create($request->validated());
        return redirect()->route('omega.admin.member.groups.index');
    }

    public function show(MemberGroup $group) {
        $permissions = acl_permissions('members');
        return view('omega::admin.member.group.show', compact('group', 'permissions'));
    }

    public function edit(MemberGroup $group) {
        $permissions = acl_permissions('members');
        $members = Member::all()->pluck('username_and_email', 'id')->toArray();
        return view('omega::admin.member.group.edit', compact('group', 'permissions', 'members'));
    }

    public function update(CreateMemberGroupRequest $request, MemberGroup $group) {
        $group->update($request->validated());

        $group->acl = acl_empty('members');
        $group->grantPermissions($request->input('permissions'));
        $group->save();


        $group->members()->detach();
        if ($request->has('members')) {
            $group->members()->attach($request->input('members'));
        }

        return redirect()->route('omega.admin.member.groups.show', $group);
    }

    public function destroy(MemberGroup $group) {
        $group->delete();
        return redirect()->route('omega.admin.member.groups.index');
    }
}