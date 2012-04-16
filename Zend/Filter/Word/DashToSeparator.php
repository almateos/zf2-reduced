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
 * @package    Zend2_Filter
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Filter\Word;

/**
 * @uses       \Zend2\Filter\Word\Separator\AbstractSeparator
 * @category   Zend2
 * @package    Zend2_Filter
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class DashToSeparator extends AbstractSeparator
{
    /**
     * Defined by Zend2\Filter\Filter
     * 
     * @param  string $value 
     * @return string
     */
    public function filter($value)
    {
        $this->setMatchPattern('#-#');
        $this->setReplacement($this->_separator);
        return parent::filter($value);
    }
}
