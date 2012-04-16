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
 * @package    Zend2_Json
 * @subpackage Expr
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Json;

/**
 * Class for Zend2_Json encode method.
 *
 * This class simply holds a string with a native Javascript Expression,
 * so objects | arrays to be encoded with Zend2_Json can contain native
 * Javascript Expressions.
 *
 * Example:
 * <code>
 * $foo = array(
 *     'integer'  =>9,
 *     'string'   =>'test string',
 *     'function' => Zend2_Json_Expr(
 *         'function(){ window.alert("javascript function encoded by Zend2_Json") }'
 *     ),
 * );
 *
 * Zend2_Json::encode($foo, false, array('enableJsonExprFinder' => true));
 * // it will returns json encoded string:
 * // {"integer":9,"string":"test string","function":function(){window.alert("javascript function encoded by Zend2_Json")}}
 * </code>
 *
 * @category   Zend2
 * @package    Zend2_Json
 * @subpackage Expr
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Expr
{
    /**
     * Storage for javascript expression.
     *
     * @var string
     */
    protected $_expression;

    /**
     * Constructor
     *
     * @param  string $expression the expression to hold.
     * @return void
     */
    public function __construct($expression)
    {
        $this->_expression = (string) $expression;
    }

    /**
     * Cast to string
     *
     * @return string holded javascript expression.
     */
    public function __toString()
    {
        return $this->_expression;
    }
}
