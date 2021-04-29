<?php
use Illuminate\Support\Facades\Route;
use rohsyl\OmegaCore\Http\Controllers\Admin\Appearance\Menu\MenuController;

Route::prefix('appearence')->group(function () {
    Route::resource('menus', MenuController::class, ['as' => 'omega.admin.appearance'])->except(['show']);
});