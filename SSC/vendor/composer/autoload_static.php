<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit444380742698d56b3cbfb34dc55a3a03
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Valitron\\' => 9,
        ),
        'S' => 
        array (
            'Src\\' => 4,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Valitron\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/valitron/src/Valitron',
        ),
        'Src\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
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
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit444380742698d56b3cbfb34dc55a3a03::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit444380742698d56b3cbfb34dc55a3a03::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit444380742698d56b3cbfb34dc55a3a03::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit444380742698d56b3cbfb34dc55a3a03::$classMap;

        }, null, ClassLoader::class);
    }
}
