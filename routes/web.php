<?php

use App\Http\Controllers\Food\Cost\FoodCostStoreController;
use App\Http\Controllers\Food\Cost\FoodCostUpdateController;
use App\Http\Controllers\Food\FoodCreateController;
use App\Http\Controllers\Food\FoodShowController;
use App\Http\Controllers\Food\FoodUpdateController;
use App\Http\Controllers\Food\Ingredient\FoodIngredientStoreController;
use App\Http\Controllers\Food\Ingredient\FoodIngredientUpdateController;
use App\Http\Controllers\Profile\ProfileDestroyController;
use App\Http\Controllers\Profile\ProfileEditController;
use App\Http\Controllers\Profile\ProfileUpdateController;
use App\Http\Controllers\User\UserIndexController;
use App\Http\Controllers\User\UserCreateController;
use App\Http\Controllers\User\UserStoreController;
use App\Http\Controllers\User\UserDestroyController;
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
        Route::get('/', UserIndexController::class)->name('index');
        Route::get('/novo', UserCreateController::class)->name('create');
        Route::post('/', UserStoreController::class)->name('store');
        Route::delete('/{user}', UserDestroyController::class)->name('destroy');
    });

    Route::prefix('/receita')->name('web.food.')->group(function () {
        Route::get('/', FoodShowController::class)->name('show');
        Route::post('/', FoodCreateController::class)->name('create');
        
        Route::prefix('{food}')->group(function () {
            Route::patch('/', FoodUpdateController::class)->name('update');
            
            Route::prefix('/ingrediente')->name('web.food.ingredient.')->group(function () {
                Route::post('/', FoodIngredientStoreController::class)->name('store');

                Route::prefix('{ingredient}')->group(function () {
                    Route::post('/', FoodIngredientUpdateController::class)->name('update');
                });
            });

            Route::prefix('/custo-operacional')->name('web.food.costs.')->group(function () {
                Route::post('/', FoodCostStoreController::class)->name('store');

                Route::prefix('{cost}')->group(function () {
                    Route::post('/', FoodCostUpdateController::class)->name('update');
                });
            });
        });
    });
});


require __DIR__.'/auth.php';
