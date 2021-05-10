<?php
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
