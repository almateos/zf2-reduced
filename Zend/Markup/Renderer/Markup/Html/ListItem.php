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

namespace Zend2\Markup\Renderer\Markup\Html;
use Zend2\Markup;

/**
 * List item markup
 *
 * @uses       \Zend2\Markup\Renderer\Markup\Html\AbstractHtml
 * @uses       \Zend2\Markup\Token
 * @category   Zend2
 * @package    Zend2_Markup
 * @subpackage Renderer_Markup_Html
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class ListItem extends AbstractHtml
{

    /**
     * Convert the token
     *
     * @param \Zend2\Markup\Token $token
     * @param string $text
     *
     * @return string
     */
    public function __invoke(Markup\Token $token, $text)
    {
        $type = null;
        if ($token->hasAttribute('list')) {
            // because '01' == '1'
            if ($token->getAttribute('list') === '01') {
                $type = 'decimal-leading-zero';
            } else {
                switch ($token->getAttribute('list')) {
                    case '1':
                        $type = 'decimal';
                        break;
                    case 'i':
                        $type = 'lower-roman';
                        break;
                    case 'I':
                        $type = 'upper-roman';
                        break;
                    case 'a':
                        $type = 'lower-alpha';
                        break;
                    case 'A':
                        $type = 'upper-alpha';
                        break;

                    // the following type is unsupported by IE (including IE8)
                    case 'alpha':
                        $type = 'lower-greek';
                        break;

                    // the CSS names itself
                    case 'armenian': // unsupported by IE (including IE8)
                    case 'decimal':
                    case 'decimal-leading-zero': // unsupported by IE (including IE8)
                    case 'georgian': // unsupported by IE (including IE8)
                    case 'lower-alpha':
                    case 'lower-greek': // unsupported by IE (including IE8)
                    case 'lower-latin': // unsupported by IE (including IE8)
                    case 'lower-roman':
                    case 'upper-alpha':
                    case 'upper-latin': // unsupported by IE (including IE8)
                    case 'upper-roman':
                        $type = $token->getAttribute('list');
                        break;
                }
            }
        }

        if (null !== $type) {
            return "<ol style=\"list-style-type: {$type}\">{$text}</ol>";
        } else {
            return "<ul>{$text}</ul>";
        }
    }

}
