<?php
namespace LaminasTest\ZendFrameworkBridge\TestAsset;

class ModuleManager
{
    public function __construct(EventManager $eventManager = null)
    {
        $this->eventManager = $eventManager ?: new EventManager();
    }

    /**
     * @return EventManager
     */
    public function getEventManager()
    {
        return $this->eventManager;
    }
}
