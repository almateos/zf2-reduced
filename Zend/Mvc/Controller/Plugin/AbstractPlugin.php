<?php

namespace Zend2\Mvc\Controller\Plugin;

use Zend2\Stdlib\Dispatchable;

abstract class AbstractPlugin
{
    protected $controller;

    public function setController(Dispatchable $controller)
    {
        $this->controller = $controller;
    }

    public function getController()
    {
        return $this->controller;
    }
}
