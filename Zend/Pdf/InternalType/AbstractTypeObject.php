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
use Zend2\Pdf;

/**
 * PDF file element implementation
 *
 * @uses       \Zend2\Pdf\InternalType\ArrayObject
 * @uses       \Zend2\Pdf\InternalType\BooleanObject
 * @uses       \Zend2\Pdf\InternalType\DictionaryObject
 * @uses       \Zend2\Pdf\InternalType\NumericObject
 * @uses       \Zend2\Pdf\InternalType\StringObject
 * @package    Zend2_PDF
 * @subpackage Zend2_PDF_Internal
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class AbstractTypeObject
{
    const TYPE_BOOL        = 1;
    const TYPE_NUMERIC     = 2;
    const TYPE_STRING      = 3;
    const TYPE_NAME        = 4;
    const TYPE_ARRAY       = 5;
    const TYPE_DICTIONARY  = 6;
    const TYPE_STREAM      = 7;
    const TYPE_NULL        = 11;

    /**
     * Reference to the top level indirect object, which contains this element.
     *
     * @var \Zend2\Pdf\InternalType\IndirectObject
     */
    private $_parentObject = null;

    /**
     * Return type of the element.
     * See ZPDFPDFConst for possible values
     *
     * @return integer
     */
    abstract public function getType();

    /**
     * Convert element to a string, which can be directly
     * written to a PDF file.
     *
     * $factory parameter defines operation context.
     *
     * @param \Zend2\Pdf\ObjectFactory $factory
     * @return string
     */
    abstract public function toString(Pdf\ObjectFactory $factory = null);


    const CLONE_MODE_SKIP_PAGES    = 1; // Do not follow pages during deep copy process
    const CLONE_MODE_FORCE_CLONING = 2; // Force top level object cloning even it's already processed

    /**
     * Detach PDF object from the factory (if applicable), clone it and attach to new factory.
     *
     * @todo It's necessary to check if SplObjectStorage class works faster
     * (Needs PHP 5.3.x to attach object _with_ additional data to storage)
     *
     * @param \Zend2\Pdf\ObjectFactory $factory  The factory to attach
     * @param array &$processed List of already processed indirect objects, used to avoid objects duplication
     * @param integer $mode  Cloning mode (defines filter for objects cloning)
     * @returns \Zend2\Pdf\InternalType\AbstractTypeObject
     */
    public function makeClone(Pdf\ObjectFactory $factory, array &$processed, $mode)
    {
        return clone $this;
    }

    /**
     * Set top level parent indirect object.
     *
     * @param \Zend2\Pdf\InternalType\IndirectObject $parent
     */
    public function setParentObject(IndirectObject $parent)
    {
        $this->_parentObject = $parent;
    }


    /**
     * Get top level parent indirect object.
     *
     * @return \Zend2\Pdf\InternalType\IndirectObject
     */
    public function getParentObject()
    {
        return $this->_parentObject;
    }


    /**
     * Mark object as modified, to include it into new PDF file segment.
     *
     * We don't automate this action to keep control on PDF update process.
     * All new objects are treated as "modified" automatically.
     */
    public function touch()
    {
        if ($this->_parentObject !== null) {
            $this->_parentObject->touch();
        }
    }

    /**
     * Clean up resources, used by object
     */
    public function cleanUp()
    {
        // Do nothing
    }

    /**
     * Convert PDF element to PHP type.
     *
     * @return mixed
     */
    public function toPhp()
    {
        return $this->value;
    }

    /**
     * Convert PHP value into PDF element.
     *
     * @param mixed $input
     * @return \Zend2\Pdf\InternalType\AbstractTypeObject
     */
    public static function phpToPDF($input)
    {
        if (is_numeric($input)) {
            return new NumericObject($input);
        } else if (is_bool($input)) {
            return new BooleanObject($input);
        } else if (is_array($input)) {
            $pdfElementsArray = array();
            $isDictionary = false;

            foreach ($input as $key => $value) {
                if (is_string($key)) {
                    $isDictionary = true;
                }
                $pdfElementsArray[$key] = self::phpToPDF($value);
            }

            if ($isDictionary) {
                return new DictionaryObject($pdfElementsArray);
            } else {
                return new ArrayObject($pdfElementsArray);
            }
        } else {
            return new StringObject((string)$input);
        }
    }
}
