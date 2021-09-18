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



Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

Route::get('/post/create', 'PostController@create')->name('post.create');
Route::post('/post', 'PostController@store');
Route::get('/post/{post}','PostController@show');
Route::get('/post/{post}/delete', 'PostController@delete');
Route::post('/post/{post}/remove','PostController@remove');
Route::get('/post/{post}/edit', 'PostController@edit');
Route::patch('/post/{post}/update', 'PostController@update');

Route::get('/event/create', 'EventController@create')->name('event.create');
Route::post('/event', 'EventController@store');
Route::get('/event/{event}', 'EventController@show');
Route::get('/event/{event}/delete', 'EventController@delete');
Route::post('/event/{event}/remove','EventController@remove');
Route::get('/event/{event}/edit', 'EventController@edit');
Route::patch('/event/{event}/update', 'EventController@update');

Route::get('/index', 'EventController@index');





Route::get('/home', 'HomeController@index')->name('home');
