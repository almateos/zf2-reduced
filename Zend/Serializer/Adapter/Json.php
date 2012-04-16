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

use Zend2\Serializer\Exception\InvalidArgumentException,
    Zend2\Serializer\Exception\RuntimeException,
    Zend2\Json\Json as Zend2Json;

/**
 * @uses       Zend2\Serializer\Adapter\AbstractAdapter
 * @uses       Zend2\Serializer\Exception\InvalidArgumentException
 * @uses       Zend2\Serializer\Exception\RuntimeException
 * @uses       Zend2\Json\Json
 * @category   Zend2
 * @package    Zend2_Serializer
 * @subpackage Adapter
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Json extends AbstractAdapter
{
    /**
     * @var array Default options
     */
    protected $_options = array(
        'cycleCheck'           => false,
        'enableJsonExprFinder' => false,
        'objectDecodeType'     => Zend2Json::TYPE_ARRAY,
    );

    /**
     * Serialize PHP value to JSON
     * 
     * @param  mixed $value 
     * @param  array $opts 
     * @return string
     * @throws Zend2\Serializer\Exception on JSON encoding exception
     */
    public function serialize($value, array $opts = array())
    {
        $opts = $opts + $this->_options;

        try  {
            return Zend2Json::encode($value, $opts['cycleCheck'], $opts);
        } catch (\InvalidArgumentException $e) {
            throw new InvalidArgumentException('Serialization failed: ' . $e->getMessage(), 0, $e);
        } catch (\Exception $e) {
            throw new RuntimeException('Serialization failed: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Deserialize JSON to PHP value
     * 
     * @param  string $json 
     * @param  array $opts 
     * @return mixed
     */
    public function unserialize($json, array $opts = array())
    {
        $opts = $opts + $this->_options;

        try {
            $ret = Zend2Json::decode($json, $opts['objectDecodeType']);
        } catch (\InvalidArgumentException $e) {
            throw new InvalidArgumentException('Unserialization failed: ' . $e->getMessage(), 0, $e);
        } catch (\Exception $e) {
            throw new RuntimeException('Unserialization failed: ' . $e->getMessage(), 0, $e);
        }

        return $ret;
    }
}
