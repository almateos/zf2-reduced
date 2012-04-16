<?php

namespace Zend2\Mvc;

use Zend2\Di\Locator;

interface LocatorAware
{
    public function setLocator(Locator $locator);
    public function getLocator();
}
