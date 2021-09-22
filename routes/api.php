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

Route::post('/event/{event}/favorite', 'FavoriteController@favorite');
Route::post('/event/{event}/unfavorite', 'FavoriteController@unfavorite');

Route::post('/profile/{profile}/follow', 'followController@follow');
Route::post('/profile/{profile}/unfollow', 'followController@unfollow');
