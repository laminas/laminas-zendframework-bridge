<?php

/**
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright https://github.com/laminas/laminas-zendframework-bridge/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\ZendFrameworkBridge;

use Laminas\ZendFrameworkBridge\ConfigPostProcessor;
use PHPUnit\Framework\TestCase;

class ConfigPostProcessorTest extends TestCase
{
    /**
     * @return iterable
     */
    public function configurations()
    {
        return array(
            array('Acelaya Expressive Slim Router', 'ExpressiveSlimRouterConfig.php'),
            array('mwop.net App module config', 'MwopNetAppConfig.php'),
            array('cyclical aliasing', 'CyclicalAliasing.php'),
            array('unknown Expressive config', 'UnknownExpressiveConfiguration.php'),
            array('equivalent key merging', 'MergeEquivalentKeys.php'),
            array('ignore router config', 'RouterConfig.php'),
            array('process invokable config', 'InvokableConfig.php')
        );
    }

    /**
     * @dataProvider configurations
     * @param string $name
     * @param string $configFile
     */
    public function testRewritesNestedKeys($name, $configFile)
    {
        $configLocation = sprintf('%s/TestAsset/ConfigPostProcessor/%s', __DIR__, $configFile);
        $expectedResultLocation = $configLocation . '.out';
        $config    = require $configLocation;
        $expected  = require $expectedResultLocation;
        $processor = new ConfigPostProcessor();

        $this->assertSame($expected, $processor($config), $name);
    }
}
