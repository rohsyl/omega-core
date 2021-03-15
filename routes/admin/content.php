<?php
use Illuminate\Support\Facades\Route;
use rohsyl\OmegaCore\Http\Controllers\Admin\Content\Page\PageController;

Route::prefix('content')->group(function () {
    Route::resource('pages', PageController::class, ['as' => 'omega.admin.content']);
});