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
    return view('landing');
});
Route::post('deploy', 'UtilController@deploy');

Route::group(['prefix' => 'api', 'middleware' => 'cors'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/idCheck/{account}', 'UserController@idCheck');
        Route::post('/register', 'UserController@register');
        Route::post('/login', 'UserController@login');
        Route::post('/findId', 'UserController@findId');
        Route::post('/findPw', 'UserController@findPw');
        Route::post('/setProfile/{id}', 'UserController@setProfile');
        Route::get('/{id}', 'UserController@show');
    });
    Route::group(['prefix' => 'case'], function () {
        Route::post('/addQuiz', 'CaseController@createQuiz');
        Route::post('/addColumn', 'CaseController@addColumn');
        Route::post('/addCase', 'CaseController@createCase');
        Route::get('/getInterest', 'CaseController@getInterest');
        Route::get('/', 'CaseController@list');
        Route::get('/{id}', 'CaseController@show');
        Route::get('/{id}/{sequence}', 'CaseController@showQuiz');
        Route::post('/lastQuiz/{id}', 'CaseController@showLastQuiz');
    });
    Route::get('test', 'TestController');
});

Route::get('/{any}', 'SpaController')->where('any', '.*');
