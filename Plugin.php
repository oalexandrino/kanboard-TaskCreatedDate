<?php

namespace Kanboard\Plugin\TaskCreatedDate;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;

class Plugin extends Base
{
    public function initialize()
    {
        $this->attachTemplates();
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginName()
    {
        return 'TaskCreatedDate';
    }

    public function getPluginDescription()
    {
        return t('This plugin allows you to update the created date for a given task.');
    }

    public function getPluginAuthor()
    {
        return 'Olavo Alexandrino';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/kanboard/plugin-myplugin';
    }

    /**
     * Attached the templates of the current plugin
     *
     * @author   Olavo Alexandrino
     * @return void
     */ 
    private function attachTemplates() 
    {
        $settings = $this->generalSettingsController->get();
        if (is_array($settings))
        {
            if($settings['enabled'] == 1)
            {
                $this->template->hook->attach('template:task:form:second-column', 'TaskCreatedDate:task/creationdatelink');
            }
        }
        $this->template->hook->attach('template:config:sidebar', 'TaskCreatedDate:links/general_settings_link');
    }    

    /**
     * Sets the classes used by the plugin
     *
     * @author   Olavo Alexandrino
     * @return void
     */ 
    public function getClasses()
    {
      return [
          'Plugin\TaskCreatedDate\Controller' => [
              'TaskCreatedDateController',
          ],
          'Plugin\TaskCreatedDate\Helper' => [
              'TaskCreatedDateLayoutHelper',
              'TaskCreatedDateHelper', 
          ],          
          'Plugin\TaskCreatedDate\Model' => [
              'TaskCreatedDateSettingsModel',
          ]
          
      ];
    }   

    
}

