<?php

use Illuminate\Support\Facades\Route;
use Town\Http\Controllers\TownController;

Route::group([
    'namespace' => 'Town\Http\Controllers',
    'prefix' => 'address/api/v1',
    'middleware' => ['cors']
], function () {
    Route::group(['prefix' => 'towns'], function () {
        Route::get('/', 'TownController@list')->name('Town.list');
        Route::post('/', 'TownController@create')->name('Town.create');
        Route::get('/{id}', 'TownController@show')->name('Town.show');
        Route::put('/{id}', 'TownController@update')->name('Town.update');
        Route::delete('/{id}', 'TownController@destroy')->name('Town.destroy');
        Route::get('/township/{id}', 'TownController@getByTownshipId')->name('Town.getByTownshipId');
        Route::get('/district/{id}', 'TownController@getByDistrictId')->name('Town.getByDistrictId');
        Route::get('/city/{id}', 'TownController@getByCityId')->name('Town.getByCityId');
        Route::get('/District/{id}', 'TownController@getByDistrictId')->name('Town.getByDistrictId');
    });
});
