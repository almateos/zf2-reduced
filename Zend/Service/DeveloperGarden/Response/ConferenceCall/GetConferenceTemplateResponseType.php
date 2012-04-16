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
class Zend2_Service_DeveloperGarden_Response_ConferenceCall_GetConferenceTemplateResponseType
    extends Zend2_Service_DeveloperGarden_Response_BaseType
{
    /**
     * details
     *
     * @var Zend2_Service_DeveloperGarden_ConferenceCall_ConferenceDetail
     */
    public $detail = null;

    /**
     * array of Zend2_Service_DeveloperGarden_ConferenceCall_Participant
     *
     * @var array
     */
    public $participants = null;

    /**
     * returns the details object
     *
     * @return Zend2_Service_DeveloperGarden_ConferenceCall_ConferenceDetail
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * returns array with all participants
     * Zend2_Service_DeveloperGarden_ConferenceCall_ParticipantDetail
     *
     * @return array of Zend2_Service_DeveloperGarden_ConferenceCall_ParticipantDetail
     */
    public function getParticipants()
    {
        if ($this->participants instanceof Zend2_Service_DeveloperGarden_ConferenceCall_Participant) {
            $this->participants = array(
                $this->participants
            );
        }
        return $this->participants;
    }

    /**
     * returns the participant object if found in the response
     *
     * @param string $participantId
     * @return Zend2_Service_DeveloperGarden_ConferenceCall_Participant
     */
    public function getParticipantById($participantId)
    {
        $participants = $this->getParticipants();
        if ($participants !== null) {
            foreach ($participants as $participant) {
                if (strcmp($participant->getParticipantId(), $participantId) == 0) {
                    return $participant;
                }
            }
        }
        return null;
    }
}
