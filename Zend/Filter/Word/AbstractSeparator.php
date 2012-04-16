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

use Zend2\Filter\PregReplace as PregReplaceFilter;

/**
 * @uses       \Zend2\Filter\Exception
 * @uses       \Zend2\Filter\PregReplace
 * @category   Zend2
 * @package    Zend2_Filter
 * @uses       \Zend2\Filter\PregReplace
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class AbstractSeparator extends PregReplaceFilter
{

    protected $_separator = null;

    /**
     * Constructor
     *
     * @param  string $separator Space by default
     * @return void
     */
    public function __construct($separator = ' ')
    {
        $this->setSeparator($separator);
    }

    /**
     * Sets a new seperator
     *
     * @param  string  $separator  Seperator
     * @return $this
     */
    public function setSeparator($separator)
    {
        if ($separator == null) {
            throw new \Zend2\Filter\Exception\InvalidArgumentException('"' . $separator . '" is not a valid separator.');
        }
        $this->_separator = $separator;
        return $this;
    }

    /**
     * Returns the actual set seperator
     *
     * @return  string
     */
    public function getSeparator()
    {
        return $this->_separator;
    }
}
