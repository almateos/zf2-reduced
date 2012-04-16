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
 * Abstract PDF destination representation class
 *
 * @uses       \Zend2\Pdf\Destination\Fit
 * @uses       \Zend2\Pdf\Destination\FitBoundingBox
 * @uses       \Zend2\Pdf\Destination\FitBoundingBoxHorizontally
 * @uses       \Zend2\Pdf\Destination\FitBoundingBoxVertically
 * @uses       \Zend2\Pdf\Destination\FitHorizontally
 * @uses       \Zend2\Pdf\Destination\FitRectangle
 * @uses       \Zend2\Pdf\Destination\FitVertically
 * @uses       \Zend2\Pdf\Destination\Named
 * @uses       \Zend2\Pdf\Destination\Unknown
 * @uses       \Zend2\Pdf\Destination\Zoom
 * @uses       \Zend2\Pdf\InternalType\AbstractTypeObject
 * @uses       \Zend2\Pdf\Exception
 * @uses       \Zend2\Pdf\InternalStructure\NavigationTarget
 * @package    Zend2_PDF
 * @subpackage Zend2_PDF_Destination
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class AbstractDestination extends Pdf\InternalStructure\NavigationTarget
{
    /**
     * Load Destination object from a specified resource
     *
     * @internal
     * @param $destinationArray
     * @return \Zend2\Pdf\Destination\AbstractDestination
     */
    public static function load(InternalType\AbstractTypeObject $resource)
    {
        if ($resource->getType() == InternalType\AbstractTypeObject::TYPE_NAME  ||  $resource->getType() == InternalType\AbstractTypeObject::TYPE_STRING) {
            return new Named($resource);
        }

        if ($resource->getType() != InternalType\AbstractTypeObject::TYPE_ARRAY) {
            throw new Exception\CorruptedPdfException('An explicit destination must be a direct or an indirect array object.');
        }
        if (count($resource->items) < 2) {
            throw new Exception\CorruptedPdfException('An explicit destination array must contain at least two elements.');
        }

        switch ($resource->items[1]->value) {
            case 'XYZ':
                return new Zoom($resource);
                break;

            case 'Fit':
                return new Fit($resource);
                break;

            case 'FitH':
                return new FitHorizontally($resource);
                break;

            case 'FitV':
                return new FitVertically($resource);
                break;

            case 'FitR':
                return new FitRectangle($resource);
                break;

            case 'FitB':
                return new FitBoundingBox($resource);
                break;

            case 'FitBH':
                return new FitBoundingBoxHorizontally($resource);
                break;

            case 'FitBV':
                return new FitBoundingBoxVertically($resource);
                break;

            default:
                return new Unknown($resource);
                break;
        }
    }
}
