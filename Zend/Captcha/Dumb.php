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
 * @package    Zend2_Captcha
 * @subpackage Adapter
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Captcha;

/**
 * Example dumb word-based captcha
 *
 * Note that only rendering is necessary for word-based captcha
 *
 * @uses       Zend2\Captcha\Word
 * @category   Zend2
 * @package    Zend2_Captcha
 * @subpackage Adapter
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
*/
class Dumb extends Word
{
    /**
     * Render the captcha
     *
     * @param  \Zend2\View\Renderer $view
     * @param  mixed $element
     * @return string
     */
    public function render(\Zend2\View\Renderer $view = null, $element = null)
    {
        return 'Please type this word backwards: <b>'
             . strrev($this->getWord())
             . '</b>';
    }
}
