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
 * The YouTube comments flavor of an Atom Entry
 *
 * @uses       \Zend2\GData\Media\Feed
 * @uses       \Zend2\GData\YouTube
 * @category   Zend2
 * @package    Zend2_Gdata
 * @subpackage YouTube
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class CommentEntry extends \Zend2\GData\Entry
{

    /**
     * The classname for individual feed elements.
     *
     * @var string
     */
    protected $_entryClassName = 'Zend2\GData\YouTube\CommentEntry';

    /**
     * Constructs a new Zend2_Gdata_YouTube_CommentEntry object.
     * @param DOMElement $element (optional) The DOMElement on which to
     * base this object.
     */
    public function __construct($element = null)
    {
        $this->registerAllNamespaces(YouTube::$namespaces);
        parent::__construct($element);
    }

}
