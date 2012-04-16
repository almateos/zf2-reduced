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
 * @package    Zend2_InfoCard
 * @subpackage Zend2_InfoCard_Xml
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\InfoCard\XML\KeyInfo;

/**
 * An object representation of a XML <KeyInfo> block which doesn't provide a namespace
 * In this context, it is assumed to mean that it is the type of KeyInfo block which
 * contains the SecurityTokenReference
 *
 * @uses       \Zend2\InfoCard\XML\Exception
 * @uses       \Zend2\InfoCard\XML\KeyInfo\AbstractKeyInfo
 * @uses       \Zend2\InfoCard\XML\SecurityTokenReference
 * @category   Zend2
 * @package    Zend2_InfoCard
 * @subpackage Zend2_InfoCard_Xml
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class DefaultKeyInfo extends AbstractKeyInfo
{
    /**
     * Returns the object representation of the SecurityTokenReference block
     *
     * @throws \Zend2\InfoCard\XML\Exception
     * @return \Zend2\InfoCard\XML\SecurityTokenReference
     */
    public function getSecurityTokenReference()
    {
        $this->registerXPathNamespace('o', 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd');

        list($sectokenref) = $this->xpath('//o:SecurityTokenReference');

        if(!($sectokenref instanceof \Zend2\InfoCard\XML\AbstractElement)) {
            throw new \Zend2\InfoCard\XML\Exception\RuntimeException('Could not locate the Security Token Reference');
        }

        return \Zend2\InfoCard\XML\SecurityTokenReference::getInstance($sectokenref);
    }
}
