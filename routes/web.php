<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['prefix' => 'profile'], function(){
    Route::get('{user}', 'ProfilesController@index')->name('profile.show');
    Route::get('{user}/edit', 'ProfilesController@edit')->name('profile.edit');
    Route::patch('{user}', 'ProfilesController@update')->name('profile.update');
});

Route::group(['prefix' => 'event'], function(){
    Route::get('create', 'EventController@create');
    Route::post('', 'EventController@store');
    Route::get('{event}', 'EventController@show');
    Route::get('{event}/delete', 'EventController@delete');
    Route::post('{event}/remove','EventController@remove');
    Route::get('{event}/edit', 'EventController@edit');
    Route::patch('{event}/update', 'EventController@update');
});

Route::get('/home', 'HomeController@index')->name('home');
