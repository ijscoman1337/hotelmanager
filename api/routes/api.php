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

//AUTHENTICATION
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('profile', 'AuthController@profile');
    });
});

//HOME
Route::get('home', 'ApiController@getHomepage');
//RESERVATIONS
Route::post('makereservation', 'ApiController@makeReservation');
//ROOMS
Route::get('rooms','ApiController@getRooms');
//ADMIN
Route::group(
    ['middleware' => 'auth:api'],
    function() {
        Route::middleware('is.admin')->group(function(){
            Route::prefix('admin')->group(function(){
                Route::get('getreservation','AdminController@getReservation');
                Route::post('confirmreservation','AdminController@confirmreservation');

            });
        });
    }
);
//CUSTOMER
Route::group(
    ['middleware' => 'auth:api'],
    function() {
        Route::middleware('is.customer')->group(function(){
            Route::prefix('user')->group(function(){
                Route::get('reservations','ApiController@getReservationsByUser');
            });
        });
    }
);



