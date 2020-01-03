<?php

/**
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright https://github.com/laminas/laminas-zendframework-bridge/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\ZendFrameworkBridge;

use Laminas\ZendFrameworkBridge\Replacements;
use PHPUnit\Framework\TestCase;

class ReplacementsTest extends TestCase
{
    /**
     * @return iterable
     */
    public function edgeCases()
    {
        return array(
            array('Example class', array(
                file_get_contents(__DIR__ . '/TestAsset/Replacements/TestClass.php'),
                file_get_contents(__DIR__ . '/TestAsset/Replacements/TestClass.php.out'),
            )
            ),
            array('Apigility module', array('ZF\Apigility', 'Laminas\ApiTools')),
            array('Apigility documentation module', array(
                'ZF\Apigility\Documentation', 'Laminas\ApiTools\Documentation')
            ),
            array('Apigility modules.config.php', array(
                file_get_contents(__DIR__ . '/TestAsset/Replacements/edge-case-apigility-modules.php'),
                file_get_contents(__DIR__ . '/TestAsset/Replacements/edge-case-apigility-modules.php.out'),
            )),
            array('Auryn', array(
                'Northwoods\Container\Zend\Config',
                'Northwoods\Container\Zend\Config'
            )),
            array('Expressive ZendRouter', array(
                'Zend\Expressive\Router\ZendRouter',
                'Mezzio\Router\LaminasRouter'
            )),
            array('Expressive ZendView Renderer', array(
                'Zend\Expressive\ZendView\ZendViewRenderer',
                'Mezzio\LaminasView\LaminasViewRenderer'
            )),
            array('Expressive ACL Authorizations', array(
                'Zend\Expressive\Authorization\Acl\ZendAcl',
                'Mezzio\Authorization\Acl\LaminasAcl'
            )),
            array('Expressive RBAC Authorizations', array(
                'Zend\Expressive\Authorization\Rbac\ZendRbac',
                'Mezzio\Authorization\Rbac\LaminasRbac'
            )),
            array('Cache Zend Server abstract adapter', array(
                'Zend\Cache\Storage\Adapter\AbstractZendServer',
                'Laminas\Cache\Storage\Adapter\AbstractZendServer'
            )),
            array('Cache Zend Server Disk adapter', array(
                'Zend\Cache\Storage\Adapter\ZendServerDisk',
                'Laminas\Cache\Storage\Adapter\ZendServerDisk'
            )),
            array('Cache Zend Server Shm adapter', array(
                'Zend\Cache\Storage\Adapter\ZendServerShm',
                'Laminas\Cache\Storage\Adapter\ZendServerShm'
            )),
            array('Log Zend Monitor writer', array(
                'Zend\Log\Writer\ZendMonitor',
                'Laminas\Log\Writer\ZendMonitor'
            ))
        );
    }

    /**
     * @dataProvider edgeCases
     * @param string $name
     * @param array  $values
     */
    public function testEdgeCases($name, $values)
    {
        list($string, $expected) = $values;

        $replacements = new Replacements();
        $this->assertSame($expected, $replacements->replace($string), $name);
    }
}
