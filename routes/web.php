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
<<<<<<< HEAD
    Route::group(['prefix' => 'case'], function (){
       Route::post('/addQuiz', 'CaseController@createQuiz');
       Route::post('/addColumn', 'CaseController@addColumn');
       Route::post('/addCase', 'CaseController@createCase');
       Route::get('/getInterest', 'CaseController@getInterest');
       Route::get('/', 'CaseController@list');
       Route::get('/{id}', 'CaseController@show');
       Route::get('/{id}/{sequence}', 'CaseController@showQuiz');
       Route::post('/lastQuiz/{id}', 'CaseController@showLastQuiz');
       Route::post('/solve', 'CaseController@solve');
=======
    Route::group(['prefix' => 'case'], function () {
        Route::post('/addQuiz', 'CaseController@createQuiz');
        Route::post('/addColumn', 'CaseController@addColumn');
        Route::post('/addCase', 'CaseController@createCase');
        Route::get('/getInterest', 'CaseController@getInterest');
        Route::get('/', 'CaseController@list');
        Route::get('/{id}', 'CaseController@show');
        Route::get('/{id}/{sequence}', 'CaseController@showQuiz');
        Route::post('/lastQuiz/{id}', 'CaseController@showLastQuiz');
>>>>>>> 5c1514744bd8173f2f79aecb93cc6be473f4643e
    });
    Route::get('test', 'TestController');
});

Route::get('/{any}', 'SpaController')->where('any', '.*');
