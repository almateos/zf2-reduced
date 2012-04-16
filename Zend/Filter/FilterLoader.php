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
 * @package    Zend2_Filter
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Filter;

use Zend2\Loader\PluginClassLoader;

/**
 * Plugin Class Loader implementation for filters.
 *
 * @category   Zend2
 * @package    Zend2_Filter
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class FilterLoader extends PluginClassLoader
{
    /**
     * @var array Pre-aliased filter 
     */
    protected $plugins = array(
        'alnum'                          => 'Zend2\Filter\Alnum',
        'alpha'                          => 'Zend2\Filter\Alpha',
        'basename'                       => 'Zend2\Filter\BaseName',
        'base_name'                      => 'Zend2\Filter\BaseName',
        'boolean'                        => 'Zend2\Filter\Boolean',
        'callback'                       => 'Zend2\Filter\Callback',
        'compress'                       => 'Zend2\Filter\Compress',
        'compress\\bz2'                  => 'Zend2\Filter\Compress\Bz2',
        'compress_bz2'                   => 'Zend2\Filter\Compress\Bz2',
        'compress\\gz'                   => 'Zend2\Filter\Compress\Gz',
        'compress_gz'                    => 'Zend2\Filter\Compress\Gz',
        'compress\\lzf'                  => 'Zend2\Filter\Compress\Lzf',
        'compress_lzf'                   => 'Zend2\Filter\Compress\Lzf',
        'compress\\rar'                  => 'Zend2\Filter\Compress\Rar',
        'compress_rar'                   => 'Zend2\Filter\Compress\Rar',
        'compress\\tar'                  => 'Zend2\Filter\Compress\Tar',
        'compress_tar'                   => 'Zend2\Filter\Compress\Tar',
        'compress\\zip'                  => 'Zend2\Filter\Compress\Zip',
        'compress_zip'                   => 'Zend2\Filter\Compress\Zip',
        'decompress'                     => 'Zend2\Filter\Decompress',
        'decrypt'                        => 'Zend2\Filter\Decrypt',
        'digits'                         => 'Zend2\Filter\Digits',
        'dir'                            => 'Zend2\Filter\Dir',
        'encrypt'                        => 'Zend2\Filter\Encrypt',
        'encrypt\\mcrypt'                => 'Zend2\Filter\Encrypt\Mcrypt',
        'encrypt_mcrypt'                 => 'Zend2\Filter\Encrypt\Mcrypt',
        'encrypt\\openssl'               => 'Zend2\Filter\Encrypt\Openssl',
        'encrypt_openssl'                => 'Zend2\Filter\Encrypt\Openssl',
        'file\\decrypt'                  => 'Zend2\Filter\File\Decrypt',
        'file_decrypt'                   => 'Zend2\Filter\File\Decrypt',
        'file\\encrypt'                  => 'Zend2\Filter\File\Encrypt',
        'file_encrypt'                   => 'Zend2\Filter\File\Encrypt',
        'file\\lowercase'                => 'Zend2\Filter\File\LowerCase',
        'file\\lower_case'               => 'Zend2\Filter\File\LowerCase',
        'file_lowercase'                 => 'Zend2\Filter\File\LowerCase',
        'file_lower_case'                => 'Zend2\Filter\File\LowerCase',
        'file\\rename'                   => 'Zend2\Filter\File\Rename',
        'file_rename'                    => 'Zend2\Filter\File\Rename',
        'file\\uppercase'                => 'Zend2\Filter\File\UpperCase',
        'file\\upper_case'               => 'Zend2\Filter\File\UpperCase',
        'file_uppercase'                 => 'Zend2\Filter\File\UpperCase',
        'file_upper_case'                => 'Zend2\Filter\File\UpperCase',
        'htmlentities'                   => 'Zend2\Filter\HtmlEntities',
        'html_entities'                  => 'Zend2\Filter\HtmlEntities',
        'inflector'                      => 'Zend2\Filter\Inflector',
        'int'                            => 'Zend2\Filter\Int',
        'localizedtonormalized'          => 'Zend2\Filter\LocalizedToNormalized',
        'localized_to_normalized'        => 'Zend2\Filter\LocalizedToNormalized',
        'normalizedtolocalized'          => 'Zend2\Filter\NormalizedToLocalized',
        'normalized_to_localized'        => 'Zend2\Filter\NormalizedToLocalized',
        'null'                           => 'Zend2\Filter\Null',
        'pregreplace'                    => 'Zend2\Filter\PregReplace',
        'preg_replace'                   => 'Zend2\Filter\PregReplace',
        'realpath'                       => 'Zend2\Filter\RealPath',
        'real_path'                      => 'Zend2\Filter\RealPath',
        'stringtolower'                  => 'Zend2\Filter\StringToLower',
        'string_to_lower'                => 'Zend2\Filter\StringToLower',
        'stringtoupper'                  => 'Zend2\Filter\StringToUpper',
        'string_to_upper'                => 'Zend2\Filter\StringToUpper',
        'stringtrim'                     => 'Zend2\Filter\StringTrim',
        'string_trim'                    => 'Zend2\Filter\StringTrim',
        'stripnewlines'                  => 'Zend2\Filter\StripNewlines',
        'strip_newlines'                 => 'Zend2\Filter\StripNewlines',
        'striptags'                      => 'Zend2\Filter\StripTags',
        'strip_tags'                     => 'Zend2\Filter\StripTags',
        'word\\camelcasetodash'          => 'Zend2\Filter\Word\CamelCaseToDash',
        'word\\camel_case_to_dash'       => 'Zend2\Filter\Word\CamelCaseToDash',
        'word_camelcasetodash'           => 'Zend2\Filter\Word\CamelCaseToDash',
        'word_camel_case_to_dash'        => 'Zend2\Filter\Word\CamelCaseToDash',
        'word\\camelcasetoseparator'     => 'Zend2\Filter\Word\CamelCaseToSeparator',
        'word\\camel_case_to_separator'  => 'Zend2\Filter\Word\CamelCaseToSeparator',
        'word_camelcasetoseparator'      => 'Zend2\Filter\Word\CamelCaseToSeparator',
        'word_camel_case_to_separator'   => 'Zend2\Filter\Word\CamelCaseToSeparator',
        'word\\camelcasetounderscore'    => 'Zend2\Filter\Word\CamelCaseToUnderscore',
        'word\\camel_case_to_underscore' => 'Zend2\Filter\Word\CamelCaseToUnderscore',
        'word_camelcasetounderscore'     => 'Zend2\Filter\Word\CamelCaseToUnderscore',
        'word_camel_case_to_underscore'  => 'Zend2\Filter\Word\CamelCaseToUnderscore',
        'word\\dashtocamelcase'          => 'Zend2\Filter\Word\DashToCamelCase',
        'word\\dash_to_camel_case'       => 'Zend2\Filter\Word\DashToCamelCase',
        'word_dashtocamelcase'           => 'Zend2\Filter\Word\DashToCamelCase',
        'word_dash_to_camel_case'        => 'Zend2\Filter\Word\DashToCamelCase',
        'word\\dashtoseparator'          => 'Zend2\Filter\Word\DashToSeparator',
        'word\\dash_to_separator'        => 'Zend2\Filter\Word\DashToSeparator',
        'word_dashtoseparator'           => 'Zend2\Filter\Word\DashToSeparator',
        'word_dash_to_separator'         => 'Zend2\Filter\Word\DashToSeparator',
        'word\\dashtounderscore'         => 'Zend2\Filter\Word\DashToUnderscore',
        'word\\dash_to_underscore'       => 'Zend2\Filter\Word\DashToUnderscore',
        'word_dashtounderscore'          => 'Zend2\Filter\Word\DashToUnderscore',
        'word_dash_to_underscore'        => 'Zend2\Filter\Word\DashToUnderscore',
        'word\\separatortocamelcase'     => 'Zend2\Filter\Word\SeparatorToCamelCase',
        'word\\separator_to_camel_case'  => 'Zend2\Filter\Word\SeparatorToCamelCase',
        'word_separatortocamelcase'      => 'Zend2\Filter\Word\SeparatorToCamelCase',
        'word_separator_to_camel_case'   => 'Zend2\Filter\Word\SeparatorToCamelCase',
        'word\\separatortodash'          => 'Zend2\Filter\Word\SeparatorToDash',
        'word\\separator_to_dash'        => 'Zend2\Filter\Word\SeparatorToDash',
        'word_separatortodash'           => 'Zend2\Filter\Word\SeparatorToDash',
        'word_separator_to_dash'         => 'Zend2\Filter\Word\SeparatorToDash',
        'word\\separatortoseparator'     => 'Zend2\Filter\Word\SeparatorToSeparator',
        'word\\separator_to_separator'   => 'Zend2\Filter\Word\SeparatorToSeparator',
        'word_separatortoseparator'      => 'Zend2\Filter\Word\SeparatorToSeparator',
        'word_separator_to_separator'    => 'Zend2\Filter\Word\SeparatorToSeparator',
        'word\\underscoretocamelcase'    => 'Zend2\Filter\Word\UnderscoreToCamelCase',
        'word\\underscore_to_camel_case' => 'Zend2\Filter\Word\UnderscoreToCamelCase',
        'word_underscoretocamelcase'     => 'Zend2\Filter\Word\UnderscoreToCamelCase',
        'word_underscore_to_camel_case'  => 'Zend2\Filter\Word\UnderscoreToCamelCase',
        'word\\underscoretodash'         => 'Zend2\Filter\Word\UnderscoreToDash',
        'word\\underscore_to_dash'       => 'Zend2\Filter\Word\UnderscoreToDash',
        'word_underscoretodash'          => 'Zend2\Filter\Word\UnderscoreToDash',
        'word_underscore_to_dash'        => 'Zend2\Filter\Word\UnderscoreToDash',
        'word\\underscoretoseparator'    => 'Zend2\Filter\Word\UnderscoreToSeparator',
        'word\\underscore_to_separator'  => 'Zend2\Filter\Word\UnderscoreToSeparator',
        'word_underscoretoseparator'     => 'Zend2\Filter\Word\UnderscoreToSeparator',
        'word_underscore_to_separator'   => 'Zend2\Filter\Word\UnderscoreToSeparator',
    );
}
