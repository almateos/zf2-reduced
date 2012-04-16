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
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\InfoCard\XML\KeyInfo;

use Zend2\InfoCard\XML\KeyInfo;

/**
 * Represents a Xml Digital Signature XML Data Block
 *
 * @uses       \Zend2\InfoCard\XML\EncryptedKey
 * @uses       \Zend2\InfoCard\XML\Exception
 * @uses       \Zend2\InfoCard\XML\KeyInfo\AbstractKeyInfo
 * @uses       \Zend2\InfoCard\XML\KeyInfo
 * @category   Zend2
 * @package    Zend2_InfoCard
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class XMLDSig extends AbstractKeyInfo implements KeyInfo
{
    /**
     * Returns an instance of the EncryptedKey Data Block
     *
     * @throws \Zend2\InfoCard\XML\Exception
     * @return \Zend2\InfoCard\XML\EncryptedKey
     */
    public function getEncryptedKey()
    {
        $this->registerXPathNamespace('e', 'http://www.w3.org/2001/04/xmlenc#');
        list($encryptedkey) = $this->xpath('//e:EncryptedKey');

        if(!($encryptedkey instanceof \Zend2\InfoCard\XML\AbstractElement)) {
            throw new \Zend2\InfoCard\XML\Exception\RuntimeException("Failed to retrieve encrypted key");
        }

        return \Zend2\InfoCard\XML\EncryptedKey::getInstance($encryptedkey);
    }

    /**
     * Returns the KeyInfo Block within the encrypted key
     *
     * @return \Zend2\InfoCard\XML\KeyInfo\Default
     */
    public function getKeyInfo()
    {
        return $this->getEncryptedKey()->getKeyInfo();
    }
}
