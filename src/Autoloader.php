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
    /**
     * This autoloader is _append_, so a mix of legacy and Laminas classes can be used.
     */
    public static function load()
    {
        $classes = RewriteRules::namespaceRewrite();
        spl_autoload_register(static function ($class) use ($classes) {
            $segments = explode('\\', $class);

            $i = 0;
            $check = '';

            while (isset($classes[$check . $segments[$i] . '\\'])) {
                $check .= $segments[$i] . '\\';
                ++$i;
            }

            if ($check !== '') {
                $alias = $classes[$check] . substr($class, strlen($check));
                class_alias($alias, $class);
                return;
            }
        });
    }
}
