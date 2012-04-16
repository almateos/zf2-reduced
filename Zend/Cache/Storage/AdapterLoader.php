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

use Zend2\Loader\PluginClassLoader;

/**
 * Plugin Class Loader implementation for cache storage adapters.
 *
 * @category   Zend2
 * @package    Zend2_Cache
 * @subpackage Storage
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class AdapterLoader extends PluginClassLoader
{
    /**
     * @var array Pre-aliased adapters
     */
    protected $plugins = array(
        'apc'              => 'Zend2\Cache\Storage\Adapter\Apc',
        'filesystem'       => 'Zend2\Cache\Storage\Adapter\Filesystem',
        'memcached'        => 'Zend2\Cache\Storage\Adapter\Memcached',
        'memory'           => 'Zend2\Cache\Storage\Adapter\Memory',
        'sysvshm'          => 'Zend2\Cache\Storage\Adapter\SystemVShm',
        'systemvshm'       => 'Zend2\Cache\Storage\Adapter\SystemVShm',
        'sqlite'           => 'Zend2\Cache\Storage\Adapter\Sqlite',
        'dba'              => 'Zend2\Cache\Storage\Adapter\Dba',
        'wincache'         => 'Zend2\Cache\Storage\Adapter\WinCache',
        'xcache'           => 'Zend2\Cache\Storage\Adapter\XCache',
        'zendserverdisk'   => 'Zend2\Cache\Storage\Adapter\Zend2ServerDisk',
        'zend_server_disk' => 'Zend2\Cache\Storage\Adapter\Zend2ServerDisk',
        'zendservershm'    => 'Zend2\Cache\Storage\Adapter\Zend2ServerShm',
        'zend_server_shm'  => 'Zend2\Cache\Storage\Adapter\Zend2ServerShm',
    );
}
