<?php


namespace rohsyl\OmegaCore\Http\Controllers\Admin\Member\Member;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use rohsyl\OmegaCore\Http\Requests\Admin\Member\Member\UpdateMemberPasswordRequest;
use rohsyl\OmegaCore\Models\Member;

class PasswordController extends Controller
{
    public function edit(Member $member) {
        return view('omega::admin.member.member.password.edit', compact('member'));
    }

    public function update(UpdateMemberPasswordRequest $request, Member $member) {

        $newPassword = $request->input('password');
        $member->password = Hash::make($newPassword);
        $member->save();

        return redirect()->route('omega.admin.member.members.show', $member);
    }
}