<?php
/**
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright https://github.com/laminas/laminas-zendframework-bridge/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\ZendFrameworkBridge;

use Laminas\ZendFrameworkBridge\Replacements;
use PHPUnit\Framework\TestCase;

class ReplacementsTest extends TestCase
{
    /**
     * @return iterable
     */
    public function edgeCases()
    {
        yield 'Example class' => [
            file_get_contents(__DIR__ . '/TestAsset/Replacements/TestClass.php'),
            file_get_contents(__DIR__ . '/TestAsset/Replacements/TestClass.php.out'),
        ];
        yield 'Apigility module' => ['ZF\Apigility', 'Apigility'];
        yield 'Apigility documentation module' => ['ZF\Apigility\Documentation', 'Apigility\Documentation'];
        yield 'Apigility modules.config.php' => [
            file_get_contents(__DIR__ . '/TestAsset/Replacements/edge-case-apigility-modules.php'),
            file_get_contents(__DIR__ . '/TestAsset/Replacements/edge-case-apigility-modules.php.out'),
        ];
    }

    /**
     * @dataProvider edgeCases
     * @param string $string
     * @param string $expected
     */
    public function testEdgeCases($string, $expected)
    {
        $replacements = new Replacements();
        $this->assertSame($expected, $replacements->replace($string));
    }
}
