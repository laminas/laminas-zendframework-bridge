<?php
/**
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright https://github.com/laminas/laminas-zendframework-bridge/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

if (PHP_VERSION_ID >= 71000) {
    require __DIR__ . '/autoload-functions-containerconfigtest.php';
    require __DIR__ . '/autoload-functions-diactoros.php';
}

if (PHP_VERSION_ID >= 56000) {
    require __DIR__ . '/autoload-functions-stratigility.php';
}

/**
 * Alias legacy Zend Framework project classes/interfaces/traits to Laminas equivalents.
 *
 * This autoloader is _appended_, so a mix of legacy and Laminas classes can be used.
 */
spl_autoload_register(function ($class) {
    // Zend and Expressive
    if (strpos($class, 'Zend\\') === 0) {
        $alias = strpos($class, 'Zend\\Expressive\\') === 0 || strpos($class, 'Zend\\ProblemDetails\\') === 0
            ? str_replace(array('Zend\\Expressive\\', 'Zend\\ProblemDetails\\'), 'Expressive\\', $class)
            : str_replace('Zend\\', 'Laminas\\', $class);

        class_alias($alias, $class);
        return;
    }

    // Apigility
    // @todo Need to determine the final name and namespace for zf-console
    if (strpos($class, 'ZF\\') === 0) {
        $alias = preg_match('#^ZF\\(ComposerAutoloading|Deploy|DevelopmentMode)\\#', $class)
            ? str_replace('ZF\\', 'Laminas\\', $class)
            : str_replace('ZF\\', 'Apigility\\', $class);

        // zf-apigility-doctrine
        if (strpos($alias, 'Apigility\\Apigility\\') === 0) {
            $alias = str_replace('Apigility\\Apigility\\', 'Apigility\\', $alias);
        }

        class_alias($alias, $class);
        return;
    }

    // ZendXml, API wrappers, zend-http OAuth support, zend-diagnostics
    if (strpos($class, 'ZendXml\\') === 0
        || strpos($class, 'ZendService\\') === 0
        || strpos($class, 'ZendOAuth\\') === 0
        || strpos($class, 'ZendDiagnostics\\') === 0
    ) {
        // phpcs:disable
        $alias = str_replace(
            array(     'ZendXml\\', 'ZendService\\',      'ZendOAuth\\',      'ZendDiagnostics\\'),
            array('Laminas\\Xml\\',     'Laminas\\', 'Laminas\\OAuth\\', 'Laminas\\Diagnostics\\'),
            $class
        );
        // phpcs:enable
        class_alias($alias, $class);
        return;
    }
});
