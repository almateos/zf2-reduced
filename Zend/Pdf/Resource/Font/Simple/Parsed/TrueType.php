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
 * @subpackage Zend2_PDF_Fonts
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Pdf\Resource\Font\Simple\Parsed;
use Zend2\Pdf;
use Zend2\Pdf\InternalType;
use Zend2\Pdf\Resource\Font as FontResource;
use Zend2\Pdf\BinaryParser\Font\OpenType as OpenTypeFontParser;

/**
 * TrueType fonts implementation
 *
 * Font objects should be normally be obtained from the factory methods
 * {@link \Zend2\Pdf\Font::fontWithName} and {@link \Zend2\Pdf\Font::fontWithPath}.
 *
 * @uses       \Zend2\Pdf\InternalType
 * @uses       \Zend2\Pdf\Font
 * @uses       \Zend2\Pdf\Resource\Font\FontDescriptor
 * @uses       \Zend2\Pdf\Resource\Font\Simple\Parsed\AbstractParsed
 * @package    Zend2_PDF
 * @subpackage Zend2_PDF_Fonts
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class TrueType extends AbstractParsed
{
    /**
     * Object constructor
     *
     * @param \Zend2\Pdf\BinaryParser\Font\OpenType\TrueType $fontParser Font parser
     *   object containing parsed TrueType file.
     * @param integer $embeddingOptions Options for font embedding.
     * @throws \Zend2\Pdf\Exception
     */
    public function __construct(OpenTypeFontParser\TrueType $fontParser, $embeddingOptions)
    {
        parent::__construct($fontParser, $embeddingOptions);

        $this->_fontType = Pdf\Font::TYPE_TRUETYPE;

        $this->_resource->Subtype  = new InternalType\NameObject('TrueType');

        $fontDescriptor = FontResource\FontDescriptor::factory($this, $fontParser, $embeddingOptions);
        $this->_resource->FontDescriptor = $this->_objectFactory->newObject($fontDescriptor);
    }
}
