<?php

namespace Zend\ProblemDetails;

use ZF\ComposerAutoloading\Something;
use ZF\Apigility\Doctrine\MyDoctrine;
use Zend\Version;
use ZendService\Amazon;
use ZendPdf\Renderer;

class MyClass extends \Zend\Expressive\Router
{
    /** @var string|\Zend\View\Renderer */
    private $class;

    public function __construct()
    {
        $this->class = 'Zend\\View\\Renderer';
    }
}
