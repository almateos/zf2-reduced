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
 * @package    Zend2_Dojo
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

namespace Zend2\Dojo\View;

use Zend2\Loader\PluginClassLoader;

/**
 * Plugin Class Loader implementation for Dojo view helpers.
 *
 * @category   Zend2
 * @package    Zend2_Dojo
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class HelperLoader extends PluginClassLoader
{
    /**
     * @var array Pre-aliased view helpers
     */
    protected $plugins = array(
        'accordioncontainer' => 'Zend2\Dojo\View\Helper\AccordionContainer',
        'accordionpane'      => 'Zend2\Dojo\View\Helper\AccordionPane',
        'bordercontainer'    => 'Zend2\Dojo\View\Helper\BorderContainer',
        'button'             => 'Zend2\Dojo\View\Helper\Button',
        'checkbox'           => 'Zend2\Dojo\View\Helper\CheckBox',
        'combobox'           => 'Zend2\Dojo\View\Helper\ComboBox',
        'contentpane'        => 'Zend2\Dojo\View\Helper\ContentPane',
        'currencytextbox'    => 'Zend2\Dojo\View\Helper\CurrencyTextBox',
        'customdijit'        => 'Zend2\Dojo\View\Helper\CustomDijit',
        'datetextbox'        => 'Zend2\Dojo\View\Helper\DateTextBox',
        'dijitcontainer'     => 'Zend2\Dojo\View\Helper\DijitContainer',
        'dijit'              => 'Zend2\Dojo\View\Helper\Dijit',
        'dojo'               => 'Zend2\Dojo\View\Helper\Dojo',
        'editor'             => 'Zend2\Dojo\View\Helper\Editor',
        'filteringselect'    => 'Zend2\Dojo\View\Helper\FilteringSelect',
        'dojoform'           => 'Zend2\Dojo\View\Helper\DojoForm',
        'horizontalslider'   => 'Zend2\Dojo\View\Helper\HorizontalSlider',
        'numberspinner'      => 'Zend2\Dojo\View\Helper\NumberSpinner',
        'numbertextbox'      => 'Zend2\Dojo\View\Helper\NumberTextBox',
        'passwordtextbox'    => 'Zend2\Dojo\View\Helper\PasswordTextBox',
        'radiobutton'        => 'Zend2\Dojo\View\Helper\RadioButton',
        'simpletextarea'     => 'Zend2\Dojo\View\Helper\SimpleTextarea',
        'slider'             => 'Zend2\Dojo\View\Helper\Slider',
        'splitcontainer'     => 'Zend2\Dojo\View\Helper\SplitContainer',
        'stackcontainer'     => 'Zend2\Dojo\View\Helper\StackContainer',
        'submitbutton'       => 'Zend2\Dojo\View\Helper\SubmitButton',
        'tabcontainer'       => 'Zend2\Dojo\View\Helper\TabContainer',
        'textarea'           => 'Zend2\Dojo\View\Helper\Textarea',
        'textbox'            => 'Zend2\Dojo\View\Helper\TextBox',
        'timetextbox'        => 'Zend2\Dojo\View\Helper\TimeTextBox',
        'validationtextbox'  => 'Zend2\Dojo\View\Helper\ValidationTextBox',
        'verticalslider'     => 'Zend2\Dojo\View\Helper\VerticalSlider',
    );
}
