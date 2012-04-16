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

namespace Zend2\Amf\Response;

use Zend2\Amf\Response as AMFResponse,
    Zend2\Amf\Parser,
    Zend2\Amf\Parser\Amf0,
    Zend2\Amf;

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
class StreamResponse implements AMFResponse
{
    /**
     * @var int Object encoding for response
     */
    protected $_objectEncoding = 0;

    /**
     * Array of Zend2_Amf_Value_MessageBody objects
     * @var array
     */
    protected $_bodies = array();

    /**
     * Array of Zend2_Amf_Value_MessageHeader objects
     * @var array
     */
    protected $_headers = array();

    /**
     * @var \Zend2\Amf\Parser\OutputStream
     */
    protected $_outputStream;

    /**
     * Instantiate new output stream and start serialization
     *
     * @return \Zend2\Amf\Response\StreamResponse
     */
    public function finalize()
    {
        $this->_outputStream = new Parser\OutputStream();
        $this->writeMessage($this->_outputStream);
        return $this;
    }

    /**
     * Serialize the PHP data types back into Actionscript and
     * create and AMF stream.
     *
     * @param  \Zend2\Amf\Parser\OutputStream $stream
     * @return \Zend2\Amf\Response\StreamResponse
     */
    public function writeMessage(Parser\OutputStream $stream)
    {
        $objectEncoding = $this->_objectEncoding;

        //Write encoding to start of stream. Preamble byte is written of two byte Unsigned Short
        $stream->writeByte(0x00);
        $stream->writeByte($objectEncoding);

        // Loop through the AMF Headers that need to be returned.
        $headerCount = count($this->_headers);
        $stream->writeInt($headerCount);
        foreach ($this->getAmfHeaders() as $header) {
            $serializer = new Amf0\Serializer($stream);
            $stream->writeUTF($header->name);
            $stream->writeByte($header->mustRead);
            $stream->writeLong(Amf\Constants::UNKNOWN_CONTENT_LENGTH);
            if (is_object($header->data)) {
                // Workaround for PHP5 with E_STRICT enabled complaining about 
                // "Only variables should be passed by reference"
                $placeholder = null;
                $serializer->writeTypeMarker($placeholder, null, $header->data);
            } else {
                $serializer->writeTypeMarker($header->data);
            }
        }

        // loop through the AMF bodies that need to be returned.
        $bodyCount = count($this->_bodies);
        $stream->writeInt($bodyCount);
        foreach ($this->_bodies as $body) {
            $serializer = new Amf0\Serializer($stream);
            $stream->writeUTF($body->getTargetURI());
            $stream->writeUTF($body->getResponseURI());
            $stream->writeLong(Amf\Constants::UNKNOWN_CONTENT_LENGTH);
            $bodyData   = $body->getData();
            $markerType = ($this->_objectEncoding == Amf\Constants::AMF0_OBJECT_ENCODING) ? null : Amf\Constants::AMF0_AMF3;
            if (is_object($bodyData)) {
                // Workaround for PHP5 with E_STRICT enabled complaining about 
                // "Only variables should be passed by reference"
                $placeholder = null;
                $serializer->writeTypeMarker($placeholder, $markerType, $bodyData);
            } else {
                $serializer->writeTypeMarker($bodyData, $markerType);
            }
        }

        return $this;
    }

    /**
     * Return the output stream content
     *
     * @return string The contents of the output stream
     */
    public function getResponse()
    {
        return $this->_outputStream->getStream();
    }

    /**
     * Return the output stream content
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getResponse();
    }

    /**
     * Add an AMF body to be sent to the Flash Player
     *
     * @param  \Zend2\Amf\Value\MessageBody $body
     * @return \Zend2\Amf\Response\StreamResponse
     */
    public function addAmfBody(Amf\Value\MessageBody $body)
    {
        $this->_bodies[] = $body;
        return $this;
    }

    /**
     * Return an array of AMF bodies to be serialized
     *
     * @return array
     */
    public function getAmfBodies()
    {
        return $this->_bodies;
    }

    /**
     * Add an AMF Header to be sent back to the flash player
     *
     * @param  \Zend2\Amf\Value\MessageHeader $header
     * @return \Zend2\Amf\Response\StreamResponse
     */
    public function addAmfHeader(Amf\Value\MessageHeader $header)
    {
        $this->_headers[] = $header;
        return $this;
    }

    /**
     * Retrieve attached AMF message headers
     *
     * @return array Array of \Zend2\Amf\Value\MessageHeader objects
     */
    public function getAmfHeaders()
    {
        return $this->_headers;
    }

    /**
     * Set the AMF encoding that will be used for serialization
     *
     * @param  int $encoding
     * @return \Zend2\Amf\Response\StreamResponse
     */
    public function setObjectEncoding($encoding)
    {
        $this->_objectEncoding = $encoding;
        return $this;
    }
}
