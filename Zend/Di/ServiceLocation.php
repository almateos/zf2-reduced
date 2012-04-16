<?php
namespace Zend2\Di;

interface ServiceLocation extends Locator
{
    public function set($name, $service);
}
