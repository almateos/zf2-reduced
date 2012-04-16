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
 * @package    Zend2_Wildfire
 * @subpackage Plugin
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Wildfire\Plugin\FirePhp;

use Zend2\Wildfire\Plugin\FirePhp,
    Zend2\Wildfire\Plugin\Exception,
    Zend2\Wildfire;

/**
 * A message envelope that can be updated for the duration of the requet before
 * it gets flushed at the end of the request.
 *
 * @uses       \Zend2\Wildfire\Exception
 * @uses       \Zend2\Wildfire\Plugin\FirePhp
 * @uses       \Zend2\Wildfire\Plugin\FirePhp\Message
 * @category   Zend2
 * @package    Zend2_Wildfire
 * @subpackage Plugin
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class TableMessage extends Message
{
    /**
     * The header of the table containing all columns
     * @var array
     */
    protected $_header = null;

    /**
     * The rows of the table
     * $var array
     */
    protected $_rows = array();

    /**
     * Constructor
     *
     * @param string $label The label of the table
     */
    public function __construct($label)
    {
        parent::__construct(FirePhp::TABLE, null);
        $this->setLabel($label);
    }

    /**
     * Set the table header
     *
     * @param array $header The header columns
     * @return void
     */
    public function setHeader($header)
    {
        $this->_header = $header;
    }

    /**
     * Append a row to the end of the table.
     *
     * @param array $row An array of column values representing a row.
     * @return void
     */
    public function addRow($row)
    {
        $this->_rows[] = $row;
    }

    /**
     * Get the actual message to be sent in its final format.
     *
     * @return mixed Returns the message to be sent.
     */
    public function getMessage()
    {
        $table = $this->_rows;
        if($this->_header) {
            array_unshift($table,$this->_header);
        }
        return $table;
    }

    /**
     * Returns the row at the given index
     *
     * @param integer $index The index of the row
     * @return array Returns the row
     * @throws \Zend2\Wildfire\Exception
     */
    public function getRowAt($index)
    {
        $count = $this->getRowCount();

        if($index < 0 || $index > $count-1) {
            throw new Exception\OutOfBoundsException('Row index('.$index.') out of bounds('.$count.')!');
        }

        return $this->_rows[$index];
    }

    /**
     * Sets the row on the given index to a new row
     *
     * @param integer $index The index of the row
     * @param array $row The new data for the row
     * @throws \Zend2\Wildfire\Exception
     */
    public function setRowAt($index, $row)
    {
        $count = $this->getRowCount();

        if($index < 0 || $index > $count-1) {
            throw new Exception\OutOfBoundsException('Row index('.$index.') out of bounds('.$count.')!');
        }

        $this->_rows[$index] = $row;
    }

    /**
     * Returns the number of rows
     *
     * @return integer
     */
    public function getRowCount()
    {
        return count($this->_rows);
    }

    /**
     * Returns the last row of the table
     *
     * @return array Returns the last row
     * @throws \Zend2\Wildfire\Exception
     */
    public function getLastRow()
    {
        $count = $this->getRowCount();

        if($count==0) {
            throw new Exception\OutOfBoundsException('Cannot get last row as no rows exist!');
        }

        return $this->_rows[$count-1];
    }
}
