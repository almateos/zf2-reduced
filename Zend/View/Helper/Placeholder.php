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
 * @package    Zend2_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\View\Helper;

use Zend2\View\Exception\InvalidArgumentException;

/**
 * Helper for passing data between otherwise segregated Views. It's called
 * Placeholder to make its typical usage obvious, but can be used just as easily
 * for non-Placeholder things. That said, the support for this is only
 * guaranteed to effect subsequently rendered templates, and of course Layouts.
 *
 * @uses       \Zend2\View\Helper\AbstractHelper.php
 * @uses       \Zend2\View\Helper\Placeholder\Registry
 * @package    Zend2_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Placeholder extends AbstractHelper
{
    /**
     * Placeholder items
     * @var array
     */
    protected $_items = array();

    /**
     * @var \Zend2\View\Helper\Placeholder\Registry
     */
    protected $_registry;

    /**
     * Constructor
     *
     * Retrieve container registry from Zend2_Registry, or create new one and register it.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_registry = Placeholder\Registry::getRegistry();
    }

    /**
     * Placeholder helper
     *
     * @param  string $name
     * @return \Zend2\View\Helper\Placeholder\Container\AbstractContainer
     * @throws InvalidArgumentException
     */
    public function __invoke($name = null)
    {
        if ($name == null) {
            throw new InvalidArgumentException('Placeholder: missing argument.  $name is required by placeholder($name)');
        }

        $name = (string) $name;
        return $this->_registry->getContainer($name);
    }

    /**
     * Retrieve the registry
     *
     * @return \Zend2\View\Helper\Placeholder\Registry
     */
    public function getRegistry()
    {
        return $this->_registry;
    }
}
