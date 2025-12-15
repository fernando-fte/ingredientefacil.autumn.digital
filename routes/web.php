<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('web.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('web.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('web.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('web.profile.destroy');
});

require __DIR__.'/auth.php';
