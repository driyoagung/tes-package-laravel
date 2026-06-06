<?php

use Driyoagung\TesPackageLaravel\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function (): void {
    Route::get('/tes-package', LandingPageController::class)->name('tes-package.landing');
});
