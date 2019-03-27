<?php
/**
 * Provide aliases for zend-containerconfigtest functions.
 *
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright Copyright (c) 2019 Laminas Foundation (https://getlaminas.org)
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

namespace Zend\ContainerConfigTest\TestAsset;

use Laminas\ContainerConfigTest\TestAsset\FactoryService;
use Laminas\ContainerConfigTest\TestAsset\Service;
use Psr\Container\ContainerInterface;

use function Laminas\ContainerConfigTest\TestAsset\function_factory as laminas_function_factory;
use function Laminas\ContainerConfigTest\TestAsset\function_factory_with_name as laminas_function_factory_with_name;

// Only define functions if one or more known functions do not exist
if (! function_exists(__NAMESPACE__ . '\function_factory')) {
    function function_factory(ContainerInterface $container, string $name) : Service
    {
        return laminas_function_factory($container, $name);
    }
    
    function function_factory_with_name(ContainerInterface $container, string $name) : FactoryService
    {
        return laminas_function_factory_with_name($container, $name);
    }
}
