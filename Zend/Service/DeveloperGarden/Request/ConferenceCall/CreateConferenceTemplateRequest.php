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
 * @uses       Zend2_Service_DeveloperGarden_Request_AbstractRequest
 * @category   Zend2
 * @package    Zend2_Service
 * @subpackage DeveloperGarden
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @author     Marco Kaiser
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend2_Service_DeveloperGarden_Request_ConferenceCall_CreateConferenceTemplateRequest
    extends Zend2_Service_DeveloperGarden_Request_AbstractRequest
{
    /**
     * unique owner id
     *
     * @var string
     */
    public $ownerId = null;

    /**
     * object with details for this conference
     *
     * @var Zend2_Service_DeveloperGarden_ConferenceCall_ConferenceDetail
     */
    public $detail = null;

    /**
     * array with Zend2_Service_DeveloperGarden_ConferenceCall_ParticipantDetail elements
     *
     * @var array
     */
    public $participants = null;

    /**
     * constructor
     *
     * @param integer $environment
     * @param string $ownerId
     * @param Zend2_Service_DeveloperGarden_ConferenceCall_ConferenceDetail $conferenceDetails
     * @param array $conferenceParticipants
     */
    public function __construct($environment, $ownerId,
        Zend2_Service_DeveloperGarden_ConferenceCall_ConferenceDetail $conferenceDetails,
        array $conferenceParticipants = null
    ) {
        parent::__construct($environment);
        $this->setOwnerId($ownerId)
             ->setDetail($conferenceDetails)
             ->setParticipants($conferenceParticipants);
    }

    /**
     * sets $participants
     *
     * @param array $participants
     * @return Zend2_Service_DeveloperGarden_Request_ConferenceCall_CreateConferenceTemplateRequest
     */
    public function setParticipants(array $participants = null)
    {
        $this->participants = $participants;
        return $this;
    }

    /**
     * sets $detail
     *
     * @param Zend2_Service_DeveloperGarden_ConferenceCall_ConferenceDetail $detail
     * @return Zend2_Service_DeveloperGarden_Request_ConferenceCall_CreateConferenceTemplateRequest
     */
    public function setDetail(Zend2_Service_DeveloperGarden_ConferenceCall_ConferenceDetail $detail)
    {
        $this->detail = $detail;
        return $this;
    }

    /**
     * sets $ownerId
     *
     * @param string $ownerId
     * @return Zend2_Service_DeveloperGarden_Request_ConferenceCall_CreateConferenceTemplateRequest
     */
    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;
        return $this;
    }
}
