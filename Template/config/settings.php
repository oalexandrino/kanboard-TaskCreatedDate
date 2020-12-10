<div class="flow-metrics-content">
    <div class="page-header">
        <h2><?= t('TaskCreatedDate  settings') ?></h2>
    </div>
    <form method="post" action="<?= $this->url->href('TaskCreatedDateController', 'update_settings', array('plugin' => 'TaskCreatedDate')) ?>" autocomplete="off">
        <?= $this->form->csrf() ?>
        <fieldset>
            <legend><?= t('Plugin enabled?') ?></legend>
            <?= $this->form->radios('enabled', array(
                    '1' => t('Yes'),
                    '0' => t('No'),
                ),
                $general_settings
            ) ?>        
        </fieldset>        
        <div class='flow-metrics-paragraph'>
            <?= t('Last configuration defined by') ?>:
            <b>
                <?php if (is_array($user)): ?>
                    <?php print ($user['name']); ?>
                <?php else: ?>
                    <?= t('Configuration never set.') ?>
                <?php endif;?>
            </b>
        </div>        
        <div class="form-actions">
            <button type="submit" class="btn btn-blue"><?= t('Save') ?></button>
        </div>
    </form>
</div>            