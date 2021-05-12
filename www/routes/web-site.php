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

// controllers

if (config('site.services.offer-controller')) :
    // offer controller
    Route::get('/'.__('routes.offer').'.html', 'App\Http\Controllers\OfferController@index')->name('offer.index');
    Route::get('/'.__('routes.offer').'/{slug}.html', 'App\Http\Controllers\OfferController@show')->name('offer.show');
endif;

if (config('site.services.offer-page')) :
    // page offer controller
    Route::get('/'.__('routes.offer').'.html', 'App\Http\Controllers\PageOfferController@index')->name('offer.index');
    Route::get('/'.__('routes.offer').'/{slug}.html', 'App\Http\Controllers\PageOfferController@show')->name('offer.show');
endif;

if (config('site.services.blog')) :
    // page blog controller
    Route::get('/'.__('routes.blog').'.html', 'App\Http\Controllers\PageBlogController@index')->name('blog.index');
    Route::get('/'.__('routes.blog').'/{slug}.html', 'App\Http\Controllers\PageBlogController@show')->name('blog.show');
endif;

if (config('site.services.gallery')) :
    // page gallery controller
    Route::get('/'.__('routes.gallery').'.html', 'App\Http\Controllers\PageGalleryController@index')->name('gallery.index');
    Route::get('/'.__('routes.gallery').'/{slug}.html', 'App\Http\Controllers\PageGalleryController@show')->name('gallery.show');
endif;

// page contact controller
Route::get('/'.__('routes.contact').'.html', 'App\Http\Controllers\PageContactController@show')->name('contact');

// page controller
Route::get('/{slug}.html', 'App\Http\Controllers\PageController@show')->name('page.show')->where(['slug' => '^(?:(?!admin).)*$',]);
