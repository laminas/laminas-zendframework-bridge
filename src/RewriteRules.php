<?php
/**
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright https://github.com/laminas/laminas-zendframework-bridge/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\ZendFrameworkBridge;

class RewriteRules
{
    /**
     * @return array
     */
    public static function namespaceRewrite()
    {
        return array(
            // Expressive
            'Zend\\ProblemDetails\\' => 'Expressive\\ProblemDetails\\',
            'Zend\\Expressive\\'     => 'Expressive\\',

            // Laminas
            'Zend\\'                    => 'Laminas\\',
            'ZF\\ComposerAutoloading\\' => 'Laminas\\ComposerAutoloading\\',
            'ZF\\Deploy\\'              => 'Laminas\\Deploy\\',
            'ZF\\DevelopmentMode\\'     => 'Laminas\\DevelopmentMode\\',

            // Apigility
            'ZF\\Apigility\\' => 'Apigility\\',
            'ZF\\'            => 'Apigility\\',

            // ZendXml, API wrappers, zend-http OAuth support, zend-diagnostics, ZendDeveloperTools
            'ZendXml\\'                => 'Laminas\\Xml\\',
            'ZendOAuth\\'              => 'Laminas\\OAuth\\',
            'ZendDiagnostics\\'        => 'Laminas\\Diagnostics\\',
            'ZendService\\ReCaptcha\\' => 'Laminas\\ReCaptcha\\',
            'ZendService\\Twitter\\'   => 'Laminas\\Twitter\\',
            'ZendDeveloperTools\\'     => 'Laminas\\DeveloperTools\\',
        );
    }

    /**
     * @return array
     */
    public static function namespaceReverse()
    {
        return array(
            // ZendXml, ZendOAuth, ZendDiagnostics, ZendDeveloperTools
            'Laminas\\Xml\\'            => 'ZendXml\\',
            'Laminas\\OAuth\\'          => 'ZendOAuth\\',
            'Laminas\\Diagnostics\\'    => 'ZendDiagnostics\\',
            'Laminas\\DeveloperTools\\' => 'ZendDeveloperTools\\',

            // Zend Service
            'Laminas\\ReCaptcha\\' => 'ZendService\\ReCaptcha\\',
            'Laminas\\Twitter\\'   => 'ZendService\\Twitter\\',

            // Zend
            'Laminas\\' => 'Zend\\',

            // Expressive
            'Expressive\\ProblemDetails\\' => 'Zend\\ProblemDetails\\',
            'Expressive\\'                 => 'Zend\\Expressive\\',

            // Laminas to ZfCampus
            'Laminas\\ComposerAutoloading\\' => 'ZF\\ComposerAutoloading\\',
            'Laminas\\Deploy\\'              => 'ZF\\Deploy\\',
            'Laminas\\DevelopmentMode\\'     => 'ZF\\DevelopmentMode\\',

            // Apigility
            'Apigility\\Admin\\'         => 'ZF\\Apigility\\Admin\\',
            'Apigility\\Doctrine\\'      => 'ZF\\Apigility\\Doctrine\\',
            'Apigility\\Documentation\\' => 'ZF\\Apigility\\Documentation\\',
            'Apigility\\Example\\'       => 'ZF\\Apigility\\Example\\',
            'Apigility\\Provider\\'      => 'ZF\\Apigility\\Provider\\',
            'Apigility\\Welcome\\'       => 'ZF\\Apiglity\\Welcome\\',
            'Apigility\\'                => 'ZF\\',
        );
    }
}
