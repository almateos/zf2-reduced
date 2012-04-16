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
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Serializer;

use Zend2\Loader\PluginClassLoader;

/**
 * Plugin Class Loader implementation for serializer adapters.
 *
 * @category   Zend2
 * @package    Zend2_Serializer
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class AdapterLoader extends PluginClassLoader
{
    /**
     * @var array Pre-aliased adapters 
     */
    protected $plugins = array(
        'amf0'          => 'Zend2\Serializer\Adapter\Amf0',
        'amf3'          => 'Zend2\Serializer\Adapter\Amf3',
        'ig_binary'     => 'Zend2\Serializer\Adapter\IgBinary',
        'igbinary'      => 'Zend2\Serializer\Adapter\IgBinary',
        'json'          => 'Zend2\Serializer\Adapter\Json',
        'php_code'      => 'Zend2\Serializer\Adapter\PhpCode',
        'phpcode'       => 'Zend2\Serializer\Adapter\PhpCode',
        'php_serialize' => 'Zend2\Serializer\Adapter\PhpSerialize',
        'phpserialize'  => 'Zend2\Serializer\Adapter\PhpSerialize',
        'python_pickle' => 'Zend2\Serializer\Adapter\PythonPickle',
        'pythonpickle'  => 'Zend2\Serializer\Adapter\PythonPickle',
        'wddx'          => 'Zend2\Serializer\Adapter\Wddx',
    );
}
