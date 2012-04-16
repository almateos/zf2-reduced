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
 * @package    Zend2_Crypt
 * @subpackage Rsa
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Crypt\Rsa;

/**
 * @uses       Zend2\Crypt\Exception
 * @uses       Zend2\Crypt\Rsa\Key
 * @category   Zend2
 * @package    Zend2_Crypt
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class PublicKey extends Key
{

    protected $_certificateString = null;

    public function __construct($string)
    {
        $this->_parse($string);
    }

    /**
     * @param string $string
     * @throws Zend2\Crypt\Exception
     */
    protected function _parse($string)
    {
        if (preg_match("/^-----BEGIN CERTIFICATE-----/", $string)) {
            $this->_certificateString = $string;
        } else {
            $this->_pemString = $string;
        }

        $result = openssl_get_publickey($string);
        if (!$result) {
            throw new \Zend2\Crypt\Exception('Unable to load public key');
        }

        $this->_opensslKeyResource = $result;
        $this->_details = openssl_pkey_get_details($this->_opensslKeyResource);
    }

    public function getCertificate()
    {
        return $this->_certificateString;
    }

}
