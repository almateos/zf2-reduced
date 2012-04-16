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
 * @package    Zend2_Acl
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Acl\Role;

use Zend2\Acl\Role\RoleInterface;

/**
 * @category   Zend2
 * @package    Zend2_Acl
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class GenericRole implements RoleInterface
{
    /**
     * Unique id of Role
     *
     * @var string
     */
    protected $_roleId;

    /**
     * Sets the Role identifier
     *
     * @param  string $roleId
     * @return void
     */
    public function __construct($roleId)
    {
        $this->_roleId = (string) $roleId;
    }

    /**
     * Defined by Zend2\Acl\Role\RoleInterface; returns the Role identifier
     *
     * @return string
     */
    public function getRoleId()
    {
        return $this->_roleId;
    }

    /**
     * Defined by Zend2\Acl\Role\RoleInterface; returns the Role identifier
     * Proxies to getRoleId()
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getRoleId();
    }
}
