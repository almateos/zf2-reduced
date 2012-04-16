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
 * @subpackage Zend2_InfoCard_Xml_Security
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\InfoCard\XML\Security\Transform;

use Zend2\InfoCard\XML\Security\Transform,
    Zend2\InfoCard\XML\Security\Exception;

/**
 * A Transform to perform C14n XML Exclusive Canonicalization
 *
 * @uses       DOMDocument
 * @uses       \Zend2\InfoCard\XML\Security\Transform\Exception
 * @uses       \Zend2\InfoCard\XML\Security\Transform
 * @category   Zend2
 * @package    Zend2_InfoCard
 * @subpackage Zend2_InfoCard_Xml_Security
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class XMLExcC14N implements Transform
{
    /**
     * Transform the input XML based on C14n XML Exclusive Canonicalization rules
     *
     * @throws \Zend2\InfoCard\XML\Security\Transform\Exception
     * @param string $strXMLData The input XML
     * @return string The output XML
     */
    public function transform($strXMLData)
    {
        $dom = new \DOMDocument();
        $dom->loadXML($strXMLData);

        if(method_exists($dom, 'C14N')) {
            return $dom->C14N(true, false);
        }

        throw new Exception\RuntimeException("This transform requires the C14N() method to exist in the DOM extension");
    }
}
