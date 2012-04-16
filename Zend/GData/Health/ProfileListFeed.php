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
 * @package    Zend2_Gdata
 * @subpackage Health
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\GData\Health;

/**
 * Represents a Google Health user's Profile List Feed
 *
 * @link http://code.google.com/apis/health/
 *
 * @uses       \Zend2\GData\Feed
 * @category   Zend2
 * @package    Zend2_Gdata
 * @subpackage Health
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class ProfileListFeed extends \Zend2\GData\Feed
{
    /**
     * The class name for individual profile feed elements.
     *
     * @var string
     */
    protected $_entryClassName = '\Zend2\GData\Health\ProfileListEntry';

    public function getEntries()
    {
        return $this->entry;
    }
}
