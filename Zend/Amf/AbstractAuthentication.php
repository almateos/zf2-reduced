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
 * @package    Zend2_Amf
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Amf;

/**
 * Base abstract class for AMF authentication implementation
 *
 * @uses       \Zend2\Authentication\Adapter
 * @package    Zend2_Amf
 * @subpackage Auth
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class AbstractAuthentication implements \Zend2\Authentication\Adapter
{
    protected $_username;
    protected $_password;

    public function setCredentials($username, $password) 
    {
        $this->_username = $username;
        $this->_password = $password;
    }
}
