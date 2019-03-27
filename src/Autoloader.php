<?php
/**
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright Copyright (c) 2019 Laminas Foundation (https://getlaminas.org)
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\ZendFrameworkBridge;

/**
 * Alias legacy Zend Framework project classes/interfaces/traits to Laminas equivalents.
 */
class Autoloader
{
    public static function load()
    {
        self::registerFunctionAliases();
        self::registerClassLoader();
    }

    /**
     * @todo: maybe we should remove aliasing for functions from this bridge library
     *      and using similar method we can provide aliases in the respective libraries,
     *      then we can easily support all version of zend-stratigility, zend-diactoros...
     */
    public static function registerFunctionAliases()
    {
        $functions = RewriteRules::functionRewrite();
        foreach ($functions as $legacy => $new) {
            if (! function_exists($legacy)
                && function_exists($new)
            ) {
                $last = strrpos($legacy, '\\');
                $namespace = substr($legacy, 0, $last);
                $function = substr($legacy, $last + 1);

                $string = sprintf(
                    'namespace %s; function %s() { return call_user_func_array(\'%s\', func_get_args()); }',
                    $namespace,
                    $function,
                    $new
                );

                // @todo: think about better method here, as eval can be disabled on many prod env
                eval($string);
            }
        }
    }

    /**
     * This autoloader is _append_, so a mix of legacy and Laminas classes can be used.
     */
    public static function registerClassLoader()
    {
        $classes = RewriteRules::classRewrite();
        spl_autoload_register(static function ($class) use ($classes) {
            foreach ($classes as $legacy => $new) {
                if (strpos($class, $legacy) === 0) {
                    $alias = $new . substr($class, strlen($legacy));
                    class_alias($alias, $class);
                    return;
                }
            }
        });
    }
}
