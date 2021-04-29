<?php
use Illuminate\Support\Facades\Route;
use rohsyl\OmegaCore\Http\Controllers\Admin\Member\Member\MemberController;
use rohsyl\OmegaCore\Http\Controllers\Admin\Member\Group\GroupController;
use rohsyl\OmegaCore\Http\Controllers\Admin\Member\Member\PasswordController;


Route::prefix('member')->group(function () {

    Route::resource('members', MemberController::class, ['as' => 'omega.admin.member']);
    Route::resource('groups', GroupController::class, ['as' => 'omega.admin.member']);

    Route::get('members/{member}/password', [PasswordController::class, 'edit'])->name('omega.admin.member.members.password.edit');
    Route::put('members/{member}/password', [PasswordController::class, 'update'])->name('omega.admin.member.members.password.update');
});