<?php
/**
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright https://github.com/laminas/laminas-zendframework-bridge/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\ZendFrameworkBridge;

/**
 * Alias legacy Zend Framework project classes/interfaces/traits to Laminas equivalents.
 */
class Autoloader
{
    /**
     * This autoloader is _appended_, so a mix of legacy and Laminas classes
     * can be used.
     */
    public static function load()
    {
        static $loaded = array();

        $classLoader = self::getClassLoader();

        $namespaces = RewriteRules::namespaceRewrite();
        spl_autoload_register(function ($class) use ($namespaces, $classLoader, &$loaded) {
            if (isset($loaded[$class])) {
                return;
            }

            // @todo: we need here reverse mapping:
            //    from new class names we need to get old class name
            //    that we can add alias - then typehints can work
            //    as expected.
            if (strpos($class, 'Expressive\\') === 0) {
                if ($file = $classLoader->findFile($class)) {
                    \Composer\Autoload\includeFile($file);
                    class_alias($class, 'Zend\\' . $class, false);
                }
            } elseif (strpos($class, 'Laminas\\') === 0) {
                if ($file = $classLoader->findFile($class)) {
                    \Composer\Autoload\includeFile($file);
                    class_alias($class, str_replace('Laminas\\', 'Zend\\', $class), false);
                }
            } elseif (strpos($class, 'Apigility\\') === 0) {
                if ($file = $classLoader->findFile($class)) {
                    \Composer\Autoload\includeFile($file);
                    class_alias($class, 'ZF\\' . $class);
                }
            }
        }, true, true);

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

    private static function getClassLoader()
    {
        if (file_exists(__DIR__ . '/../../../autoload.php')) {
            return include __DIR__ . '/../../../autoload.php';
        }

        if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
            return include __DIR__ . '/../vendor/autoload.php';
        }

        throw new \RuntimeException('Cannot detect composer autoload. Please run composer install');
    }
}
