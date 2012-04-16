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
    Zend2\Config\Exception,
    Zend2\Filter\Filter as Zend2Filter,
    \Traversable,
    \ArrayObject;

/**
 * @category   Zend2
 * @package    Zend2_Config
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Filter implements Processor
{
    /**
     * @var \Zend2\Filter\Filter
     */
    protected $filter;

    /**
     * Filter all config values using the supplied Zend2\Filter
     *
     * @param \Zend2\Filter\Filter $filter
     * @return \Zend2\Config\Processor\Filter
     */
    public function __construct(Zend2Filter $filter)
    {
        $this->setFilter($filter);
    }

    /**
     * @return \Zend2\Filter\Filter
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param \Zend2\Filter\Filter $filter
     */
    public function setFilter(Zend2Filter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * Process
     * 
     * @param  Config $config
     * @return Config 
     */
    public function process(Config $config)
    {
        if ($config->isReadOnly()) {
            throw new Exception\InvalidArgumentException('Cannot parse config because it is read-only');
        }

        /**
         * Walk through config and replace values
         */
        foreach ($config as $key => $val) {
            if ($val instanceof Config) {
                $this->process($val);
            } else {
                $config->$key = $this->filter->filter($val);
            }
        }

        return $config;
    }

    /**
     * Process a single value
     *
     * @param $value
     * @return mixed
     */
    public function processValue($value)
    {
        return $this->filter->filter($value);
    }
}
