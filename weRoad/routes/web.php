<?php

use App\Http\Controllers\TourController;
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


// Show create tour by travel
Route::get('/travels/{travel}/tours/create', [TourController::class, 'create']);

// Store Tour Data
Route::post('/travels/{travel}/tours', [TourController::class, 'store']);

// Show Edit Form
Route::get('/tours/{tour}/edit', [TourController::class, 'edit']);

// Update Tour
Route::put('/tours/{tour}', [TourController::class, 'update'])->name('tours.update');

// Delete Travels
Route::delete('/tours/{tour}', [TourController::class, 'destroy']);
