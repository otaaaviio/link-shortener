<?php

use App\Http\Controllers\ShortenedUrlController;
use Illuminate\Support\Facades\Route;

Route::post('/findOrCreate', [ShortenedUrlController::class, 'findOrCreate']);
Route::get('/{hashedUrl}', [ShortenedUrlController::class, 'redirectToOriginalUrl']);
