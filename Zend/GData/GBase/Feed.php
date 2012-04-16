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
 * @subpackage GBase
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\GData\GBase;

use Zend2\GData\GBase;

/**
 * Base class for the Google Base Feed
 *
 * @link http://code.google.com/apis/base/
 *
 * @uses       \Zend2\GData\Feed
 * @uses       \Zend2\GData\GBase
 * @category   Zend2
 * @package    Zend2_Gdata
 * @subpackage GBase
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Feed extends \Zend2\GData\Feed
{
    /**
     * The classname for the feed.
     *
     * @var string
     */
    protected $_feedClassName = 'Zend2\GData\GBase\Feed';

    /**
     * Create a new instance.
     *
     * @param DOMElement $element (optional) DOMElement from which this
     *          object should be constructed.
     */
    public function __construct($element = null)
    {
        $this->registerAllNamespaces(GBase::$namespaces);
        parent::__construct($element);
    }
}
