<?php
/**
 * Zend2 Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend2
 * @package    Zend2_Dojo
 * @subpackage Form
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Dojo\Form;

use Zend2\Loader\PrefixPathMapper as PluginLoader,
    Zend2\View\Renderer as View;

/**
 * Dijit-enabled DisplayGroup
 *
 * @uses       \Zend2\Form\DisplayGroup
 * @package    Zend2_Dojo
 * @subpackage Form
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class DisplayGroup extends \Zend2\Form\DisplayGroup
{
    /**
     * Constructor
     *
     * @param  string $name
     * @param  \Zend2\Loader\PrefixPathMapper $loader
     * @param  array|\Zend2\Config\Config|null $options
     * @return void
     */
    public function __construct($name, PluginLoader $loader, $options = null)
    {
        parent::__construct($name, $loader, $options);
        $this->addPrefixPath('Zend2\Dojo\Form\Decorator', 'Zend2/Dojo/Form/Decorator');
    }

    /**
     * Set the view object
     *
     * Ensures that the view object has the dojo view helper path set.
     *
     * @param  \Zend2\View\Renderer $view
     * @return \Zend2\Dojo\Form\Element\Dijit
     */
    public function setView(View $view = null)
    {
        if (null !== $view) {
            if(false === $view->getBroker()->isLoaded('dojo')) {
                $loader = new \Zend2\Dojo\View\HelperLoader();
                $view->getBroker()->getClassLoader()->registerPlugins($loader);
            }
        }
        return parent::setView($view);
    }
}
