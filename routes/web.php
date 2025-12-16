<?php

use App\Http\Controllers\Profile\ProfileDestroyController;
use App\Http\Controllers\Profile\ProfileEditController;
use App\Http\Controllers\Profile\ProfileUpdateController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('web.dashboard');

Route::middleware('auth')->group(function () {

    Route::prefix('perfil')->name('web.profile.')->group(function () {
        Route::get('/', ProfileEditController::class)->name('edit');
        Route::patch('/', ProfileUpdateController::class)->name('update');
        Route::delete('/', ProfileDestroyController::class)->name('destroy');
    });

    Route::prefix('usuarios')->name('web.users.')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('index');
        Route::get('/novo', [UsersController::class, 'create'])->name('create');
        Route::post('/', [UsersController::class, 'store'])->name('store');
        Route::delete('/{id}', [UsersController::class, 'destroy'])->name('destroy');
    });
});


require __DIR__.'/auth.php';
