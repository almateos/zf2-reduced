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
 * @package    Zend2_PDF
 * @subpackage Zend2_PDF_Internal
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Pdf\InternalStructure;
use Zend2\Pdf\Exception;
use Zend2\Pdf\Action;
use Zend2\Pdf\Destination;
use Zend2\Pdf\InternalType;
use Zend2\Pdf;

/**
 * PDF target (action or destination)
 *
 * @uses       \Zend2\Pdf\Action\AbstractAction
 * @uses       \Zend2\Pdf\Destination\AbstractDestination
 * @uses       \Zend2\Pdf\InternalType\AbstractTypeObject
 * @uses       \Zend2\Pdf\Exception
 * @package    Zend2_PDF
 * @subpackage Zend2_PDF_Internal
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class NavigationTarget
{
    /**
     * Parse resource and return it as an Action or Explicit Destination
     *
     * $param \Zend2\Pdf\InternalType $resource
     * @return \Zend2\Pdf\Destination\AbstractDestination|\Zend2\Pdf\Action\AbstractAction
     * @throws \Zend2\Pdf\Exception
     */
    public static function load(InternalType\AbstractTypeObject $resource)
    {
        if ($resource->getType() == InternalType\AbstractTypeObject::TYPE_DICTIONARY) {
            if (($resource->Type === null  ||  $resource->Type->value =='Action')  &&  $resource->S !== null) {
                // It's a well-formed action, load it
                return Action\AbstractAction::load($resource);
            } else if ($resource->D !== null) {
                // It's a destination
                $resource = $resource->D;
            } else {
                throw new Exception\CorruptedPdfException('Wrong resource type.');
            }
        }

        if ($resource->getType() == InternalType\AbstractTypeObject::TYPE_ARRAY  ||
            $resource->getType() == InternalType\AbstractTypeObject::TYPE_NAME   ||
            $resource->getType() == InternalType\AbstractTypeObject::TYPE_STRING) {
            // Resource is an array, just treat it as an explicit destination array
            return Destination\AbstractDestination::load($resource);
        } else {
            throw new Exception\CorruptedPdfException('Wrong resource type.');
        }
    }

    /**
     * Get resource
     *
     * @internal
     * @return \Zend2\Pdf\InternalType\AbstractTypeObject
     */
    abstract public function getResource();
}
