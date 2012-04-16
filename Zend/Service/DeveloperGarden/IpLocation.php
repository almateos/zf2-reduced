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
 * @uses       Zend2_Service_DeveloperGarden_Client_AbstractClient
 * @uses       Zend2_Service_DeveloperGarden_Request_IpLocation_LocateIPRequest
 * @uses       Zend2_Service_DeveloperGarden_Response_IpLocation_CityType
 * @uses       Zend2_Service_DeveloperGarden_Response_IpLocation_GeoCoordinatesType
 * @uses       Zend2_Service_DeveloperGarden_Response_IpLocation_IPAddressLocationType
 * @uses       Zend2_Service_DeveloperGarden_Response_IpLocation_LocateIPResponse
 * @uses       Zend2_Service_DeveloperGarden_Response_IpLocation_LocateIPResponseType
 * @category   Zend2
 * @package    Zend2_Service
 * @subpackage DeveloperGarden
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @author     Marco Kaiser
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend2_Service_DeveloperGarden_IpLocation 
    extends Zend2_Service_DeveloperGarden_Client_AbstractClient
{
    /**
     * wsdl file
     *
     * @var string
     */
    protected $_wsdlFile = 'https://gateway.developer.telekom.com/p3gw-mod-odg-iplocation/services/IPLocation?wsdl';

    /**
     * wsdl file local
     *
     * @var string
     */
    protected $_wsdlFileLocal = 'Wsdl/IPLocation.wsdl';

    /**
     * Response, Request Classmapping
     *
     * @var array
     *
     */
    protected $_classMap = array(
        'LocateIPResponseType'  => 'Zend2_Service_DeveloperGarden_Response_IpLocation_LocateIPResponseType',
        'IPAddressLocationType' => 'Zend2_Service_DeveloperGarden_Response_IpLocation_IPAddressLocationType',
        'RegionType'            => 'Zend2_Service_DeveloperGarden_Response_IpLocation_RegionType',
        'GeoCoordinatesType'    => 'Zend2_Service_DeveloperGarden_Response_IpLocation_GeoCoordinatesType',
        'CityType'              => 'Zend2_Service_DeveloperGarden_Response_IpLocation_CityType',
    );

    /**
     * locate the given Ip address or array of addresses
     *
     * @param Zend2_Service_DeveloperGarden_IpLocation_IpAddress|string $ip
     * @return Zend2_Service_DeveloperGarden_Response_IpLocation_LocateIPResponse
     */
    public function locateIP($ip)
    {
        $request = new Zend2_Service_DeveloperGarden_Request_IpLocation_LocateIPRequest(
            $this->getEnvironment(),
            $ip
        );

        $result = $this->getSoapClient()->locateIP($request);

        $response = new Zend2_Service_DeveloperGarden_Response_IpLocation_LocateIPResponse($result);
        return $response->parse();
    }
}
