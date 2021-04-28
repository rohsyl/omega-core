<?php


namespace rohsyl\OmegaCore\Http\Controllers\Overt\Modules\Member\Profile;


use Illuminate\Routing\Controller;
use rohsyl\OmegaCore\Utils\Overt\Facades\MemberModule;
use rohsyl\OmegaCore\Utils\Overt\Facades\Page;

class ProfileController extends Controller
{
    public function index() {
        return Page::get()
            ->withView('omega::overt.modules.member.profile._index')
            ->withPageMeta([
                'title'     => __('Member'),
                'subtitle'  => __('Profile'),
                'model'     => MemberModule::getTemplateModel()
            ])
            ->render();
    }
}