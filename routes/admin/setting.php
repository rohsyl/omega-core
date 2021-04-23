<?php
use Illuminate\Support\Facades\Route;
use rohsyl\OmegaCore\Http\Controllers\Admin\Settings\SettingsController;

Route::resource('settings', SettingsController::class, ['as' => 'omega.admin'])->only(['edit', 'update']);