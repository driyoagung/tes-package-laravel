<?php

use Driyoagung\TesPackageLaravel\Http\Controllers\LandingPageController;
use Driyoagung\TesPackageLaravel\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function (): void {
    Route::get('/tes-package', LandingPageController::class)->name('tes-package.landing');
    Route::resource('/tes-package/notes', NoteController::class)
        ->names('tes-package.notes')
        ->except('show');
});
