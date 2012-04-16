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
 * @package    Zend2_Service
 * @subpackage Yahoo
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * @uses       Zend2_Service_Yahoo_ResultSet
 * @uses       Zend2_Service_Yahoo_WebResult
 * @category   Zend2
 * @package    Zend2_Service
 * @subpackage Yahoo
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend2_Service_Yahoo_WebResultSet extends Zend2_Service_Yahoo_ResultSet
{
    /**
     * Web result set namespace
     *
     * @var string
     */
    protected $_namespace = 'urn:yahoo:srch';


    /**
     * Overrides Zend2_Service_Yahoo_ResultSet::current()
     *
     * @return Zend2_Service_Yahoo_WebResult
     */
    public function current()
    {
        return new Zend2_Service_Yahoo_WebResult($this->_results->item($this->_currentIndex));
    }
}
