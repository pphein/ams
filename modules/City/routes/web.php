<?php

use Illuminate\Support\Facades\Route;
use City\Http\Controllers\CityController;

Route::group([
    'namespace' => 'City\Http\Controllers',
    'prefix' => 'address/api/v1',
    'middleware' => ['cors']
], function () {
    Route::group(['prefix' => 'cities'], function () {
        Route::get('/', 'CityController@list')->name('city.list');
        Route::post('/', 'CityController@create')->name('city.create');
        Route::get('/{id}', 'CityController@show')->name('city.show');
        Route::put('/{id}', 'CityController@update')->name('city.update');
        Route::delete('/{id}', 'CityController@destroy')->name('city.destroy');
        Route::get('/state/{id}', 'CityController@getByStateId')->name('city.getByStateId');
        Route::get('/country/{id}', 'CityController@getByCountryId')->name('city.getByCountryId');
    });
});
