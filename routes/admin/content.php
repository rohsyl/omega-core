<?php
use Illuminate\Support\Facades\Route;
use rohsyl\OmegaCore\Http\Controllers\Admin\Content\Page\PageController;
use rohsyl\OmegaCore\Http\Controllers\Admin\Content\Page\PublishController;

Route::prefix('content')->group(function () {
    Route::resource('pages', PageController::class, ['as' => 'omega.admin.content']);

    Route::get('pages/{page}/publish', [PublishController::class, 'publish'])->name('omega.admin.content.pages.publish');
    Route::get('pages/{page}/unpublish', [PublishController::class, 'unpublish'])->name('omega.admin.content.pages.unpublish');
});