<?php

namespace Zend2\Module\Listener;

use Zend2\Loader\AutoloaderFactory,
    Zend2\Module\Consumer\AutoloaderProvider,
    Zend2\Module\ModuleEvent;

class AutoloaderListener extends AbstractListener
{

    /**
     * @param \Zend2\Module\ModuleEvent $e
     * @return void
     */
    public function __invoke(ModuleEvent $e)
    {
        $module = $e->getModule();
        if (!$module instanceof AutoloaderProvider) {
            return;
        }
        $autoloaderConfig = $module->getAutoloaderConfig();
        AutoloaderFactory::factory($autoloaderConfig);
    }
}
