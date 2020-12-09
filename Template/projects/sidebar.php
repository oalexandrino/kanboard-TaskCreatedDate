<div class="sidebar">
      <h2><?php print t('TaskCreatedDate'); ?></h2>
      <div class="flow-metrics-group"><?php print t('Actions'); ?></div>
    <?php 
    $task_id = $_GET["task_id"];
    ?>      
    <ul>
        <li <?= $this->app->checkMenuSelection('TaskCreatedDateSettingsController', 'form') ?>>
            <?= $this->modal->replaceLink(t('Updating the creation date'), 'TaskCreatedDateSettingsController', 'form', array('task_id'=>$task_id, 'project_id' => $project['id'] , 'plugin' => 'TaskCreatedDate')) ?>
        </li>           
        <li <?= $this->app->checkMenuSelection('TaskCreatedDateSettingsController', 'warning') ?>>
            <?= $this->modal->replaceLink(t('Warning at updating this field'), 'TaskCreatedDateSettingsController', 'warning', array('task_id'=>$task_id, 'project_id' => $project['id'] , 'plugin' => 'TaskCreatedDate')) ?>
        </li>              
    </ul>        
  </div>  