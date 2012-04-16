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
 * @subpackage Zend2_PDF_Destination
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Pdf\Destination;
use Zend2\Pdf\Exception;
use Zend2\Pdf\InternalType;
use Zend2\Pdf;

/**
 * \Zend2\Pdf\Destination\FitBoundingBoxVertically explicit detination
 *
 * Destination array: [page /FitBV left]
 *
 * (PDF 1.1) Display the page designated by page, with the horizontal coordinate
 * left positioned at the left edge of the window and the contents of the page
 * magnified just enough to fit the entire height of its bounding box within the
 * window.
 *
 * @uses       \Zend2\Pdf\Destination\Explicit
 * @uses       \Zend2\Pdf\InternalType\ArrayObject
 * @uses       \Zend2\Pdf\InternalType\NameObject
 * @uses       \Zend2\Pdf\InternalType\NumericObject
 * @uses       \Zend2\Pdf\Exception
 * @package    Zend2_PDF
 * @subpackage Zend2_PDF_Destination
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class FitBoundingBoxVertically extends Explicit
{
    /**
     * Create destination object
     *
     * @param \Zend2\Pdf\Page|integer $page  Page object or page number
     * @param float $left  Left edge of displayed page
     * @return \Zend2\Pdf\Destination\FitBoundingBoxVertically
     * @throws \Zend2\Pdf\Exception
     */
    public static function create($page, $left)
    {
        $destinationArray = new InternalType\ArrayObject();

        if ($page instanceof Pdf\Page) {
            $destinationArray->items[] = $page->getPageDictionary();
        } else if (is_integer($page)) {
            $destinationArray->items[] = new InternalType\NumericObject($page);
        } else {
            throw new Exception\InvalidArgumentException('$page parametr must be a \Zend2\Pdf\Page object or a page number.');
        }

        $destinationArray->items[] = new InternalType\NameObject('FitBV');
        $destinationArray->items[] = new InternalType\NumericObject($left);

        return new self($destinationArray);
    }

    /**
     * Get left edge of the displayed page
     *
     * @return float
     */
    public function getLeftEdge()
    {
        return $this->_destinationArray->items[2]->value;
    }

    /**
     * Set left edge of the displayed page
     *
     * @param float $left
     * @return \Zend2\Pdf\Action\FitBoundingBoxVertically
     */
    public function setLeftEdge($left)
    {
        $this->_destinationArray->items[2] = new InternalType\NumericObject($left);
        return $this;
    }
}
