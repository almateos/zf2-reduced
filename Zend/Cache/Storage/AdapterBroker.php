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
 * @package    Zend2_Cache
 * @subpackage Storage
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Cache\Storage;

use Zend2\Cache\Exception,
    Zend2\Loader\PluginBroker;

/**
 * Broker for cache storage adapter instances
 *
 * @category   Zend2
 * @package    Zend2_Cache
 * @subpackage Storage
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class AdapterBroker extends PluginBroker
{
    /**
     * @var string Default plugin loading strategy
     */
    protected $defaultClassLoader = 'Zend2\Cache\Storage\AdapterLoader';

    /**
     * Determine if we have a valid adapter
     *
     * @param  mixed $plugin
     * @return true
     * @throws Exception\RuntimeException
     */
    protected function validatePlugin($plugin)
    {
        if (!$plugin instanceof Adapter) {
            throw new Exception\RuntimeException('Cache storage adapters must implement Zend2\Cache\Storage\Adapter');
        }
        return true;
    }
}
