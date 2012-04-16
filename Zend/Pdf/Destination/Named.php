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
 * Destination array: [page /Fit]
 *
 * Display the page designated by page, with its contents magnified just enough
 * to fit the entire page within the window both horizontally and vertically. If
 * the required horizontal and vertical magnification factors are different, use
 * the smaller of the two, centering the page within the window in the other
 * dimension.
 *
 * @uses       \Zend2\Pdf\Destination\AbstractDestination
 * @uses       \Zend2\Pdf\InternalType\AbstractTypeObject
 * @uses       \Zend2\Pdf\InternalType\StringObject
 * @uses       \Zend2\Pdf\Exception
 * @package    Zend2_PDF
 * @subpackage Zend2_PDF_Destination
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Named extends AbstractDestination
{
    /**
     * Destination name
     *
     * @var \Zend2\Pdf\InternalType\NameObject|\Zend2\Pdf\InternalType\StringObject
     */
    protected $_nameElement;

    /**
     * Named destination object constructor
     *
     * @param $resource
     * @throws \Zend2\Pdf\Exception
     */
    public function __construct(InternalType\AbstractTypeObject $resource)
    {
        if ($resource->getType() != InternalType\AbstractTypeObject::TYPE_NAME  &&  $resource->getType() != InternalType\AbstractTypeObject::TYPE_STRING) {
            throw new Exception\CorruptedPdfException('Named destination resource must be a PDF name or a PDF string.');
        }

        $this->_nameElement = $resource;
    }

    /**
     * Create named destination object
     *
     * @param string $name
     * @return \Zend2\Pdf\Destination\Named
     */
    public static function create($name)
    {
        return new self(new InternalType\StringObject($name));
    }

    /**
     * Get name
     *
     * @return \Zend2\Pdf\InternalType\AbstractTypeObject
     */
    public function getName()
    {
        return $this->_nameElement->value;
    }

    /**
     * Get resource
     *
     * @internal
     * @return \Zend2\Pdf\InternalType\AbstractTypeObject
     */
    public function getResource()
    {
        return $this->_nameElement;
    }
}
