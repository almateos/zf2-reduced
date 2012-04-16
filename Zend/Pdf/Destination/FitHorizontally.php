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
 * \Zend2\Pdf\Destination\FitHorizontally explicit detination
 *
 * Destination array: [page /FitH top]
 *
 * Display the page designated by page, with the vertical coordinate top positioned
 * at the top edge of the window and the contents of the page magnified
 * just enough to fit the entire width of the page within the window.
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
class FitHorizontally extends Explicit
{
    /**
     * Create destination object
     *
     * @param \Zend2\Pdf\Page|integer $page  Page object or page number
     * @param float $top  Top edge of displayed page
     * @return \Zend2\Pdf\Destination\FitHorizontally
     * @throws \Zend2\Pdf\Exception
     */
    public static function create($page, $top)
    {
        $destinationArray = new InternalType\ArrayObject();

        if ($page instanceof Pdf\Page) {
            $destinationArray->items[] = $page->getPageDictionary();
        } else if (is_integer($page)) {
            $destinationArray->items[] = new InternalType\NumericObject($page);
        } else {
            throw new Exception\InvalidArgumentException('$page parametr must be a \Zend2\Pdf\Page object or a page number.');
        }

        $destinationArray->items[] = new InternalType\NameObject('FitH');
        $destinationArray->items[] = new InternalType\NumericObject($top);

        return new self($destinationArray);
    }

    /**
     * Get top edge of the displayed page
     *
     * @return float
     */
    public function getTopEdge()
    {
        return $this->_destinationArray->items[2]->value;
    }

    /**
     * Set top edge of the displayed page
     *
     * @param float $top
     * @return \Zend2\Pdf\Action\FitHorizontally
     */
    public function setTopEdge($top)
    {
        $this->_destinationArray->items[2] = new InternalType\NumericObject($top);

        return $this;
    }
}
