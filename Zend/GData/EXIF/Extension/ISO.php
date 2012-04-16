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
 * @subpackage Exif
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\GData\EXIF\Extension;

/**
 * Represents the exif:iso element used by the Gdata Exif extensions.
 *
 * @uses       \Zend2\GData\EXIF
 * @uses       \Zend2\GData\Extension
 * @category   Zend2
 * @package    Zend2_Gdata
 * @subpackage Exif
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class ISO extends \Zend2\GData\Extension
{

    protected $_rootNamespace = 'exif';
    protected $_rootElement = 'iso';

    /**
     * Constructs a new Zend2_Gdata_Exif_Extension_Iso object.
     *
     * @param string $text (optional) The value to use for this element.
     */
    public function __construct($text = null)
    {
        $this->registerAllNamespaces(\Zend2\GData\EXIF::$namespaces);
        parent::__construct();
        $this->setText($text);
    }

}
