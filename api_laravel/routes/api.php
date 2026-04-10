<?php

use App\Http\Controllers\Api\LogController;
use Illuminate\Support\Facades\Route;

Route::get('/logs', [LogController::class, 'index']);
Route::post('/logs', [LogController::class, 'store']);
