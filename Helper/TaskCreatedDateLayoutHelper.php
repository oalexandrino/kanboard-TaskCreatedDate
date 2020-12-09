<?php
namespace Kanboard\Plugin\TaskCreatedDate\Helper;
use Kanboard\Helper\LayoutHelper;
use Kanboard\Core\Base;

/**
 * Layout Helper
 *
 * @package helper
 * @author  Olavo Alexandrino
 */
class TaskCreatedDateLayoutHelper extends LayoutHelper
{
    /**
     * Common layout for flowMetrics views
     *
     * @access public
     * @param  string $template
     * @param  array  $params
     * @return string
     */
    public function show($template, array $params)
    {
        if (isset($params['project']['name'])) {
            $params['title'] = $params['project']['name'].' &gt; '.$params['title'];
        }

        $general_settings = $this->taskCreatedDateSettingsModel->get();

        if (is_array($general_settings))
        {
            return $this->subLayout('TaskCreatedDate:projects/layout', 'TaskCreatedDate:projects/sidebar', $template, $params, true);
        }
    }
}
