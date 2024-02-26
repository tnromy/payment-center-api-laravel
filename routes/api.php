<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function(){
	return "Welcome to API Simpeg Kota Tangerang Selatan";
});

include '_api_master.php';
include '_api_admin.php';
include '_api_pegawai.php';
include 'api2.php';
include '_api_unor.php';




Route::controller(App\Http\Controllers\RoleController::class)->group(function() {
	Route::get('/roles', 'index');
	Route::get('/role/apps', 'apps');
});

Route::controller(App\Http\Controllers\AuthController::class)->group(function() {
	Route::get('/test/redis', 'myRedis');
	Route::get('/email/verification/{user_id}', 'verificationEmail')->name('email.verification')->middleware('signed');
	Route::get('/login/oauth2-url', 'getOauth2URL');
	Route::post('/login/oauth2-token', 'getAccessToken');
	Route::get('/login/oauth2-refresh', 'refreshToken');
	Route::get('/login/oauth2-user', 'getUserInfo')->middleware('keycloak');
	Route::get('/logout/oauth2-url', 'getLogoutURL')->middleware(["keycloak:Admin|ASN|OP BKSDM|OP OPD|OP PD"]);

});

Route::controller(App\Http\Controllers\UserController::class)->group(function() {
Route::post('/register', 'register');
});

Route::controller(App\Http\Controllers\AgamaController::class)->group(function() {
Route::get('/agama-lists', 'index');
});

Route::controller(App\Http\Controllers\StatusPerkawinanController::class)->group(function() {
Route::get('/status-perkawinan-lists', 'index');
});

Route::controller(App\Http\Controllers\SukuController::class)->group(function() {
Route::get('/suku-lists', 'index');
});

Route::controller(App\Http\Controllers\GelarController::class)->group(function() {
Route::get('/gelar-lists/{gelar_kategori}', 'index');
Route::post('/gelar', 'store')->middleware(['keycloak:Admin']);
Route::post('/gelar/search', 'search');
Route::put('/gelar/{gelar_id}', 'update')->middleware(['keycloak:Admin']);
Route::get('/gelar/{gelar_id}', 'show')->middleware(['keycloak:Admin']);
Route::delete('/gelar/{gelar_id}', 'destroy')->middleware(['keycloak:Admin']);
});

Route::controller(App\Http\Controllers\JenisPegawaiController::class)->group(function() {
Route::get('/jenis-pegawai-lists', 'index');
Route::post('/jenis-pegawai', 'store')->middleware(['keycloak:Admin']);
Route::post('/jenis-pegawai/search', 'search');
Route::put('/jenis-pegawai/{jenis_pegawai_id}', 'update')->middleware(['keycloak:Admin']);
Route::delete('/jenis-pegawai/{jenis_pegawai_id}', 'destroy')->middleware(['keycloak:Admin']);
});

Route::controller(App\Http\Controllers\GolonganController::class)->group(function() {
Route::get('/golongan-lists', 'index');
Route::post('/golongan', 'store')->middleware(['keycloak:Admin']);
Route::put('/golongan/{golongan_id}', 'update')->middleware(['keycloak:Admin']);
Route::delete('/golongan/{golongan_id}', 'destroy')->middleware(['keycloak:Admin']);
});

Route::controller(App\Http\Controllers\LokasiController::class)->group(function() {
    Route::get('/lokasi/provinsi-lists', 'states'); // route untuk menampilkan daftar provinsi
    Route::get('/lokasi/provinsi/{lokasi_kode}/kota-lists', 'cities'); // route untuk menampilkan daftar kota di suatu provinsi
    Route::get('/lokasi/kota/{lokasi_kode}/kecamatan-lists', 'districts'); // route untuk menampilkan daftar kecamatan di suatu kota
    Route::get('/lokasi/kecamatan/{lokasi_kode}/kelurahan-lists', 'villages'); // route untuk menampilkan daftar kelurahan di suatu kecamatan

});

Route::controller(App\Http\Controllers\KedudukanHukumController::class)->group(function() {
Route::get('/kedudukan-hukum-lists', 'index');
});

Route::controller(App\Http\Controllers\InstansiController::class)->group(function() {
Route::get('/instansi-lists', 'index');
Route::post('/instansi/search', 'search');
});

Route::controller(App\Http\Controllers\KpknController::class)->group(function() {
Route::get('/kpkn-lists', 'index');
Route::post('/kpkn/search', 'search');
});

Route::controller(App\Http\Controllers\TaspenController::class)->group(function() {
Route::get('/taspen-lists', 'index');
});

Route::controller(App\Http\Controllers\RefTableController::class)->group(function() {
	Route::get('/ref-table-list', 'index')->middleware(["keycloak:Admin"]);
});

Route::controller(App\Http\Controllers\JenisKepangkatanController::class)->group(function() {
	Route::get('/jenis-kepangkatan-list', 'index');
});
Route::controller(App\Http\Controllers\JenisDokumenController::class)->group(function () {
	Route::get('/dokumen/jenis-lists', 'index');
});

Route::controller(App\Http\Controllers\DokumenPegawaiController::class)->group(function () {
	Route::post('/dokumen/pegawai', 'store')->middleware(["keycloak:Admin|ASN|OP BKSDM|OP OPD|OP PD"]);
	Route::delete('/dokumen/pegawai/{dokumen_pegawai_id}', 'destroy')->middleware(["keycloak:Admin|ASN|OP BKSDM|OP OPD|OP PD"]);
	Route::put('/dokumen/pegawai/{dokumen_pegawai_id}', 'update')->middleware(["keycloak:Admin|ASN|OP BKSDM|OP OPD|OP PD"]);
	Route::get('/dokumen/pegawai-lists', 'index')->middleware(["keycloak:Admin|ASN|OP BKSDM|OP OPD|OP PD"]);
});


Route::controller(App\Http\Controllers\KeteranganJabatanController::class)->group(function () {
	Route::get('/jabatan/keterangan-list', 'index');
});

