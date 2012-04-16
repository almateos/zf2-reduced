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
 * @package    Zend2_Barcode
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Barcode;

use Zend2\Loader\PluginClassLoader;

/**
 * Plugin Class Loader implementation for Barcodes.
 *
 * @category   Zend2
 * @package    Zend2_Barcode
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class ObjectLoader extends PluginClassLoader
{
    /**
     * @var array Pre-aliased filter
     */
    protected $plugins = array(
        'codabar'            => 'Zend2\Barcode\Object\Codabar',
        'code128'            => 'Zend2\Barcode\Object\Code128',
        'code25'             => 'Zend2\Barcode\Object\Code25',
        'code25_interleaved' => 'Zend2\Barcode\Object\Code25interleaved',
        'code39'             => 'Zend2\Barcode\Object\Code39',
        'ean13'              => 'Zend2\Barcode\Object\Ean13',
        'ean2'               => 'Zend2\Barcode\Object\Ean2',
        'ean5'               => 'Zend2\Barcode\Object\Ean5',
        'ean8'               => 'Zend2\Barcode\Object\Ean8',
        'error'              => 'Zend2\Barcode\Object\Error',
        'identcode'          => 'Zend2\Barcode\Object\Identcode',
        'itf14'              => 'Zend2\Barcode\Object\Itf14',
        'leitcode'           => 'Zend2\Barcode\Object\Leitcode',
        'planet'             => 'Zend2\Barcode\Object\Planet',
        'postnet'            => 'Zend2\Barcode\Object\Postnet',
        'royalmail'          => 'Zend2\Barcode\Object\Royalmail',
        'upca'               => 'Zend2\Barcode\Object\Upca',
        'upce'               => 'Zend2\Barcode\Object\Upce',
    );
}
