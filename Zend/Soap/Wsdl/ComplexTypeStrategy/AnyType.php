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
 * @package    Zend2_Soap
 * @subpackage WSDL
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Soap\Wsdl\ComplexTypeStrategy;

use Zend2\Soap\Wsdl\ComplexTypeStrategy;

/**
 * Zend2_Soap_Wsdl_Strategy_AnyType
 *
 * @uses       \Zend2\Soap\Wsdl\Strategy\StrategyInterface
 * @category   Zend2
 * @package    Zend2_Soap
 * @subpackage WSDL
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class AnyType implements ComplexTypeStrategy
{
    /**
     * Not needed in this strategy.
     *
     * @param \Zend2\Soap\Wsdl $context
     */
    public function setContext(\Zend2\Soap\Wsdl $context)
    {

    }

    /**
     * Returns xsd:anyType regardless of the input.
     *
     * @param string $type
     * @return string
     */
    public function addComplexType($type)
    {
        return 'xsd:anyType';
    }
}
