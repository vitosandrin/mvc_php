<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2e2b58a73d9d5dc53acd0c2c7f29d456
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2e2b58a73d9d5dc53acd0c2c7f29d456::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2e2b58a73d9d5dc53acd0c2c7f29d456::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2e2b58a73d9d5dc53acd0c2c7f29d456::$classMap;

        }, null, ClassLoader::class);
    }
}
