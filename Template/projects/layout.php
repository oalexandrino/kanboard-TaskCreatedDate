<div class="page-header">
        <?php 
        $filters = array(
            'controller' => "KBFlowMetricsController",
            'action' => 'home',
            'project_id' => $project['id'],
            'search' => '',
            'plugin' => 'KanboardFlowMetrics',
        );
        ?>
        <?= $this->render('project_header/views', array('project' => $project, 'filters' => $filters)) ?>
</div>
<section class="sidebar-container">
    <?= $this->render($sidebar_template, array('project' => $project)) ?>
    <div class="sidebar-content">
        <?= $content_for_sublayout ?>
    </div>
</section>
