<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('home-view', 'welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {
    Route::view('/blank-page', 'admin.blank_page')->name('admin.blank_page');
    Route::view('/login', 'admin.auth.login')->name('admin.login');
    Route::group(['namespace' => 'Admin'], function () {
        Route::post('/login-post', 'AuthController@loginPost')->name('admin.login_post');

        Route::group(['middleware' => 'auth'], function () {
            Route::view('/', 'admin.dashboard')->name('admin.dashboard');
            Route::get('logout', 'AuthController@logout')->name('admin.logout');
        });
    });

    Route::middleware('auth')->prefix('salons')->name('admin.salons.')->namespace('Admin\Salons')->group(function () {
        Route::get('/', 'SalonsController@index')->name('index');
        Route::get('create', 'SalonsController@create')->name('create');
        Route::post('store', 'SalonsController@store')->name('store');
        Route::get('edit/{salon_id}', 'SalonsController@edit')->name('edit')->where('salon_id', '[0-9]+');
        Route::post('update/{salon_id}', 'SalonsController@update')->name('update')->where('salon_id', '[0-9]+');
        Route::post('update-owner-details/{salon_id}', 'SalonsController@updateOwnerDetails')->name('update_owner_details')->where('salon_id', '[0-9]+');
    });
});
