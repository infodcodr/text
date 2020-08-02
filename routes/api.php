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

Route::group([ 'prefix' => 'auth'], function (){
    Route::group(['middleware' => ['guest:api']], function () {
        Route::post('login', 'Api\AuthController@login');
        Route::post('signup', 'Api\AuthController@signup');
    });
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'Api\AuthController@logout');
        Route::post('getuser', 'Api\AuthController@getUser');
    });
});
Route::post('upload', 'PostConroller@uploadImages');
Route::group(['middleware' => 'auth:api'], function() {
    Route::post('timeline', 'PostConroller@index');
    Route::post('post', 'PostConroller@store');
    Route::post('post/{id}', 'PostConroller@show');
    Route::post('post/{id}/update', 'PostConroller@update');
    Route::post('post/{id}/remove', 'PostConroller@destroy');
});


Route::group(['middleware' => 'auth:api'], function() {
    Route::post('comment', 'CommentController@store');
    Route::post('comment/{id}', 'CommentController@show');
    Route::post('comment/{id}/update', 'CommentController@update');
    Route::post('comment/{id}/remove', 'CommentController@destroy');
});


Route::group(['middleware' => 'auth:api'], function() {
    Route::post('follow', 'UserController@follow');
    Route::post('accept', 'UserController@accept');
    Route::post('reject', 'UserController@reject');
    Route::post('remove', 'UserController@removeAccount');
    Route::post('profile', 'UserController@profileUpload');
    Route::post('search', 'UserController@search');
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('favourite', 'FavouriteController@store');
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('profile', 'UserController@update');
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('privacy', 'PrivacyController@store');
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('notification/update', 'NotificationSettingController@store');
});
Route::group(['middleware' => 'auth:api'], function() {
    Route::post('block', 'BlockController@store');
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('message', 'MessageController@index');
    Route::post('message/store', 'MessageController@store');
    Route::post('message/{id}', 'MessageController@show');
});

