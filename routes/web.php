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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/pasien', 'PasienController@index')->name('pasien');
Route::resource('pasien', 'PasienController');

Route::get('/obat', 'ObatController@index')->name('obat');
Route::resource('obat', 'ObatController');

Route::get('/lab', 'LabController@index')->name('lab');
Route::resource('lab', 'LabController');

Route::get('/rekamedis', 'RekamMedisController@index')->name('rekamedis');
Route::resource('rekamedis', 'RekamMedisController');