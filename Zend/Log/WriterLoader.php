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
 * @package    Zend2_Log
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * @namespace
 */
namespace Zend2\Log;

use Zend2\Loader\PluginClassLoader;

/**
 * @uses       \Zend2\Loader\PluginClassLoader
 * @category   Zend2
 * @package    Zend2_Log
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class WriterLoader extends PluginClassLoader
{
    /**
     * @var array Pre-aliased writers
     */
    protected $plugins = array(
        'db'           => 'Zend2\Log\Writer\Db',
        'firebug'      => 'Zend2\Log\Writer\Firebug',
        'mail'         => 'Zend2\Log\Writer\Mail',
        'mock'         => 'Zend2\Log\Writer\Mock',
        'null'         => 'Zend2\Log\Writer\Null',
        'stream'       => 'Zend2\Log\Writer\Stream',
        'syslog'       => 'Zend2\Log\Writer\Syslog',
        'zend_monitor' => 'Zend2\Log\Writer\Zend2Monitor',
    );
}
