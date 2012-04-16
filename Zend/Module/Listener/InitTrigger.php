<?php

namespace Zend2\Module\Listener;

use Zend2\Module\ModuleEvent;

class InitTrigger extends AbstractListener
{
    /**
     * @param \Zend2\Module\ModuleEvent $e
     * @eturn void
     */
    public function __invoke(ModuleEvent $e)
    {
        $module = $e->getModule();
        if (is_callable(array($module, 'init'))) {
            $module->init($e->getTarget());
        }
    }
}
