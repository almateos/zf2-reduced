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
 * @subpackage Photos
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\GData\Photos\Extension;

/**
 * Represents the gphoto:client element used by the API.
 * This is an optional field that can be used to indicate the
 * client which created a photo.
 *
 * @uses       \Zend2\GData\Extension
 * @uses       \Zend2\GData\Photos
 * @category   Zend2
 * @package    Zend2_Gdata
 * @subpackage Photos
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Client extends \Zend2\GData\Extension
{

    protected $_rootNamespace = 'gphoto';
    protected $_rootElement = 'client';

    /**
     * Constructs a new Zend2_Gdata_Photos_Extension_Client object.
     *
     * @param string $text (optional) The value to represent.
     */
    public function __construct($text = null)
    {
        $this->registerAllNamespaces(\Zend2\GData\Photos::$namespaces);
        parent::__construct();
        $this->setText($text);
    }

}
