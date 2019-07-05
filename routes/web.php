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

Route::group(['prefix' => 'api'], function (){
    Route::group(['prefix' => 'user'], function (){
        Route::get('/idCheck/{account}', 'UserController@idCheck');
        Route::post('/register', 'UserController@register');
        Route::post('/findId', 'UserController@findId');
        Route::post('/findPw', 'UserController@findPw');
        Route::post('/setProfile/{id}', 'UserController@setProfile');
        Route::get('/{id}', 'UserController@show');
    });
    Route::get('test', 'TestController');
});

Route::get('/{any}', 'SpaController')->where('any', '.*');
