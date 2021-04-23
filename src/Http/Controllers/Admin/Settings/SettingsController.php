<?php


namespace rohsyl\OmegaCore\Http\Controllers\Admin\Settings;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use rohsyl\OmegaCore\Models\Page;

class SettingsController extends Controller
{
    public function edit() {

        $pages = Page::query()
            ->whereNull('parent_id')
            ->get();
        return view('omega::admin.settings.edit', compact('pages'))
            ->with('generalConfig', [
                'om_site_title' => om_config('om_site_title'),
                'om_site_slogan' => om_config('om_site_slogan'),
                'om_home_page_id' => om_config('om_home_page_id'),
                'om_lang' => om_config('om_lang'),
                'om_web_adress' => om_config('om_web_adress'),
            ])
            ;
    }

    public function update(Request $request) {

    }
}