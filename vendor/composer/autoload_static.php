<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2346ee765b0efaf4b95c59ee85c58403
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'C\\Ministries\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'C\\Ministries\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2346ee765b0efaf4b95c59ee85c58403::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2346ee765b0efaf4b95c59ee85c58403::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2346ee765b0efaf4b95c59ee85c58403::$classMap;

        }, null, ClassLoader::class);
    }
}
