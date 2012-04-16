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
 * Helper for rendering fieldsets
 *
 * @uses       \Zend2\View\Helper\FormElement
 * @package    Zend2_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Fieldset extends FormElement
{
    /**
     * Render HTML form
     *
     * @param  string $name Form name
     * @param  string $content Form content
     * @param  array $attribs HTML form attributes
     * @return string
     */
    public function __invoke($name = null, $content = null, $attribs = null)
    {
        $info   = $this->_getInfo($name, $content, $attribs);
        $escape = $id = null;
        extract($info);

        // get legend
        $escaper = $this->view->plugin('escape');
        $legend = '';
        if (isset($attribs['legend'])) {
            $legendString = trim($attribs['legend']);
            if (!empty($legendString)) {
                $legend = '<legend>'
                        . (($escape) ? $escaper($legendString) : $legendString)
                        . '</legend>' . PHP_EOL;
            }
            unset($attribs['legend']);
        }

        // get id
        if (!empty($id)) {
            $id = ' id="' . $escaper($id) . '"';
        } else {
            $id = '';
        }

        // render fieldset
        $xhtml = '<fieldset'
               . $id
               . $this->_htmlAttribs($attribs)
               . '>'
               . $legend
               . $content
               . '</fieldset>';

        return $xhtml;
    }
}
