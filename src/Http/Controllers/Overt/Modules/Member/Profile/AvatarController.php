<?php


namespace rohsyl\OmegaCore\Http\Controllers\Overt\Modules\Member\Profile;


use Illuminate\Routing\Controller;
use rohsyl\OmegaCore\Http\Requests\Overt\Modules\Member\Profile\UpdateAvatarRequest;
use rohsyl\OmegaCore\Utils\Overt\Facades\MemberModule;
use rohsyl\OmegaCore\Utils\Overt\Facades\Page;

class AvatarController extends Controller
{
    public function edit() {

        return Page::get()
            ->withView('omega::overt.modules.member.profile._avatar')
            ->withPageMeta([
                'title'     => __('Member'),
                'subtitle'  => __('Profile'),
                'model'     => MemberModule::getTemplateModel()
            ])
            ->render();
    }

    public function update(UpdateAvatarRequest $request) {

        $member = auth('member')->user();

        $file = $request->file('avatar');

        $path = 'omega/members/' . $member->id;
        $filename = 'avatar.'.$file->extension();

        $path = $file->storeAs(
            $path, $filename, 'public'
        );

        $member->avatar = $path;
        $member->save();

        return redirect()->route('overt.module.member.profile');
    }
}