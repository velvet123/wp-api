<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit1d5e2dd562e2eb956e62e4de32253a85
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit1d5e2dd562e2eb956e62e4de32253a85', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit1d5e2dd562e2eb956e62e4de32253a85', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit1d5e2dd562e2eb956e62e4de32253a85::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}