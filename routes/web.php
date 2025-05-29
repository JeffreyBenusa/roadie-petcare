<?php

use App\Http\Controllers\HomepageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AvailabilityController;


Route::get('/', [HomepageController::class, 'show'])->name('home');

Route::get('listings', [ListingController::class, 'index'])->name('listings.index');
Route::get('listings/{id}', [ListingController::class, 'show'])->name('listings.show');

Route::get('/providers', [AvailabilityController::class, 'search'])->name('providers.index');

Route::resource('users', UserController::class);

require __DIR__.'/admin.php';
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
