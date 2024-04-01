<?php

use App\Http\Controllers\TourController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Show Travels index
Route::get('/dashboard', [TravelController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/', [TravelController::class, 'index'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // travels
    Route::get('/travels/create', [TravelController::class, 'create'])->name('travels.create');
    Route::get('/travels/{travel}/edit', [TravelController::class, 'edit'])->name('travels.edit');
    Route::get('/travels/{travel}', [TravelController::class, 'show'])->name('travels.show');
    Route::post('/travels', [TravelController::class, 'store'])->name('travels.store');
    Route::put('/travels/{travel}', [TravelController::class, 'update'])->name('travels.update');
    Route::delete('/travels/{travel}', [TravelController::class, 'destroy'])->name('travels.destroy');

    // tours
    Route::get('/travels/{travel}/tours/create', [TourController::class, 'create'])->name('tours.create');
    Route::post('/travels/{travel}/tours', [TourController::class, 'store'])->name('tours.store');
    Route::get('/tours/{tour}/edit', [TourController::class, 'edit'])->name('tours.edit');
    Route::put('/tours/{tour}', [TourController::class, 'update'])->name('tours.update');
    Route::delete('/tours/{tour}', [TourController::class, 'destroy'])->name('tours.destroy');
});

require __DIR__ . '/auth.php';
