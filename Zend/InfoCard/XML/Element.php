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
 * @package    Zend2_InfoCard
 * @subpackage Zend2_InfoCard_Xml
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\InfoCard\XML;

/**
 * The Interface used to represent an XML Data Type
 *
 * @category   Zend2
 * @package    Zend2_InfoCard
 * @subpackage Zend2_InfoCard_Xml
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
interface Element
{
    /**
     * Return the data within the object as an XML document
     */
    public function asXML();

    /**
     * Magic function which allows us to treat the object as a string to return XML
     * (same as the asXML() method)
     */
    public function __toString();
}
