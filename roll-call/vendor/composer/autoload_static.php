<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5d5f64f73432025f17a99dcfb6891689
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Rollcall\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Rollcall\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5d5f64f73432025f17a99dcfb6891689::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5d5f64f73432025f17a99dcfb6891689::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5d5f64f73432025f17a99dcfb6891689::$classMap;

        }, null, ClassLoader::class);
    }
}
