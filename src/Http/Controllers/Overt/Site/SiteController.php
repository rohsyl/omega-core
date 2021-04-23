<?php
namespace rohsyl\OmegaCore\Http\Controllers\Overt\Site;

use Illuminate\Routing\Controller;
use rohsyl\OmegaCore\Utils\Overt\Facades\Page;

class SiteController extends Controller
{

    public function home() {
        return Page::render();
    }

    public function home_with_lang(string $lang) {
        return Page::get()
            ->withLang($lang)
            ->render();
    }

    public function slug_and_lang(string $lang, string $slug) {
        return Page::get()
            ->withSlug($slug)
            ->withLang($lang)
            ->render();
    }


}