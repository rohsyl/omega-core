<?php


namespace rohsyl\OmegaCore\Http\Controllers\Admin\Member\Member;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use rohsyl\OmegaCore\Http\Requests\Admin\Member\Member\CreateMemberRequest;
use rohsyl\OmegaCore\Http\Requests\Admin\Member\Member\UpdateMemberRequest;
use rohsyl\OmegaCore\Models\Member;
use rohsyl\OmegaCore\Models\MemberGroup;

class MemberController extends Controller
{

    public function index() {
        $members = Member::all();
        return view('omega::admin.member.member.index', compact('members'));
    }

    public function create() {
        return view('omega::admin.member.member.create');
    }

    public function store(CreateMemberRequest $request) {

        $inputs = $request->validated();
        $inputs['password'] = Hash::make($inputs['password']);
        Member::create($inputs);

        return redirect()->route('omega.admin.member.members.index');
    }

    public function show(Member $member) {
        $permissions = acl_permissions('members');
        return view('omega::admin.member.member.show', compact('member', 'permissions'));
    }

    public function edit(Member $member) {
        $permissions = acl_permissions('members');
        $membergroups = MemberGroup::all()->pluck('name', 'id')->toArray();
        return view('omega::admin.member.member.edit', compact('member', 'permissions', 'membergroups'));
    }

    public function update(UpdateMemberRequest $request, Member $member) {
        $member->update($request->validated());

        $member->acl = acl_empty('members');
        $member->grantPermissions($request->input('permissions'));
        $member->save();

        $member->membergroups()->detach();
        if ($request->has('membergroups')) {
            $member->membergroups()->attach($request->input('membergroups'));
        }

        return redirect()->route('omega.admin.member.members.show', $member);
    }

    public function destroy(Member $member) {
        $member->delete();
        return redirect()->route('omega.admin.member.members.index');
    }
}