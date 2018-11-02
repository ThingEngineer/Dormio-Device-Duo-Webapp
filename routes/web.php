<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| https://laravel.com/docs/5.7/routing
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('dp', 'WearableDataPointsController');

Route::get('ver/{mac}','FirmwareController@ver');
Route::get('bin/{mac}','FirmwareController@bin');
