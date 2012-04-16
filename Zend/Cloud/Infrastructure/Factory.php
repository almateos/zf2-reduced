<?php
/**
 * @category   Zend2
 * @package    Zend2\Cloud
 * @subpackage Infrastructure
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * namespace
 */
namespace Zend2\Cloud\Infrastructure;

use Zend2\Cloud\AbstractFactory,
    Zend2\Cloud\Exception\InvalidArgumentException;

/**
 * Factory for infrastructure adapters
 * 
 * @package    Zend2\Cloud
 * @subpackage Infrastructure
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Factory extends AbstractFactory
{
    const INFRASTRUCTURE_ADAPTER_KEY = 'infrastructure_adapter';

    /**
     * @var string Interface which adapter must implement to be considered valid
     */
    protected static $_adapterInterface = 'Zend2\Cloud\Infrastructure\Adapter';

    /**
     * Constructor
     *
     * Private ctor - should not be used
     *
     * @return void
     */
    private function __construct()
    {
    }

    /**
     * Retrieve an adapter instance
     *
     * @param  array $options
     * @return void
     */
    public static function getAdapter($options = array())
    {
        $adapter = parent::_getAdapter(self::INFRASTRUCTURE_ADAPTER_KEY, $options);

        if (!$adapter) {
            throw new InvalidArgumentException(sprintf(
                'Class must be specified using the "%s" key',
                self::INFRASTRUCTURE_ADAPTER_KEY
            ));
        } elseif (!$adapter instanceof self::$_adapterInterface) {
            throw new InvalidArgumentException(sprintf(
                'Adapter must implement "%s"', self::$_adapterInterface
            ));
        }
        return $adapter;
    }
}
