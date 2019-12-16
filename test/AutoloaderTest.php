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
        return [
            // phpcs:disable Generic.Files.LineLength.TooLong
            // Expressive
            ['Zend\Expressive\Application',                                             'Mezzio\Application'],
            ['Zend\Expressive\Authentication\Authentication',                           'Mezzio\Authentication\Authentication'],
            ['Zend\Expressive\Authentication\ZendAuthentication\AuthenticationAdapter', 'Mezzio\Authentication\LaminasAuthentication\AuthenticationAdapter'],
            ['Zend\Expressive\Authentication\ZendAuthentication\ZendAuthentication',    'Mezzio\Authentication\LaminasAuthentication\LaminasAuthentication'],
            ['Zend\Expressive\Authorization\Authorization',                             'Mezzio\Authorization\Authorization'],
            ['Zend\Expressive\Authorization\Acl\ZendAclFactory',                        'Mezzio\Authorization\Acl\LaminasAclFactory'],
            ['Zend\Expressive\Authorization\Rbac\ZendRbac',                             'Mezzio\Authorization\Rbac\LaminasRbac'],
            ['Zend\Expressive\Router\Router',                                           'Mezzio\Router\Router'],
            ['Zend\Expressive\Router\ZendRouter',                                       'Mezzio\Router\LaminasRouter'],
            ['Zend\Expressive\Router\ZendRouter\RouterAdapter',                         'Mezzio\Router\LaminasRouter\RouterAdapter'],
            ['Zend\Expressive\ZendView\ZendViewRenderer',                               'Mezzio\LaminasView\LaminasViewRenderer'],
            ['Zend\ProblemDetails\ProblemDetails',                                      'Mezzio\ProblemDetails\ProblemDetails'],
            ['Zend\Expressive\Hal\LinkGenerator\ExpressiveUrlGenerator',                'Mezzio\Hal\LinkGenerator\MezzioUrlGenerator'],
            // phpcs:enable

            // Laminas
            ['Zend\Expressive',                    'Laminas\Mezzio'],
            ['Zend\Main',                          'Laminas\Main'],
            ['Zend\Psr7Bridge\Psr7Bridge',         'Laminas\Psr7Bridge\Psr7Bridge'],
            ['Zend\Psr7Bridge\ZendBridge',         'Laminas\Psr7Bridge\LaminasBridge'],
            ['Zend\Psr7Bridge\Zend\Psr7Bridge',    'Laminas\Psr7Bridge\Laminas\Psr7Bridge'],
            ['Zend\Psr7Bridge\Zend\ZendBridge',    'Laminas\Psr7Bridge\Laminas\LaminasBridge'],
            ['ZendService\ReCaptcha\MyClass',      'Laminas\ReCaptcha\MyClass'],
            ['ZendService\Twitter\MyClass',        'Laminas\Twitter\MyClass'],
            ['ZendXml\XmlService',                 'Laminas\Xml\XmlService'],
            ['ZendOAuth\OAuthService',             'Laminas\OAuth\OAuthService'],
            ['ZendDiagnostics\Tools',              'Laminas\Diagnostics\Tools'],
            ['ZendDeveloperTools\Tools',           'Laminas\DeveloperTools\Tools'],
            ['ZF\ComposerAutoloading\Autoloading', 'Laminas\ComposerAutoloading\Autoloading'],
            ['ZF\Deploy\Deploy',                   'Laminas\Deploy\Deploy'],
            ['ZF\DevelopmentMode\DevelopmentMode', 'Laminas\DevelopmentMode\DevelopmentMode'],

            // Apigility
            ['ZF\Apigility\BaseModule',        'Laminas\ApiTools\BaseModule'],
            ['ZF\BaseModule',                  'Laminas\ApiTools\BaseModule'],
            ['ZF\Apigility\Admin\Controller\ApigilityVersionController', 'Laminas\ApiTools\Admin\Controller\ApiToolsVersionController'],
            ['ZF\Apigility\ApigilityModuleInterface', 'Laminas\ApiTools\ApiToolsModuleInterface', true],
            ['ZF\Apigility\Provider\ApigilityProviderInterface', 'Laminas\ApiTools\Provider\ApiToolsProviderInterface', true],
        ];
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
        return [
            // Apigility
            ['Laminas\ApiTools\Admin\Example',         'ZF\Apigility\Admin\Example'],
            ['Laminas\ApiTools\Doctrine\Example',      'ZF\Apigility\Doctrine\Example'],
            ['Laminas\ApiTools\Documentation\Example', 'ZF\Apigility\Documentation\Example'],
            ['Laminas\ApiTools\Example\Example',       'ZF\Apigility\Example\Example'],
            ['Laminas\ApiTools\Provider\Example',      'ZF\Apigility\Provider\Example'],
            ['Laminas\ApiTools\Welcome\Example',       'ZF\Apigility\Welcome\Example'],
            ['Laminas\ApiTools\Other\Example',         'ZF\Other\Example'],
            ['Laminas\ApiTools\Example',               'ZF\Example'],

            // Expressive
            ['Mezzio\ProblemDetails\Example', 'Zend\ProblemDetails\Example'],
            ['Mezzio\Other\Example',          'Zend\Expressive\Other\Example'],
            ['Mezzio\Example',                'Zend\Expressive\Example'],

            // Laminas
            ['Laminas\ReCaptcha\Example',           'ZendService\ReCaptcha\Example'],
            ['Laminas\Twitter\Example',             'ZendService\Twitter\Example'],
            ['Laminas\ComposerAutoloading\Example', 'ZF\ComposerAutoloading\Example'],
            ['Laminas\Deploy\Example',              'ZF\Deploy\Example'],
            ['Laminas\DevelopmentMode\Example',     'ZF\DevelopmentMode\Example'],
            ['Laminas\Diagnostics\Example',         'ZendDiagnostics\Example'],
            ['Laminas\OAuth\Example',               'ZendOAuth\Example'],
            ['Laminas\Xml\Example',                 'ZendXml\Example'],
            ['Laminas\Other\LaminasExample',        'Zend\Other\ZendExample'],
            ['Laminas\Other\Example',               'Zend\Other\Example'],
            ['Laminas\Example',                     'Zend\Example'],
            ['Laminas\DeveloperTools\Example',      'ZendDeveloperTools\Example'],
        ];
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
