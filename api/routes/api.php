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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//AUTHENTICATION
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    // These routes are protected by the group.
    // So if you click either one of these it will tell you that the routes are undefined.
    // The reason why we leave these routes as undefined based on the middleware auth definition
    // and not provide a redirect is because we are working with an API
    // so to redirect with a specific given request is pointless
    // TODO: although it might be interesting to change this later so we can provide an error message instead
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'AuthController@logout');
        Route::get('profile', 'AuthController@profile');
    });
});

//ARTICLES
Route::get('profile', ['middleware' => 'auth', 'uses' => 'ProfileController@show']);

