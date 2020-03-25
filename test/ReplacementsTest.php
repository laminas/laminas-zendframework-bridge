<?php

/**
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright https://github.com/laminas/laminas-zendframework-bridge/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\ZendFrameworkBridge;

use Laminas\ZendFrameworkBridge\Replacements;
use PHPUnit\Framework\TestCase;

use function file_get_contents;

class ReplacementsTest extends TestCase
{
    /**
     * @return iterable
     */
    public function edgeCases()
    {
        yield 'Example class' => [
            file_get_contents(__DIR__ . '/TestAsset/Replacements/TestClass.php'),
            file_get_contents(__DIR__ . '/TestAsset/Replacements/TestClass.php.out'),
        ];
        yield 'Apigility module' => ['ZF\Apigility', 'Laminas\ApiTools'];
        yield 'Apigility documentation module' => ['ZF\Apigility\Documentation', 'Laminas\ApiTools\Documentation'];
        yield 'Apigility modules.config.php' => [
            file_get_contents(__DIR__ . '/TestAsset/Replacements/edge-case-apigility-modules.php'),
            file_get_contents(__DIR__ . '/TestAsset/Replacements/edge-case-apigility-modules.php.out'),
        ];
        yield 'Auryn' => [
            'Northwoods\Container\Zend\Config',
            'Northwoods\Container\Zend\Config',
        ];
        yield 'Expressive ZendRouter' => [
            'Zend\Expressive\Router\ZendRouter',
            'Mezzio\Router\LaminasRouter',
        ];
        yield 'Expressive ZendView Renderer' => [
            'Zend\Expressive\ZendView\ZendViewRenderer',
            'Mezzio\LaminasView\LaminasViewRenderer',
        ];
        yield 'Expressive ACL Authorizations' => [
            'Zend\Expressive\Authorization\Acl\ZendAcl',
            'Mezzio\Authorization\Acl\LaminasAcl',
        ];
        yield 'Expressive RBAC Authorizations' => [
            'Zend\Expressive\Authorization\Rbac\ZendRbac',
            'Mezzio\Authorization\Rbac\LaminasRbac',
        ];
        yield 'Cache Zend Server abstract adapter' => [
            'Zend\Cache\Storage\Adapter\AbstractZendServer',
            'Laminas\Cache\Storage\Adapter\AbstractZendServer',
        ];
        yield 'Cache Zend Server Disk adapter' => [
            'Zend\Cache\Storage\Adapter\ZendServerDisk',
            'Laminas\Cache\Storage\Adapter\ZendServerDisk',
        ];
        yield 'Cache Zend Server Shm adapter' => [
            'Zend\Cache\Storage\Adapter\ZendServerShm',
            'Laminas\Cache\Storage\Adapter\ZendServerShm',
        ];
        yield 'Log Zend Monitor writer' => [
            'Zend\Log\Writer\ZendMonitor',
            'Laminas\Log\Writer\ZendMonitor',
        ];
    }

    /**
     * @dataProvider edgeCases
     *
     * @param string $string
     * @param string $expected
     */
    public function testEdgeCases($string, $expected)
    {
        $replacements = new Replacements();
        $this->assertSame($expected, $replacements->replace($string));
    }
}
