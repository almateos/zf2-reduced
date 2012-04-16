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
 * @uses       Zend2_Service_DeveloperGarden_Response_BaseType
 * @category   Zend2
 * @package    Zend2_Service
 * @subpackage DeveloperGarden
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @author     Marco Kaiser
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class Zend2_Service_DeveloperGarden_Response_ConferenceCall_AbstractConferenceCall
    extends Zend2_Service_DeveloperGarden_Response_BaseType
{
    /**
     * returns the response object or null
     *
     * @return mixed
     */
    public function getResponse()
    {
        $r = new ReflectionClass($this);
        foreach ($r->getProperties() as $p) {
            $name = $p->getName();
            if (strpos($name, 'Response') !== false) {
                return $p->getValue($this);
            }
        }
        return null;
    }

    /**
     * parse the response data and throws exceptions
     *
     * @throws Zend2_Service_DeveloperGarden_Response_Exception
     * @return mixed
     */
    public function parse()
    {
        $retVal = $this->getResponse();
        if ($retVal === null) {
            $this->statusCode    = 9999;
            $this->statusMessage = 'Internal response property not found.';
        } else {
            $this->statusCode    = $retVal->getStatusCode();
            $this->statusMessage = $retVal->getStatusMessage();
        }
        parent::parse();
        return $retVal;
    }
}
