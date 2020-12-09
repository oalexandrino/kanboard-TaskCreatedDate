<div class="flow-metrics-content">
    <div class="page-header">
        <h2><?= t('TaskCreatedDate General settings') ?></h2>
    </div>

    <form method="post" action="<?= $this->url->href('TaskCreatedDateSettingsController', 'update', array('plugin' => 'TaskCreatedDate')) ?>" autocomplete="off">

        <?= $this->form->csrf() ?>
        <fieldset>
            <legend><?= t('Plugin enabled?') ?></legend>
            <?= $this->form->radios('enabled', array(
                    '1' => t('Sim'),
                    '0' => t('Não'),
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