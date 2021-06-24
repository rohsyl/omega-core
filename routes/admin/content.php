<?php
use Illuminate\Support\Facades\Route;
use rohsyl\OmegaCore\Http\Controllers\Admin\Content\Page\PageController;
use rohsyl\OmegaCore\Http\Controllers\Admin\Content\Page\PublishController;
use rohsyl\OmegaCore\Http\Controllers\Admin\Content\Media\MediaController;

Route::prefix('content')->group(function () {
    Route::resource('pages', PageController::class, ['as' => 'omega.admin.content']);

    Route::get('pages/{page}/publish', [PublishController::class, 'publish'])->name('omega.admin.content.pages.publish');
    Route::get('pages/{page}/unpublish', [PublishController::class, 'unpublish'])->name('omega.admin.content.pages.unpublish');

    Route::get('media', [MediaController::class, 'index'])->name('omega.admin.content.media.index');
    Route::get('media/modal', [MediaController::class, 'modal'])->name('omega.admin.content.media.index.modal');
});