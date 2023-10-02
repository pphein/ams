<?php

use Illuminate\Support\Facades\Route;
use State\Http\Controllers\StateController;

Route::group([
    'namespace' => 'State\Http\Controllers',
    'prefix' => 'address/api/v1',
    'middleware' => ['cors']
], function () {
    Route::group(['prefix' => 'state'], function () {
        Route::get('/', 'StateController@list')->name('state.list');
        Route::post('/', 'StateController@create')->name('state.create');
        Route::get('/{id}', 'StateController@show')->name('state.show');
        Route::put('/{id}', 'StateController@update')->name('state.update');
        Route::delete('/{id}', 'StateController@destroy')->name('state.destroy');
        Route::get('/country/{id}', 'StateController@getByCountryId')->name('state.getByCountryId');
    });
});
