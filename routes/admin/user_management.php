<?php
use Illuminate\Support\Facades\Route;
use rohsyl\OmegaCore\Http\Controllers\Admin\UserManagement\UserController;
use rohsyl\OmegaCore\Http\Controllers\Admin\UserManagement\GroupController;

Route::resource('users', UserController::class, ['as' => 'omega.admin']);
Route::prefix('users')->group(function () {
});
Route::resource('groups', GroupController::class, ['as' => 'omega.admin']);
Route::prefix('groups')->group(function () {
});