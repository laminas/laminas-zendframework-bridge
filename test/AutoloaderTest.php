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
    public function classProvider()
    {
        return array(
            // Expressive
            array('Zend\Expressive\Expressive',                                              'Expressive\Expressive'),
            array('Zend\Expressive\Authentication\Authentication',                           'Expressive\Authentication\Authentication'),
            array('Zend\Expressive\Authentication\ZendAuthentication\AuthenticationAdapter', 'Expressive\Authentication\LaminasAuthentication\AuthenticationAdapter'),
            array('Zend\Expressive\Authentication\ZendAuthentication\ZendAuthentication',    'Expressive\Authentication\LaminasAuthentication\LaminasAuthentication'),
            array('Zend\Expressive\Authorization\Authorization',                             'Expressive\Authorization\Authorization'),
            array('Zend\Expressive\Authorization\Acl\ZendAclFactory',                        'Expressive\Authorization\Acl\LaminasAclFactory'),
            array('Zend\Expressive\Authorization\Rbac\ZendRbac',                             'Expressive\Authorization\Rbac\LaminasRbac'),
            array('Zend\Expressive\Router\Router',                                           'Expressive\Router\Router'),
            array('Zend\Expressive\Router\ZendRouter',                                       'Expressive\Router\LaminasRouter'),
            array('Zend\Expressive\Router\ZendRouter\RouterAdapter',                         'Expressive\Router\LaminasRouter\RouterAdapter'),
            array('Zend\Expressive\ZendView\ZendViewRenderer',                               'Expressive\LaminasView\LaminasViewRenderer'),
            array('Zend\ProblemDetails\ProblemDetails',                                      'Expressive\ProblemDetails\ProblemDetails'),
            // Laminas
            array('Zend\Main',                          'Laminas\Main'),
            array('Zend\Psr7Bridge\Psr7Bridge',         'Laminas\Psr7Bridge\Psr7Bridge'),
            array('Zend\Psr7Bridge\ZendBridge',         'Laminas\Psr7Bridge\LaminasBridge'),
            array('Zend\Psr7Bridge\Zend\Psr7Bridge',    'Laminas\Psr7Bridge\Laminas\Psr7Bridge'),
            array('Zend\Psr7Bridge\Zend\ZendBridge',    'Laminas\Psr7Bridge\Laminas\LaminasBridge'),
            array('ZendService\Service',                'Laminas\Service'),
            array('ZendXml\XmlService',                 'Laminas\Xml\XmlService'),
            array('ZendOAuth\OAuthService',             'Laminas\OAuth\OAuthService'),
            array('ZendDiagnostics\Tools',              'Laminas\Diagnostics\Tools'),
            array('ZF\ComposerAutoloading\Autoloading', 'Laminas\ComposerAutoloading\Autoloading'),
            array('ZF\Deploy\Deploy',                   'Laminas\Deploy\Deploy'),
            array('ZF\DevelopmentMode\DevelopmentMode', 'Laminas\DevelopmentMode\DevelopmentMode'),
            // Apigility
            array('ZF\Apigility\BaseModule', 'Apigility\BaseModule'),
            array('ZF\BaseModule',           'Apigility\BaseModule'),
        );
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
}
