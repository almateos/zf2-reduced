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
 * @uses       Zend2_Service_Yahoo_LocalResult
 * @uses       Zend2_Service_Yahoo_ResultSet
 * @category   Zend2
 * @package    Zend2_Service
 * @subpackage Yahoo
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend2_Service_Yahoo_LocalResultSet extends Zend2_Service_Yahoo_ResultSet
{
    /**
     * The URL of a webpage containing a map graphic with all returned results plotted on it.
     *
     * @var string
     */
    public $resultSetMapURL;

    /**
     * Local result set namespace
     *
     * @var string
     */
    protected $_namespace = 'urn:yahoo:lcl';


    /**
     * Initializes the local result set
     *
     * @param  DOMDocument $dom
     * @return void
     */
    public function __construct(DOMDocument $dom)
    {
        parent::__construct($dom);

        $this->resultSetMapURL = $this->_xpath->query('//yh:ResultSetMapUrl/text()')->item(0)->data;
    }


    /**
     * Overrides Zend2_Service_Yahoo_ResultSet::current()
     *
     * @return Zend2_Service_Yahoo_LocalResult
     */
    public function current()
    {
        return new Zend2_Service_Yahoo_LocalResult($this->_results->item($this->_currentIndex));
    }
}
