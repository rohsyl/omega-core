<?php
use Illuminate\Support\Facades\Route;
use rohsyl\OmegaCore\Http\Controllers\Admin\UserManagement\UserController;
use rohsyl\OmegaCore\Http\Controllers\Admin\UserManagement\GroupController;

Route::middleware('acl:usermanagement:1')->group(function () {

    Route::middleware('acl:usermanagement.user:1')->group(function () {
        Route::resource('users', UserController::class, ['as' => 'omega.admin']);
        Route::prefix('users')->group(function () {
            Route::get('{user}/password', [\rohsyl\OmegaCore\Http\Controllers\Admin\UserManagement\User\PasswordController::class, 'edit'])->name('omega.admin.users.password.edit');
            Route::put('{user}/password', [\rohsyl\OmegaCore\Http\Controllers\Admin\UserManagement\User\PasswordController::class, 'update'])->name('omega.admin.users.password.update');
        });
    });

    Route::middleware('acl:usermanagement.group:1')->group(function () {
        Route::resource('groups', GroupController::class, ['as' => 'omega.admin']);
        Route::prefix('groups')->group(function () {

        });
    });

});