<?php

use Illuminate\Support\Facades\Route;
use rohsyl\OmegaCore\Http\Controllers\Overt\Modules\Member\Auth\AuthenticatedSessionController;
use rohsyl\OmegaCore\Http\Controllers\Overt\Modules\Member\Profile\ProfileController;

Route::prefix('/member')->group(function() {

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('overt.module.member.login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::group(['middleware' => ['auth_member']], function() {

        Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('overt.module.member.logout');

        Route::get('/profile', [ProfileController::class, 'index'])->name('overt.module.member.profile');

    });




});