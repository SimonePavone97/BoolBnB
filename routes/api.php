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

Route::namespace('Api')->group( function(){
    Route::get('/apartments', 'ApartmentController@index');
    Route::get('/apartments/{id}', 'ApartmentController@show');
    Route::get('/positions', 'TomtomController@index');
    Route::get('/sponsored/apartments', 'ApartmentController@sponsored');
    Route::get('/services', 'ServiceController@index');
    Route::get('/banana', 'TomtomController@banana');
    Route::get('/apaservice', 'ServiceController@apaservice');

});
