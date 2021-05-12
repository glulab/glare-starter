<?php

use Illuminate\Support\Facades\Route;

Route::prefix('site')->group(function () {

});

if (\Glare\Glare::hasService(\Glare\Glare::SERVICE_OFFER_PAGE)) :
    Route::get('/'.__('routes.offer').'.html', 'App\Http\Controllers\PageOfferController@index')->name('offer.index');
    Route::get('/'.__('routes.offer').'/{slug}.html', 'App\Http\Controllers\PageOfferController@show')->name('offer.show');
endif;

if (\Glare\Glare::hasService(\Glare\Glare::SERVICE_OFFER_CONTROLLER)) :
    Route::get('/'.__('routes.offer').'.html', 'App\Http\Controllers\OfferController@index')->name('offer.index');
    Route::get('/'.__('routes.offer').'/{slug}.html', 'App\Http\Controllers\OfferController@show')->name('offer.show');
endif;

Route::get('/realizacje.html', 'App\Http\Controllers\PageRealizationController@show')->name('page-realizations.show');
Route::get('/realizacja/{slug}.html', 'App\Http\Controllers\RealizationController@show')->name('realization.show');
