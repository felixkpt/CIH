<?php

//Loading all .php files into of routes/web 

use Illuminate\Support\Facades\Route;
use CIH\Ministries\App\Repo\LoadRoutes;

Route::middleware('CIH')->group(function () {

    $dir = '/'.resolve('module');
    $dirs = array(__DIR__ . $dir);

    

    foreach ($dirs as $dir) {
        $res = (new LoadRoutes())->loadRecursively($dir, [], $dir, true);
        array_map(function ($val) {
            include_once $val;
        }, $res);
    }
});
