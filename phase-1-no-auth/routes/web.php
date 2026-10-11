<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about-us', function () {
    return view('welcome');
});

Route::resource('devices', DeviceController::class);