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
 * @subpackage YouTube
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\GData\YouTube\Extension;

/**
 * Represents the yt:releaseDate element
 *
 * @uses       \Zend2\GData\Extension
 * @uses       \Zend2\GData\YouTube
 * @category   Zend2
 * @package    Zend2_Gdata
 * @subpackage YouTube
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class ReleaseDate extends \Zend2\GData\Extension
{

    protected $_rootElement = 'releaseDate';
    protected $_rootNamespace = 'yt';

    public function __construct($text = null)
    {
        $this->registerAllNamespaces(\Zend2\GData\YouTube::$namespaces);
        parent::__construct();
        $this->_text = $text;
    }

}
