<?php
/**
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright https://github.com/laminas/laminas-zendframework-bridge/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\ZendFrameworkBridge\TestAsset;

class ConfigListener
{
    private $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function getMergedConfig()
    {
        return $this->config;
    }

    public function setMergedConfig(array $config)
    {
        $this->config = $config;
    }
}
