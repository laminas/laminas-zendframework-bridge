<?php
/**
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright https://github.com/laminas/laminas-zendframework-bridge/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\ZendFrameworkBridge\TestAsset;

class EventManager
{
    private $listeners = [];

    /**
     * @param string $eventName
     */
    public function attach($eventName, callable $listener)
    {
        $this->listeners[$eventName] = isset($this->listeners[$eventName])
            ? array_merge($this->listeners[$eventName], $listener)
            : [$listener];
    }

    /**
     * @return array
     */
    public function getListeners()
    {
        return $this->listeners;
    }
}
