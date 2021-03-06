<?php

use Illuminate\Support\Facades\Route;

// cookies
Route::prefix('site')->group(function () {

    Route::post('info-bottom-cookie-accept', [\App\Http\Controllers\Site\InfoBottomCookieController::class, 'accept'])->name('site.info-bottom-cookie-accept');
    Route::post('info-modal-cookie-accept', [\App\Http\Controllers\Site\InfoModalCookieController::class, 'accept'])->name('site.info-modal-cookie-accept');

});

// contact form
Route::prefix('site')->group(function () {

    Route::post('contact-form', [\App\Http\Controllers\Site\ContactFormController::class, 'send'])->name('site.contact-form');

});
