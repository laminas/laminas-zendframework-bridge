<?php
/**
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright https://github.com/laminas/laminas-zendframework-bridge/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

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
