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

Auth::routes();

// localhost:8000/admin
Route::middleware('auth')
->prefix('admin') //legato alla uri
->name('admin.')
->namespace('Admin')
->group( function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('Apartment', 'ApartmentController');
    
});

Route::get('{any?}', function(){
    return view('guest.home');
} )->where("any", ".*");

