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





Route::controller(App\Providers\Keycloak\KeycloakController::class)->group(function() {
	Route::get('/login/oauth2-url', 'getOauth2URL');
	Route::post('/login/oauth2-token', 'getAccessToken');
	Route::get('/login/oauth2-refresh', 'refreshToken');
	Route::get('/login/oauth2-user', 'getUserInfo')->middleware('keycloak');
	Route::get('/logout/oauth2-url', 'getLogoutURL')->middleware(["keycloak:Admin|ASN|OP BKSDM|OP OPD|OP PD"]);

});

Route::controller(App\Http\Controllers\UserController::class)->group(function() {
Route::post('/register', 'register');
});



Route::controller(App\Http\Controllers\LocationController::class)->group(function() {
    Route::get('/location/provinsi-lists', 'states'); // route untuk menampilkan daftar provinsi
    Route::get('/location/provinsi/{code}/kota-lists', 'cities'); // route untuk menampilkan daftar kota di suatu provinsi
    Route::get('/location/kota/{code}/kecamatan-lists', 'districts'); // route untuk menampilkan daftar kecamatan di suatu kota
    Route::get('/location/kecamatan/{code}/kelurahan-lists', 'villages'); // route untuk menampilkan daftar kelurahan di suatu kecamatan

});

Route::controller(App\Http\Controllers\ContactController::class)->group(function() {
	Route::post('/contact', 'store')->middleware('keycloak');
});