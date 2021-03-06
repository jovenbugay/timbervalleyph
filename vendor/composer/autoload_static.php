<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit41ecd1ee2ad3d991961b43a25a991370
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twilio\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twilio\\' => 
        array (
            0 => __DIR__ . '/..' . '/twilio/sdk/src/Twilio',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit41ecd1ee2ad3d991961b43a25a991370::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit41ecd1ee2ad3d991961b43a25a991370::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit41ecd1ee2ad3d991961b43a25a991370::$classMap;

        }, null, ClassLoader::class);
    }
}
