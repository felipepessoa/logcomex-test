<?php

use App\Http\Controllers\Pokemon\PokemonController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('auth:sanctum')->name('v1.')->group(function () {
    Route::apiResource('pokemon', PokemonController::class)->only(['index', 'show']);
});
