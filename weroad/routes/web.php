<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TravelController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Editor;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(Admin::class)->group(function () {
        Route::get('/travels/create', [TravelController::class, 'create'])->name('travels.create');
        Route::post('/travels', [TravelController::class, 'store'])->name('travels.store');
        Route::delete('/travels/{travel}', [TravelController::class, 'destroy'])->name('travels.destroy');

        Route::get('/travels/{slug}/tours/create', [TourController::class, 'create'])->name('tours.create');
        Route::post('/travels/{travel}/tours', [TourController::class, 'store'])->name('tours.store');
        Route::get('/tours/{tour}/edit', [TourController::class, 'edit'])->name('tours.edit');
        Route::put('/tours/{tour}', [TourController::class, 'update'])->name('tours.update');
        Route::delete('/tours/{tour}', [TourController::class, 'destroy'])->name('tours.destroy');
    });

    Route::middleware(Editor::class)->group(function () {
        Route::get('/travels/{slug}/edit', [TravelController::class, 'edit'])->name('travels.edit');
        Route::put('/travels/{travel}', [TravelController::class, 'update'])->name('travels.update');
    });
});

// Show Travels index
Route::get('/', [TravelController::class, 'index'])->name('dashboard');
Route::get('/travels/{slug}', [TravelController::class, 'show'])->name('travels.show');

require __DIR__.'/auth.php';
