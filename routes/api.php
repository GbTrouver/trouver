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
Route::post('login-request', 'API\Users\UserAuthController@loginRequest')->name('users.login_request');
Route::post('login-with-otp', 'API\Users\UserAuthController@loginWithOtp')->name('users.login_with_otp');
Route::post('login', 'API\Users\UserAuthController@login')->name('users.login');

Route::group(['prefix'=> 'users', 'namespace' => 'API\Users'], function() {
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('user-details', 'UserAuthController@userDetails')->name('users.user_details');
        Route::post('update-user-details', 'UserAuthController@updateUserDetails')->name('users.update_user_details');
        Route::post('change-password', 'UserAuthController@changePassword')->name('users.change_password');
        Route::post('logout', 'UserAuthController@logout')->name('users.logout');
    });
    Route::post('/forgot-password-request', 'UserAuthController@forgotPasswordRequest')->name('users.forgot_password_request');
    Route::post('/forgot-password', 'UserAuthController@forgotPassword')->name('users.forgot_password');
});
