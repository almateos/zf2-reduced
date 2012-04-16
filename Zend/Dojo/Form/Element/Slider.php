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
 * @package    Zend2_Dojo
 * @subpackage Form_Element
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Dojo\Form\Element;

/**
 * Abstract Slider dijit
 *
 * @uses       \Zend2\Dojo\Form\Element\Dijit
 * @package    Zend2_Dojo
 * @subpackage Form_Element
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class Slider extends Dijit
{
    /**
     * Set clickSelect flag
     *
     * @param  bool $clickSelect
     * @return \Zend2\Dojo\Form\Element\TextBox
     */
    public function setClickSelect($flag)
    {
        $this->setDijitParam('clickSelect', (bool) $flag);
        return $this;
    }

    /**
     * Retrieve clickSelect flag
     *
     * @return bool
     */
    public function getClickSelect()
    {
        if (!$this->hasDijitParam('clickSelect')) {
            return false;
        }
        return $this->getDijitParam('clickSelect');
    }

    /**
     * Set intermediateChanges flag
     *
     * @param  bool $intermediateChanges
     * @return \Zend2\Dojo\Form\Element\TextBox
     */
    public function setIntermediateChanges($flag)
    {
        $this->setDijitParam('intermediateChanges', (bool) $flag);
        return $this;
    }

    /**
     * Retrieve intermediateChanges flag
     *
     * @return bool
     */
    public function getIntermediateChanges()
    {
        if (!$this->hasDijitParam('intermediateChanges')) {
            return false;
        }
        return $this->getDijitParam('intermediateChanges');
    }

    /**
     * Set showButtons flag
     *
     * @param  bool $showButtons
     * @return \Zend2\Dojo\Form\Element\TextBox
     */
    public function setShowButtons($flag)
    {
        $this->setDijitParam('showButtons', (bool) $flag);
        return $this;
    }

    /**
     * Retrieve showButtons flag
     *
     * @return bool
     */
    public function getShowButtons()
    {
        if (!$this->hasDijitParam('showButtons')) {
            return false;
        }
        return $this->getDijitParam('showButtons');
    }

    /**
     * Set discreteValues
     *
     * @param  int $value
     * @return \Zend2\Dojo\Form\Element\TextBox
     */
    public function setDiscreteValues($value)
    {
        $this->setDijitParam('discreteValues', (int) $value);
        return $this;
    }

    /**
     * Retrieve discreteValues
     *
     * @return int|null
     */
    public function getDiscreteValues()
    {
        return $this->getDijitParam('discreteValues');
    }

    /**
     * Set maximum
     *
     * @param  int $value
     * @return \Zend2\Dojo\Form\Element\TextBox
     */
    public function setMaximum($value)
    {
        $this->setDijitParam('maximum', (int) $value);
        return $this;
    }

    /**
     * Retrieve maximum
     *
     * @return int|null
     */
    public function getMaximum()
    {
        return $this->getDijitParam('maximum');
    }

    /**
     * Set minimum
     *
     * @param  int $value
     * @return \Zend2\Dojo\Form\Element\TextBox
     */
    public function setMinimum($value)
    {
        $this->setDijitParam('minimum', (int) $value);
        return $this;
    }

    /**
     * Retrieve minimum
     *
     * @return int|null
     */
    public function getMinimum()
    {
        return $this->getDijitParam('minimum');
    }

    /**
     * Set pageIncrement
     *
     * @param  int $value
     * @return \Zend2\Dojo\Form\Element\TextBox
     */
    public function setPageIncrement($value)
    {
        $this->setDijitParam('pageIncrement', (int) $value);
        return $this;
    }

    /**
     * Retrieve pageIncrement
     *
     * @return int|null
     */
    public function getPageIncrement()
    {
        return $this->getDijitParam('pageIncrement');
    }
}
