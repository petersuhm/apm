<?php

namespace Tests\Unit;

use Illuminate\Http\Request;
use Orchestra\Testbench\TestCase;
use Vistik\Apm\Middleware\ApmMiddleware;
use Vistik\Apm\Request\RequestContext;
use Vistik\Apm\ServiceProvider\ApmServiceProvider;

class ApmMiddlewareTest extends TestCase
{

    protected function getEnvironmentSetUp($app)
    {
//        dd(get_class($app));
        // Setup default database to use sqlite :memory:
//        $app['config']->set('database.default', 'testbench');
//        $app['config']->set('database.connections.testbench', [
//            'driver'   => 'sqlite',
//            'database' => ':memory:',
//            'prefix'   => '',
//        ]);
//        dd($app['config']);
        $app['config']->set('apm.sampling', 0);
    }

    protected function getPackageProviders($app)
    {
        return [ApmServiceProvider::class];
    }

    /** @test */
    public function can_sample()
    {
        // Given
//        config(['apm.sampling' => 0]);
        $context = new RequestContext();
        $middleware = new ApmMiddleware($context);
        $closure = function () {};
        $mock = \Mockery::mock(Request::class);
//        $mock->shouldReceive()
        // When
        $middleware->handle($mock, $closure);

        // Then

    }
}