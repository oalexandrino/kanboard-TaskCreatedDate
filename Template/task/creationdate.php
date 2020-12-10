<?php if ($this->app->isAjax()): ?>
    <div class="page-header">
        <h2><?= $this->text->e($project['name']) ?> &gt; <?= t('Edit the task creation date') ?></h2>
    </div>
<?php else: ?>
    <div class="page-header">
        <h2><?= t('Edit the task creation date') ?></h2> 
    </div>
<?php endif ?>
<fieldset>
    <legend><?= t("Warning") ?></legend> 
        <p class="alert">
            <?= t("Before updating this field, have a look at the"); ?> 
            <?= $this->modal->replaceLink(t('warning messsage'), 'TaskCreatedDateController', 'warning', array('task_id'=>$task['id'], 'project_id' => $project['id'] , 'plugin' => 'TaskCreatedDate')) ?>.
        </p>
</fieldset>          
<fieldset>
    <legend><?= t("Task details") ?></legend>    
    <?= $this->render('task/details', array(
    'task' => $task,
    'project' => $project,
    'editable' => $this->user->hasProjectAccess('TaskModificationController', 'edit', $project['id']),
    )) ?>
</fieldset>   
<fieldset>
    <form 
    method="post" 
    action="<?= $this->url->href(
        'TaskCreatedDateController', 
        'update_task', 
        array('project_id' => $project['id'],'task_id' => $task['id'], 'redirect' => 'creationdate', 'plugin' => 'TaskCreatedDate')) 
    ?>" 
    autocomplete="off">    
        <legend><?= t("New creation date") ?></legend>    
        <?= $this->form->csrf() ?>
    <?= $this->helper->form->datetime(t('Current created date'), 'date_creation', $task)?>
    <?= $this->modal->submitButtons(array('tabindex' => 13)) ?>
    </form>
</fieldset>     

