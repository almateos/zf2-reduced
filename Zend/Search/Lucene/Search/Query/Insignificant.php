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
 * @subpackage Search
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Search\Lucene\Search\Query;
use Zend2\Search\Lucene;
use Zend2\Search\Lucene\Search\Weight;
use Zend2\Search\Lucene\Search\Highlighter;

/**
 * The insignificant query returns empty result, but doesn't limit result set as a part of other queries
 *
 * @uses       \Zend2\Search\Lucene\Search\Query\AbstractQuery
 * @uses       \Zend2\Search\Lucene\Search\Weight\EmptyResultWeight
 * @category   Zend2
 * @package    Zend2_Search_Lucene
 * @subpackage Search
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Insignificant extends AbstractQuery
{
    /**
     * Re-write query into primitive queries in the context of specified index
     *
     * @param \Zend2\Search\Lucene\SearchIndex $index
     * @return \Zend2\Search\Lucene\Search\Query\AbstractQuery
     */
    public function rewrite(Lucene\SearchIndex $index)
    {
        return $this;
    }

    /**
     * Optimize query in the context of specified index
     *
     * @param \Zend2\Search\Lucene\SearchIndex $index
     * @return \Zend2\Search\Lucene\Search\Query\AbstractQuery
     */
    public function optimize(Lucene\SearchIndex $index)
    {
        return $this;
    }

    /**
     * Constructs an appropriate Weight implementation for this query.
     *
     * @param \Zend2\Search\Lucene\SearchIndex $reader
     * @return \Zend2\Search\Lucene\Search\Weight\Weight
     */
    public function createWeight(Lucene\SearchIndex $reader)
    {
        return new Weight\EmptyResultWeight();
    }

    /**
     * Execute query in context of index reader
     * It also initializes necessary internal structures
     *
     * @param \Zend2\Search\Lucene\SearchIndex $reader
     * @param \Zend2\Search\Lucene\Index\DocsFilter|null $docsFilter
     */
    public function execute(Lucene\SearchIndex $reader, $docsFilter = null)
    {
        // Do nothing
    }

    /**
     * Get document ids likely matching the query
     *
     * It's an array with document ids as keys (performance considerations)
     *
     * @return array
     */
    public function matchedDocs()
    {
        return array();
    }

    /**
     * Score specified document
     *
     * @param integer $docId
     * @param \Zend2\Search\Lucene\SearchIndex $reader
     * @return float
     */
    public function score($docId, Lucene\SearchIndex $reader)
    {
        return 0;
    }

    /**
     * Return query terms
     *
     * @return array
     */
    public function getQueryTerms()
    {
        return array();
    }

    /**
     * Query specific matches highlighting
     *
     * @param \Zend2\Search\Lucene\Search\Highlighter $highlighter  Highlighter object (also contains doc for highlighting)
     */
    protected function _highlightMatches(Highlighter $highlighter)
    {
        // Do nothing
    }

    /**
     * Print a query
     *
     * @return string
     */
    public function __toString()
    {
        return '<InsignificantQuery>';
    }
}
