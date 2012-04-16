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
 * @subpackage Zend2_PDF_Internal
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Pdf\InternalType;
use Zend2\Pdf\Exception;
use Zend2\Pdf;

/**
 * PDF file 'array' element implementation
 *
 * @uses       ArrayObject
 * @uses       \Zend2\Pdf\InternalType\AbstractTypeObject
 * @uses       \Zend2\Pdf\Exception
 * @category   Zend2
 * @package    Zend2_PDF
 * @subpackage Zend2_PDF_Internal
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class ArrayObject extends AbstractTypeObject
{
    /**
     * Array element items
     *
     * Array of \Zend2\Pdf\InternalType\AbstractTypeObject objects
     *
     * @var array
     */
    public $items;


    /**
     * Object constructor
     *
     * @param array $val   - array of \Zend2\Pdf\InternalType\AbstractTypeObject objects
     * @throws \Zend2\Pdf\Exception
     */
    public function __construct($val = null)
    {
        $this->items = new \ArrayObject();

        if ($val !== null  &&  is_array($val)) {
            foreach ($val as $element) {
                if (!$element instanceof AbstractTypeObject) {
                    throw new Exception\RuntimeException('Array elements must be \Zend2\Pdf\InternalType\AbstractTypeObject objects');
                }
                $this->items[] = $element;
            }
        } else if ($val !== null){
            throw new Exception\RuntimeException('Argument must be an array');
        }
    }


    /**
     * Getter
     *
     * @param string $property
     * @throws \Zend2\Pdf\Exception
     */
    public function __get($property)
    {
        throw new Exception\RuntimeException('Undefined property: \Zend2\Pdf\InternalType\ArrayObject::$' . $property);
    }


    /**
     * Setter
     *
     * @param mixed $offset
     * @param mixed $value
     * @throws \Zend2\Pdf\Exception
     */
    public function __set($property, $value)
    {
        throw new Exception\RuntimeException('Undefined property: \Zend2\Pdf\InternalType\ArrayObject::$' . $property);
    }

    /**
     * Return type of the element.
     *
     * @return integer
     */
    public function getType()
    {
        return AbstractTypeObject::TYPE_ARRAY;
    }


    /**
     * Return object as string
     *
     * @param \Zend2\Pdf\ObjectFactory $factory
     * @return string
     */
    public function toString(Pdf\ObjectFactory $factory = null)
    {
        $outStr = '[';
        $lastNL = 0;

        foreach ($this->items as $element) {
            if (strlen($outStr) - $lastNL > 128)  {
                $outStr .= "\n";
                $lastNL = strlen($outStr);
            }

            $outStr .= $element->toString($factory) . ' ';
        }
        $outStr .= ']';

        return $outStr;
    }

    /**
     * Detach PDF object from the factory (if applicable), clone it and attach to new factory.
     *
     * @param \Zend2\Pdf\ObjectFactory $factory  The factory to attach
     * @param array &$processed List of already processed indirect objects, used to avoid objects duplication
     * @param integer $mode  Cloning mode (defines filter for objects cloning)
     * @returns \Zend2\Pdf\InternalType\AbstractTypeObject
     */
    public function makeClone(Pdf\ObjectFactory $factory, array &$processed, $mode)
    {
        $newArray = new self();

        foreach ($this->items as $key => $value) {
            $newArray->items[$key] = $value->makeClone($factory, $processed, $mode);
        }

        return $newArray;
    }

    /**
     * Set top level parent indirect object.
     *
     * @param \Zend2\Pdf\InternalType\IndirectObject $parent
     */
    public function setParentObject(IndirectObject $parent)
    {
        parent::setParentObject($parent);

        foreach ($this->items as $item) {
            $item->setParentObject($parent);
        }
    }

    /**
     * Convert PDF element to PHP type.
     *
     * Dictionary is returned as an associative array
     *
     * @return mixed
     */
    public function toPhp()
    {
        $phpArray = array();

        foreach ($this->items as $item) {
            $phpArray[] = $item->toPhp();
        }

        return $phpArray;
    }
}
