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
 * @package    Zend2_Paginator
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Paginator;

use Zend2\Loader\PluginClassLoader;

/**
 * Plugin Class Loader implementation for pagination adapters.
 *
 * @category   Zend2
 * @package    Zend2_Paginator
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class AdapterLoader extends PluginClassLoader
{
    /**
     * @var array Pre-aliased adapters 
     */
    protected $plugins = array(
        'array'           => 'Zend2\Paginator\Adapter\ArrayAdapter',
        'db_select'       => 'Zend2\Paginator\Adapter\DbSelect',
        'db_table_select' => 'Zend2\Paginator\Adapter\DbTableSelect',
        'iterator'        => 'Zend2\Paginator\Adapter\Iterator',
        'null'            => 'Zend2\Paginator\Adapter\Null',
    );
}
