<?php

/**
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright https://github.com/laminas/laminas-zendframework-bridge/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\ZendFrameworkBridge;

use Laminas\LegacyTypeHint;
use PHPUnit\Framework\TestCase;

class AutoloaderTest extends TestCase
{
    /**
     * @return array[]
     */
    public function classProvider()
    {
        return array(
            // phpcs:disable Generic.Files.LineLength.TooLong
            // Expressive
            array('Zend\Expressive\Application',                                             'Mezzio\Application'),
            array('Zend\Expressive\Authentication\Authentication',                           'Mezzio\Authentication\Authentication'),
            array('Zend\Expressive\Authentication\ZendAuthentication\AuthenticationAdapter', 'Mezzio\Authentication\LaminasAuthentication\AuthenticationAdapter'),
            array('Zend\Expressive\Authentication\ZendAuthentication\ZendAuthentication',    'Mezzio\Authentication\LaminasAuthentication\LaminasAuthentication'),
            array('Zend\Expressive\Authorization\Authorization',                             'Mezzio\Authorization\Authorization'),
            array('Zend\Expressive\Authorization\Acl\ZendAclFactory',                        'Mezzio\Authorization\Acl\LaminasAclFactory'),
            array('Zend\Expressive\Authorization\Rbac\ZendRbac',                             'Mezzio\Authorization\Rbac\LaminasRbac'),
            array('Zend\Expressive\Router\Router',                                           'Mezzio\Router\Router'),
            array('Zend\Expressive\Router\ZendRouter',                                       'Mezzio\Router\LaminasRouter'),
            array('Zend\Expressive\Router\ZendRouter\RouterAdapter',                         'Mezzio\Router\LaminasRouter\RouterAdapter'),
            array('Zend\Expressive\ZendView\ZendViewRenderer',                               'Mezzio\LaminasView\LaminasViewRenderer'),
            array('Zend\ProblemDetails\ProblemDetails',                                      'Mezzio\ProblemDetails\ProblemDetails'),
            array('Zend\Expressive\Hal\LinkGenerator\ExpressiveUrlGenerator',                'Mezzio\Hal\LinkGenerator\MezzioUrlGenerator'),
            // phpcs:enable

            // Laminas
            array('Zend\Cache\Storage\Adapter\AbstractZendServer', 'Laminas\Cache\Storage\Adapter\AbstractZendServer'),
            array('Zend\Cache\Storage\Adapter\ZendServerDisk',     'Laminas\Cache\Storage\Adapter\ZendServerDisk'),
            array('Zend\Cache\Storage\Adapter\ZendServerShm',      'Laminas\Cache\Storage\Adapter\ZendServerShm'),
            array('Zend\Expressive',                               'Laminas\Mezzio'),
            array('Zend\Log\Writer\ZendMonitor',                   'Laminas\Log\Writer\ZendMonitor'),
            array('Zend\Main',                                     'Laminas\Main'),
            array('Zend\Psr7Bridge\Psr7Bridge',                    'Laminas\Psr7Bridge\Psr7Bridge'),
            array('Zend\Psr7Bridge\ZendBridge',                    'Laminas\Psr7Bridge\LaminasBridge'),
            array('Zend\Psr7Bridge\Zend\Psr7Bridge',               'Laminas\Psr7Bridge\Laminas\Psr7Bridge'),
            array('Zend\Psr7Bridge\Zend\ZendBridge',               'Laminas\Psr7Bridge\Laminas\LaminasBridge'),
            array('ZendService\ReCaptcha\MyClass',                 'Laminas\ReCaptcha\MyClass'),
            array('ZendService\Twitter\MyClass',                   'Laminas\Twitter\MyClass'),
            array('ZendXml\XmlService',                            'Laminas\Xml\XmlService'),
            array('ZendOAuth\OAuthService',                        'Laminas\OAuth\OAuthService'),
            array('ZendDiagnostics\Tools',                         'Laminas\Diagnostics\Tools'),
            array('ZendDeveloperTools\Tools',                      'Laminas\DeveloperTools\Tools'),
            array('ZF\ComposerAutoloading\Autoloading',            'Laminas\ComposerAutoloading\Autoloading'),
            array('ZF\DevelopmentMode\DevelopmentMode',            'Laminas\DevelopmentMode\DevelopmentMode'),

            // Apigility
            // phpcs:disable Generic.Files.LineLength.TooLong
            array('ZF\Apigility\BaseModule',        'Laminas\ApiTools\BaseModule'),
            array('ZF\BaseModule',                  'Laminas\ApiTools\BaseModule'),
            array('ZF\Apigility\Admin\Controller\ApigilityVersionController', 'Laminas\ApiTools\Admin\Controller\ApiToolsVersionController'),
            array('ZF\Apigility\ApigilityModuleInterface', 'Laminas\ApiTools\ApiToolsModuleInterface', true),
            array('ZF\Apigility\Provider\ApigilityProviderInterface', 'Laminas\ApiTools\Provider\ApiToolsProviderInterface', true),
            // phpcs:enable
        );
    }

    /**
     * @dataProvider classProvider
     * @param string $legacy
     * @param string $actual
     * @param null|bool $isInterface
     */
    public function testLegacyClassIsAliasToLaminas($legacy, $actual, $isInterface = false)
    {
        self::assertTrue($isInterface ? interface_exists($legacy) : class_exists($legacy));
        if (! $isInterface) {
            self::assertSame($actual, get_class(new $legacy()));
        }
    }

    public function testTypeHint()
    {
        self::assertTrue(class_exists('Laminas\LegacyTypeHint'));
        new LegacyTypeHint(new \Laminas\Example());
    }

    /**
     * @return array[]
     */
    public function reverseClassProvider()
    {
        return array(
            // Apigility
            array('Laminas\ApiTools\Admin\Example',         'ZF\Apigility\Admin\Example'),
            array('Laminas\ApiTools\Doctrine\Example',      'ZF\Apigility\Doctrine\Example'),
            array('Laminas\ApiTools\Documentation\Example', 'ZF\Apigility\Documentation\Example'),
            array('Laminas\ApiTools\Example\Example',       'ZF\Apigility\Example\Example'),
            array('Laminas\ApiTools\Provider\Example',      'ZF\Apigility\Provider\Example'),
            array('Laminas\ApiTools\Welcome\Example',       'ZF\Apigility\Welcome\Example'),
            array('Laminas\ApiTools\Other\ApiToolsClass',   'ZF\Other\ApigilityClass'),
            array('Laminas\ApiTools\Other\Example',         'ZF\Other\Example'),
            array('Laminas\ApiTools\Example',               'ZF\Example'),

            // Expressive
            array('Mezzio\ProblemDetails\Example', 'Zend\ProblemDetails\Example'),
            array('Mezzio\Other\Example',          'Zend\Expressive\Other\Example'),
            array('Mezzio\Other\MezzioClass',      'Zend\Expressive\Other\ExpressiveClass'),
            array('Mezzio\Example',                'Zend\Expressive\Example'),

            // Laminas
            array('Laminas\ReCaptcha\Example',                        'ZendService\ReCaptcha\Example'),
            array('Laminas\Twitter\Example',                          'ZendService\Twitter\Example'),
            array('Laminas\Cache\Storage\Adapter\AbstractZendServer', 'Zend\Cache\Storage\Adapter\AbstractZendServer'),
            array('Laminas\Cache\Storage\Adapter\ZendServerDisk',     'Zend\Cache\Storage\Adapter\ZendServerDisk'),
            array('Laminas\Cache\Storage\Adapter\ZendServerShm',      'Zend\Cache\Storage\Adapter\ZendServerShm'),
            array('Laminas\ComposerAutoloading\Example',              'ZF\ComposerAutoloading\Example'),
            array('Laminas\DevelopmentMode\Example',                  'ZF\DevelopmentMode\Example'),
            array('Laminas\Diagnostics\Example',                      'ZendDiagnostics\Example'),
            array('Laminas\Log\Writer\ZendMonitor',                   'Zend\Log\Writer\ZendMonitor'),
            array('Laminas\OAuth\Example',                            'ZendOAuth\Example'),
            array('Laminas\Xml\Example',                              'ZendXml\Example'),
            array('Laminas\Other\LaminasExample',                     'Zend\Other\ZendExample'),
            array('Laminas\Other\Example',                            'Zend\Other\Example'),
            array('Laminas\Example',                                  'Zend\Example'),
            array('Laminas\DeveloperTools\Example',                   'ZendDeveloperTools\Example'),
            array('Laminas\Router\LaminasRouterClass',                'Zend\Router\ZendRouterClass'),
        );
    }

    /**
     * @dataProvider reverseClassProvider
     * @param string $actual
     * @param string $legacy
     */
    public function testReverseAliasCreated($actual, $legacy)
    {
        self::assertTrue(class_exists($actual));
        self::assertTrue(class_exists($legacy));
    }
}
