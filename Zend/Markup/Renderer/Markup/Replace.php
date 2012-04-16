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
 * @package    Zend2_Markup
 * @subpackage Renderer_Markup_Html
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Markup\Renderer\Markup;
use Zend2\Markup\Token;

/**
 * Simple replace markup
 *
 * @uses       \Zend2\Markup\Renderer\Markup\AbstractMarkup
 * @uses       \Zend2\Markup\Token
 * @category   Zend2
 * @package    Zend2_Markup
 * @subpackage Renderer_Markup_Html
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Replace extends AbstractMarkup
{

    /**
     * Markup's start replacement
     *
     * @var string
     */
    protected $_start;

    /**
     * Markup's end replacement
     *
     * @var string
     */
    protected $_end;
    

    /**
     * Constructor
     *
     * @param string $start
     * @param string $end
     * 
     * @return void
     */
    public function __construct($start, $end)
    {
        $this->_start = $start;
        $this->_end   = $end;
    }

    /**
     * Invoke the markup on the token
     *
     * @param \Zend2\Markup\Token $token
     * @param string $text
     *
     * @return string
     */
    public function __invoke(Token $token, $text)
    {
        return $this->_start . $text . $this->_end;
    }
}
