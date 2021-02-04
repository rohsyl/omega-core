<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => ['web']], function () {

    Route::middleware(['auth'])->group(function () {
        Route::prefix('admin')->group(function () {

            Route::get('dashboard', [\rohsyl\OmegaCore\Http\Controllers\Admin\Dashboard\DashboardController::class, 'index'])->name('omega.admin.dashboard');
        });
    });

    Route::prefix('/install')->group(function () {

        Route::get('/', [\rohsyl\OmegaCore\Http\Controllers\Overt\Install\InstallController::class, 'index'])->name('omega.install.index');
        Route::post('step1', [\rohsyl\OmegaCore\Http\Controllers\Overt\Install\InstallController::class, 'step1'])->name('omega.install.step1');
        Route::get('siteanduser', [\rohsyl\OmegaCore\Http\Controllers\Overt\Install\InstallController::class, 'siteanduser'])->name('omega.install.siteanduser');
        Route::post('step2', [\rohsyl\OmegaCore\Http\Controllers\Overt\Install\InstallController::class, 'step2'])->name('omega.install.step2');
        Route::get('launch',  [\rohsyl\OmegaCore\Http\Controllers\Overt\Install\InstallController::class, 'launch'])->name('omega.install.launch');
        Route::post('do', [\rohsyl\OmegaCore\Http\Controllers\Overt\Install\InstallController::class, 'do'])->name('omega.install.do');
        Route::get('finished', [\rohsyl\OmegaCore\Http\Controllers\Overt\Install\InstallController::class, 'finished'])->name('omega.install.finished');

    });

});