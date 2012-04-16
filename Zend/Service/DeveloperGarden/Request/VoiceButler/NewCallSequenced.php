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
 * @uses       Zend2_Service_DeveloperGarden_VoiceButler_NewCall
 * @category   Zend2
 * @package    Zend2_Service
 * @subpackage DeveloperGarden
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @author     Marco Kaiser
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend2_Service_DeveloperGarden_Request_VoiceButler_NewCallSequenced
    extends Zend2_Service_DeveloperGarden_Request_VoiceButler_NewCall
{
    /**
     * array of second numbers to be called sequenced
     *
     * @var array
     */
    public $bNumber = null;

    /**
     * max wait value to wait for new number to be called
     *
     * @var integer
     */
    public $maxWait = null;

    /**
     * @return array
     */
    public function getBNumber()
    {
        return $this->bNumber;
    }

    /**
     * @param array $bNumber
     * @return Zend2_Service_DeveloperGarden_Request_VoiceButler_NewCall
     */
    /*public function setBNumber(array $bNumber)
    {
        $this->bNumber = $bNumber;
        return $this;
    }*/

    /**
     * returns the max wait value
     *
     * @return integer
     */
    public function getMaxWait()
    {
        return $this->maxWait;
    }

    /**
     * sets new max wait value for next number call
     *
     * @param integer $maxWait
     * @return Zend2_Service_DeveloperGarden_Request_VoiceButler_NewCallSequenced
     */
    public function setMaxWait($maxWait)
    {
        $this->maxWait = $maxWait;
        return $this;
    }
}
