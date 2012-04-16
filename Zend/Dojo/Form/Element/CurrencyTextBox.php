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

use Zend2\Form\Element\Exception;

/**
 * CurrencyTextBox dijit
 *
 * @uses       \Zend2\Dojo\Form\Element\NumberTextBox
 * @uses       \Zend2\Form\Element\Exception
 * @package    Zend2_Dojo
 * @subpackage Form_Element
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class CurrencyTextBox extends NumberTextBox
{
    /**
     * Use CurrencyTextBox dijit view helper
     * @var string
     */
    public $helper = 'CurrencyTextBox';

    /**
     * Set currency
     *
     * @param  string $currency
     * @return \Zend2\Dojo\Form\Element\CurrencyTextBox
     */
    public function setCurrency($currency)
    {
        $this->setDijitParam('currency', (string) $currency);
        return $this;
    }

    /**
     * Retrieve currency
     *
     * @return string|null
     */
    public function getCurrency()
    {
        return $this->getDijitParam('currency');
    }

    /**
     * Set currency symbol
     *
     * Casts to string, uppercases, and trims to three characters.
     *
     * @param  string $symbol
     * @return \Zend2\Dojo\Form\Element\CurrencyTextBox
     */
    public function setSymbol($symbol)
    {
        $symbol = strtoupper((string) $symbol);
        $length = strlen($symbol);
        if (3 > $length) {
            throw new Exception\InvalidArgumentException('Invalid symbol provided; please provide ISO 4217 alphabetic currency code');
        }
        if (3 < $length) {
            $symbol = substr($symbol, 0, 3);
        }

        $this->setConstraint('symbol', $symbol);
        return $this;
    }

    /**
     * Retrieve symbol
     *
     * @return string|null
     */
    public function getSymbol()
    {
        return $this->getConstraint('symbol');
    }

    /**
     * Set whether currency is fractional
     *
     * @param  bool $flag
     * @return \Zend2\Dojo\Form\Element\CurrencyTextBox
     */
    public function setFractional($flag)
    {
        $this->setConstraint('fractional', (bool) $flag);
        return $this;
    }

    /**
     * Get whether or not to present fractional values
     *
     * @return bool
     */
    public function getFractional()
    {
        return ('true' == $this->getConstraint('fractional'));
    }
}
