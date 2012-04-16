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

namespace Zend2\Serializer;

/**
 * @category   Zend2
 * @package    Zend2_Serializer
 * @subpackage Adapter
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
interface Adapter 
{
    /**
     * Constructor
     *
     * @param  array|Zend2\Config\Config $opts Serializer options
     * @return void
     */
    public function __construct($opts = array());

    /**
     * Set serializer options
     *
     * @param  array|Zend2\Config\Config $opts Serializer options
     * @return Zend2\Serializer\Adapter
     */
    public function setOptions($opts);

    /**
     * Set a serializer option
     *
     * @param  string $name Option name
     * @param  mixed $value Option value
     * @return Zend2\Serializer\Adapter
     */
    public function setOption($name, $value);

    /**
     * Get serializer options
     *
     * @return array
     */
    public function getOptions();

    /**
     * Get a serializer option
     *
     * @param  string $name
     * @return mixed
     * @throws Zend2\Serializer\Exception
     */
    public function getOption($name);

    /**
     * Generates a storable representation of a value.
     *
     * @param  mixed $value Data to serialize
     * @param  array $options Serialize options
     * @return string
     * @throws Zend2\Serializer\Exception
     */
    public function serialize($value, array $options = array());

    /**
     * Creates a PHP value from a stored representation.
     *
     * @param  string $serialized Serialized string
     * @param  array $options Unserialize options
     * @return mixed
     * @throws Zend2\Serializer\Exception
     */
    public function unserialize($serialized, array $options = array());
}
