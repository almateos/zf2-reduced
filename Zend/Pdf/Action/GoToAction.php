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
 * @subpackage Zend2_PDF_Action
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Pdf\Action;
use Zend2\Pdf\Exception;
use Zend2\Pdf;
use Zend2\Pdf\Destination;
use Zend2\Pdf\InternalType;

/**
 * PDF 'Go to' action
 *
 * @uses       SplObjectStorage
 * @uses       \Zend2\Pdf\Action\AbstractAction
 * @uses       \Zend2\Pdf\Destination\AbstractDestination
 * @uses       \Zend2\Pdf\Destination\Named
 * @uses       \Zend2\Pdf\InternalType\DictionaryObject
 * @uses       \Zend2\Pdf\InternalType\NameObject
 * @uses       \Zend2\Pdf\Exception
 * @package    Zend2_PDF
 * @subpackage Zend2_PDF_Action
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class GoToAction extends AbstractAction
{
    /**
     * GoTo Action destination
     *
     * @var \Zend2\Pdf\Destination\AbstractDestination
     */
    protected $_destination;


    /**
     * Object constructor
     *
     * @param \Zend2\Pdf\InternalType\DictionaryObject $dictionary
     * @param SplObjectStorage    $processedActions  list of already processed action dictionaries,
     *                                               used to avoid cyclic references
     */
    public function __construct(InternalType\AbstractTypeObject $dictionary, \SplObjectStorage $processedActions)
    {
        parent::__construct($dictionary, $processedActions);

        $this->_destination = Destination\AbstractDestination::load($dictionary->D);
    }

    /**
     * Create new \Zend2\Pdf\Action\GoToAction object using specified destination
     *
     * @param \Zend2\Pdf\Destination\AbstractDestination|string $destination
     * @return \Zend2\Pdf\Action\GoToAction
     */
    public static function create($destination)
    {
        if (is_string($destination)) {
            $destination = Destination\Named::create($destination);
        }

        if (!$destination instanceof Destination\AbstractDestination) {
            throw new Exception\InvalidArgumentException('$destination parameter must be a \Zend2\Pdf\Destination object or string.');
        }

        $dictionary       = new InternalType\DictionaryObject();
        $dictionary->Type = new InternalType\NameObject('Action');
        $dictionary->S    = new InternalType\NameObject('GoTo');
        $dictionary->Next = null;
        $dictionary->D    = $destination->getResource();

        return new self($dictionary, new \SplObjectStorage());
    }

    /**
     * Set goto action destination
     *
     * @param \Zend2\Pdf\Destination\AbstractDestination|string $destination
     * @return \Zend2\Pdf\Action\GoToAction
     */
    public function setDestination(Destination\AbstractDestination $destination)
    {
        $this->_destination = $destination;

        $this->_actionDictionary->touch();
        $this->_actionDictionary->D = $destination->getResource();

        return $this;
    }

    /**
     * Get goto action destination
     *
     * @return \Zend2\Pdf\Destination\AbstractDestination
     */
    public function getDestination()
    {
        return $this->_destination;
    }
}
