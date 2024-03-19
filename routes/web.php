<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/contact', function() {
    //echo "halo";
    return view('contact.index');
});



