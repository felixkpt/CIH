<?php

namespace CIH\Core;

use App\Http\Middleware\CIH;
use Illuminate\Support\ServiceProvider;

class CIHServiceProvider extends ServiceProvider
{

    protected $module = 'core';

    public function boot()
    {

        // Pushing our middlewares
        /** @var Router $router */
        $router = $this->app['router'];
        $router->aliasMiddleware('CIH', CIH::class);

        // Binding our current module name and folder name to the app
        $this->app->bind('modules_folder', function () {
            return 'modules/';
        });
        $this->app->bind('module', function () {
            return $this->module;
        });
        
        $this->app->bind('folder', function () {
            $resolve_folder = \request()->route()->uri;
            return $this->module . '::' . ($resolve_folder === '/') ? 'home' : $resolve_folder;
        });

        // Telling Laravel where to load our routes, views, and migrations from
        $this->loadRoutesFrom(__DIR__ . '/routes/web/index.php');
        $this->loadViewsFrom(__DIR__ . '/views', $this->module);
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations', $this->module);

        // Loading our Console commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                \CIH\Core\App\Console\Commands\Main::class
            ]);
        }
    }

    public function regiter()
    {
    }
}
