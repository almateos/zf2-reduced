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
 * @package    Zend2_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\View\Helper;

/**
 * Helper for setting and retrieving script elements for inclusion in HTML body
 * section
 *
 * @uses       Zend2_View_Helper_Head_Script
 * @package    Zend2_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class InlineScript extends HeadScript
{
    /**
     * Registry key for placeholder
     * @var string
     */
    protected $_regKey = 'Zend2_View_Helper_InlineScript';

    /**
     * Return InlineScript object
     *
     * Returns InlineScript helper object; optionally, allows specifying a
     * script or script file to include.
     *
     * @param  string $mode Script or file
     * @param  string $spec Script/url
     * @param  string $placement Append, prepend, or set
     * @param  array $attrs Array of script attributes
     * @param  string $type Script type and/or array of script attributes
     * @return \Zend2\View\Helper\InlineScript
     */
    public function __invoke($mode = HeadScript::FILE, $spec = null, $placement = 'APPEND', array $attrs = array(), $type = 'text/javascript')
    {
        return parent::__invoke($mode, $spec, $placement, $attrs, $type);
    }
}
