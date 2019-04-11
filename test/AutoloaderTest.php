<?php

namespace LaminasTest\ZendFrameworkBridge;

use PHPUnit\Framework\TestCase;

class AutoloaderTest extends TestCase
{
    public function classProvider()
    {
        return array(
            array('Zend\Main'),
            array('Zend\Expressive\Expressive'),
            array('Zend\Expressive\Authentication\Authentication'),
            array('Zend\Expressive\Authentication\ZendAuthentication\AuthenticationAdapter'),
            array('Zend\Expressive\Router\Router'),
            array('Zend\Expressive\Router\ZendRouter\RouterAdapter'),
            array('Zend\ProblemDetails\ProblemDetails'),
        );
    }

    /**
     * @dataProvider classProvider
     * @param string $className
     */
    public function testLegacyClassIsAliasToLaminas($className)
    {
        self::assertTrue(class_exists($className));
    }
}
