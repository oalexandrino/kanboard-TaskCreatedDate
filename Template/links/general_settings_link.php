<li <?= $this->app->checkMenuSelection('TaskCreatedDateController', 'settings') ?>>
    <?= $this->url->link(t('TaskCreatedDate settings'), 'TaskCreatedDateController', 'settings', array('plugin' => 'TaskCreatedDate')) ?>
</li>