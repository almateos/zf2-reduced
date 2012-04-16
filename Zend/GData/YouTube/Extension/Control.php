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

namespace Zend2\GData\YouTube\Extension;

/**
 * Specialized Control class for use with YouTube. Enables use of yt extension elements.
 *
 * @uses       \Zend2\GData\App\Extension\Control
 * @uses       \Zend2\GData\YouTube
 * @uses       \Zend2\GData\YouTube\Extension\State
 * @category   Zend2
 * @package    Zend2_Gdata
 * @subpackage YouTube
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Control extends \Zend2\GData\App\Extension\Control
{

    protected $_state = null;

    /**
     * Constructs a new Zend2_Gdata_Calendar_Extension_Control object.
     * @see Zend2_Gdata_App_Extension_Control#__construct
     * @param \Zend2\GData\App\Extension\Draft $draft
     * @param \Zend2\GData\YouTube\Extension\State $state
     */
    public function __construct($draft = null, $state = null)
    {
        $this->registerAllNamespaces(\Zend2\GData\YouTube::$namespaces);
        parent::__construct($draft);
        $this->_state = $state;
    }

    /**
     * Retrieves a DOMElement which corresponds to this element and all
     * child properties.  This is used to build an entry back into a DOM
     * and eventually XML text for sending to the server upon updates, or
     * for application storage/persistence.
     *
     * @param DOMDocument $doc The DOMDocument used to construct DOMElements
     * @return DOMElement The DOMElement representing this element and all
     * child properties.
     */
    public function getDOM($doc = null, $majorVersion = 1, $minorVersion = null)
    {
        $element = parent::getDOM($doc, $majorVersion, $minorVersion);
        if ($this->_state != null) {
            $element->appendChild($this->_state->getDOM($element->ownerDocument));
        }
        return $element;
    }

    /**
     * Creates individual Entry objects of the appropriate type and
     * stores them as members of this entry based upon DOM data.
     *
     * @param DOMNode $child The DOMNode to process
     */
    protected function takeChildFromDOM($child)
    {
        $absoluteNodeName = $child->namespaceURI . ':' . $child->localName;
        switch ($absoluteNodeName) {
        case $this->lookupNamespace('yt') . ':' . 'state':
            $state = new State();
            $state->transferFromDOM($child);
            $this->_state = $state;
            break;
        default:
            parent::takeChildFromDOM($child);
            break;
        }
    }

    /**
     * Get the value for this element's state attribute.
     *
     * @return \Zend2\GData\YouTube\Extension\State The state element.
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * Set the value for this element's state attribute.
     *
     * @param \Zend2\GData\YouTube\Extension\State $value The desired value for this attribute.
     * @return Zend2_YouTube_Extension_Control The element being modified.
     */
    public function setState($value)
    {
        $this->_state = $value;
        return $this;
    }

    /**
    * Get the value of this element's state attribute.
    *
    * @return string The state's text value
    */
    public function getStateValue()
    {
      return $this->getState()->getText();
    }

}
