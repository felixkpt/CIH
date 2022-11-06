<?php

namespace CIH\Ministries;

use App\Http\Middleware\CIH;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class MinistriesServiceProvider extends ServiceProvider
{

    protected $module = 'ministries';

    public function boot()
    {
        // Pushing middlewares
        /** @var Router $router */
        $router = $this->app['router'];
        $router->aliasMiddleware('CIH', CIH::class);

        $this->app->bind('module', function() {
            return $this->module;
        });
        $this->app->bind('folder', function() {
            return $this->module.'::'.\request()->route()->uri;
        });

        $this->loadRoutesFrom(__DIR__ . '/routes/web/index.php');
        $this->loadViewsFrom(__DIR__ . '/views', $this->module);
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations', $this->module);
    }

    public function regiter()
    {
    }
}
