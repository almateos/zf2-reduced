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
 * @package    Zend2\Cloud
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Cloud;

/**
 * Abstract factory for Zend2\Cloud resources
 *
 * @category   Zend2
 * @package    Zend2\Cloud
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class AbstractFactory
{
    /**
     * Constructor
     *
     * @return void
     */
    private function __construct()
    {
        // private ctor - should not be used
    }

    /**
     * Get an individual adapter instance
     *
     * @param  string $adapterOption
     * @param  array|Zend2\Config $options
     * @return null|DocumentService\Adapter|QueueService\Adapter|StorageService\Adapter|Infrastructure\Adapter
     */
    protected static function _getAdapter($adapterOption, $options)
    {
        if ($options instanceof \Zend2\Config\Config) {
            $options = $options->toArray();
        }

        if (!isset($options[$adapterOption])) {
            return null;
        }

        $classname = $options[$adapterOption];
        unset($options[$adapterOption]);

        return new $classname($options);
    }
}
