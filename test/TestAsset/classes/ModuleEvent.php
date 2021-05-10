<?php
namespace LaminasTest\ZendFrameworkBridge\TestAsset;

class ModuleEvent
{
    private $listener;

    public function __construct(ConfigListener $listener = null)
    {
        $this->listener = $listener ?: new ConfigListener();
    }

    /**
     * @return ConfigListener
     */
    public function getConfigListener()
    {
        return $this->listener;
    }
}
