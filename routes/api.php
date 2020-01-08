<?php

use App\Http\Middleware\CheckClassMember;
use App\Http\Middleware\CheckClassOwner;

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

    /**user */
    Route::get('user', 'UserController@index');
    Route::put('user', 'UserController@update');
    /**-user- */

    /**classes */
    Route::get('classes', 'StudyingClassController@index');
    Route::get('classes/{class}', 'StudyingClassController@show')->middleware(CheckClassMember::class);
    Route::post('classes', 'StudyingClassController@store');
    Route::put('classes/{class}', 'StudyingClassController@update')->middleware(CheckClassOwner::class);
    Route::delete('classes/{class}', 'StudyingClassController@delete')->middleware(CheckClassOwner::class);
    /**-classes- */

    /**members */
    Route::get('classes/{class}/members', 'MembersController@index')->middleware(CheckClassMember::class);
    Route::post('classes/{class}/members', 'MembersController@store')->middleware(CheckClassOwner::class);
    Route::post('classes/{class}/add_member', 'MembersController@addMember')->middleware(CheckClassOwner::class);
    Route::delete('classes/{class}/members', 'MembersController@delete')->middleware(CheckClassMember::class);
    /**-members- */

    /**posts */
    Route::get('classes/{class}/posts', 'PostController@index')->middleware(CheckClassMember::class);
    Route::get('classes/{class}/posts/{post}', 'PostController@show')->middleware(CheckClassMember::class);
    Route::post('classes/{class}/posts', 'PostController@store')->middleware(CheckClassOwner::class);
    Route::put('classes/{class}/posts/{post}', 'PostController@update')->middleware(CheckClassOwner::class);
    Route::delete('classes/{class}/posts/{post}', 'PostController@delete')->middleware(CheckClassOwner::class);
    /**-posts- */

    /**notifications */
    Route::get('notifications', 'NotificationsController@feed');
    Route::get('classes/{class}/notifications', 'NotificationsController@index')->middleware(CheckClassMember::class);
    Route::get('classes/{class}/notifications/{notification}', 'NotificationsController@show')->middleware(CheckClassMember::class);
    Route::post('classes/{class}/notifications', 'NotificationsController@store')->middleware(CheckClassOwner::class);
    Route::put('classes/{class}/notifications/{notification}', 'NotificationsController@update')->middleware(CheckClassOwner::class);
    Route::delete('classes/{class}/notifications/{notification}', 'NotificationsController@delete')->middleware(CheckClassOwner::class);
    /**-notifications= */

    /**views */
    Route::get('posts/{post}/views', 'ViewsController@index');
    Route::post('posts/{post}/views', 'ViewsController@store');
    /**-views- */

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
