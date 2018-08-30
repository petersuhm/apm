<?php

namespace Vistik\Apm\ServiceProvider;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\ServiceProvider;
use Vistik\Apm\Listeners\QueryListener;
use Vistik\Apm\Request\RequestContext;

class ApmServiceProvider extends ServiceProvider
{

    protected $listen = [
        QueryExecuted::class => [
            QueryListener::class,
        ]
    ];

    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/apm.php' => config_path('apm.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }

    public function register()
    {
        $this->app->singleton(RequestContext::class);
    }
}