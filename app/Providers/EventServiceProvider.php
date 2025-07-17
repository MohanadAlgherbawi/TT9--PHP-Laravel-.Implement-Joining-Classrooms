<?php

namespace App\Providers;

use App\Models\Classroom;
use App\Observers\ClassroomObserver;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        Classroom::observe(ClassroomObserver::class);
    }
}
