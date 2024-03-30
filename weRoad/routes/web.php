<?php

use App\Http\Controllers\TravelController;
use Illuminate\Support\Facades\Route;

// Show Travels index
Route::get('/', [TravelController::class, 'index']);

// Show create Travel
Route::get('/travels/create', [TravelController::class, 'create']);

// Show Edit Form
Route::get('/travels/{travel}/edit', [TravelController::class, 'edit']);

// Single Travel
Route::get('/travels/{travel}', [TravelController::class, 'show']);

// Store Travel Data
Route::post('/travels', [TravelController::class, 'store']);

// Update Travels
Route::put('/travels/{travel}', [TravelController::class, 'update']);

// Delete Travels
Route::delete('/travels/{travel}', [TravelController::class, 'destroy']);
