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

use Zend2\Locale\Locale,
    Zend2\Registry,
    Zend2\Translator\Adapter\AbstractAdapter as TranslationAdapter,
    Zend2\Translator\Translator as Translation,
    Zend2\View,
    Zend2\View\Exception;

/**
 * Translation view helper
 *
 * @uses      \Zend2\Locale\Locale
 * @uses      \Zend2\Registry
 * @uses      \Zend2\View\Exception
 * @uses      \Zend2\View\Helper\AbstractHelper
 * @category  Zend2
 * @package   Zend2_View
 * @copyright Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd     New BSD License
 */
class Translator extends AbstractHelper
{
    /**
     * Translation object
     *
     * @var \Zend2\Translator\Adapter\Adapter
     */
    protected $translator;

    /**
     * Constructor for manually handling
     *
     * @param null|Translation|TranslationAdapter $translate
     */
    public function __construct($translate = null)
    {
        if ($translate !== null) {
            $this->setTranslator($translate);
        }
    }

    /**
     * Mock __invoke for manual call
     *
     * @see __invoke
     * @param  string $messageid Id of the message to be translated
     * @return string|\Zend2\View\Helper\Translator Translated message
     */
    public function translate($messageid = null)
    {
        $options = func_get_args();
        return call_user_func_array(array($this, '__invoke'), $options);
    }

    /**
     * Translate a message
     * You can give multiple params or an array of params.
     * If you want to output another locale just set it as last single parameter
     * Example 1: translate('%1\$s + %2\$s', $value1, $value2, $locale);
     * Example 2: translate('%1\$s + %2\$s', array($value1, $value2), $locale);
     *
     * @param  string $messageid Id of the message to be translated
     * @return string|\Zend2\View\Helper\Translator Translated message
     */
    public function __invoke($messageid = null)
    {
        if ($messageid === null) {
            return $this;
        }

        $translator = $this->getTranslator();
        $options    = func_get_args();

        array_shift($options);
        $count  = count($options);
        $locale = null;
        if ($count > 0) {
            if (Locale::isLocale($options[($count - 1)]) !== false) {
                // Don't treat last option as the locale if doing so will result in an error
                if (is_array($options[0]) || @vsprintf($messageid, array_slice($options, 0, -1)) !== false) {
                    $locale = array_pop($options);
                }
            }
        }

        if ((count($options) === 1) and (is_array($options[0]) === true)) {
            $options = $options[0];
        }

        if ($translator !== null) {
            $messageid = $translator->translate($messageid, $locale);
        }

        if (count($options) === 0) {
            return $messageid;
        }

        return vsprintf($messageid, $options);
    }

    /**
     * Sets a translation Adapter for translation
     *
     * @param  Translation|TranslationAdapter $translator
     * @return Translator
     * @throws Exception\InvalidArgumentException When no or a false instance was set
     */
    public function setTranslator($translator)
    {
        if ($translator instanceof TranslationAdapter) {
            $this->translator = $translator;
        } else if ($translator instanceof Translation) {
            $this->translator = $translator->getAdapter();
        } else {
            throw new Exception\InvalidArgumentException(
                'You must set an instance of Zend2\Translator\Translator or Zend2\Translator\Adapter'
            );
        }

        return $this;
    }

    /**
     * Retrieve translation object
     *
     * @return TranslationAdapter|null
     */
    public function getTranslator()
    {
        if ($this->translator === null) {
            if (Registry::isRegistered('Zend2_Translator')) {
                $this->setTranslator(Registry::get('Zend2_Translator'));
            }
        }

        return $this->translator;
    }

    /**
     * Set's a new locale for all further translations
     *
     * @param  string|Locale $locale New locale to set
     * @return Translator
     * @throws Exception\RuntimeException When no Translation instance was set
     */
    public function setLocale($locale = null)
    {
        $translator = $this->getTranslator();
        if ($translator === null) {
            throw new Exception\RuntimeException(
                'You must set an instance of Zend2\Translator\Translator or Zend2\Translator\Adapter'
            );
        }

        $translator->setLocale($locale);
        return $this;
    }

    /**
     * Returns the set locale for translations
     *
     * @throws ViewException 
     * @return string|Locale
     * @throws Exception\RuntimeException When no Translation instance was set
     */
    public function getLocale()
    {
        $translator = $this->getTranslator();
        if ($translator === null) {
            throw new Exception\RuntimeException(
                'You must set an instance of Zend2\Translator\Translator or Zend2\Translator\Adapter'
            );
        }

        return $translator->getLocale();
    }
}
