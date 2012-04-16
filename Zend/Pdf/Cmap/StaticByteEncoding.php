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
 * @package    Zend2_PDF
 * @subpackage Zend2_PDF_Font
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Pdf\Cmap;
use Zend2\Pdf\Exception;
use Zend2\Pdf;

/**
 * Custom cmap type used for the Adobe Standard 14 PDF fonts.
 *
 * Just like {@link \Zend2\Pdf\Cmap\ByteEncoding} except that the constructor
 * takes a predefined array of glyph numbers and can cover any Unicode character.
 *
 * @uses       \Zend2\Pdf\Cmap\ByteEncoding
 * @uses       \Zend2\Pdf\Exception
 * @package    Zend2_PDF
 * @subpackage Zend2_PDF_Font
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class StaticByteEncoding extends ByteEncoding
{
    /**** Public Interface ****/


    /* Object Lifecycle */

    /**
     * Object constructor
     *
     * @param array $cmapData Array whose keys are Unicode character codes and
     *   values are glyph numbers.
     * @throws \Zend2\Pdf\Exception
     */
    public function __construct($cmapData)
    {
        if (! is_array($cmapData)) {
            throw new Exception\CorruptedFontException('Constructor parameter must be an array');
        }
        $this->_glyphIndexArray = $cmapData;
    }

}
