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
 * @package    Zend2_Amf
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Amf\Adobe;

/**
 * This class implements authentication against XML file with roles for Flex Builder.
 *
 * @package    Zend2_Amf
 * @subpackage Adobe
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class DbInspector
{
    /**
     * Connect to the database
     *
     * @see    Zend2_Db::factory()
     * @param  string $dbType Database adapter type for Zend2_Db
     * @param  array|object $dbDescription Adapter-specific connection settings
     * @return Zend2_Db_Adapter_Abstract
     */
    protected function _connect($dbType, $dbDescription)
    {
        if (is_object($dbDescription)) {
            $dbDescription = get_object_vars($dbDescription);
        }
        return \Zend2_Db::factory($dbType, $dbDescription);
    }

    /**
     * Describe database object.
     *
     * Usage example:
     * $inspector->describeTable('Pdo_Mysql',
     *     array(
     *         'host'     => '127.0.0.1',
     *         'username' => 'webuser',
     *         'password' => 'xxxxxxxx',
     *         'dbname'   => 'test'
     *     ),
     *     'mytable'
     * );
     *
     * @see    Zend2_Db::describeTable()
     * @see    Zend2_Db::factory()
     * @param  string $dbType Database adapter type for Zend2_Db
     * @param  array|object $dbDescription Adapter-specific connection settings
     * @param  string $tableName Table name
     * @return array Table description
     */
    public function describeTable($dbType, $dbDescription, $tableName)
    {
        $db = $this->_connect($dbType, $dbDescription);
        return $db->describeTable($tableName);
    }

    /**
     * Test database connection
     *
     * @see    Zend2_Db::factory()
     * @param  string $dbType Database adapter type for Zend2_Db
     * @param  array|object $dbDescription Adapter-specific connection settings
     * @return bool
     */
    public function connect($dbType, $dbDescription)
    {
        $db = $this->_connect($dbType, $dbDescription);
        $db->listTables();
        return true;
    }

    /**
     * Get the list of database tables
     *
     * @param  string $dbType Database adapter type for Zend2_Db
     * @param  array|object $dbDescription Adapter-specific connection settings
     * @return array List of the tables
     */
    public function getTables($dbType, $dbDescription)
    {
        $db = $this->_connect($dbType, $dbDescription);
        return $db->listTables();
    }
}
