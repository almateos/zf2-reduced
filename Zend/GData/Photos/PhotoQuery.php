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
 * @subpackage Photos
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\GData\Photos;

/**
 * Assists in constructing queries for comment/tag entries.
 * Instances of this class can be provided in many places where a URL is
 * required.
 *
 * For information on submitting queries to a server, see the
 * service class, Zend2_Gdata_Photos.
 *
 * @uses       \Zend2\GData\App\InvalidArgumentException
 * @uses       \Zend2\GData\Photos\AlbumQuery
 * @category   Zend2
 * @package    Zend2_Gdata
 * @subpackage Photos
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class PhotoQuery extends AlbumQuery
{

    /**
     * The ID of the photo to query for.
     *
     * @var string
     */
    protected $_photoId = null;

    /**
     * Set the photo ID to query for. When set, this photo's comments/tags
     * will be returned. If not set or null, the default user's feed will be
     * returned instead.
     *
     * @param string $value The ID of the photo to retrieve, or null to
     *          clear.
     */
     public function setPhotoId($value)
     {
         $this->_photoId = $value;
     }

    /**
     * Get the photo ID which is to be returned.
     *
     * @see setPhoto
     * @return string The ID of the photo to retrieve.
     */
    public function getPhotoId()
    {
        return $this->_photoId;
    }

    /**
     * Returns the URL generated for this query, based on it's current
     * parameters.
     *
     * @return string A URL generated based on the state of this query.
     * @throws \Zend2\GData\App\InvalidArgumentException
     */
    public function getQueryUrl($incomingUri = '')
    {
        $uri = '';
        if ($this->getPhotoId() !== null) {
            $uri .= '/photoid/' . $this->getPhotoId();
        } else {
            throw new \Zend2\GData\App\InvalidArgumentException(
                    'PhotoId cannot be null');
        }
        $uri .= $incomingUri;
        return parent::getQueryUrl($uri);
    }

}
