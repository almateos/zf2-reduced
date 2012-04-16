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
 * PDF file 'null' element implementation
 *
 * @uses       \Zend2\Pdf\InternalType\AbstractTypeObject
 * @category   Zend2
 * @package    Zend2_PDF
 * @subpackage Zend2_PDF_Internal
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class NullObject extends AbstractTypeObject
{
    /**
     * Object value. Always null.
     *
     * @var mixed
     */
    public $value;


    /**
     * Object constructor
     */
    public function __construct()
    {
        $this->value = null;
    }


    /**
     * Return type of the element.
     *
     * @return integer
     */
    public function getType()
    {
        return AbstractTypeObject::TYPE_NULL;
    }


    /**
     * Return object as string
     *
     * @param \Zend2\Pdf\ObjectFactory $factory
     * @return string
     */
    public function toString(Pdf\ObjectFactory $factory = null)
    {
        return 'null';
    }
}
