<?php if (array_key_exists('task_id',$_GET)): ?>
    <p>
    <br>
        <?php 
            $project_id = $_GET["project_id"];
            $task_id = $_GET["task_id"];
        ?>
        <?= $this->url->link(t('Update the creation date for this task'), 'TaskCreatedDateController', 'warning', array('task_id' => $task_id ,'project_id' => $project_id ,'plugin' => 'TaskCreatedDate')) ?>
    </p>
<?php endif ?>