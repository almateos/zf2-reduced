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
 * @subpackage View
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Dojo\View\Helper;

use Zend2\Dojo\View\Exception,
    Zend2\Registry,
    Zend2\View\Renderer as View,
    Zend2\View\Helper\AbstractHelper as AbstractViewHelper;

/**
 * Zend2_Dojo_View_Helper_Dojo: Dojo View Helper
 *
 * Allows specifying stylesheets, path to dojo, module paths, and onLoad
 * events.
 *
 * @uses       \Zend2\Dojo\View\Exception
 * @uses       \Zend2\Dojo\View\Helper\DojoContainer
 * @uses       \Zend2\Registry
 * @package    Zend2_Dojo
 * @subpackage View
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Dojo extends AbstractViewHelper
{
    /**#@+
     * Programmatic dijit creation style constants
     */
    const PROGRAMMATIC_SCRIPT = 1;
    const PROGRAMMATIC_NOSCRIPT = -1;
    /**#@-*/

    /**
     * @var \Zend2\View\Renderer
     */
    public $view;

    /**
     * @var \Zend2\Dojo\View\Helper\Dojo\Container
     */
    protected $_container;

    /**
     * @var bool Whether or not dijits should be declared programmatically
     */
    protected static $_useProgrammatic = true;

    /**
     * Initialize helper
     *
     * Retrieve container from registry or create new container and store in
     * registry.
     *
     * @return void
     */
    public function __construct()
    {
        $registry = Registry::getInstance();
        $key      = __CLASS__;
        if (!isset($registry[$key])) {
            $container = new Dojo\Container();
            $registry[$key] = $container;
        }
        $this->_container = $registry[$key];
    }

    /**
     * Set view object
     *
     * @param  Zend2\View\Renderer $view
     * @return void
     */
    public function setView(View $view)
    {
        $this->view = $view;
        $this->_container->setView($view);
    }

    /**
     * Return dojo container
     *
     * @return \Zend2\Dojo\View\Helper\Dojo\Container
     */
    public function __invoke()
    {
        return $this->_container;
    }

    /**
     * Proxy to container methods
     *
     * @param  string $method
     * @param  array $args
     * @return mixed
     * @throws \Zend2\Dojo\View\Exception For invalid method calls
     */
    public function __call($method, $args)
    {
        if (!method_exists($this->_container, $method)) {
            throw new Exception\BadMethodCallException(sprintf('Invalid method "%s" called on dojo view helper', $method));
        }

        return call_user_func_array(array($this->_container, $method), $args);
    }

    /**
     * Set whether or not dijits should be created declaratively
     *
     * @return void
     */
    public static function setUseDeclarative()
    {
        self::$_useProgrammatic = false;
    }

    /**
     * Set whether or not dijits should be created programmatically
     *
     * Optionally, specifiy whether or not dijit helpers should generate the
     * programmatic dojo.
     *
     * @param  int $style
     * @return void
     */
    public static function setUseProgrammatic($style = self::PROGRAMMATIC_SCRIPT)
    {
        if (!in_array($style, array(self::PROGRAMMATIC_SCRIPT, self::PROGRAMMATIC_NOSCRIPT))) {
            $style = self::PROGRAMMATIC_SCRIPT;
        }
        self::$_useProgrammatic = $style;
    }

    /**
     * Should dijits be created declaratively?
     *
     * @return bool
     */
    public static function useDeclarative()
    {
        return (false === self::$_useProgrammatic);
    }

    /**
     * Should dijits be created programmatically?
     *
     * @return bool
     */
    public static function useProgrammatic()
    {
        return (false !== self::$_useProgrammatic);
    }

    /**
     * Should dijits be created programmatically but without scripts?
     *
     * @return bool
     */
    public static function useProgrammaticNoScript()
    {
        return (self::PROGRAMMATIC_NOSCRIPT === self::$_useProgrammatic);
    }
}
