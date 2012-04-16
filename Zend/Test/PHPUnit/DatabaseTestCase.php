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
 * @package    Zend2_Test
 * @subpackage PHPUnit
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Test\PHPUnit;

/**
 * Generic Testcase for Zend2 Framework related DbUnit Testing with PHPUnit
 *
 * @uses       PHPUnit_Extensions_Database_Operation_Composite
 * @uses       PHPUnit_Extensions_Database_TestCase
 * @uses       \Zend2\Test\PHPUnit\Db\Connection
 * @uses       \Zend2\Test\PHPUnit\Db\DataSet\DbTable
 * @uses       \Zend2\Test\PHPUnit\Db\DataSet\DbTableDataSet
 * @uses       \Zend2\Test\PHPUnit\Db\DataSet\DbRowset
 * @uses       \Zend2\Test\PHPUnit\Db\Operation\Insert
 * @uses       \Zend2\Test\PHPUnit\Db\Operation\Truncate
 * @category   Zend2
 * @package    Zend2_Test
 * @subpackage PHPUnit
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class DatabaseTestCase extends \PHPUnit_Extensions_Database_TestCase
{
    /**
     * Creates a new Zend2 Database Connection using the given Adapter and database schema name.
     *
     * @param  \Zend2\Db\Adapter\AbstractAdapter $connection
     * @param  string $schema
     * @return \Zend2\Test\PHPUnit\Db\Connection
     */
    protected function createZend2DbConnection(\Zend2\Db\Adapter\AbstractAdapter $connection, $schema)
    {
        return new Db\Connection($connection, $schema);
    }

    /**
     * Convenience function to get access to the database connection.
     *
     * @return \Zend2\Db\Adapter\AbstractAdapter
     */
    protected function getAdapter()
    {
        return $this->getConnection()->getConnection();
    }

    /**
     * Returns the database operation executed in test setup.
     *
     * @return PHPUnit_Extensions_Database_Operation_DatabaseOperation
     */
    protected function getSetUpOperation()
    {
        return new \PHPUnit_Extensions_Database_Operation_Composite(array(
            new Db\Operation\Truncate(),
            new Db\Operation\Insert(),
        ));
    }

    /**
     * Returns the database operation executed in test cleanup.
     *
     * @return PHPUnit_Extensions_Database_Operation_DatabaseOperation
     */
    protected function getTearDownOperation()
    {
        return \PHPUnit_Extensions_Database_Operation_Factory::NONE();
    }

    /**
     * Create a dataset based on multiple Zend2_Db_Table instances
     *
     * @param  array $tables
     * @return \Zend2\Test\PHPUnit\Db\DataSet\DbTableDataSet
     */
    protected function createDbTableDataSet(array $tables=array())
    {
        $dataSet = new Db\DataSet\DbTableDataSet();
        foreach($tables AS $table) {
            $dataSet->addTable($table);
        }
        return $dataSet;
    }

    /**
     * Create a table based on one Zend2_Db_Table instance
     *
     * @param \Zend2\Db\Table\AbstractTable $table
     * @param string $where
     * @param string $order
     * @param string $count
     * @param string $offset
     * @return \Zend2\Test\PHPUnit\Db\DataSet\DbTable
     */
    protected function createDbTable(\Zend2\Db\Table\AbstractTable $table, $where=null, $order=null, $count=null, $offset=null)
    {
        return new Db\DataSet\DbTable($table, $where, $order, $count, $offset);
    }

    /**
     * Create a data table based on a Zend2_Db_Table_Rowset instance
     *
     * @param  \Zend2\Db\Table\AbstractRowset $rowset
     * @param  string
     * @return \Zend2\Test\PHPUnit\Db\DataSet\DbRowset
     */
    protected function createDbRowset(\Zend2\Db\Table\AbstractRowset $rowset, $tableName = null)
    {
        return new Db\DataSet\DbRowset($rowset, $tableName);
    }
}
