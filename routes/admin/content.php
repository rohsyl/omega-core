<?php
use Illuminate\Support\Facades\Route;
use rohsyl\OmegaCore\Http\Controllers\Admin\Content\Page\PageController;
use rohsyl\OmegaCore\Http\Controllers\Admin\Content\Page\PublishController;
use rohsyl\OmegaCore\Http\Controllers\Admin\Content\Media\MediaController;
use rohsyl\OmegaCore\Http\Controllers\Admin\Content\Page\WidgetArea\WidgetController;

Route::prefix('content')->middleware('acl:content:1')->group(function () {
    Route::middleware('acl:content.page:1')->group(function () {
        Route::resource('pages', PageController::class, ['as' => 'omega.admin.content']);

        Route::get('pages/{page}/editv2', [PageController::class, 'editv2'])->name('omega.admin.content.pages.editv2');

        Route::get('pages/page-builder/blocks', \rohsyl\OmegaCore\Http\Controllers\Admin\Content\Page\PageBuilder\BlockController::class)->name('omega.admin.content.pages.pagebuilder.blocks');

        Route::get('pages/{page}/publish', [PublishController::class, 'publish'])->name('omega.admin.content.pages.publish');
        Route::get('pages/{page}/unpublish', [PublishController::class, 'unpublish'])->name('omega.admin.content.pages.unpublish');

        Route::put('pages/{page}/widgetarea/widgets/{component}', [WidgetController::class, 'update'])->name('omega.admin.content.pages.widgetarea.widgets.save');

    });
    Route::middleware('acl:content.medialibrary:1')->group(function () {
        Route::get('media', [MediaController::class, 'index'])->name('omega.admin.content.media.index');
        Route::get('media/modal', [MediaController::class, 'modal'])->name('omega.admin.content.media.index.modal');
    });
});