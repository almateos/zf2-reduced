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
 * @package    Zend2_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\View\Helper;

use Zend2\View\Exception;

/**
 * Helper for setting and retrieving title element for HTML head
 *
 * @uses       \Zend2\Registry
 * @uses       \Zend2\View\Exception
 * @uses       \Zend2\View\Helper\Placeholder\Container\AbstractContainer
 * @uses       \Zend2\View\Helper\Placeholder\Container\Standalone
 * @package    Zend2_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class HeadTitle extends Placeholder\Container\Standalone
{
    /**
     * Registry key for placeholder
     * @var string
     */
    protected $_regKey = 'Zend2_View_Helper_HeadTitle';

    /**
     * Whether or not auto-translation is enabled
     * @var boolean
     */
    protected $_translate = false;

    /**
     * Translation object
     *
     * @var \Zend2\Translator\Adapter\Adapter
     */
    protected $_translator;

    /**
     * Default title rendering order (i.e. order in which each title attached)
     *
     * @var string
     */
    protected $_defaultAttachOrder = null;

    /**
     * Retrieve placeholder for title element and optionally set state
     *
     * @param  string $title
     * @param  string $setType
     * @param  string $separator
     * @return \Zend2\View\Helper\HeadTitle
     */
    public function __invoke($title = null, $setType = null)
    {
        if ($setType === null && $this->getDefaultAttachOrder() === null) {
            $setType = Placeholder\Container\AbstractContainer::APPEND;
        } elseif ($setType === null && $this->getDefaultAttachOrder() !== null) {
            $setType = $this->getDefaultAttachOrder();
        }
        $title = (string) $title;
        if ($title !== '') {
            if ($setType == Placeholder\Container\AbstractContainer::SET) {
                $this->set($title);
            } elseif ($setType == Placeholder\Container\AbstractContainer::PREPEND) {
                $this->prepend($title);
            } else {
                $this->append($title);
            }
        }

        return $this;
    }

    /**
     * Set a default order to add titles
     *
     * @param string $setType
     * @return void
     * @throws Exception\DomainException
     */
    public function setDefaultAttachOrder($setType)
    {
        if (!in_array($setType, array(
            Placeholder\Container\AbstractContainer::APPEND,
            Placeholder\Container\AbstractContainer::SET,
            Placeholder\Container\AbstractContainer::PREPEND
        ))) {
            throw new Exception\DomainException(
                "You must use a valid attach order: 'PREPEND', 'APPEND' or 'SET'"
            );
        }
        $this->_defaultAttachOrder = $setType;
    }

    /**
     * Get the default attach order, if any.
     *
     * @return mixed
     */
    public function getDefaultAttachOrder()
    {
        return $this->_defaultAttachOrder;
    }

    /**
     * Sets a translation Adapter for translation
     *
     * @param  Zend2_Translator|\Zend2\Translator\Adapter\Adapter $translate
     * @return \Zend2\View\Helper\HeadTitle
     * @throws Exception\InvalidArgumentException
     */
    public function setTranslator($translate)
    {
        if ($translate instanceof \Zend2\Translator\Adapter\AbstractAdapter) {
            $this->_translator = $translate;
        } elseif ($translate instanceof \Zend2\Translator\Translator) {
            $this->_translator = $translate->getAdapter();
        } else {
            throw new Exception\InvalidArgumentException(
                "You must set an instance of Zend2_Translator or Zend2_Translator_Adapter"
            );
        }
        return $this;
    }

    /*
     * Retrieve translation object
     *
     * If none is currently registered, attempts to pull it from the registry
     * using the key 'Zend2_Translator'.
     *
     * @return Zend2_Translator_Adapter|null
     */
    public function getTranslator()
    {
        if (null === $this->_translator) {
            if (\Zend2\Registry::isRegistered('Zend2_Translator')) {
                $this->setTranslator(\Zend2\Registry::get('Zend2_Translator'));
            }
        }
        return $this->_translator;
    }

    /**
     * Enables translation
     *
     * @return \Zend2\View\Helper\HeadTitle
     */
    public function enableTranslation()
    {
        $this->_translate = true;
        return $this;
    }

    /**
     * Disables translation
     *
     * @return \Zend2\View\Helper\HeadTitle
     */
    public function disableTranslation()
    {
        $this->_translate = false;
        return $this;
    }

    /**
     * Turn helper into string
     *
     * @param  string|null $indent
     * @param  string|null $locale
     * @return string
     */
    public function toString($indent = null, $locale = null)
    {
        $indent = (null !== $indent)
                ? $this->getWhitespace($indent)
                : $this->getIndent();

        $items = array();

        if($this->_translate && $translator = $this->getTranslator()) {
            foreach ($this as $item) {
                $items[] = $translator->translate($item, $locale);
            }
        } else {
            foreach ($this as $item) {
                $items[] = $item;
            }
        }

        $separator = $this->getSeparator();
        $output = '';

        $prefix = $this->getPrefix();
        if($prefix) {
            $output  .= $prefix;
        }

        $output .= implode($separator, $items);

        $postfix = $this->getPostfix();
        if($postfix) {
            $output .= $postfix;
        }

        $output = ($this->_autoEscape) ? $this->_escape($output) : $output;

        return $indent . '<title>' . $output . '</title>';
    }
}
