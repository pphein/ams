<?php

use Illuminate\Support\Facades\Route;
use Township\Http\Controllers\TownshipController;

Route::group([
    'namespace' => 'Township\Http\Controllers',
    'prefix' => 'address/api/v1',
    'middleware' => ['cors']
], function () {
    Route::group(['prefix' => 'townships'], function () {
        Route::get('/', 'TownshipController@list')->name('township.list');
        Route::post('/', 'TownshipController@create')->name('township.create');
        Route::get('/{id}', 'TownshipController@show')->name('township.show');
        Route::put('/{id}', 'TownshipController@update')->name('township.update');
        Route::delete('/{id}', 'TownshipController@destroy')->name('township.destroy');
        Route::get('/district/{id}', 'TownshipController@getByDistrictId')->name('township.getByDistrictId');
        Route::get('/city/{id}', 'TownshipController@getByCityId')->name('township.getByCityId');
        Route::get('/state/{id}', 'TownshipController@getByStateId')->name('township.getByStateId');
        Route::get('/country/{id}', 'TownshipController@getByCountryId')->name('township.getByCountryId');
    });
});
