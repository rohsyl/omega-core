<?php

use Illuminate\Support\Facades\Route;
use rohsyl\OmegaCore\Utils\Common\Facades\OmegaUtils;
use rohsyl\OmegaCore\Http\Controllers\Overt\Site\SiteController;

Route::group(['middleware' => ['om_load_entity']], function () {
    // Homepage
    Route::any('/', [SiteController::class, 'home'])
        ->name('omega.overt');


    if (OmegaUtils::isInstalled()) {

        // Homepage with lang
        Route::any('/{lang}', [SiteController::class, 'home_with_lang'])
            ->where(['lang' => '[a-z]{2}'])
            ->name('omega.overt.homelang');


        // Page by slug and lang
        Route::any('/{lang}/{slug}',  [SiteController::class, 'slug_and_lang'])
            ->where(['lang' => '[a-z]{2}'])
            ->name('omega.overt.bylangandslug');


    }

    // Modules
    /*
        Route::get('language/change/{target}/{referer?}', 'PublicControllers\LanguageController@change')->name('public.language.change');
    });*/
    Route::prefix('/module')->group(function(){
        if(config('omega.member.enabled', true)) {
            require __DIR__ . '/modules/member.php';
        }
    });
});