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
 * @subpackage Analysis
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Search\Lucene\Analysis\Analyzer\Common\Text;
use Zend2\Search\Lucene\Analysis\Analyzer\Common;
use Zend2\Search\Lucene\Analysis\TokenFilter;

/**
 * @uses       \Zend2\Search\Lucene\Analysis\Analyzer\Common\Text\Text
 * @uses       \Zend2\Search\Lucene\Analysis\TokenFilter\LowerCase
 * @category   Zend2
 * @package    Zend2_Search_Lucene
 * @subpackage Analysis
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class CaseInsensitive extends Common\Text
{
    public function __construct()
    {
        $this->addFilter(new TokenFilter\LowerCase());
    }
}

