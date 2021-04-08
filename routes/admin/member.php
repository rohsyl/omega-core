<?php
use Illuminate\Support\Facades\Route;
use rohsyl\OmegaCore\Http\Controllers\Admin\Member\Member\MemberController;
use rohsyl\OmegaCore\Http\Controllers\Admin\Member\Group\GroupController;


Route::prefix('member')->group(function () {

    Route::resource('members', MemberController::class, ['as' => 'omega.admin.member']);
    Route::resource('groups', GroupController::class, ['as' => 'omega.admin.member']);

});