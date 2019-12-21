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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('subscribers', 'SubscriberController@index');
Route::get('subscribers/{subscriber}', 'SubscriberController@show');
Route::post('subscribers', 'SubscriberController@store');
Route::put('subscribers/{subscriber}', 'SubscriberController@update');
Route::delete('subscribers/{subscriber}', 'SubscriberController@destroy');
