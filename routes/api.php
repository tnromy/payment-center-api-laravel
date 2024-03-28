<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
	Route::get('/contacts', 'index')->middleware('keycloak');
	Route::get('/contact/search', 'search')->middleware('keycloak');
	Route::delete('/contact', 'destroy')->middleware('keycloak');
	Route::put('/contact', 'update')->middleware('keycloak');
	Route::get('/contact/{id}/groups', 'contactGroups')->middleware('keycloak');
});

Route::controller(App\Http\Controllers\ContactGroupController::class)->group(function() {
	Route::get('/contact-groups', 'index')->middleware('keycloak');
	Route::post('/contact-group', 'store')->middleware('keycloak');
});