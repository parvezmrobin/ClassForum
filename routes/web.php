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

Auth::routes();

Route::get('/home', 'ThreadController@index')->middleware('auth');
Route::get('/', 'ThreadController@index')->middleware('auth');

Route::get('/threads/{channel}/{thread}/replies', 'RepliesController@index');
Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store');
Route::patch('/replies/{reply}', 'RepliesController@update');
Route::delete('/replies/{reply}', 'RepliesController@destroy');


// Api
// TODO implement follow/unfollow channel
Route::put('api/follow/channel', 'ChannelController@follow')->middleware('auth');
Route::put('api/unfollow/channel', 'ChannelController@unfollow')->middleware('auth');