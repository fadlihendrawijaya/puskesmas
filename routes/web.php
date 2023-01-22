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
Route::get('/pasien/tambah/', 'PasienController@tambah_pasien')->name('pasien.tambah');
Route::get('/pasien/hapus/{id}', 'PasienController@hapus_pasien');
Route::get('/pasien/edit/{id}', 'PasienController@edit_pasien');
Route::post('/pasien/tambah/simpan', 'PasienController@simpan_pasien')->name('pasien.simpan');
Route::post('/pasien/edit/update/', 'PasienController@update_pasien')->name('pasien.update');

Route::get('/obat', 'ObatController@index')->name('obat');
Route::get('/obat/hapus/{id}','ObatController@hapus_obat');
Route::get('/obat/edit/{id}', 'ObatController@edit_obat');
Route::get('/obat/tambah/', 'ObatController@tambah_obat')->name('obat.tambah');
Route::post('/obat/tambah/simpan', 'ObatController@simpan_obat')->name('obat.simpan');
Route::post('/obat/edit/update/', 'ObatController@update_obat')->name('obat.update');

Route::get('/lab', 'LabController@index')->name('lab');
Route::get('/lab/hapus/{id}','LabController@hapus_lab');
Route::get('/lab/edit/{id}', 'LabController@edit_lab');
Route::get('/lab/tambah/', 'LabController@tambah_lab')->name('lab.tambah');
Route::post('/lab/tambah/simpan', 'LabController@simpan_lab')->name('lab.simpan');
Route::post('/lab/edit/update/', 'LabController@update_lab')->name('lab.update');

Route::get('/rekamedis', 'RekamMedisController@index')->name('rekamedis');
Route::get('/rekamedis/hapus/{id}','RekamMedisController@hapus_rm');
Route::get('/rekamedis/edit/{id}', 'RekamMedisController@edit_rm');
Route::get('/rekamedis/tambah', 'RekamMedisController@tambah_rm')->name('rekamedis.tambah');
Route::get('/rekamedis/tambah/{idpasien}', 'RekamMedisController@tambah_rmid')->name('rekamedis.tambah.id');
Route::post('/rekamedis/simpan/', 'RekamMedisController@simpan_rm')->name('rekamedis.simpan');
Route::post('/rekamedis/update/', 'RekamMedisController@update_rm')->name('rekamedis.update');
Route::get('/rekamedis/list/{idpasien}', 'RekamMedisController@list_rm')->name('rekamedis.list');
Route::get('/rekamedis/lihat/{id}', 'RekamMedisController@lihat_rm')->name('rekamedis.lihat');

Route::get('/tagihan/{id}', 'RekamMedisController@tagihan')->name('rekamedis.tagihan');
