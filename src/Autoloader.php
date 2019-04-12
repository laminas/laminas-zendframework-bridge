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
        $namespaces = RewriteRules::namespaceRewrite();
        spl_autoload_register(function ($class) use ($namespaces) {
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

            if (class_exists($alias) || interface_exists($alias) || trait_exists($alias)) {
                class_alias($alias, $class);
            }
        });
    }
}
