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

use Zend2\View\Renderer as View;

/**
 * Dijit-enabled Form
 *
 * @uses       \Zend2\Form\Form
 * @package    Zend2_Dojo
 * @subpackage Form
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Form extends \Zend2\Form\Form
{
    /**
     * Constructor
     *
     * @param  array|\Zend2\Config\Config|null $options
     * @return void
     */
    public function __construct($options = null)
    {
        $this->addPrefixPath('Zend2\Dojo\Form\Decorator', 'Zend2/Dojo/Form/Decorator', 'decorator')
             ->addPrefixPath('Zend2\Dojo\Form\Element', 'Zend2/Dojo/Form/Element', 'element')
             ->addElementPrefixPath('Zend2\Dojo\Form\Decorator', 'Zend2/Dojo/Form/Decorator', 'decorator')
             ->addDisplayGroupPrefixPath('Zend2\Dojo\Form\Decorator', 'Zend2/Dojo/Form/Decorator')
             ->setDefaultDisplayGroupClass('Zend2\Dojo\Form\DisplayGroup');
        parent::__construct($options);
    }

    /**
     * Load the default decorators
     *
     * @return void
     */
    public function loadDefaultDecorators()
    {
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return;
        }

        $decorators = $this->getDecorators();
        if (empty($decorators)) {
            $this->addDecorator('FormElements')
                 ->addDecorator('HtmlTag', array('tag' => 'dl', 'class' => 'zend_form_dojo'))
                 ->addDecorator('DijitForm');
        }
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
