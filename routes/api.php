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

Route::post('register', 'Auth\AuthController@register');
Route::post('login', 'Auth\AuthController@login');

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::get('classes', 'StudyingClassController@index');
    Route::get('classes/{class}', 'StudyingClassController@show');
    Route::post('classes', 'StudyingClassController@store');
    Route::put('classes/{class}', 'StudyingClassController@update');
    Route::delete('classes/{class}', 'StudyingClassController@delete');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
