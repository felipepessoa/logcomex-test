<?php

namespace App\Providers;

use App\Services\AI\Contracts\ExpenseExtractorInterface;
use App\Services\AI\GeminiExpenseExtractor;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ExpenseExtractorInterface::class, GeminiExpenseExtractor::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
