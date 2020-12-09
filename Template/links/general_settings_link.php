<li <?= $this->app->checkMenuSelection('TaskCreatedDateSettingsController', 'generalSettings') ?>>
    <?= $this->url->link(t('TaskCreatedDate'), 'TaskCreatedDateSettingsController', 'generalSettings', array('plugin' => 'TaskCreatedDate')) ?>
</li>