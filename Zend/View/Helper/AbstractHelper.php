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

use Zend2\View\Helper;

/**
 * @uses       \Zend2\View\Helper
 * @category   Zend2
 * @package    Zend2_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class AbstractHelper implements Helper
{
    /**
     * View object
     *
     * @var \Zend2\View\Renderer
     */
    protected $view = null;

    /**
     * Set the View object
     *
     * @param  \Zend2\View\Renderer $view
     * @return \Zend2\View\Helper\AbstractHelper
     */
    public function setView(\Zend2\View\Renderer $view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     * Get the view object
     * 
     * @return null|AbstractHelper
     */
    public function getView()
    {
        return $this->view;
    }
}
