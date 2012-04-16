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
 * @package    Zend2_Http
 * @subpackage Client_Adapter
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Http\Client\Adapter;

/**
 * An interface description for Zend2_Http_Client_Adapter_Stream classes.
 *
 * This interface decribes Zend2_Http_Client_Adapter which supports streaming.
 *
 * @category   Zend2
 * @package    Zend2_Http
 * @subpackage Client_Adapter
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
interface Stream
{
    /**
     * Set output stream
     * 
     * This function sets output stream where the result will be stored.
     * 
     * @param resource $stream Stream to write the output to
     * 
     */
    function setOutputStream($stream);
}
