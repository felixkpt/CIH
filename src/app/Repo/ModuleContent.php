<?php

namespace CIH\Core\App\Repo;

use Illuminate\Support\Facades\Artisan;

class ModuleContent
{
    protected static $path = null;
    protected static $action = null;
    protected static $name = null;
    protected static $namespace = null;
    protected static $args = null;
    static function make($path, $action, $name, $namespace, $args = null)
    {

        self::$path = $path;
        self::$action = $action;
        self::$name = array_slice(explode('/', $name), -1, 1)[0];
        self::$namespace = preg_replace("#/#", "\\\\", $namespace);
        self::$args = $args;
        if ($action == "Controllers") {
            self::controller();
        } else if ($action == "Models") {
            self::model();
        } else if ($action == "migrations") {
            self::migration();
        } else if ($action == "routes") {
            self::route();
        }
    }

    function controller()
    {
        $namespace = 'CIH\\' . self::$namespace;
        $contents = 
'<?php 
namespace ' . $namespace . ';
class ' . self::$name . ' {

}';

        file_put_contents(self::$path, $contents);
    }
    function model()
    {
        $namespace = 'CIH\\' . self::$namespace;
        $contents = 
'<?php 
namespace ' . $namespace . ';
class ' . self::$name . ' {
}';

        file_put_contents(self::$path, $contents);
    }

    function migration()
    {

   Artisan::call('make:migration', 
    array(
        'name' => self::$name,
        '--path' => resolve('modules_folder').preg_replace('#\\\#', "/", self::$namespace),
        '--table' => self::$args['table']
        )
    );

    }

    function route()
    {
        $contents = 
'<?php 
use Illuminate\Support\Facades\Route;
';
        file_put_contents(self::$path, $contents);
    }
}
