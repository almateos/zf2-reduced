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
 * @package    Zend2_Tag
 * @subpackage Cloud
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Tag\Cloud;

use Zend2\Loader\PluginClassLoader;

/**
 * Plugin Class Loader implementation for decorators.
 *
 * @category   Zend2
 * @package    Zend2_Tag
 * @subpackage Cloud
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class DecoratorLoader extends PluginClassLoader
{
    /**
     * @var array Pre-aliased decorators 
     */
    protected $plugins = array(
        'html_cloud' => 'Zend2\Tag\Cloud\Decorator\HtmlCloud',
        'htmlcloud'  => 'Zend2\Tag\Cloud\Decorator\HtmlCloud',
        'html_tag'   => 'Zend2\Tag\Cloud\Decorator\HtmlTag',
        'htmltag'    => 'Zend2\Tag\Cloud\Decorator\HtmlTag',
        'tag'        => 'Zend2\Tag\Cloud\Decorator\Tag',
    );
}
