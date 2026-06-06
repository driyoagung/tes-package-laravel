<?php

namespace Driyoagung\TesPackageLaravel;

use Illuminate\Support\ServiceProvider;

class TesPackageLaravelServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tes-package');
    }
}
