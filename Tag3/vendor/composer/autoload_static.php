<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit71c380cc402da7ef84c570f1ca1c6977
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Src\\' => 4,
        ),
        'R' => 
        array (
            'Renne\\Tag3\\' => 11,
        ),
        'L' => 
        array (
            'Lib\\' => 4,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Src\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Renne\\Tag3\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Lib\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Steampixel' => 
            array (
                0 => __DIR__ . '/..' . '/steampixel/simple-php-router/src',
            ),
        ),
        'P' => 
        array (
            'Parsedown' => 
            array (
                0 => __DIR__ . '/..' . '/erusev/parsedown',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit71c380cc402da7ef84c570f1ca1c6977::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit71c380cc402da7ef84c570f1ca1c6977::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit71c380cc402da7ef84c570f1ca1c6977::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit71c380cc402da7ef84c570f1ca1c6977::$classMap;

        }, null, ClassLoader::class);
    }
}
