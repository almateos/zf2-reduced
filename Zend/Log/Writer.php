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
 * @package    Zend2_Log
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Log;

/**
 * @category   Zend2
 * @package    Zend2_Log
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
interface Writer
{
    /**
     * Add a log filter to the writer
     *
     * @param  int|Filter $filter
     * @return Writer
     */
    public function addFilter($filter);

    /**
     * Set a message formatter for the writer
     *
     * @param Formatter $formatter
     * @return Writer
     */
    public function setFormatter(Formatter $formatter);

    /**
     * Write a log message
     *
     * @param  array $event
     * @return Writer
     */
    public function write(array $event);

    /**
     * Perform shutdown activities
     *
     * @return void
     */
    public function shutdown();
}
