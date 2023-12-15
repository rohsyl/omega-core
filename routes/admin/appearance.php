<?php
use Illuminate\Support\Facades\Route;
use rohsyl\OmegaCore\Http\Controllers\Admin\Appearance\Menu\MenuController;

Route::prefix('appearence')->middleware('acl:appearance:1')->group(function () {
    Route::middleware('acl:appearance.menu:1')->group(function () {
        Route::resource('menus', MenuController::class, ['as' => 'omega.admin.appearance'])->except(['show']);
    });
});