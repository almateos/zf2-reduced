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

namespace Zend2\GData\App\Extension;

use Zend2\GData\App\Extension;

/**
 * Represents the app:control element
 *
 * @uses       \Zend2\GData\App\Extension
 * @uses       \Zend2\GData\App\Extension\Draft
 * @category   Zend2
 * @package    Zend2_Gdata
 * @subpackage App
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Control extends Extension
{

    protected $_rootNamespace = 'app';
    protected $_rootElement = 'control';
    protected $_draft = null;

    public function __construct($draft = null)
    {
        parent::__construct();
        $this->_draft = $draft;
    }

    public function getDOM($doc = null, $majorVersion = 1, $minorVersion = null)
    {
        $element = parent::getDOM($doc, $majorVersion, $minorVersion);
        if ($this->_draft != null) {
            $element->appendChild($this->_draft->getDOM($element->ownerDocument));
        }
        return $element;
    }

    protected function takeChildFromDOM($child)
    {
        $absoluteNodeName = $child->namespaceURI . ':' . $child->localName;
        switch ($absoluteNodeName) {
        case $this->lookupNamespace('app') . ':' . 'draft':
            $draft = new Draft();
            $draft->transferFromDOM($child);
            $this->_draft = $draft;
            break;
        default:
            parent::takeChildFromDOM($child);
            break;
        }
    }

    /**
     * @return \Zend2\GData\App\Extension\Draft
     */
    public function getDraft()
    {
        return $this->_draft;
    }

    /**
     * @param \Zend2\GData\App\Extension\Draft $value
     * @return \Zend2\GData\App\Entry Provides a fluent interface
     */
    public function setDraft($value)
    {
        $this->_draft = $value;
        return $this;
    }

}
