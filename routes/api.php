<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Recomendations
Route::group(['prefix' => 'recomendations'], function() {
    Route::get('{sku}', ['uses' => 'RecomendationController@getBySku'])->name('getBySku.recomendations');
});

// Orders
Route::group(['prefix' => 'orders'], function() {
    Route::post('', ['uses' => 'OrderController@create'])->name('create.order');
});
