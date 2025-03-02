<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::apiResource("contacts",ContactController::class);