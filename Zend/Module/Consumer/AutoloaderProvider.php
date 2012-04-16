<?php

namespace Zend2\Module\Consumer;

interface AutoloaderProvider
{
    /**
     * Return an array for passing to Zend2\Loader\AutoloaderFactory.
     *
     * @return array
     */
    public function getAutoloaderConfig();
}
