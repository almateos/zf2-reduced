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
 * @package    Zend2_Mail
 * @subpackage Storage
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Mail\Storage\Message;

use Zend2\Mail\Storage\MailMessage,
    Zend2\Mail\Storage\Part\File as FilePart;

/**
 * @category   Zend2
 * @package    Zend2_Mail
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class File extends FilePart implements MailMessage
{
    /**
     * flags for this message
     * @var array
     */
    protected $_flags = array();

    /**
     * Public constructor
     *
     * In addition to the parameters of Zend2_Mail_Part::__construct() this constructor supports:
     * - flags array with flags for message, keys are ignored, use constants defined in Zend2_Mail_Storage
     *
     * @param  string $rawMessage  full message with or without headers
     * @throws \Zend2\Mail\Storage\Exception
     */
    public function __construct(array $params)
    {
        if (!empty($params['flags'])) {
            // set key and value to the same value for easy lookup
            $this->_flags = array_combine($params['flags'], $params['flags']);
        }

        parent::__construct($params);
    }

    /**
     * return toplines as found after headers
     *
     * @return string toplines
     */
    public function getTopLines()
    {
        return $this->_topLines;
    }

    /**
     * check if flag is set
     *
     * @param mixed $flag a flag name, use constants defined in \Zend2\Mail\Storage
     * @return bool true if set, otherwise false
     */
    public function hasFlag($flag)
    {
        return isset($this->_flags[$flag]);
    }

    /**
     * get all set flags
     *
     * @return array array with flags, key and value are the same for easy lookup
     */
    public function getFlags()
    {
        return $this->_flags;
    }
}
