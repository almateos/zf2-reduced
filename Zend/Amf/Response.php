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
 * Handles converting the PHP object ready for response back into AMF
 *
 * @uses       \Zend2\Amf\Constants
 * @uses       \Zend2\Amf\Parser\Amf0\Serializer
 * @uses       \Zend2\Amf\Parser\OutputStream
 * @package    Zend2_Amf
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
interface Response
{
    /**
     * Instantiate new output stream and start serialization
     *
     * @return \Zend2\Amf\Response
     */
    public function finalize();

    /**
     * Serialize the PHP data types back into Actionscript and
     * create and AMF stream.
     *
     * @param  Zend2\Amf\Parser\OutputStream $stream
     * @return Zend2\Amf\Response
     */
    public function writeMessage(Parser\OutputStream $stream);

    /**
     * Return the output stream content
     *
     * @return string The contents of the output stream
     */
    public function getResponse();

    /**
     * Return the output stream content
     *
     * @return string
     */
    public function __toString();

    /**
     * Add an AMF body to be sent to the Flash Player
     *
     * @param  Zend2\Amf\Value\MessageBody $body
     * @return Zend2\Amf\Response
     */
    public function addAmfBody(Value\MessageBody $body);

    /**
     * Return an array of AMF bodies to be serialized
     *
     * @return array
     */
    public function getAmfBodies();

    /**
     * Add an AMF Header to be sent back to the flash player
     *
     * @param  Zend2\Amf\Value\MessageHeader $header
     * @return Zend2\Amf\Response
     */
    public function addAmfHeader(Value\MessageHeader $header);

    /**
     * Retrieve attached AMF message headers
     *
     * @return array Array of \Zend2\Amf\Value\MessageHeader objects
     */
    public function getAmfHeaders();

    /**
     * Set the AMF encoding that will be used for serialization
     *
     * @param  int $encoding
     * @return Zend2\Amf\Response
     */
    public function setObjectEncoding($encoding);
}
