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
 * @package    Zend2_XmlRpc
 * @subpackage Value
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\XmlRpc\Value;

/**
 * @uses       Zend2\XmlRpc\Value\Collection
 * @category   Zend2
 * @package    Zend2_XmlRpc
 * @subpackage Value
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class ArrayValue extends Collection
{
    /**
     * Set the value of an array native type
     *
     * @param array $value
     */
    public function __construct($value)
    {
        $this->_type = self::XMLRPC_TYPE_ARRAY;
        parent::__construct($value);
    }


    /**
     * Generate the XML code that represent an array native MXL-RPC value
     *
     * @return void
     */
    protected function _generateXml()
    {
        $generator = $this->getGenerator();
        $generator->openElement('value')
                  ->openElement('array')
                  ->openElement('data');

        if (is_array($this->_value)) {
            foreach ($this->_value as $val) {
                $val->generateXml();
            }
        }
        $generator->closeElement('data')
                  ->closeElement('array')
                  ->closeElement('value');
    }
}

