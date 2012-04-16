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
 * @package    Zend2_Search_Lucene
 * @subpackage Document
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Search\Lucene;

use Zend2\Search\Lucene\Exception\InvalidArgumentException;

/**
 * A Document is a set of fields. Each field has a name and a textual value.
 *
 * @uses       \Zend2\Search\Lucene\Exception\InvalidArgumentException
 * @uses       \Zend2\Search\Lucene\Document\Field
 * @category   Zend2
 * @package    Zend2_Search_Lucene
 * @subpackage Document
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Document
{

    /**
     * Associative array \Zend2\Search\Lucene\Document\Field objects where the keys to the
     * array are the names of the fields.
     *
     * @var array
     */
    protected $_fields = array();

    /**
     * Field boost factor
     * It's not stored directly in the index, but affects on normalization factor
     *
     * @var float
     */
    public $boost = 1.0;
    
    /**
     * Magic method for checking the existence of a field
     *
     * @param string $offset
     * @return boolean TRUE if the field exists else FALSE
     */
    public function __isset($offset)
    {
        return in_array($offset, $this->getFieldNames());
    }

    /**
     * Proxy method for getFieldValue(), provides more convenient access to
     * the string value of a field.
     *
     * @param  $offset
     * @return string
     */
    public function __get($offset)
    {
        return $this->getFieldValue($offset);
    }


    /**
     * Add a field object to this document.
     *
     * @param \Zend2\Search\Lucene\Document\Field $field
     * @return \Zend2\Search\Lucene\Document
     */
    public function addField(Document\Field $field)
    {
        $this->_fields[$field->name] = $field;

        return $this;
    }


    /**
     * Return an array with the names of the fields in this document.
     *
     * @return array
     */
    public function getFieldNames()
    {
        return array_keys($this->_fields);
    }


    /**
     * Returns {@link \Zend2\Search\Lucene\Document\Field} object for a named field in this document.
     *
     * @param string $fieldName
     * @throws \Zend2\Search\Lucene\Exception\InvalidArgumentException
     * @return \Zend2\Search\Lucene\Document\Field
     */
    public function getField($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_fields)) {
            throw new InvalidArgumentException("Field name \"$fieldName\" not found in document.");
        }
        return $this->_fields[$fieldName];
    }


    /**
     * Returns the string value of a named field in this document.
     *
     * @see __get()
     * @return string
     */
    public function getFieldValue($fieldName)
    {
        return $this->getField($fieldName)->value;
    }

    /**
     * Returns the string value of a named field in UTF-8 encoding.
     *
     * @see __get()
     * @return string
     */
    public function getFieldUtf8Value($fieldName)
    {
        return $this->getField($fieldName)->getUtf8Value();
    }
}
