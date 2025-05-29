<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\ListingController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\AvailabilityController;
use App\Http\Controllers\Admin\BookingController;

Route::redirect('/dashboard', '/admin/dashboard');
Route::group([
    'namespace' => 'App\Http\Controllers\Admin',
    'prefix' => 'admin',
    'middleware' => ['auth','verified'],
    'as' => 'admin.',
], function () {
    Route::redirect('/', '/admin/dashboard');
    Route::get('dashboard', function () {
        return Inertia::render('admin/dashboard');
    })->name('dashboard');
    
    Route::resource('listings', ListingController::class);
    Route::resource('reviews', ReviewController::class);
    
    Route::resource('bookings', BookingController::class)->except(['create', 'store', 'edit']);
    
    Route::get('/availability', [AvailabilityController::class, 'index'])->name('availability.index');
    Route::post('/availability/services', [AvailabilityController::class, 'updateServices']);
    
});
