<?php

use Illuminate\Support\Facades\Route;
use rohsyl\OmegaCore\Http\Controllers\Common\Content\Media\MediaController;


Route::get('/medialibrary/{media}/{name}', MediaController::class)->name('omega.common.media');