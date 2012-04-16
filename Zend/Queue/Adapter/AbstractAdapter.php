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

use Zend2\Queue\Adapter,
    Zend2\Queue\Queue,
    Zend2\Queue\Exception as QueueException,
    Zend2\Config\Config;

/**
 * Class for connecting to queues performing common operations.
 *
 * @uses       \Zend2\Queue\Queue
 * @uses       \Zend2\Queue\Adapter
 * @uses       \Zend2\Queue\Message
 * @uses       \Zend2\Queue\Exception
 * @category   Zend2
 * @package    Zend2_Queue
 * @subpackage Adapter
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class AbstractAdapter implements Adapter
{
    /**
     * Default timeout for createQueue() function
     */
    const CREATE_TIMEOUT_DEFAULT = 30;

    /**
     * Default timeout for recieve() function
     */
    const RECEIVE_TIMEOUT_DEFAULT = 30;

    /**
     * User-provided options
     *
     * @var array
     */
    protected $_options = array();

    /**
     * Internal array of queues to save on lookups
     *
     * @var array
     */
    protected $_queues = array();

    /**
     * Contains the \Zend2\Queue\Queue that this object
     *
     * @var \Zend2\Queue\Queue
     */
    protected $_queue = null;

    /**
     * Constructor.
     *
     * $options is an array of key/value pairs or an instance of Zend2_Config
     * containing configuration options.  These options are common to most adapters:
     *
     * See the Zend2_Queue Adapter Notes documentation for example configurations.
     *
     * Some options are used on a case-by-case basis by adapters:
     *
     * access_key     => (string) Amazon AWS Access Key
     * secret_key     => (string) Amazon AWS Secret Key
     * dbname         => (string) The name of the database to user
     * username       => (string) Connect to the database as this username.
     * password       => (string) Password associated with the username.
     * host           => (string) What host to connect to, defaults to localhost
     * port           => (string) The port of the database
     *
     * @param  array|\Zend2\Config\Config $config An array having configuration data
     * @param  \Zend2\Queue\Queue The \Zend2\Queue\Queue object that created this class
     * @return void
     * @throws \Zend2\Queue\Exception
     */
    public function __construct($options, Queue $queue = null)
    {
        if ($options instanceof Config) {
            $options = $options->toArray();
        }

        /*
         * Verify that adapter parameters are in an array.
         */
        if (!is_array($options)) {
            throw new QueueException('Adapter options must be an array or Zend2_Config object');
        }

        // set the queue
        if ($queue !== null) {
            $this->setQueue($queue);
        }

        $adapterOptions = array();
        $driverOptions  = array();

        // Normalize the options and merge with the defaults
        if (array_key_exists('options', $options)) {
            if (!is_array($options['options'])) {
                throw new QueueException("Configuration array 'options' must be an array");
            }

            // Can't use array_merge() because keys might be integers
            foreach ($options['options'] as $key => $value) {
                $adapterOptions[$key] = $value;
            }
        }
        if (array_key_exists('driverOptions', $options)) {
            // can't use array_merge() because keys might be integers
            foreach ((array)$options['driverOptions'] as $key => $value) {
                $driverOptions[$key] = $value;
            }
        }
        $this->_options = array_merge($this->_options, $options);
        $this->_options['options']       = $adapterOptions;
        $this->_options['driverOptions'] = $driverOptions;
    }

    /********************************************************************
    * Queue management functions
     *********************************************************************/
    /**
     * get the Zend2_Queue class that is attached to this object
     *
     * @return \Zend2\Queue\Queue|null
     */
    public function getQueue()
    {
        return $this->_queue;
    }

    /**
     * set the Zend2_Queue class for this object
     *
     * @param  \Zend2\Queue\Queue $queue
     * @return \Zend2\Queue\Adapter
     */
    public function setQueue(Queue $queue)
    {
        $this->_queue = $queue;
        return $this;
    }

    /**
     * Returns the configuration options in this adapter.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->_options;
    }

    /**
     * Indicates if a function is supported or not.
     *
     * @param  string $name
     * @return boolean
     */
    public function isSupported($name)
    {
        $list = $this->getCapabilities();

        return (isset($list[$name]) && $list[$name]);
     }
}
