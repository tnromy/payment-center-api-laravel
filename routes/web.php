<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function() {
	return redirect('/api');
});


Route::get('/login', function() {
	//echo "halo";
	return view('login.index');
});

Route::get('/login/callback', function() {
	//echo "halo";
	return view('login.oauth2');
});



