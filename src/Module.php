<?php
/**
 * @see       https://github.com/laminas/laminas-zendframework-bridge for the canonical source repository
 * @copyright https://github.com/laminas/laminas-zendframework-bridge/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-zendframework-bridge/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\ZendFrameworkBridge;

use Laminas\ModuleManager\Listener\ConfigMergerInterface;
use Laminas\ModuleManager\ModuleEvent;
use Laminas\ModuleManager\ModuleManager;

class Module
{
    /** @var string[] */
    private $replacements;

    public function init(ModuleManager $moduleManager)
    {
        $moduleManager
            ->getEventManager()
            ->attach(ModuleEvent::EVENT_MERGE_CONFIG, [$this, 'onMergeConfig']);
    }

    /**
     * Perform substitutions in the merged configuration.
     *
     * Rewrites keys and values matching known ZF classes, namespaces, and
     * configuration keys to their Laminas equivalents.
     */
    public function onMergeConfig(ModuleEvent $event)
    {
        /** @var ConfigMergerInterface */
        $configMerger = $event->getConfigListener();
        $processor    = new ConfigPostProcessor();
        $configMerger->setMergedConfig(
            $processor(
                $configMerger->getMergedConfig($returnAsObject = false)
            )
        );
    }
}
