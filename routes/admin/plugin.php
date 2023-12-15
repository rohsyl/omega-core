<?php
use Illuminate\Support\Facades\Route;


Route::middleware('acl:plugins:1')->group(function () {

    Route::get('plugins/{plugin}/install', \rohsyl\OmegaCore\Http\Controllers\Admin\Plugin\InstallController::class)->name('omega.admin.plugins.install');
    Route::resource('plugins', \rohsyl\OmegaCore\Http\Controllers\Admin\Plugin\PluginController::class, ['as' => 'omega.admin'])->only(['index']);

});