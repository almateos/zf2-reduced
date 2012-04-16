<?php

namespace Zend2\Mvc\Controller;

use Zend2\Loader\PluginClassLoader;

class PluginLoader extends PluginClassLoader
{
    /**
     * @var array Pre-aliased plugins
     */
    protected $plugins = array(
        'flash_messenger' => 'Zend2\Mvc\Controller\Plugin\FlashMessenger',
        'flashmessenger'  => 'Zend2\Mvc\Controller\Plugin\FlashMessenger',
        'forward'         => 'Zend2\Mvc\Controller\Plugin\Forward',
        'layout'          => 'Zend2\Mvc\Controller\Plugin\Layout',
        'redirect'        => 'Zend2\Mvc\Controller\Plugin\Redirect',
        'url'             => 'Zend2\Mvc\Controller\Plugin\Url',
    );
}
