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
 * @subpackage Geo
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\GData\Geo;

use Zend2\GData\Geo;

/**
 * An Atom entry containing Geograpic data.
 *
 * @uses       \Zend2\GData\Entry
 * @uses       \Zend2\GData\Geo
 * @uses       \Zend2\GData\Geo\Extension\GeoRssWhere
 * @category   Zend2
 * @package    Zend2_Gdata
 * @subpackage Geo
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Entry extends \Zend2\GData\Entry
{

    protected $_entryClassName = 'Zend2\GData\Geo\Entry';

    protected $_where = null;

    public function __construct($element = null)
    {
        $this->registerAllNamespaces(Geo::$namespaces);
        parent::__construct($element);
    }

    public function getDOM($doc = null, $majorVersion = 1, $minorVersion = null)
    {
        $element = parent::getDOM($doc, $majorVersion, $minorVersion);
        if ($this->_where != null) {
            $element->appendChild($this->_where->getDOM($element->ownerDocument));
        }
        return $element;
    }

    protected function takeChildFromDOM($child)
    {
        $absoluteNodeName = $child->namespaceURI . ':' . $child->localName;
        switch ($absoluteNodeName) {
        case $this->lookupNamespace('georss') . ':' . 'where':
            $where = new Extension\GeoRssWhere();
            $where->transferFromDOM($child);
            $this->_where = $where;
            break;
        default:
            parent::takeChildFromDOM($child);
            break;
        }
    }

    public function getWhere()
    {
        return $this->_where;
    }

    public function setWhere($value)
    {
        $this->_where = $value;
        return $this;
    }


}
