<?php


namespace rohsyl\OmegaCore\Http\Controllers\Admin\Member\Member;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use rohsyl\OmegaCore\Http\Requests\Admin\Member\Member\CreateMemberRequest;
use rohsyl\OmegaCore\Http\Requests\Admin\Member\Member\UpdateMemberRequest;
use rohsyl\OmegaCore\Models\Member;

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

        Member::create($request->all());

        return redirect()->route('omega.admin.member.members.index');
    }

    public function show(Member $member) {
        return view('omega::admin.member.member.show', compact('member'));
    }

    public function edit(Member $member) {
        return view('omega::admin.member.member.edit', compact('member'));
    }

    public function update(UpdateMemberRequest $request, Member $member) {
        $member->update($request->validated());
        return redirect()->route('omega.admin.member.members.edit', $member);
    }

    public function destroy(Member $member) {
        $member->delete();
        return redirect()->route('omega.admin.member.members.index');
    }
}