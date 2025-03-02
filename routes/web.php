<?php

use Illuminate\Support\Facades\Route;

Route::get('/hi', function () {
    return view('welcome');
});
