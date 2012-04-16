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
 * Plugin Class Loader implementation for cache storage plugins.
 *
 * @category   Zend2
 * @package    Zend2_Cache
 * @subpackage Storage
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class PluginLoader extends PluginClassLoader
{
    /**
     * Pre-aliased adapters
     *
     * @var array
     */
    protected $plugins = array(
        'clear_by_factor'    => 'Zend2\Cache\Storage\Plugin\ClearByFactor',
        'clearbyfactor'      => 'Zend2\Cache\Storage\Plugin\ClearByFactor',
        'exception_handler'  => 'Zend2\Cache\Storage\Plugin\ExceptionHandler',
        'exceptionhandler'   => 'Zend2\Cache\Storage\Plugin\ExceptionHandler',
        //'filter'             => 'Zend2\Cache\Storage\Plugin\Filter',
        'ignore_user_abort'  => 'Zend2\Cache\Storage\Plugin\IgnoreUserAbort',
        'ignoreuserabort'    => 'Zend2\Cache\Storage\Plugin\IgnoreUserAbort',
        //'key_filter'         => 'Zend2\Cache\Storage\Plugin\KeyFilter',
        //'keyfilter'          => 'Zend2\Cache\Storage\Plugin\KeyFilter',
        //'levels'             => 'Zend2\Cache\Storage\Plugin\Levels',
        //'locking'            => 'Zend2\Cache\Storage\Plugin\Locking',
        //'master_file'        => 'Zend2\Cache\Storage\Plugin\MasterFile',
        //'masterfile'         => 'Zend2\Cache\Storage\Plugin\MasterFile',
        'optimize_by_factor' => 'Zend2\Cache\Storage\Plugin\OptimizeByFactor',
        'optimizebyfactor'   => 'Zend2\Cache\Storage\Plugin\OptimizeByFactor',
        //'reluctant'          => 'Zend2\Cache\Storage\Plugin\Reluctant',
        'serializer'         => 'Zend2\Cache\Storage\Plugin\Serializer',
        //'store_times'        => 'Zend2\Cache\Storage\Plugin\StoreTimes',
        //'storetimes'         => 'Zend2\Cache\Storage\Plugin\StoreTimes',
        //'tagging'            => 'Zend2\Cache\Storage\Plugin\Tagging',
        //'write_control'      => 'Zend2\Cache\Storage\Plugin\WriteControl',
        //'writecontrol'       => 'Zend2\Cache\Storage\Plugin\WriteControl',
    );
}
