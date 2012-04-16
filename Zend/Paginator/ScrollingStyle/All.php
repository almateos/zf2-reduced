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

namespace Zend2\Paginator\ScrollingStyle;

use Zend2\Paginator\ScrollingStyle;

/**
 * A scrolling style that returns every page in the collection.
 * Useful when it is necessary to make every page available at
 * once--for example, when using a dropdown menu pagination control.
 *
 * @uses       \Zend2\Paginator\ScrollingStyle
 * @category   Zend2
 * @package    Zend2_Paginator
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class All implements ScrollingStyle
{
    /**
     * Returns an array of all pages given a page number and range.
     *
     * @param  \Zend2\Paginator\Paginator $paginator
     * @param  integer $pageRange Unused
     * @return array
     */
    public function getPages(\Zend2\Paginator\Paginator $paginator, $pageRange = null)
    {
        return $paginator->getPagesInRange(1, $paginator->count());
    }
}
