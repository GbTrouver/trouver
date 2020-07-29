<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', 'API\Users\UserAuthController@register')->name('users.register');
Route::post('login', 'API\Users\UserAuthController@login')->name('users.login');

Route::group(['prefix'=> 'users', 'middleware' => 'auth:api', 'namespace' => 'API\Users'], function() {
    Route::get('user-details', 'UserAuthController@userDetails')->name('users.user_details');
    Route::post('update-user-details', 'UserAuthController@updateUserDetails')->name('users.update_user_details');
});
