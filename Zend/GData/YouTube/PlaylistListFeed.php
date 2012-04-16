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
 * @subpackage YouTube
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\GData\YouTube;

use Zend2\GData\YouTube;

/**
 * The YouTube video playlist flavor of an Atom Feed with media support
 * Represents a list of individual playlists, where each contained entry is
 * a playlist.
 *
 * @uses       \Zend2\GData\Media\Feed
 * @uses       \Zend2\GData\YouTube
 * @uses       \Zend2\GData\YouTube\PlaylistListEntry
 * @category   Zend2
 * @package    Zend2_Gdata
 * @subpackage YouTube
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class PlaylistListFeed extends \Zend2\GData\Media\Feed
{

    /**
     * The classname for individual feed elements.
     *
     * @var string
     */
    protected $_entryClassName = 'Zend2\GData\YouTube\PlaylistListEntry';

    /**
     * Creates a Playlist list feed, representing a list of playlists,
     * usually associated with an individual user.
     *
     * @param DOMElement $element (optional) DOMElement from which this
     *          object should be constructed.
     */
    public function __construct($element = null)
    {
        $this->registerAllNamespaces(YouTube::$namespaces);
        parent::__construct($element);
    }

}
