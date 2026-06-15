
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function () {
    return 'Login submitted';
});

Route::get('/register', function () {
    return view('register');
})->name('register');