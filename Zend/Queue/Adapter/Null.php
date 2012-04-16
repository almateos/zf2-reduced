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
 * @package    Zend2_Queue
 * @subpackage Adapter
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Queue\Adapter;
use Zend2\Queue\Queue,
    Zend2\Queue\Message,
    Zend2\Queue\Exception as QueueException;


/**
 * Class testing.  No supported functions.  Also used to disable a Zend2_Queue.
 *
 * @uses       \Zend2\Queue\Adapter\AdapterAbstract
 * @uses       \Zend2\Queue\Queue
 * @uses       \Zend2\Queue\Exception
 * @uses       \Zend2\Queue\Message
 * @category   Zend2
 * @package    Zend2_Queue
 * @subpackage Adapter
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Null extends AbstractAdapter
{
    /**
     * Constructor
     *
     * @param  array|\Zend2\Config\Config $options
     * @param  null|\Zend2\Queue\Queue $queue
     * @return void
     */
    public function __construct($options, Queue $queue = null)
    {
        parent::__construct($options, $queue);
    }

    /********************************************************************
     * Queue management functions
     *********************************************************************/

    /**
     * Does a queue already exist?
     *
     * @throws \Zend2\Queue\Exception - not supported.
     */
    public function isExists($name)
    {
        throw new QueueException(__FUNCTION__ . '() is not supported by ' . get_class($this));
    }


    /**
     * Create a new queue
     *
     * @throws \Zend2\Queue\Exception - not supported.
     */
    public function create($name, $timeout=null)
    {
        throw new QueueException(__FUNCTION__ . '() is not supported by ' . get_class($this));
    }

    /**
     * Delete a queue and all of it's messages
     *
     * @throws \Zend2\Queue\Exception - not supported.
     */
    public function delete($name)
    {
        throw new QueueException(__FUNCTION__ . '() is not supported by ' . get_class($this));
    }

    /**
     * Get an array of all available queues
     *
     * @throws \Zend2\Queue\Exception - not supported.
     */
    public function getQueues()
    {
        throw new QueueException(__FUNCTION__ . '() is not supported by ' . get_class($this));
    }

    /**
     * Return the approximate number of messages in the queue
     *
     * @throws \Zend2\Queue\Exception - not supported.
     */
    public function count(Queue $queue=null)
    {
        throw new QueueException(__FUNCTION__ . '() is not supported by ' . get_class($this));
    }

    /********************************************************************
     * Messsage management functions
     *********************************************************************/

    /**
     * Send a message to the queue
     *
     * @throws \Zend2\Queue\Exception - not supported.
     */
    public function send($message, Queue $queue=null)
    {
        throw new QueueException(__FUNCTION__ . '() is not supported by ' . get_class($this));
    }

    /**
     * Get messages in the queue
     *
     * @throws \Zend2\Queue\Exception - not supported.
     */
    public function receive($maxMessages=null, $timeout=null, Queue $queue=null)
    {
        throw new QueueException(__FUNCTION__ . '() is not supported by ' . get_class($this));
    }

    /**
     * Delete a message from the queue
     *
     * @throws \Zend2\Queue\Exception - not supported.
     */
    public function deleteMessage(Message $message)
    {
        throw new QueueException(__FUNCTION__ . '() is not supported by ' . get_class($this));
    }

    /********************************************************************
     * Supporting functions
     *********************************************************************/

    /**
     * Return a list of queue capabilities functions
     *
     * $array['function name'] = true or false
     * true is supported, false is not supported.
     *
     * @param  string $name
     * @return array
     */
    public function getCapabilities()
    {
        return array(
            'create'        => false,
            'delete'        => false,
            'send'          => false,
            'receive'       => false,
            'deleteMessage' => false,
            'getQueues'     => false,
            'count'         => false,
            'isExists'      => false,
        );
    }
}
