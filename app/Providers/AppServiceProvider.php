<?php

namespace App\Providers;

use App\StudyingClass;
use App\Observers\ClassObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        StudyingClass::observe(ClassObserver::class);
    }
}
