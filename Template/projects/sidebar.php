<div class="sidebar">
    <h2><?php print t('TaskCreatedDate'); ?></h2>
    <div class="flow-metrics-group"><?php print t('Actions'); ?></div>
    <?php if (array_key_exists('task_id',$_GET)): ?>
        <?php $task_id = $_GET["task_id"]; ?>      
        <ul>
            <li <?= $this->app->checkMenuSelection('TaskCreatedDateController', 'creationdate') ?>>
                <?= $this->modal->replaceLink(t('Updating the creation date'), 'TaskCreatedDateController', 'creationdate', array('task_id'=>$task_id, 'project_id' => $project['id'] , 'plugin' => 'TaskCreatedDate')) ?>
            </li>           
            <li <?= $this->app->checkMenuSelection('TaskCreatedDateController', 'warning') ?>>
                <?= $this->modal->replaceLink(t('Warning at updating this field'), 'TaskCreatedDateController', 'warning', array('task_id'=>$task_id, 'project_id' => $project['id'] , 'plugin' => 'TaskCreatedDate')) ?>
            </li>              
        </ul>    
    <?php endif ?>    
</div>  