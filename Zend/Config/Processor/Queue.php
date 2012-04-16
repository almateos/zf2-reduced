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
 * @package    Zend2_Config
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Config\Processor;

use Zend2\Config\Config,
    Zend2\Config\Processor,
    Zend2\Config\Exception\InvalidArgumentException,
    Zend2\Stdlib\PriorityQueue;

/**
 * @category   Zend2
 * @package    Zend2_Config
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Queue extends PriorityQueue implements Processor
{
    /**
     * Process the whole config structure with each parser in the queue.
     *
     * @param \Zend2\Config\Config $config
     * @throws \Zend2\Config\Exception\InvalidArgumentException
     */
    public function process(Config $config)
    {
        if ($config->isReadOnly()) {
            throw new InvalidArgumentException('Cannot parse config because it is read-only');
        }

        foreach ($this as $parser) {
            /** @var $parser \Zend2\Config\Processor */
            $parser->process($config);
        }
    }

    /**
     * Process a single value
     *
     * @param $value
     * @return mixed
     */
    public function processValue($value)
    {
        foreach ($this as $parser) {
            /** @var $parser \Zend2\Config\Processor */
            $value = $parser->processValue($value);
        }

        return $value;
    }
}
