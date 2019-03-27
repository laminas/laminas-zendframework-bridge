<?php
/**
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright Copyright (c) 2019 Laminas Foundation (https://getlaminas.org)
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\ZendFrameworkBridge;

class RewriteRules
{
    /**
     * @return array
     */
    public static function classRewrite()
    {
        // @todo Need to determine the final name and namespace for zf-console
        return [
            // Expressive
            'Zend\\ProblemDetails\\' => 'Expressive\\',
            'Zend\\Expressive\\' => 'Expressive\\',
            // Laminas
            'Zend\\' => 'Laminas\\',
            'ZF\\ComposerAutoloading\\' => 'Laminas\\ComposerAutoloading\\',
            'ZF\\Deploy\\' => 'Laminas\\Deploy\\',
            'ZF\\DevelopmentMode\\' => 'Laminas\\DevelopmentMode\\',
            // Apigility
            'ZF\\Apigility\\' => 'Apigility\\',
            'ZF\\' => 'Apigility\\',
            // ZendXml, API wrappers, zend-http OAuth support, zend-diagnostics
            'ZendXml\\' => 'Laminas\\Xml\\',
            'ZendService\\' => 'Laminas\\',
            'ZendOAuth\\' => 'Laminas\\OAuth\\',
            'ZendDiagnostics\\' => 'Laminas\\Diagnostics\\',
        ];
    }

    /**
     * @return array
     */
    public static function functionRewrite()
    {
        return [
            // Container Config Test
            'Zend\ContainerConfigTest\TestAsset\function_factory' => 'Laminas\ContainerConfigTest\TestAsset\function_factory',
            'Zend\ContainerConfigTest\TestAsset\function_factory_with_name' => 'Laminas\ContainerConfigTest\TestAsset\function_factory_with_name',
            // Diactoros
            'Zend\Diactoros\createUploadedFile' => 'Laminas\Diactoros\createUploadedFile',
            'Zend\Diactoros\marshalHeadersFromSapi' => 'Laminas\Diactoros\marshalHeadersFromSapi',
            'Zend\Diactoros\marshalMethodFromSapi' => 'Laminas\Diactoros\marshalMethodFromSapi',
            'Zend\Diactoros\marshalProtocolVersionFromSapi' => 'Laminas\Diactoros\marshalProtocolVersionFromSapi',
            'Zend\Diactoros\marshalUriFromSapi' => 'Laminas\Diactoros\marshalUriFromSapi',
            'Zend\Diactoros\normalizeServer' => 'Laminas\Diactoros\normalizeServer',
            'Zend\Diactoros\normalizeUploadedFiles' => 'Laminas\Diactoros\normalizeUploadedFiles',
            'Zend\Diactoros\parseCookieHeader' => 'Laminas\Diactoros\parseCookieHeader',
            // Stratigility
            'Zend\Stratigility\doublePassMiddleware' => 'Laminas\Stratigility\doublePassMiddleware',
            'Zend\Stratigility\host' => 'Laminas\Stratigility\host',
            'Zend\Stratigility\middleware' => 'Laminas\Stratigility\middleware',
            'Zend\Stratigility\path' => 'Laminas\Stratigility\path',
        ];
    }
}
