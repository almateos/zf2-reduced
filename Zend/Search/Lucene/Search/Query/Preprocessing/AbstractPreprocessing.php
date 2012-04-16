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

namespace Zend2\Search\Lucene\Search\Query\Preprocessing;

use Zend2\Search\Lucene,
	Zend2\Search\Lucene\Search\Query,
	Zend2\Search\Lucene\Exception\UnsupportedMethodCallException;

/**
 * It's an internal abstract class intended to finalize ase a query processing after query parsing.
 * This type of query is not actually involved into query execution.
 *
 * @uses       \Zend2\Search\Lucene\Exception\UnsupportedMethodCallException
 * @uses       \Zend2\Search\Lucene\Search\Query\AbstractQuery
 * @category   Zend2
 * @package    Zend2_Search_Lucene
 * @subpackage Search
 * @internal
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class AbstractPreprocessing extends Query\AbstractQuery
{
    /**
     * Matched terms.
     *
     * Matched terms list.
     * It's filled during rewrite operation and may be used for search result highlighting
     *
     * Array of Zend2_Search_Lucene_Index_Term objects
     *
     * @var array
     */
    protected $_matches = null;

    /**
     * Optimize query in the context of specified index
     *
     * @param \Zend2\Search\Lucene\SearchIndex $index
     * @throws \Zend2\Search\Lucene\Exception\UnsupportedMethodCallException
     * @return \Zend2\Search\Lucene\Search\Query\AbstractQuery
     */
    public function optimize(Lucene\SearchIndex $index)
    {
        throw new UnsupportedMethodCallException('This query is not intended to be executed.');
    }

    /**
     * Constructs an appropriate Weight implementation for this query.
     *
     * @param \Zend2\Search\Lucene\SearchIndex $reader
     * @throws \Zend2\Search\Lucene\Exception\UnsupportedMethodCallException
     * @return \Zend2\Search\Lucene\Search\Weight\Weight
     */
    public function createWeight(Lucene\SearchIndex $reader)
    {
        throw new UnsupportedMethodCallException('This query is not intended to be executed.');
    }

    /**
     * Execute query in context of index reader
     * It also initializes necessary internal structures
     *
     * @param \Zend2\Search\Lucene\SearchIndex $reader
     * @param \Zend2\Search\Lucene\Index\DocsFilter|null $docsFilter
     * @throws \Zend2\Search\Lucene\Exception\UnsupportedMethodCallException
     */
    public function execute(Lucene\SearchIndex $reader, $docsFilter = null)
    {
        throw new UnsupportedMethodCallException('This query is not intended to be executed.');
    }

    /**
     * Get document ids likely matching the query
     *
     * It's an array with document ids as keys (performance considerations)
     *
     * @throws \Zend2\Search\Lucene\Exception\UnsupportedMethodCallException
     * @return array
     */
    public function matchedDocs()
    {
        throw new UnsupportedMethodCallException('This query is not intended to be executed.');
    }

    /**
     * Score specified document
     *
     * @param integer $docId
     * @param \Zend2\Search\Lucene\SearchIndex $reader
     * @throws \Zend2\Search\Lucene\Exception\UnsupportedMethodCallException
     * @return float
     */
    public function score($docId, Lucene\SearchIndex $reader)
    {
        throw new UnsupportedMethodCallException('This query is not intended to be executed.');
    }

    /**
     * Return query terms
     *
     * @throws \Zend2\Search\Lucene\Exception\UnsupportedMethodCallException
     * @return array
     */
    public function getQueryTerms()
    {
        throw new UnsupportedMethodCallException('Rewrite operation has to be done before retrieving query terms.');
    }
}
