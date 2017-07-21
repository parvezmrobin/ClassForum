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

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'ThreadController@index');
    Route::get('/', 'ThreadController@index');
    Route::get('/thread/{thread}', 'ThreadController@show');


    // Api
    Route::post('ajax/answer', 'AnswerController@store');
    Route::delete('ajax/answer/{answer}', 'AnswerController@destroy');

    Route::post('ajax/reply', 'ReplyController@store');
    Route::delete('ajax/reply/{reply}', 'ReplyController@destroy');
    // TODO implement follow/unfollow channel
    Route::post('ajax/follow/channel', 'ChannelController@follow');
    Route::delete('ajax/unfollow/channel', 'ChannelController@unfollow');
});