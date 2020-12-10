<li <?= $this->app->checkMenuSelection('TaskCreatedDateController', 'generalSettings') ?>>
    <?= $this->url->link(t('TaskCreatedDate'), 'TaskCreatedDateController', 'generalSettings', array('plugin' => 'TaskCreatedDate')) ?>
</li>