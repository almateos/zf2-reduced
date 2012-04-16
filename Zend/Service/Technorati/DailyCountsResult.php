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
 * @package    Zend2_Service
 * @subpackage Technorati
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Service\Technorati;

use DomElement,
    Zend2\Date\Date as Zend2Date;

/**
 * Represents a single Technorati DailyCounts query result object.
 * It is never returned as a standalone object,
 * but it always belongs to a valid DailyCountsResultSet object.
 *
 * @category   Zend2
 * @package    Zend2_Service
 * @subpackage Technorati
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class DailyCountsResult extends Result
{
    /**
     * Date of count.
     *
     * @var     Zend2Date
     * @access  protected
     */
    protected $date;

    /**
     * Number of posts containing query on given date.
     *
     * @var     int
     * @access  protected
     */
    protected $count;


    /**
     * Constructs a new object object from DOM Document.
     *
     * @param   DomElement $dom the ReST fragment for this object
     */
    public function __construct(DomElement $dom)
    {
        $this->fields = array( 'date'   => 'date',
                               'count'  => 'count');
        parent::__construct($dom);

        // filter fields
        $this->date  = new Zend2Date(strtotime($this->date));
        $this->count = (int) $this->count;
    }

    /**
     * Returns the date of count.
     *
     * @return  Zend2Date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Returns the number of posts containing query on given date.
     *
     * @return  int
     */
    public function getCount()
    {
        return $this->count;
    }
}
