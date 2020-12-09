<?php
namespace Kanboard\Plugin\TaskCreatedDate\Model;
use Kanboard\Core\Base;
use Kanboard\Model\ProjectModel;

/**
 * TaskCreatedDateSettingsModel
 *
 * @package  Kanboard\Plugin\TaskCreatedDate\Model
 * @author   Olavo Alexandrino
 */
class TaskCreatedDateSettingsModel extends Base
{
    /**
     * SQL table name for TaskCreatedDate general settings
     *
     * @var string
     */
    const TABLE = 'task_created_date_general_settings';    

    /**
     * Updates TaskCreatedDate general settings
     *
     * @author   Olavo Alexandrino
     * @access public
     * @param  array    $values    Form values
     * @return bool
     */
    public function update(array $values)
    {
        $this->db->table(self::TABLE)->remove();
        return $this->db->table(self::TABLE)->save($values);
    }

    /**
     * Inserts the first record of TaskCreatedDate general settings
     *
     * @author   Olavo Alexandrino
     * @access public
     * @param  array    $values    Form values
     * @return bool
     */
    public function insert(array $values)
    {
        return $this->db->table(self::TABLE)->insert($values);
    }

    /**
     * Gets the TaskCreatedDate general settings
     *
     * @author   Olavo Alexandrino
     * @access public
     * @return array
     */
    public function get()
    {
        return $this->db->table(self::TABLE)->findOne();
    }    
}