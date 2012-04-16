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
 * @subpackage Client
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Soap\Client;

use Zend2\Soap\Client as SOAPClient,
    Zend2\Soap\Server as SOAPServer;

/**
 * \Zend2\Soap\Client\Local
 *
 * Class is intended to be used as local SOAP client which works
 * with a provided Server object.
 *
 * Could be used for development or testing purposes.
 *
 * @uses       \Zend2\Soap\Client
 * @uses       \Zend2\Soap\Server
 * @category   Zend2
 * @package    Zend2_Soap
 * @subpackage Client
 */
class Local extends SOAPClient
{
    /**
     * Server object
     *
     * @var \Zend2\Soap\Server
     */
    protected $_server;

    /**
     * Local client constructor
     *
     * @param \Zend2\Soap\Server $server
     * @param string $wsdl
     * @param array $options
     */
    function __construct(SOAPServer $server, $wsdl, $options = null)
    {
        $this->_server = $server;

        // Use Server specified SOAP version as default
        $this->setSoapVersion($server->getSoapVersion());

        parent::__construct($wsdl, $options);
    }

    /**
     * Actual "do request" method.
     *
     * @internal
     * @param \Zend2\Soap\Client\Common $client
     * @param string $request
     * @param string $location
     * @param string $action
     * @param int    $version
     * @param int    $one_way
     * @return mixed
     */
    public function _doRequest(Common $client, $request, $location, $action, $version, $one_way = null)
    {
        // Perform request as is
        ob_start();
        $this->_server->handle($request);
        $response = ob_get_clean();

        return $response;
    }
}
