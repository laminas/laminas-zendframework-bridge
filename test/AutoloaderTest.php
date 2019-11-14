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
            ['Zend\Expressive\Expressive',                                              'Expressive\Expressive'],
            ['Zend\Expressive\Authentication\Authentication',                           'Expressive\Authentication\Authentication'],
            ['Zend\Expressive\Authentication\ZendAuthentication\AuthenticationAdapter', 'Expressive\Authentication\LaminasAuthentication\AuthenticationAdapter'],
            ['Zend\Expressive\Authentication\ZendAuthentication\ZendAuthentication',    'Expressive\Authentication\LaminasAuthentication\LaminasAuthentication'],
            ['Zend\Expressive\Authorization\Authorization',                             'Expressive\Authorization\Authorization'],
            ['Zend\Expressive\Authorization\Acl\ZendAclFactory',                        'Expressive\Authorization\Acl\LaminasAclFactory'],
            ['Zend\Expressive\Authorization\Rbac\ZendRbac',                             'Expressive\Authorization\Rbac\LaminasRbac'],
            ['Zend\Expressive\Router\Router',                                           'Expressive\Router\Router'],
            ['Zend\Expressive\Router\ZendRouter',                                       'Expressive\Router\LaminasRouter'],
            ['Zend\Expressive\Router\ZendRouter\RouterAdapter',                         'Expressive\Router\LaminasRouter\RouterAdapter'],
            ['Zend\Expressive\ZendView\ZendViewRenderer',                               'Expressive\LaminasView\LaminasViewRenderer'],
            ['Zend\ProblemDetails\ProblemDetails',                                      'Expressive\ProblemDetails\ProblemDetails'],
            // phpcs:enable

            // Laminas
            ['Zend\Expressive',                    'Laminas\Expressive'],
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
            ['ZF\Apigility\BaseModule', 'Apigility\BaseModule'],
            ['ZF\BaseModule',           'Apigility\BaseModule'],
        ];
    }

    /**
     * @dataProvider classProvider
     * @param string $legacy
     * @param string $actual
     */
    public function testLegacyClassIsAliasToLaminas($legacy, $actual)
    {
        self::assertTrue(class_exists($legacy));
        self::assertSame($actual, get_class(new $legacy()));
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
            ['Apigility\Admin\Example',         'ZF\Apigility\Admin\Example'],
            ['Apigility\Doctrine\Example',      'ZF\Apigility\Doctrine\Example'],
            ['Apigility\Documentation\Example', 'ZF\Apigility\Documentation\Example'],
            ['Apigility\Example\Example',       'ZF\Apigility\Example\Example'],
            ['Apigility\Provider\Example',      'ZF\Apigility\Provider\Example'],
            ['Apigility\Welcome\Example',       'ZF\Apigility\Welcome\Example'],
            ['Apigility\Other\Example',         'ZF\Other\Example'],
            ['Apigility\Example',               'ZF\Example'],

            // Expressive
            ['Expressive\ProblemDetails\Example', 'Zend\ProblemDetails\Example'],
            ['Expressive\Other\Example',          'Zend\Expressive\Other\Example'],
            ['Expressive\Example',                'Zend\Expressive\Example'],

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
