<?php if ($this->app->isAjax()): ?>
    <div class="page-header">
        <h2><?= $this->text->e($project['name']) ?> &gt; <?= t('Warning message') ?></h2>
    </div>
<?php else: ?>
    <div class="page-header">
        <h2><?= t('Warning message') ?></h2> 
    </div>
<?php endif ?>
<?= t("Changing the task creation dates is a procedure that requires attention, responsibility, sincerity and respect for the team involved, as it will directly interfere the system's flow metrics. It should be done only by administrators and when there is a need to include an old task or when you forget to create a task at the right time. You should not take advantage of this functionality to decrease or increase the lead time, reaction time or cycle time."); ?>