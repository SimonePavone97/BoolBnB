<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    Route::resource('apartments', 'ApartmentController');
    Route::resource('messages', 'MessageController');
    Route::resource('user', 'UserController');
    Route::get('/sponsorship/{apartment}', 'SponsorshipController@index')->name('sponsorship.index');
    Route::get('/payment/{sponsorship}/{apartment}', 'PaymentController@index')->name('payment.index');
    Route::post('/payment/checkout/{sponsorship}/{apartment}', 'PaymentController@store')->name('payment.checkout');
});

Route::get('{any?}', function(){
    return view('guest.welcome');
} )->where("any", ".*");

