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
 * @subpackage App
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\GData\App;

/**
 * Concrete class for working with Atom entries containing multi-part data.
 *
 * @uses       \Zend2\GData\App\InvalidArgumentException
 * @uses       \Zend2\GData\App\Entry
 * @uses       \Zend2\GData\App\MediaSource
 * @uses       \Zend2\GData\MediaMimeStream
 * @category   Zend2
 * @package    Zend2_Gdata
 * @subpackage App
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class MediaEntry extends Entry
{
    /**
     * The attached MediaSource/file
     *
     * @var \Zend2\GData\App\MediaSource
     */
    protected $_mediaSource = null;

    /**
     * Constructs a new MediaEntry, representing XML data and optional
     * file to upload
     *
     * @param DOMElement $element (optional) DOMElement from which this
     *          object should be constructed.
     */
    public function __construct($element = null, $mediaSource = null)
    {
        parent::__construct($element);
        $this->_mediaSource = $mediaSource;
    }

    /**
     * Return the MIME multipart representation of this MediaEntry.
     *
     * @return string|\Zend2\GData\MediaMimeStream The MIME multipart
     *         representation of this MediaEntry. If the entry consisted only
     *         of XML, a string is returned.
     */
    public function encode()
    {
        $xmlData = $this->saveXML();
        $mediaSource = $this->getMediaSource();
        if ($mediaSource === null) {
            // No attachment, just send XML for entry
            return $xmlData;
        } else {
            return new \Zend2\GData\MediaMimeStream($xmlData,
                $mediaSource->getFilename(), $mediaSource->getContentType());
        }
    }

    /**
     * Return the MediaSource object representing the file attached to this
     * MediaEntry.
     *
     * @return \Zend2\GData\App\MediaSource The attached MediaSource/file
     */
    public function getMediaSource()
    {
        return $this->_mediaSource;
    }

    /**
     * Set the MediaSource object (file) for this MediaEntry
     *
     * @param \Zend2\GData\App\MediaSource $value The attached MediaSource/file
     * @return \Zend2\GData\App\MediaEntry Provides a fluent interface
     */
    public function setMediaSource($value)
    {
        if ($value instanceof MediaSource) {
            $this->_mediaSource = $value;
        } else {
            throw new InvalidArgumentException(
                    'You must specify the media data as a class that conforms to \Zend2\Gdata\App\MediaSource.');
        }
        return $this;
    }

}
