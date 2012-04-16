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
 * @package    Zend2_Filter
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Filter;

/**
 * Encrypts a given string
 *
 * @uses       Zend2\Filter\Exception
 * @uses       Zend2\Filter\AbstractFilter
 * @uses       Zend2\Loader
 * @category   Zend2
 * @package    Zend2_Filter
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Encrypt extends AbstractFilter
{
    /**
     * Encryption adapter
     */
    protected $_adapter;

    /**
     * Class constructor
     *
     * @param string|array $options (Optional) Options to set, if null mcrypt is used
     */
    public function __construct($options = null)
    {
        if ($options instanceof \Zend2\Config\Config) {
            $options = $options->toArray();
        }

        $this->setAdapter($options);
    }

    /**
     * Returns the name of the set adapter
     *
     * @return string
     */
    public function getAdapter()
    {
        return $this->_adapter->toString();
    }

    /**
     * Sets new encryption options
     *
     * @param  string|array $options (Optional) Encryption options
     * @return \Zend2\Filter\Encrypt\Encrypt
     */
    public function setAdapter($options = null)
    {
        if (is_string($options)) {
            $adapter = $options;
        } else if (isset($options['adapter'])) {
            $adapter = $options['adapter'];
            unset($options['adapter']);
        } else {
            $adapter = 'Mcrypt';
        }

        if (!is_array($options)) {
            $options = array();
        }

        if (\Zend2\Loader::isReadable('Zend2/Filter/Encrypt/' . ucfirst($adapter). '.php')) {
            $adapter = 'Zend2\\Filter\\Encrypt\\' . ucfirst($adapter);
        }

        if (!class_exists($adapter)) {
            \Zend2\Loader::loadClass($adapter);
        }

        $this->_adapter = new $adapter($options);
        if (!$this->_adapter instanceof Encrypt\EncryptionAlgorithm) {
            throw new Exception\InvalidArgumentException("Encoding adapter '" . $adapter . "' does not implement Zend2\\Filter\\Encrypt\\EncryptionAlgorithm");
        }

        return $this;
    }

    /**
     * Calls adapter methods
     *
     * @param string       $method  Method to call
     * @param string|array $options Options for this method
     */
    public function __call($method, $options)
    {
        $part = substr($method, 0, 3);
        if ((($part != 'get') and ($part != 'set')) or !method_exists($this->_adapter, $method)) {
            throw new Exception\BadMethodCallException("Unknown method '{$method}'");
        }

        return call_user_func_array(array($this->_adapter, $method), $options);
    }

    /**
     * Defined by Zend2\Filter\Filter
     *
     * Encrypts the content $value with the defined settings
     *
     * @param  string $value Content to encrypt
     * @return string The encrypted content
     */
    public function filter($value)
    {
        return $this->_adapter->encrypt($value);
    }
}
