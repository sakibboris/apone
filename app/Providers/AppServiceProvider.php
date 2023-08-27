<?php

namespace App\Providers;

use App\Constants\CommonConstants;
use App\Repositories\BlogRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\BlogRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BlogRepositoryInterface::class, BlogRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
