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
 * @package    Zend2_XmlRpc
 * @subpackage Client
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\XmlRpc\Client\Exception;

/**
 * Thrown by Zend2_XmlRpc_Client when an XML-RPC fault response is returned.
 *
 * @uses       Zend2\XmlRpc\Client\Exception
 * @category   Zend2
 * @package    Zend2_XmlRpc
 * @subpackage Client
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class FaultException
    extends \BadMethodCallException
    implements \Zend2\XmlRpc\Client\Exception
{}
