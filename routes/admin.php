<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\ReviewController;

Route::redirect('/dashboard', '/admin/dashboard');
//https://github.com/balajidharma/laravel-vue-admin-panel/blob/2.x/routes/admin.php
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
    
    Route::resource('jobs', JobController::class);
    Route::resource('reviews', ReviewController::class);
});
