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

namespace Zend2\Test\PHPUnit\Db\Operation;

/**
 * Delete All Operation that can be executed on set up or tear down of a database tester.
 *
 * @uses       PHPUnit_Extensions_Database_DataSet_IDataSet
 * @uses       PHPUnit_Extensions_Database_DB_IDatabaseConnection
 * @uses       PHPUnit_Extensions_Database_Operation_Exception
 * @uses       PHPUnit_Extensions_Database_Operation_IDatabaseOperation
 * @uses       \Zend2\Test\PHPUnit\Db\Connection
 * @uses       \Zend2\Test\PHPUnit\Db\Exception\InvalidArgumentException
 * @category   Zend2
 * @package    Zend2_Test
 * @subpackage PHPUnit
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class DeleteAll implements \PHPUnit_Extensions_Database_Operation_IDatabaseOperation
{
    /**
     * @param PHPUnit_Extensions_Database_DB_IDatabaseConnection $connection
     * @param PHPUnit_Extensions_Database_DataSet_IDataSet $dataSet
     */
    public function execute(\PHPUnit_Extensions_Database_DB_IDatabaseConnection $connection, \PHPUnit_Extensions_Database_DataSet_IDataSet $dataSet)
    {
        if(!($connection instanceof \Zend2\Test\PHPUnit\Db\Connection)) {
            throw new \Zend2\Test\PHPUnit\Db\Exception\InvalidArgumentException(
            	"Not a valid Zend2_Test_PHPUnit_Db_Connection instance, ".get_class($connection)." given!"
            );
        }

        foreach ($dataSet as $table) {
            try {
                $tableName = $table->getTableMetaData()->getTableName();
                $connection->getConnection()->delete($tableName);
            } catch (\Exception $e) {
                throw new \PHPUnit_Extensions_Database_Operation_Exception('DELETEALL', 'DELETE FROM '.$tableName.'', array(), $table, $e->getMessage());
            }
        }
    }
}
