<?php

/**
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright https://github.com/laminas/laminas-zendframework-bridge/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\ZendFrameworkBridge;

use Laminas\ZendFrameworkBridge\ConfigPostProcessor;
use PHPUnit\Framework\TestCase;
use stdClass;

use function sprintf;

class ConfigPostProcessorTest extends TestCase
{
    /**
     * @return iterable
     */
    public function configurations()
    {
        yield 'Acelaya Expressive Slim Router' => ['ExpressiveSlimRouterConfig.php'];
        yield 'mwop.net App module config' => ['MwopNetAppConfig.php'];
        yield 'cyclical aliasing' => ['CyclicalAliasing.php'];
        yield 'unknown Expressive config' => ['UnknownExpressiveConfiguration.php'];
        yield 'equivalent key merging' => ['MergeEquivalentKeys.php'];
        yield 'ignore router config' => ['RouterConfig.php'];
        yield 'process invokable config' => ['InvokableConfig.php'];
        yield 'non aliased service config' => ['NonAliasedServiceConfiguration.php'];
        yield 'config delegators' => ['Delegators.php'];
        yield 'abstract factories' => ['AbstractFactories.php'];
        yield 'lazy services' => ['LazyServices.php'];
        yield 'service manager configuration' => ['FullServiceManagerConfiguration.php'];
        yield 'invalid service manager configuration' => ['InvalidServiceManagerConfiguration.php'];
    }

    /**
     * @dataProvider configurations
     * @param string $configFile
     */
    public function testRewritesNestedKeys($configFile)
    {
        $configLocation         = sprintf('%s/TestAsset/ConfigPostProcessor/%s', __DIR__, $configFile);
        $expectedResultLocation = $configLocation . '.out';
        $config                 = require $configLocation;
        $expected               = require $expectedResultLocation;
        $processor              = new ConfigPostProcessor();

        $this->assertSame($expected, $processor($config));
    }

    public function testServiceManagerServiceInstancesCanBeHandled()
    {
        $instance = new stdClass();
        $config = [
            'dependencies' => [
                'services' => [
                    'Zend\Cache\MyClass' => $instance,
                ],
            ],
        ];
        $expected = [
            'dependencies' => [
                'services' => [
                    'Laminas\Cache\MyClass' => $instance,
                ],
                'aliases' => [
                    'Zend\Cache\MyClass' => 'Laminas\Cache\MyClass',
                ],
            ],
        ];

        $processor = new ConfigPostProcessor();

        self::assertSame($expected, $processor($config));
    }

    /**
     * @dataProvider invalidServiceManagerConfiguration
     * @param array<string,array<string,mixed>> $config
     */
    public function testWillSkipInvalidConfigurations($config)
    {
        $processor = new ConfigPostProcessor();
        self::assertSame($config, $processor($config));
    }

    public function invalidServiceManagerConfiguration()
    {
        yield 'non array values in dependency config' => [
            [
                'dependencies' => [
                    'services' => 'non-array',
                    'aliases' => 'non-array',
                    'factories' => 'non-array',
                    'delegators' => 'non-array',
                    'invokables' => 'non-array',
                    'abstract_factories' => 'non-array',
                ],
            ],
        ];

        yield 'non array values in dependency delegators config' => [
            [
                'dependencies' => [
                    'delegators' => [
                        'class' => 'non-array',
                    ],
                ],
            ],
        ];

        yield 'non array values in lazy_services.class_map config' => [
            [
                'dependencies' => [
                    'lazy_services' => [
                        'class_map' => 'non-array',
                    ],
                ],
            ],
        ];

        yield 'non string values in alias key/value pairs' => [
            [
                'dependencies' => [
                    'aliases' => [
                        'foo',
                    ],
                ],
            ],
        ];

        yield 'non string value for mapped alias' => [
            [
                'dependencies' => [
                    'aliases' => [
                        'foo' => 0,
                        'bar' => new stdClass(),
                    ],
                ],
            ],
        ];
    }
}
