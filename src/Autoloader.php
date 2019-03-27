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
