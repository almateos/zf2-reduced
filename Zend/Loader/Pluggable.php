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
 * @package    Zend2_Loader
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

namespace Zend2\Loader;

/**
 * Pluggable class interface
 *
 * @category   Zend2
 * @package    Zend2_Loader
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
interface Pluggable
{
    /**
     * Get plugin broker instance
     * 
     * @return Zend2\Loader\Broker
     */
    public function getBroker();

    /**
     * Set plugin broker instance
     * 
     * @param  string|Broker $broker Plugin broker to load plugins
     * @return Zend2\Loader\Pluggable
     */
    public function setBroker($broker);

    /**
     * Get plugin instance
     * 
     * @param  string     $plugin  Name of plugin to return
     * @param  null|array $options Options to pass to plugin constructor (if not already instantiated)
     * @return mixed
     */
    public function plugin($name, array $options = null);
}
