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
 * @package    Zend2_CodeGenerator
 * @subpackage PHP
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Code\Generator\Docblock\Tag;

/**
 * @uses       \Zend2\Code\Generator\DocBlock\Tag
 * @category   Zend2
 * @package    Zend2_CodeGenerator
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class LicenseTag extends \Zend2\Code\Generator\Docblock\Tag
{

    /**
     * @var string
     */
    protected $_url = null;

    /**
     * fromReflection()
     *
     * @param \Zend2\Code\Reflection\ReflectionDocblockTag $reflectionTagReturn
     * @return \Zend2\Code\Generator\DocBlock\Tag\LicenseTag
     */
    public static function fromReflection(\Zend2\Code\Reflection\ReflectionDocblockTag $reflectionTagLicense)
    {
        $returnTag = new self();

        $returnTag->setName('license');
        $returnTag->setUrl($reflectionTagLicense->getUrl());
        $returnTag->setDescription($reflectionTagLicense->getDescription());

        return $returnTag;
    }

    /**
     * setUrl()
     *
     * @param string $url
     * @return \Zend2\Code\Generator\DocBlock\Tag\LicenseTag
     */
    public function setUrl($url)
    {
        $this->_url = $url;
        return $this;
    }

    /**
     * getUrl()
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->_url;
    }


    /**
     * generate()
     *
     * @return string
     */
    public function generate()
    {
        $output = '@license ' . $this->_url . ' ' . $this->description . self::LINE_FEED;
        return $output;
    }

}
