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
 * @package    Zend2_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\View\Helper;
use Zend2;
use Zend2\Locale;

/**
 * Currency view helper
 *
 * @uses      \Zend2\Currency\Currency
 * @uses      \Zend2\Locale\Locale
 * @uses      \Zend2\Registry
 * @uses      \Zend2\View\Helper\AbstractHelper
 * @category  Zend2
 * @package   Zend2_View
 * @copyright Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd     New BSD License
 */
class Currency extends AbstractHelper
{
    /**
     * Currency object
     *
     * @var \Zend2\Currency\Currency
     */
    protected $_currency;

    /**
     * Constructor for manually handling
     *
     * @param  \Zend2\Currency\Currency $currency Instance of \Zend2\Currency\Currency
     * @return void
     */
    public function __construct($currency = null)
    {
        if ($currency === null) {
            if (\Zend2\Registry::isRegistered('Zend2_Currency')) {
                $currency = \Zend2\Registry::get('Zend2_Currency');
            }
        }

        $this->setCurrency($currency);
    }

    /**
     * Output a formatted currency
     *
     * @param  integer|float                    $value    Currency value to output
     * @param  string|Zend2_Locale|\Zend2\Currency\Currency $currency OPTIONAL Currency to use for this call
     * @return string Formatted currency
     */
    public function __invoke($value = null, $currency = null)
    {
        if ($value === null) {
            return $this;
        }

        if (is_string($currency) || ($currency instanceof Locale\Locale)) {
            if (Locale\Locale::isLocale($currency)) {
                $currency = array('locale' => $currency);
            }
        }

        if (is_string($currency)) {
            $currency = array('currency' => $currency);
        }

        if (is_array($currency)) {
            return $this->_currency->toCurrency($value, $currency);
        }

        return $this->_currency->toCurrency($value);
    }

    /**
     * Sets a currency to use
     *
     * @param  Zend2_Currency|String|\Zend2\Locale\Locale $currency Currency to use
     * @throws \Zend2\View\Exception When no or a false currency was set
     * @return \Zend2\View\Helper\Currency
     */
    public function setCurrency($currency = null)
    {
        if (!$currency instanceof \Zend2\Currency\Currency) {
            $currency = new \Zend2\Currency\Currency($currency);
        }
        $this->_currency = $currency;

        return $this;
    }

    /**
     * Retrieve currency object
     *
     * @return \Zend2\Currency\Currency|null
     */
    public function getCurrency()
    {
        return $this->_currency;
    }
}
