<?php

namespace Vilija19\Modelshistory;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class ModelsHistoryServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/modelshistory.php', 'modelshistory'
        );
    }

    public function boot()
    {

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->publishes([
            __DIR__.'/../config/modelshistory.php' => config_path('modelshistory.php'),
        ]);

        foreach (config('modelshistory.models') as $model) {
            if (!class_exists($model)) {
                continue;
            }
            $model::saved(UpdateModelLogger::class, 'handle');
        }

    }
    
}
