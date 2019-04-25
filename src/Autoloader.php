<?php
/**
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright https://github.com/laminas/laminas-zendframework-bridge/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\ZendFrameworkBridge;

use Composer\Autoload\ClassLoader;
use RuntimeException;

/**
 * Alias legacy Zend Framework project classes/interfaces/traits to Laminas equivalents.
 */
class Autoloader
{
    /**
     * We attach two autoloaders:
     * - _prepend_ to handle new classes and add aliases for legacy classes.
     *   This is required to keep typehints compatibility.
     * - _append_ to handle legacy classes and alias them to new classes.
     */
    public static function load()
    {
        static $loaded = array();

        $classLoader = self::getClassLoader();

        $namespaces = RewriteRules::namespaceReverse();
        spl_autoload_register(function ($class) use ($namespaces, $classLoader, &$loaded) {
            if (isset($loaded[$class])) {
                return;
            }

            $segments = explode('\\', $class);

            $i = 0;
            $check = '';

            while (isset($namespaces[$check . $segments[$i] . '\\'])) {
                $check .= $segments[$i] . '\\';
                ++$i;
            }

            if ($check === '') {
                return;
            }

            if ($classLoader->loadClass($class)) {
                $legacy = $namespaces[$check] . str_replace('Laminas', 'Zend', substr($class, strlen($check)));
                class_alias($class, $legacy);
            }
        }, true, true);

        $namespaces = RewriteRules::namespaceRewrite();
        spl_autoload_register(function ($class) use ($namespaces, &$loaded) {
            $segments = explode('\\', $class);

            $i = 0;
            $check = '';

            // We are checking segments of the namespace to match quicker
            while (isset($namespaces[$check . $segments[$i] . '\\'])) {
                $check .= $segments[$i] . '\\';
                ++$i;
            }

            if ($check === '') {
                return;
            }

            $alias = $namespaces[$check] . str_replace('Zend', 'Laminas', substr($class, strlen($check)));

            $loaded[$alias] = true;
            if (class_exists($alias) || interface_exists($alias) || trait_exists($alias)) {
                class_alias($alias, $class);
            }
        });
    }

    /**
     * @return ClassLoader
     * @throws RuntimeException
     */
    private static function getClassLoader()
    {
        if (file_exists(__DIR__ . '/../../../autoload.php')) {
            return include __DIR__ . '/../../../autoload.php';
        }

        if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
            return include __DIR__ . '/../vendor/autoload.php';
        }

        throw new RuntimeException('Cannot detect composer autoload. Please run composer install');
    }
}
