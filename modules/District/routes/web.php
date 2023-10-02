<?php

use Illuminate\Support\Facades\Route;
use District\Http\Controllers\DistrictController;

Route::group([
    'namespace' => 'District\Http\Controllers',
    'prefix' => 'address/api/v1',
    'middleware' => ['cors']
], function () {
    Route::group(['prefix' => 'district'], function () {
        Route::get('/', 'DistrictController@list')->name('district.list');
        Route::post('/', 'DistrictController@create')->name('district.create');
        Route::get('/{id}', 'DistrictController@show')->name('district.show');
        Route::put('/{id}', 'DistrictController@update')->name('district.update');
        Route::delete('/{id}', 'DistrictController@destroy')->name('district.destroy');
        Route::get('/state/{id}', 'DistrictController@getByStateId')->name('district.getByStateId');
        Route::get('/country/{id}', 'DistrictController@getByCountryId')->name('district.getByCountryId');
    });
});
