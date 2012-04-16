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
 * @package    Zend2_Validate
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Validator;
use Zend2;

/**
 * @uses       \Zend2\Locale\Locale
 * @uses       \Zend2\Locale\Format
 * @uses       \Zend2\Registry
 * @uses       \Zend2\Validator\AbstractValidator
 * @category   Zend2
 * @package    Zend2_Validate
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Int extends AbstractValidator
{
    const INVALID = 'intInvalid';
    const NOT_INT = 'notInt';

    /**
     * @var array
     */
    protected $_messageTemplates = array(
        self::INVALID => "Invalid type given. String or integer expected",
        self::NOT_INT => "'%value%' does not appear to be an integer",
    );

    protected $_locale;

    /**
     * Constructor for the integer validator
     *
     * @param string|Zend2_Config|\Zend2\Locale\Locale $locale
     */
    public function __construct($locale = null)
    {
        if ($locale instanceof \Zend2\Config\Config) {
            $locale = $locale->toArray();
        }

        if (is_array($locale)) {
            if (array_key_exists('locale', $locale)) {
                $locale = $locale['locale'];
            } else {
                $locale = null;
            }
        }

        if (empty($locale)) {
            if (\Zend2\Registry::isRegistered('Zend2_Locale')) {
                $locale = \Zend2\Registry::get('Zend2_Locale');
            }
        }

        if ($locale !== null) {
            $this->setLocale($locale);
        }
        
        parent::__construct();
    }

    /**
     * Returns the set locale
     */
    public function getLocale()
    {
        return $this->_locale;
    }

    /**
     * Sets the locale to use
     *
     * @param string|\Zend2\Locale\Locale $locale
     */
    public function setLocale($locale = null)
    {
        $this->_locale = \Zend2\Locale\Locale::findLocale($locale);
        return $this;
    }

    /**
     * Returns true if and only if $value is a valid integer
     *
     * @param  string|integer $value
     * @return boolean
     */
    public function isValid($value)
    {
        if (!is_string($value) && !is_int($value) && !is_float($value)) {
            $this->error(self::INVALID);
            return false;
        }

        if (is_int($value)) {
            return true;
        }

        $this->setValue($value);
        if ($this->_locale === null) {
            $locale        = localeconv();
            $valueFiltered = str_replace($locale['decimal_point'], '.', $value);
            $valueFiltered = str_replace($locale['thousands_sep'], '', $valueFiltered);

            if (strval(intval($valueFiltered)) != $valueFiltered) {
                $this->error(self::NOT_INT);
                return false;
            }

        } else {
            try {
                if (!\Zend2\Locale\Format::isInteger($value, array('locale' => $this->_locale))) {
                    $this->error(self::NOT_INT);
                    return false;
                }
            } catch (\Zend2\Locale\Exception $e) {
                $this->error(self::NOT_INT);
                return false;
            }
        }

        return true;
    }
}
