<?php

namespace Vistik\Apm\ServiceProvider;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Vistik\Apm\Listeners\QueryListener;
use Vistik\Apm\Request\RequestContext;

class ApmServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/apm.php' => config_path('apm.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }

    public function register()
    {
        $this->app->singleton(RequestContext::class);

        Event::listen(QueryExecuted::class, QueryListener::class);
    }
}