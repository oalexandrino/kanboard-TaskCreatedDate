<?php if ($this->app->isAjax()): ?>
    <div class="page-header">
        <h2><?= $this->text->e($project['name']) ?> &gt; <?= t('Warning message') ?></h2>
    </div>
<?php else: ?>
    <div class="page-header">
        <h2><?= t('Warning message') ?></h2> 
    </div>
<?php endif ?>
<fieldset>
    <legend><?= t("Task details") ?></legend>    
    <?= $this->render('task/details', array(
    'task' => $task,
    'project' => $project,
    'editable' => $this->user->hasProjectAccess('TaskModificationController', 'edit', $project['id']),
    )) ?>
</fieldset> 
<p class="alert">
    <?= t("Dear administrator "); ?><b><?php print ($user['name']); ?></b>,
</p>
<p class="alert">
    <?= t("Changing the task creation dates is a procedure that requires attention, responsibility, sincerity and respect for the team involved, as it will directly interfere the project's flow metrics. "); ?>
</p>
<p class="alert">
    <?= t("
It should be done only by administrators and when there is a need to include an old task or when you forget to create a task at the right time." ); ?>
</p>
<p class="alert">
    <?= t("You should not take advantage of this functionality because it will decrease or increase the lead time, reaction time, cycle time, and other insights of your team performance."); ?>
</p>
<p class="alert">
    <?= t("Keep in mind that every change (who did it and when did it) will be recorded at"); ?>
    <?= $this->modal->replaceLink(t('activity stream'), 'ActivityController', 'task', array('task_id'=>$task['id'], 'project_id' => $project['id'] )) ?>
    <?= t("of the this task."); ?>
</p>