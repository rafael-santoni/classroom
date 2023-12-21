<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInite6653d38f2115bbb028f486e601dd276
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

        spl_autoload_register(array('ComposerAutoloaderInite6653d38f2115bbb028f486e601dd276', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInite6653d38f2115bbb028f486e601dd276', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInite6653d38f2115bbb028f486e601dd276::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
