<?php

use Illuminate\Support\Facades\Route;
use Ward\Http\Controllers\WardController;

Route::group([
    'namespace' => 'Ward\Http\Controllers',
    'prefix' => 'address/api/v1',
    'middleware' => ['cors']
], function () {
    Route::group(['prefix' => 'wards'], function () {
        Route::get('/', 'WardController@list')->name('Ward.list');
        Route::post('/', 'WardController@create')->name('Ward.create');
        Route::get('/{id}', 'WardController@show')->name('Ward.show');
        Route::put('/{id}', 'WardController@update')->name('Ward.update');
        Route::delete('/{id}', 'WardController@destroy')->name('Ward.destroy');
        Route::get('/town/{id}', 'WardController@getByTownId')->name('Ward.getByTownId');
        Route::get('/township/{id}', 'WardController@getByWardshipId')->name('Ward.getByTownshipId');
        Route::get('/district/{id}', 'WardController@getByDistrictId')->name('Ward.getByDistrictId');
        Route::get('/city/{id}', 'WardController@getByCityId')->name('Ward.getByCityId');
        Route::get('/district/{id}', 'WardController@getByDistrictId')->name('Ward.getByDistrictId');
    });
});
