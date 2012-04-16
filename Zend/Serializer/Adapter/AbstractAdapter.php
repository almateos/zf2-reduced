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
 * @package    Zend2_Serializer
 * @subpackage Adapter
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Serializer\Adapter;

use Zend2\Serializer\Adapter as SerializationAdapter,
    Zend2\Serializer\Exception\InvalidArgumentException;

/**
 * @uses       \Zend2\Serializer\Adapter
 * @uses       \Zend2\Serializer\Exception\InvalidArgumentException
 * @category   Zend2
 * @package    Zend2_Serializer
 * @subpackage Adapter
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class AbstractAdapter implements SerializationAdapter
{
    /**
     * Serializer options
     *
     * @var array
     */
    protected $_options = array();

    /**
     * Constructor
     *
     * @param array|Zend2\Config\Config $opts Serializer options
     */
    public function __construct($opts = array()) 
    {
        $this->setOptions($opts);
    }

    /**
     * Set serializer options
     *
     * @param  array|Zend2\Config\Config $opts Serializer options
     * @return Zend2\Serializer\Adapter\AbstractAdapter
     */
    public function setOptions($opts) 
    {
        if ($opts instanceof \Zend2\Config\Config) {
            $opts = $opts->toArray();
        } else {
            $opts = (array) $opts;
        }

        foreach ($opts as $k => $v) {
            $this->setOption($k, $v);
        }
        return $this;
    }

    /**
     * Set a serializer option
     *
     * @param  string $name Option name
     * @param  mixed $value Option value
     * @return Zend2\Serializer\Adapter\AbstractAdapter
     */
    public function setOption($name, $value) 
    {
        $this->_options[(string) $name] = $value;
        return $this;
    }

    /**
     * Get serializer options
     *
     * @return array
     */
    public function getOptions() 
    {
        return $this->_options;
    }

    /**
     * Get a serializer option
     *
     * @param  string $name
     * @return mixed
     * @throws Zend2\Serializer\Exception
     */
    public function getOption($name) 
    {
        $name = (string) $name;
        if (!array_key_exists($name, $this->_options)) {
            throw new InvalidArgumentException("Unknown option '{$name}'");
        }

        return $this->_options[$name];
    }
}
