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
 * @subpackage Spreadsheets
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\GData\Spreadsheets\Extension;

/**
 * Concrete class for working with colCount elements.
 *
 * @uses       \Zend2\GData\Entry
 * @uses       \Zend2\GData\Extension
 * @uses       \Zend2\GData\Spreadsheets
 * @category   Zend2
 * @package    Zend2_Gdata
 * @subpackage Spreadsheets
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class ColCount extends \Zend2\GData\Extension
{

    protected $_rootElement = 'colCount';
    protected $_rootNamespace = 'gs';

    /**
     * Constructs a new Zend2_Gdata_Spreadsheets_Extension_ColCount element.
     * @param string $text (optional) Text contents of the element.
     */
    public function __construct($text = null)
    {
        $this->registerAllNamespaces(\Zend2\GData\Spreadsheets::$namespaces);
        parent::__construct();
        $this->_text = $text;
    }
}
