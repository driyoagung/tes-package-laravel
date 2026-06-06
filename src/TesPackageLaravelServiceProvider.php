<?php

namespace Driyoagung\TesPackageLaravel;

use Illuminate\Support\ServiceProvider;

class TesPackageLaravelServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tes-package');
    }
}
