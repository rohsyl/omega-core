<?php


namespace rohsyl\OmegaCore\Http\Controllers\Admin\Member\Group;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use rohsyl\OmegaCore\Http\Requests\Admin\Member\Group\CreateMemberGroupRequest;
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
        return view('omega::admin.member.group.show', compact('group'));
    }

    public function edit(MemberGroup $group) {

    }

    public function update(Request $request, MemberGroup $group) {

    }

    public function destroy(MemberGroup $group) {
        $group->delete();
        return redirect()->route('omega.admin.member.groups.index');
    }
}