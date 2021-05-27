<?php

use Illuminate\Support\Facades\Route;

// home
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

// controllers

if (config('site.services.offer-controller')) :
    // offer controller
    Route::get('/'.__('site::routes.offer.index').'.html', 'App\Http\Controllers\OfferController@index')->name('offer.index');
    Route::get('/'.__('site::routes.offer.show').'{slug}.html', 'App\Http\Controllers\OfferController@show')->name('offer.show');
endif;

if (config('site.services.offer-page')) :
    // page offer controller
    Route::get('/'.__('site::routes.offer.index').'.html', 'App\Http\Controllers\PageOfferController@index')->name('offer.index');
    Route::get('/'.__('site::routes.offer.show').'{slug}.html', 'App\Http\Controllers\PageOfferController@show')->name('offer.show');
endif;

if (config('site.services.blog')) :
    // page blog controller
    Route::get('/'.__('site::routes.blog.index').'.html', 'App\Http\Controllers\PageBlogController@index')->name('blog.index');
    Route::get('/'.__('site::routes.blog.show').'{slug}.html', 'App\Http\Controllers\PageBlogController@show')->name('blog.show');
endif;

if (config('site.services.gallery')) :
    // page gallery controller
    Route::get('/'.__('site::routes.gallery.index').'.html', 'App\Http\Controllers\PageGalleryController@index')->name('gallery.index');
    Route::get('/'.__('site::routes.gallery.show').'{slug}.html', 'App\Http\Controllers\PageGalleryController@show')->name('gallery.show');
endif;

// page contact controller
Route::get('/'.__('site::routes.contact').'.html', 'App\Http\Controllers\PageContactController@show')->name('contact');

// page controller
// Route::get('/{slug}.html', 'App\Http\Controllers\PageController@show')->name('page.show')->where(['slug' => '^(?:(?!admin).)*$',]);
