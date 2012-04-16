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

namespace Zend2\Search\Lucene\Search\Highlighter;

use Zend2\Search\Lucene\Search\Highlighter,
    Zend2\Search\Lucene\Document;

/**
 * @uses       \Zend2\Search\Lucene\Search\Highlighter
 * @uses       \Zend2\Search\Lucene\Document;
 * @category   Zend2
 * @package    Zend2_Search_Lucene
 * @subpackage Search
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class DefaultHighlighter implements Highlighter
{
    /**
     * List of colors for text highlighting
     *
     * @var array
     */
    protected $_highlightColors = array('#66ffff', '#ff66ff', '#ffff66',
                                        '#ff8888', '#88ff88', '#8888ff',
                                        '#88dddd', '#dd88dd', '#dddd88',
                                        '#aaddff', '#aaffdd', '#ddaaff',
                                        '#ddffaa', '#ffaadd', '#ffddaa');

    /**
     * Index of current color for highlighting
     *
     * Index is increased at each highlight() call, so terms matching different queries are highlighted using different colors.
     *
     * @var integer
     */
    protected $_currentColorIndex = 0;

    /**
     * HTML document for highlighting
     *
     * @var \Zend2\Search\Lucene\Document\HTML
     */
    protected $_doc;

    /**
     * Set document for highlighting.
     *
     * @param \Zend2\Search\Lucene\Document\HTML $document
     */
    public function setDocument(Document\HTML $document)
    {
        $this->_doc = $document;
    }

    /**
     * Get document for highlighting.
     *
     * @return \Zend2\Search\Lucene\Document\HTML $document
     */
    public function getDocument()
    {
        return $this->_doc;
    }

    /**
     * Highlight specified words
     *
     * @param string|array $words  Words to highlight. They could be organized using the array or string.
     */
    public function highlight($words)
    {
        $color = $this->_highlightColors[$this->_currentColorIndex];
        $this->_currentColorIndex = ($this->_currentColorIndex + 1) % count($this->_highlightColors);

        $this->_doc->highlight($words, $color);
    }
}
