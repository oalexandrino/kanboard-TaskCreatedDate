<p>
<br>
    <?php 
        $project_id = $_GET["project_id"];
        $task_id = $_GET["task_id"];
    ?>
    <?= $this->url->link(t('Update the created date for this task'), 'TaskCreatedDateController', 'creationdate', array('task_id' => $task_id ,'project_id' => $project_id ,'plugin' => 'TaskCreatedDate')) ?>
</p>