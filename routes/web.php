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

Route::group(['middleware' => ['web']],function(){
    Route::get('/',function(){
        return view('welcome');
    })->name('home');

    Route::get('/home',[
        'uses' => 'ThreadController@getThread',
        'as' => 'home',
        'middleware' => 'auth'
    ]);
    Route::post('/ShowThread',[
        'uses' => 'ThreadController@Show_Thread',
        'as' => 'threads',
        'middleware' => 'auth'
    ]);



});