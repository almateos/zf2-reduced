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
 * @package    Zend2_Gdata
 * @subpackage Books
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\GData\Books\Extension;

/**
 * Describes a preview link
 *
 * @uses       \Zend2\GData\Books
 * @uses       \Zend2\GData\Books\Extension\BooksLink
 * @category   Zend2
 * @package    Zend2_Gdata
 * @subpackage Books
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class PreviewLink extends
    BooksLink
{

    /**
     * Constructor for Zend2_Gdata_Books_Extension_PreviewLink which
     * Describes a preview link
     *
     * @param string|null $href Linked resource URI
     * @param string|null $rel Forward relationship
     * @param string|null $type Resource MIME type
     * @param string|null $hrefLang Resource language
     * @param string|null $title Human-readable resource title
     * @param string|null $length Resource length in octets
     */
    public function __construct($href = null, $rel = null, $type = null,
            $hrefLang = null, $title = null, $length = null)
    {
        $this->registerAllNamespaces(\Zend2\GData\Books::$namespaces);
        parent::__construct($href, $rel, $type, $hrefLang, $title, $length);
    }

}
