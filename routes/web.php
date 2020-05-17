<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'CabinetController@index')->name('cabinet');
Route::get('/today', 'CabinetController@today')->name('today');
Route::get('/tomorrow', 'CabinetController@tomorrow')->name('tomorrow');
Route::get('/permit/{id}', 'PermitController@permit')->name('permit');
Route::get('/permit-pdf/{id}', 'PermitController@pdf')->name('pdf');
