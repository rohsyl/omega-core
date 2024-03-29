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

    /********************************************************************
     * Omega CMS must be installed to acces all these routes
     * The *om_not_installed* middleware check if omega is installed,
     * if it's not the case, it redirect the user to the installation
     * page.
     ********************************************************************/
    Route::middleware(['om_not_installed', 'om_load_config'])->group(function() {

        include __DIR__ . '/overt/index.php';

        include __DIR__ . '/common/media.php';

        /********************************************************************
         * Public admin routes
         ********************************************************************/
        Route::prefix('/admin')->group(function(){

            require __DIR__ . '/admin/auth.php';
        });

        /********************************************************************
         * Private admin routes
         ********************************************************************/
        Route::group(['middleware' => ['auth', 'om_admin_locale']], function () {
            Route::prefix('admin')->group(function () {

                Route::redirect('/', '/admin/dashboard');

                Route::get('dashboard', [\rohsyl\OmegaCore\Http\Controllers\Admin\Dashboard\DashboardController::class, 'index'])->name('omega.admin.dashboard');

                require __DIR__ . '/admin/content.php';
                require __DIR__ . '/admin/appearance.php';
                require __DIR__ . '/admin/member.php';
                require __DIR__ . '/admin/setting.php';
                require __DIR__ . '/admin/plugin.php';

                require __DIR__ . '/admin/user_management.php';
            });
        });

    });


    /********************************************************************
     * The installation must be done only one time.
     * The *om_is_installed* middleware check if omega is installed,
     * if it's the case all these route will return a 404 error.
     ********************************************************************/
    Route::middleware('om_is_installed')->group(function() {
        Route::prefix('install')->group(function () {

            Route::get('/', [\rohsyl\OmegaCore\Http\Controllers\Overt\Install\InstallController::class, 'index'])->name('omega.install.index');
            Route::post('step1', [\rohsyl\OmegaCore\Http\Controllers\Overt\Install\InstallController::class, 'step1'])->name('omega.install.step1');
            Route::get('siteanduser', [\rohsyl\OmegaCore\Http\Controllers\Overt\Install\InstallController::class, 'siteanduser'])->name('omega.install.siteanduser');
            Route::post('step2', [\rohsyl\OmegaCore\Http\Controllers\Overt\Install\InstallController::class, 'step2'])->name('omega.install.step2');
            Route::get('launch', [\rohsyl\OmegaCore\Http\Controllers\Overt\Install\InstallController::class, 'launch'])->name('omega.install.launch');
            Route::post('do', [\rohsyl\OmegaCore\Http\Controllers\Overt\Install\InstallController::class, 'do'])->name('omega.install.do');
            Route::get('finished', [\rohsyl\OmegaCore\Http\Controllers\Overt\Install\InstallController::class, 'finished'])->name('omega.install.finished');

        });
    });


});