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
 * @subpackage Filter
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Log\Filter;

use Zend2\Log\Exception,
    Zend2\Log\Filter,
    Zend2\Validator\Validator as Zend2Validator;

/**
 * @category   Zend2
 * @package    Zend2_Log
 * @subpackage Filter
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Validator implements Filter
{
    /**
     * Regex to match
     *
     * @var Zend2Validator
     */
    protected $validator;

    /**
     * Filter out any log messages not matching the validator
     *
     * @param  Zend2Validator $validator
     * @throws Exception\InvalidArgumentException
     */
    public function __construct($validator)
    {
        if (!$validator instanceof Zend2Validator) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Expected Zend2\Validator object'
            ));
        }
        $this->validator = $validator;
    }

    /**
     * Returns TRUE to accept the message, FALSE to block it.
     *
     * @param array $event event data
     * @return boolean 
     */
    public function filter(array $event)
    {
        return $this->validator->isValid($event['message']);
    }
}
