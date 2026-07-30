<?php

use App\Http\Controllers\ExpensesController;

Route::prefix('expenses')
    ->name('expenses.')
    ->group(static function (): void {
        Route::post('/import', [ExpensesController::class, 'import'])->name('import');
        Route::get('/', [ExpensesController::class, 'index'])->name('index');
    });
