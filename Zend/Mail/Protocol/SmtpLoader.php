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
 * @package    Zend2_Mail
 * @subpackage Protocol
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Mail\Protocol;

use Zend2\Loader\PluginClassLoader;

/**
 * Plugin Class Loader implementation for SMTP protocol authentication extensions.
 *
 * @category   Zend2
 * @package    Zend2_Mail
 * @subpackage Protocol
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class SmtpLoader extends PluginClassLoader
{
    /**
     * @var array Pre-aliased authentication plugins
     */
    protected $plugins = array(
        'crammd5'          => 'Zend2\Mail\Protocol\Smtp\Auth\Crammd5',
        'login'            => 'Zend2\Mail\Protocol\Smtp\Auth\Login',
        'plain'            => 'Zend2\Mail\Protocol\Smtp\Auth\Plain',
        'smtp'             => 'Zend2\Mail\Protocol\Smtp',
    );
}
