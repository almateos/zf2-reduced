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

namespace Zend2\Validator\Barcode;

/**
 * @uses       \Zend2\Validator\Barcode\AbstractAdapter
 * @category   Zend2
 * @package    Zend2_Validate
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Upce extends AbstractAdapter
{
    /**
     * Constructor for this barcode adapter
     *
     * @return void
     */
    public function __construct()
    {
        $this->setLength(array(6, 7, 8));
        $this->setCharacters('0123456789');
        $this->setChecksum('_gtin');
    }

    /**
     * Overrides parent checkLength
     *
     * @param string $value Value
     * @return boolean
     */
    public function hasValidLength($value)
    {
        if (strlen($value) != 8) {
            $this->useChecksum(false);
        } else {
            $this->useChecksum(true);
        }

        return parent::hasValidLength($value);
    }
}
