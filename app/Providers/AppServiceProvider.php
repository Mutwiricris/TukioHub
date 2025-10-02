<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Booking;
use App\Observers\EventObserver;
use App\Observers\BookingObserver;
use App\Services\CacheService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register CacheService as singleton
        $this->app->singleton(CacheService::class, function ($app) {
            return new CacheService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register model observers
        Event::observe(EventObserver::class);
        Booking::observe(BookingObserver::class);

        // Share cache status with all views
        View::composer('*', function ($view) {
            $view->with('cacheEnabled', config('cache.default') === 'redis');
        });

        // Optimize database queries
        if (app()->environment('production')) {
            // Enable query caching in production
            config(['database.redis.options.prefix' => config('cache.prefix')]);
        }
    }
}
