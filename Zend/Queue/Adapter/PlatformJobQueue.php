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
use Zend2\Queue;
use Zend2\Queue\Message;

/**
 * Zend2 Platform JobQueue adapter
 *
 * @uses       \Zend2API_Queue
 * @uses       \Zend2API_Job
 * @uses       \Zend2\Queue\Adapter\AdapterAbstract
 * @uses       \Zend2\Queue\Queue
 * @uses       \Zend2\Queue\Exception
 * @uses       \Zend2\Queue\Message\Message
 * @category   Zend2
 * @package    Zend2_Queue
 * @subpackage Adapter
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class PlatformJobQueue extends AbstractAdapter
{
    /**
     * @var \Zend2API_Queue
     */
    protected $_zendQueue;

    /**
     * Constructor
     *
     * @param  array|\Zend2\Config\Config $options
     * @param  \Zend2\Queue\Queue|null $queue
     * @return void
     */
    public function __construct($options, Queue\Queue $queue = null)
    {
        parent::__construct($options, $queue);

        if (!extension_loaded("jobqueue_client")) {
            throw new Queue\Exception('Platform Job Queue extension does not appear to be loaded');
        }

        if (! isset($this->_options['daemonOptions'])) {
            throw new Queue\Exception('Job Queue host and password should be provided');
        }

        $options = $this->_options['daemonOptions'];

        if (!array_key_exists('host', $options)) {
            throw new Queue\Exception('Platform Job Queue host should be provided');
        }
        if (!array_key_exists('password', $options)) {
            throw new Queue\Exception('Platform Job Queue password should be provided');
        }

        $this->_zendQueue = new \Zend2API_Queue($options['host']);

        if (!$this->_zendQueue) {
            throw new Queue\Exception('Platform Job Queue connection failed');
        }
        if (!$this->_zendQueue->login($options['password'])) {
            throw new Queue\Exception('Job Queue login failed');
        }

        if ($this->_queue) {
            $this->_queue->setMessageClass('\Zend2\Queue\Message\PlatformJob');
        }
    }

    /********************************************************************
     * Queue management functions
     ********************************************************************/

    /**
     * Does a queue already exist?
     *
     * @param  string $name
     * @return boolean
     * @throws \Zend2\Queue\Exception (not supported)
     */
    public function isExists($name)
    {
        throw new Queue\Exception('isExists() is not supported in this adapter');
    }

    /**
     * Create a new queue
     *
     * @param  string  $name    queue name
     * @param  integer $timeout default visibility timeout
     * @return void
     * @throws \Zend2\Queue\Exception
     */
    public function create($name, $timeout=null)
    {
        throw new Queue\Exception('create() is not supported in ' . get_class($this));
    }

    /**
     * Delete a queue and all of its messages
     *
     * @param  string $name queue name
     * @return void
     * @throws \Zend2\Queue\Exception
     */
    public function delete($name)
    {
        throw new Queue\Exception('delete() is not supported in ' . get_class($this));
    }

    /**
     * Get an array of all available queues
     *
     * @return void
     * @throws \Zend2\Queue\Exception
     */
    public function getQueues()
    {
        throw new Queue\Exception('getQueues() is not supported in this adapter');
    }

    /**
     * Return the approximate number of messages in the queue
     *
     * @param  \Zend2\Queue\Queue|null $queue
     * @return integer
     */
    public function count(Queue\Queue $queue = null)
    {
        if ($queue !== null) {
            throw new Queue\Exception('Queue parameter is not supported');
        }

        return $this->_zendQueue->getNumOfJobsInQueue();
    }

    /********************************************************************
     * Messsage management functions
     ********************************************************************/

    /**
     * Send a message to the queue
     *
     * @param  array|\Zend2API_Job $message Message to send to the active queue
     * @param  \Zend2\Queue\Queue $queue     Not supported
     * @return \Zend2\Queue\Message\Message
     * @throws \Zend2\Queue\Exception
     */
    public function send($message, Queue\Queue $queue = null)
    {
        if ($queue !== null) {
            throw new Queue\Exception('Queue parameter is not supported');
        }

        // This adapter can work only for this message type
        $classname = $this->_queue->getMessageClass();

        if ($message instanceof \Zend2API_Job) {
            $message = array('data' => $message);
        }

        $zendApiJob = new $classname($message);

        // Unfortunately, the Platform JQ API is PHP4-style...
        $platformJob = $zendApiJob->getJob();

        $jobId = $this->_zendQueue->addJob($platformJob);

        if (!$jobId) {
            throw new Queue\Exception('Failed to add a job to queue: '
                . $this->_zendQueue->getLastError());
        }

        $zendApiJob->setJobId($jobId);
        return $zendApiJob;
    }

    /**
     * Get messages in the queue
     *
     * @param  integer    $maxMessages    Maximum number of messages to return
     * @param  integer    $timeout        Ignored
     * @param  \Zend2\Queue\Queue $queue   Not supported
     * @throws \Zend2\Queue\Exception
     * @return ArrayIterator
     */
    public function receive($maxMessages = null, $timeout = null, Queue\Queue $queue = null)
    {
        if ($maxMessages === null) {
            $maxMessages = 1;
        }

        if ($queue !== null) {
            throw new Queue\Exception('Queue shouldn\'t be set');
        }

        $jobs = $this->_zendQueue->getJobsInQueue(null, $maxMessages, true);

        $options = array(
            'queue'        => $this->_queue,
            'data'         => $jobs,
            'messageClass' => $this->_queue->getMessageClass(),
        );
        $classname = $this->_queue->getMessageSetClass();
        return new $classname($options);
    }

    /**
     * Delete a message from the queue
     *
     * Returns true if the message is deleted, false if the deletion is
     * unsuccessful.
     *
     * @param  \Zend2\Queue\Message\Message $message
     * @return boolean
     * @throws \Zend2\Queue\Exception
     */
    public function deleteMessage(Message\Message $message)
    {
        if (get_class($message) != $this->_queue->getMessageClass()) {
            throw new Queue\Exception(
                'Failed to remove job from the queue; only messages of type '
                . '\Zend2\Queue\Message\PlatformJob may be used'
            );
        }

        return $this->_zendQueue->removeJob($message->getJobId());
    }

    public function isJobIdExist($id)
    {
         return (($this->_zendQueue->getJob($id))? true : false);
    }

    /********************************************************************
     * Supporting functions
     ********************************************************************/

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
            'create'                => false,
            'delete'                => false,
            'getQueues'             => false,
            'isExists'              => false,
            'count'                 => true,
            'send'                  => true,
            'receive'               => true,
            'deleteMessage'         => true,
        );
    }

    /********************************************************************
     * Functions that are not part of the \Zend2\Queue\Adapter\AdapterAbstract
     ********************************************************************/

    /**
     * Serialize
     *
     * @return array
     */
    public function __sleep()
    {
        return array('_options');
    }

    /**
     * Unserialize
     *
     * @return void
     */
    public function __wakeup()
    {
        $options = $this->_options['daemonOptions'];

        $this->_zendQueue = new \Zend2API_Queue($options['host']);

        if (!$this->_zendQueue) {
            throw new Queue\Exception('Platform Job Queue connection failed');
        }
        if (!$this->_zendQueue->login($options['password'])) {
            throw new Queue\Exception('Job Queue login failed');
        }
    }
}
