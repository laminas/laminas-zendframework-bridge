<?php
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
