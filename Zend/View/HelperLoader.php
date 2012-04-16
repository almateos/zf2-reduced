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
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

namespace Zend2\View;

use Zend2\Loader\PluginClassLoader;

/**
 * Plugin Class Loader implementation for view helpers.
 *
 * @category   Zend2
 * @package    Zend2_View
 * @copyright  Copyright (c) 2005-2012 Zend2 Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class HelperLoader extends PluginClassLoader
{
    /**
     * @var array Pre-aliased view helpers
     */
    protected $plugins = array(
        'action'              => 'Zend2\View\Helper\Action',
        'basepath'            => 'Zend2\View\Helper\BasePath',
        'currency'            => 'Zend2\View\Helper\Currency',
        'cycle'               => 'Zend2\View\Helper\Cycle',
        'declarevars'         => 'Zend2\View\Helper\DeclareVars',
        'doctype'             => 'Zend2\View\Helper\Doctype',
        'escape'              => 'Zend2\View\Helper\Escape',
        'fieldset'            => 'Zend2\View\Helper\Fieldset',
        'formbutton'          => 'Zend2\View\Helper\FormButton',
        'formcheckbox'        => 'Zend2\View\Helper\FormCheckbox',
        'formcsrf'            => 'Zend2\View\Helper\FormCsrf',
        'formerrors'          => 'Zend2\View\Helper\FormErrors',
        'formfile'            => 'Zend2\View\Helper\FormFile',
        'formhidden'          => 'Zend2\View\Helper\FormHidden',
        'formimage'           => 'Zend2\View\Helper\FormImage',
        'formlabel'           => 'Zend2\View\Helper\FormLabel',
        'formmulticheckbox'   => 'Zend2\View\Helper\FormMultiCheckbox',
        'formnote'            => 'Zend2\View\Helper\FormNote',
        'formpassword'        => 'Zend2\View\Helper\FormPassword',
        'formradio'           => 'Zend2\View\Helper\FormRadio',
        'formreset'           => 'Zend2\View\Helper\FormReset',
        'formselect'          => 'Zend2\View\Helper\FormSelect',
        'formsubmit'          => 'Zend2\View\Helper\FormSubmit',
        'formtextarea'        => 'Zend2\View\Helper\FormTextarea',
        'formtext'            => 'Zend2\View\Helper\FormText',
        'form'                => 'Zend2\View\Helper\Form',
        'gravatar'            => 'Zend2\View\Helper\Gravatar',
        'headlink'            => 'Zend2\View\Helper\HeadLink',
        'headmeta'            => 'Zend2\View\Helper\HeadMeta',
        'headscript'          => 'Zend2\View\Helper\HeadScript',
        'headstyle'           => 'Zend2\View\Helper\HeadStyle',
        'headtitle'           => 'Zend2\View\Helper\HeadTitle',
        'htmlflash'           => 'Zend2\View\Helper\HtmlFlash',
        'htmllist'            => 'Zend2\View\Helper\HtmlList',
        'htmlobject'          => 'Zend2\View\Helper\HtmlObject',
        'htmlpage'            => 'Zend2\View\Helper\HtmlPage',
        'htmlquicktime'       => 'Zend2\View\Helper\HtmlQuicktime',
        'inlinescript'        => 'Zend2\View\Helper\InlineScript',
        'json'                => 'Zend2\View\Helper\Json',
        'layout'              => 'Zend2\View\Helper\Layout',
        'navigation'          => 'Zend2\View\Helper\Navigation',
        'paginationcontrol'   => 'Zend2\View\Helper\PaginationControl',
        'partialloop'         => 'Zend2\View\Helper\PartialLoop',
        'partial'             => 'Zend2\View\Helper\Partial',
        'placeholder'         => 'Zend2\View\Helper\Placeholder',
        'renderchildmodel'    => 'Zend2\View\Helper\RenderChildModel',
        'render_child_model'  => 'Zend2\View\Helper\RenderChildModel',
        'rendertoplaceholder' => 'Zend2\View\Helper\RenderToPlaceholder',
        'serverurl'           => 'Zend2\View\Helper\ServerUrl',
        'translator'          => 'Zend2\View\Helper\Translator',
        'url'                 => 'Zend2\View\Helper\Url',
        'viewmodel'           => 'Zend2\View\Helper\ViewModel',
        'view_model'          => 'Zend2\View\Helper\ViewModel',
    );
}
