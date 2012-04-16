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
 * @package    Zend2_Gdata
 * @subpackage DublinCore
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\GData\DublinCore\Extension;

/**
 * Information about rights held in and over the resource
 *
 * @uses       \Zend2\GData\DublinCore
 * @uses       \Zend2\GData\Extension
 * @category   Zend2
 * @package    Zend2_Gdata
 * @subpackage DublinCore
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Rights extends \Zend2\GData\Extension
{

    protected $_rootNamespace = 'dc';
    protected $_rootElement = 'rights';

    /**
     * Constructor for Zend2_Gdata_DublinCore_Extension_Rights which
     * Information about rights held in and over the resource
     *
     * @param DOMElement $element (optional) DOMElement from which this
     *          object should be constructed.
     */
    public function __construct($value = null)
    {
        $this->registerAllNamespaces(\Zend2\GData\DublinCore::$namespaces);
        parent::__construct();
        $this->_text = $value;
    }

}
