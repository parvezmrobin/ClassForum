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
    Route::get('/thread/create', 'ThreadController@store');
    Route::post('/thread', "ThreadController@store");
    Route::get('/thread/{thread}', 'ThreadController@show')->name('thread.show');


    // Api
    Route::post('ajax/answer', 'AnswerController@store');
    Route::delete('ajax/answer/{answer}', 'AnswerController@destroy');

    Route::post('ajax/reply', 'ReplyController@store');
    Route::delete('ajax/reply/{reply}', 'ReplyController@destroy');

    Route::post('ajax/follow/thread/{thread}', 'ThreadController@followThread');
    Route::delete('ajax/unfollow/thread/{thread}', 'ThreadController@unfollowThread');
    Route::post('ajax/favorite/thread/{thread}', 'ThreadController@favoriteThread');
    Route::delete('ajax/unfavorite/thread/{thread}', 'ThreadController@unfavoriteThread');
    // TODO implement follow/unfollow channel
    Route::post('ajax/follow/channel', 'ChannelController@follow');
    Route::delete('ajax/unfollow/channel', 'ChannelController@unfollow');
});