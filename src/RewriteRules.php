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
        // @todo Need to determine the final name and namespace for zf-console
        return array(
            // Expressive
            'Zend\\ProblemDetails\\'                                 => 'Expressive\\ProblemDetails\\',
            'Zend\\Expressive\\Authentication\\ZendAuthentication\\' => 'Expressive\\Authentication\\LaminasAuthentication\\',
            'Zend\\Expressive\\Authentication\\'                     => 'Expressive\\Authentication\\',
            'Zend\\Expressive\\Router\\ZendRouter\\'                 => 'Expressive\\Router\\LaminasRouter\\',
            'Zend\\Expressive\\Router\\'                             => 'Expressive\\Router\\',
            'Zend\\Expressive\\ZendView\\'                           => 'Expressive\\LaminasView\\',
            'Zend\\Expressive\\'                                     => 'Expressive\\',
            // Laminas
            'Zend\\Psr7Bridge\\Zend\\'  => 'Laminas\\Psr7Bridge\\Laminas\\',
            'Zend\\Psr7Bridge\\'        => 'Laminas\\Psr7Bridge\\',
            'Zend\\'                    => 'Laminas\\',
            'ZF\\ComposerAutoloading\\' => 'Laminas\\ComposerAutoloading\\',
            'ZF\\Deploy\\'              => 'Laminas\\Deploy\\',
            'ZF\\DevelopmentMode\\'     => 'Laminas\\DevelopmentMode\\',
            // Apigility
            'ZF\\Apigility\\' => 'Apigility\\',
            'ZF\\'            => 'Apigility\\',
            // ZendXml, API wrappers, zend-http OAuth support, zend-diagnostics
            'ZendXml\\'         => 'Laminas\\Xml\\',
            'ZendService\\'     => 'Laminas\\',
            'ZendOAuth\\'       => 'Laminas\\OAuth\\',
            'ZendDiagnostics\\' => 'Laminas\\Diagnostics\\',
        );
    }
}
