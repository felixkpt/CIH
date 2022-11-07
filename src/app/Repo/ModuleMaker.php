<?php

namespace CIH\Core\App\Repo;

use \Illuminate\Support\Facades\Artisan;

class ModuleMaker
{

    protected $module = null;
    protected $namespace = null;
    protected $action = null;
    protected $name = null;
    protected $actionIsFile = false;
    protected $args = false;
    public function __construct($module)
    {
        $this->module = ucfirst($module);
    }

    public function make($action = null, $name = null, $args = null)
    {

        $this->action = $action;
        if ($action == 'controller' || $action == 'model')
            $name = ucfirst($name);
        $this->name = $name;
        $this->args = $args;

        $action = resolve('modules_folder') . $this->module;
        if ($this->action === 'controller') {
            $this->action = 'Controllers';
            $action = resolve('modules_folder') . $this->module . "/app/Http/$this->action";
            if ($this->name)
                $action = resolve('modules_folder') . $this->module . "/app/Http/$this->action/" . $this->name;
        } elseif ($this->action === 'model') {
            $this->action = 'Models';
            $action = resolve('modules_folder') . $this->module . "/app/$this->action";
            if ($this->name)
                $action = resolve('modules_folder') . $this->module . "/app/$this->action/" . $this->name;
        } elseif ($this->action === 'migration') {
            $this->action = 'migrations';
            $action = resolve('modules_folder') . $this->module . "/database/$this->action";
            if ($this->name)
                $action = resolve('modules_folder') . $this->module . "/database/$this->action/" . $this->name;
        } elseif ($this->action === 'route') {
            $this->action = 'routes';
            $action = resolve('modules_folder') . $this->module . "/routes/web";
            if ($this->name)
                $action = resolve('modules_folder') . $this->module . "/routes/web/" . $this->name;
        }

        if ($this->exists() === false) {
            $msg = '';
            if ($this->actionIsFile) {
                $namespace = preg_replace("#app/#", "App/", ucfirst(trim(preg_replace("#^" . resolve('modules_folder') . "#", "", $action), '/')), 1);
                $this->namespace = substr($namespace, 0, strrpos($namespace, '/'));
                if (!file_exists($action . '.php')) {
                    $this->createPath($action . '.php');
                    $msg = 'Created ' . $action;
                } else {
                    $msg = 'Already created ' . $action;
                }
            } else {
                // Use case when module name is only supplied. Here we create default controller, model, route, migrations, factory/seeder and request
                if (is_string($action) && $name == null && $args == null) {
                    // dd($this->module);
                    // php artisan make:model Todo -a
                    $this->createPath($action);
                }

                $msg = 'Created folder ' . $action;
            }
            return $msg;
        } else {
            return "Already exists";
        }
    }

    public function exists(): bool
    {

        if ($this->action && $this->name) {
            $this->actionIsFile = true;
            return file_exists($this->path());
        }

        return is_dir($this->path());
    }

    public function path(): string
    {
        $res = base_path(resolve('modules_folder') . $this->module);
        if ($this->action && $this->name) {
            $res .= '/' . $this->action . '/' . $this->name . '.php';
        } elseif ($this->action) {
            $res .= $this->action;
        }

        return $res;
    }

    public function createPath($path)
    {
        $path = base_path($path);
        // dd('p::' . $path);
        $parts = explode('/', $path);
        $prev = '';
        foreach ($parts as $part) {
            $prev .= '/' . $part;
            $prev = preg_replace('#//#', '/', $prev);

            if (!preg_match('#\.php#', $prev)) {
                if (!is_dir($prev)) {
                    mkdir($prev);
                }
            } elseif (!is_file($prev)) {
                ModuleContent::make($prev, $this->action, $this->name, $this->namespace, $this->args);
            }
        }
    }
}
