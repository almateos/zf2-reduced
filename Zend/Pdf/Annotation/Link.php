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
 * @subpackage Zend2_PDF_Annotation
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Pdf\Annotation;
use Zend2\Pdf\Exception;
use Zend2\Pdf;
use Zend2\Pdf\InternalStructure;
use Zend2\Pdf\InternalType;
use Zend2\Pdf\Destination;

/**
 * A link annotation represents either a hypertext link to a destination elsewhere in
 * the document or an action to be performed.
 *
 * Only destinations are used now since only GoTo action can be created by user
 * in current implementation.
 *
 * @uses       \Zend2\Pdf\Action\AbstractAction
 * @uses       \Zend2\Pdf\Annotation\AbstractAnnotation
 * @uses       \Zend2\Pdf\Destination\AbstractDestination
 * @uses       \Zend2\Pdf\Destination\Named
 * @uses       \Zend2\Pdf\InternalType\AbstractTypeObject
 * @uses       \Zend2\Pdf\InternalType\ArrayObject
 * @uses       \Zend2\Pdf\InternalType\DictionaryObject
 * @uses       \Zend2\Pdf\InternalType\NameObject
 * @uses       \Zend2\Pdf\InternalType\NumericObject
 * @uses       \Zend2\Pdf\Exception
 * @package    Zend2_PDF
 * @subpackage Zend2_PDF_Annotation
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Link extends AbstractAnnotation
{
    /**
     * Annotation object constructor
     *
     * @throws \Zend2\Pdf\Exception
     */
    public function __construct(InternalType\AbstractTypeObject $annotationDictionary)
    {
        if ($annotationDictionary->getType() != InternalType\AbstractTypeObject::TYPE_DICTIONARY) {
            throw new Exception\CorruptedPdfException('Annotation dictionary resource has to be a dictionary.');
        }

        if ($annotationDictionary->Subtype === null  ||
            $annotationDictionary->Subtype->getType() != InternalType\AbstractTypeObject::TYPE_NAME  ||
            $annotationDictionary->Subtype->value != 'Link') {
            throw new Exception\CorruptedPdfException('Subtype => Link entry is requires');
        }

        parent::__construct($annotationDictionary);
    }

    /**
     * Create link annotation object
     *
     * @param float $x1
     * @param float $y1
     * @param float $x2
     * @param float $y2
     * @param \Zend2\Pdf\InternalStructure\NavigationTarget|string $target
     * @return \Zend2\Pdf\Annotation\Link
     */
    public static function create($x1, $y1, $x2, $y2, $target)
    {
        if (is_string($target)) {
            $destination = Destination\Named::create($target);
        }
        if (!$target instanceof InternalStructure\NavigationTarget) {
            throw new Exception\InvalidArgumentException('$target parameter must be a \Zend2\Pdf\InternalStructure\NavigationTarget object or a string.');
        }

        $annotationDictionary = new InternalType\DictionaryObject();

        $annotationDictionary->Type    = new InternalType\NameObject('Annot');
        $annotationDictionary->Subtype = new InternalType\NameObject('Link');

        $rectangle = new InternalType\ArrayObject();
        $rectangle->items[] = new InternalType\NumericObject($x1);
        $rectangle->items[] = new InternalType\NumericObject($y1);
        $rectangle->items[] = new InternalType\NumericObject($x2);
        $rectangle->items[] = new InternalType\NumericObject($y2);
        $annotationDictionary->Rect = $rectangle;

        if ($target instanceof Destination\AbstractDestination) {
            $annotationDictionary->Dest = $target->getResource();
        } else {
            $annotationDictionary->A = $target->getResource();
        }

        return new self($annotationDictionary);
    }

    /**
     * Set link annotation destination
     *
     * @param \Zend2\Pdf\InternalStructure\NavigationTarget|string $target
     * @return \Zend2\Pdf\Annotation\Link
     */
    public function setDestination($target)
    {
        if (is_string($target)) {
            $destination = Destination\Named::create($target);
        }
        if (!$target instanceof InternalStructure\NavigationTarget) {
            throw new Exception\InvalidArgumentException('$target parameter must be a \Zend2\Pdf\InternalStructure\NavigationTarget object or a string.');
        }

        $this->_annotationDictionary->touch();
        $this->_annotationDictionary->Dest = $destination->getResource();
        if ($target instanceof Destination\AbstractDestination) {
            $this->_annotationDictionary->Dest = $target->getResource();
            $this->_annotationDictionary->A    = null;
        } else {
            $this->_annotationDictionary->Dest = null;
            $this->_annotationDictionary->A    = $target->getResource();
        }

        return $this;
    }

    /**
     * Get link annotation destination
     *
     * @return \Zend2\Pdf\InternalStructure\NavigationTarget|null
     */
    public function getDestination()
    {
        if ($this->_annotationDictionary->Dest === null  &&
            $this->_annotationDictionary->A    === null) {
            return null;
        }

        if ($this->_annotationDictionary->Dest !== null) {
            return Destination\AbstractDestination::load($this->_annotationDictionary->Dest);
        } else {
            return Pdf\Action\AbstractAction::load($this->_annotationDictionary->A);
        }
    }
}
