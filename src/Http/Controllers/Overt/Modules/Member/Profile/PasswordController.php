<?php


namespace rohsyl\OmegaCore\Http\Controllers\Overt\Modules\Member\Profile;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use rohsyl\OmegaCore\Http\Requests\Overt\Modules\Member\Profile\UpdatePasswordRequest;
use rohsyl\OmegaCore\Utils\Overt\Facades\MemberModule;
use rohsyl\OmegaCore\Utils\Overt\Facades\Page;

class PasswordController extends Controller
{
    public function edit() {

        return Page::get()
            ->withView('omega::overt.modules.member.profile._password')
            ->withPageMeta([
                'title'     => __('Member'),
                'subtitle'  => __('Password'),
                'model'     => MemberModule::getTemplateModel()
            ])
            ->render();
    }

    public function update(UpdatePasswordRequest $request) {
        $member = auth('member')->user();
        $newPassword = $request->input('password');
        $member->password = Hash::make($newPassword);
        $member->save();
        return redirect()->route('overt.module.member.profile');
    }
}