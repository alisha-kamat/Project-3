<?php 
/**
 * Meta character count plugin
 * @author Alisha Kamat 
 *
 * @copyright (C) 2018 Open Source Matters, Inc. <https://www.joomla.org>
 * @license   GNU General Public License version 2 or later; see LICENSE.txt
 * @since     4.0
 */

defined('_JEXEC') or die();
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\WebAsset\WebAssetManager;
use  \Joomla\CMS\Application\CMSApplication;
use Joomla\Component\Fields\Administrator\Helper\FieldsHelper;

/**
 * Meta character count plugin 
 *
 * @since 4.0
 */
class PlgContentMetaCharacterCount extends CMSPlugin
{
    /**
     * Application object
     *
     * @var   \Joomla\CMS\Application\CMSApplication
     * @since 3.2
     */
    protected $app;
    function __construct($event, $params)
    {
        parent::__construct($event, $params);
    }
    /**
     * Listener for the `onContentPrepareForm` event
     *
     * @return void
     * @since  1.0
     */
    public function onContentPrepareForm(JForm $form, $data)
    {
        if (!Factory::getApplication()->isClient('administrator')) {
            return;
        }

        if (Factory::getDocument()->getType() !== 'html') {
            return;
        }

        $jinput = Factory::getApplication()->input;
        $option = $jinput->get('option');
        $view = $jinput->get('view');
        $execute = false;

        if ($option == 'com_content' && $view == 'article') {
            $execute = true;
        }
        if (!$execute) {
            return;
        }
        $plg_params['params'] = $this->params;
        $plg_params['AK_META_CHARACTERS_LEFT'] 
            = JText::_('AK_META_CHARACTERS_LEFT');

        // Load JavaScript
        Factory::getDocument()->getWebAssetManager()
            ->registerAndUseScript(
                'plg_content_metacharactercount_js', 
                'media/plg_content_metacharactercount/js/script.js', 
                [], ['defer' => true]
            );
    }

}