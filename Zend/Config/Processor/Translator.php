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
 * @package    Zend2_Config
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Config\Processor;

use Zend2\Config\Config,
    Zend2\Config\Processor,
    Zend2\Config\Exception\InvalidArgumentException,
    Zend2\Translator\Translator as Zend2Translator,
    Zend2\Locale\Locale,
    \Traversable,
    \ArrayObject;

/**
 * @category   Zend2
 * @package    Zend2_Config
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Translator implements Processor
{
    /**
     * @var \Zend2\Translator\Translator
     */
    protected $translator;

    /**
     * @var \Zend2\Locale\Locale|string|null
     */
    protected $locale = null;

    /**
     * Translator uses the supplied Zend2\Translator\Translator to find and
     * translate language strings in config.
     *
     * @param  Zend2Translator $translator
     * @param  Locale|string|null $locale
     * @return Zend2Translator
     */
    public function __construct(Zend2Translator $translator, $locale = null)
    {
        $this->setTranslator($translator);
        $this->setLocale($locale);
    }

    /**
     * @return \Zend2\Translator\Translator
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * @param \Zend2\Translator\Translator $translator
     */
    public function setTranslator(Zend2Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @return \Zend2\Locale\Locale|string|null
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param \Zend2\Locale\Locale|string|null $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    public function process(Config $config)
    {
        if ($config->isReadOnly()) {
            throw new InvalidArgumentException('Cannot parse config because it is read-only');
        }

        /**
         * Walk through config and replace values
         */
        foreach ($config as $key => $val) {
            if ($val instanceof Config) {
                $this->process($val);
            } else {
                $config->$key = $this->translator->translate($val, $this->locale);
            }
        }

        return $config;
    }

    /**
     * Process a single value
     *
     * @param $value
     * @return mixed
     */
    public function processValue($value)
    {
        return $this->translator->translate($value, $this->locale);
    }

}
