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
 * @package    Zend2_Service
 * @subpackage DeveloperGarden
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * @uses       Zend2_Service_DeveloperGarden_IpLocation_IpAddress
 * @uses       Zend2_Service_DeveloperGarden_Request_AbstractRequest
 * @uses       Zend2_Service_DeveloperGarden_Request_Exception
 * @category   Zend2
 * @package    Zend2_Service
 * @subpackage DeveloperGarden
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @author     Marco Kaiser
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend2_Service_DeveloperGarden_Request_IpLocation_LocateIPRequest
    extends Zend2_Service_DeveloperGarden_Request_AbstractRequest
{
    /**
     * the ip addresses to lookup for
     *
     * @var Zend2_Service_DeveloperGarden_Request_IpLocation_IpAddress
     */
    public $address = null;

    /**
     * the account
     *
     * @var string
     */
    public $account = null;

    /**
     * constructor give them the environment
     *
     * @param integer $environment
     * @param Zend2_Service_DeveloperGarden_IpLocation_IpAddress|array $ip
     *
     * @return Zend2_Service_DeveloperGarden_Request_AbstractRequest
     */
    public function __construct($environment, $ip = null)
    {
        parent::__construct($environment);

        if ($ip !== null) {
            $this->setIp($ip);
        }
    }

    /**
     * sets new ip or array of ips
     *
     * @param Zend2_Service_DeveloperGarden_IpLocation_IpAddress|array $ip
     *
     * @return Zend2_Service_DeveloperGarden_Request_IpLocation_LocateIPRequest
     */
    public function setIp($ip)
    {
        if ($ip instanceof Zend2_Service_DeveloperGarden_IpLocation_IpAddress) {
            $this->address[] = array(
                'ipType'    => $ip->getVersion(),
                'ipAddress' => $ip->getIp(),
            );
            return $this;
        }

        if (is_array($ip)) {
            foreach ($ip as $ipObject) {
                if (!$ipObject instanceof Zend2_Service_DeveloperGarden_IpLocation_IpAddress
                    && !is_string($ipObject)
                ) {
                    throw new Zend2_Service_DeveloperGarden_Request_Exception(
                        'Not a valid Ip Address object found.'
                    );
                }
                $this->setIp($ipObject);
            }
            return $this;
        }

        if (!is_string($ip)) {
            throw new Zend2_Service_DeveloperGarden_Request_Exception('Not a valid Ip Address object found.');
        }

        return $this->setIp(new Zend2_Service_DeveloperGarden_IpLocation_IpAddress($ip));
    }
}
