<?php
namespace Kanboard\Plugin\TaskCreatedDate\Controller;
use Kanboard\Controller\BaseController;
use Kanboard\Plugin\TaskCreatedDate\Model\TaskCreatedDateSettingsModel;
use Kanboard\Model\TaskModificationModel;
use Kanboard\Core\Controller\AccessForbiddenException;

/**
 * TaskCreatedDateController Controller. It controls everything related to main settings of the plugin.
 * @author   Olavo Alexandrino
 */
class TaskCreatedDateController extends BaseController
{
    /**
     * Returns the general settings
     * 
     * @author  Olavo Alexandrino
     * @return  array
     */    
    public function get()
    {
        $settings = $this->taskCreatedDateSettingsModel->get();
        return $settings;
    } 

    /**
     * Updates the date creation for a given task
     * 
     * @author  Olavo Alexandrino
     * @throws \Kanboard\Core\Controller\AccessForbiddenException
     * @return  void
     */       
    public function update_task()
    {
        $aux = true;
        $message = "";
        
        $task = $this->getTask();
        $user = $this->getUser();

        if (isset($task['owner_id']) && $user['id'] != $task['owner_id'] ) 
        {
            $aux = false;
            $message = 'You are not allowed to update tasks assigned to someone else.';
        }

        $values = $this->request->getValues();
        
        $values['id'] = $task['id'];
        $values['project_id'] = $task['project_id'];

        if (isset($values["date_creation"]) && !empty($values["date_creation"]))
        {
            $date = \DateTime::createFromFormat('d/m/Y H:i', $values["date_creation"]);
            $values["date_creation"] = $date->getTimestamp();
        }
        else
        {
            $aux = false;
            $message = 'You must provide a valid date.';              
        }

        if ($task['date_due'] > 0 && $values["date_creation"] >= $task['date_due'] )
        {
            $aux = false;
            $message = 'The provided date must be earlier than the task due date.';            
        }

        if ($task['date_started'] > 0 &&  $values["date_creation"] >= $task['date_started'] )
        {
            $aux = false;
            $message = 'The provided date must be earlier than the task started date.';            
        }        

        if ($task['date_completed'] > 0 &&  $values["date_creation"] >= $task['date_completed'] )
        {
            $aux = false;
            $message = 'The provided date must be earlier than the task completed date.';            
        }                
        
        if (!$aux)
        {
            $this->flash->failure(t($message));
            return $this->response->redirect($this->helper->url->to('TaskCreatedDateController', 'creationdate', array('task_id' => $task["id"] ,'project_id' => $task["project_id"] ,'plugin' => 'TaskCreatedDate')), true);
        }
        else
        {
            if ($this->taskModificationModel->update($values)) {
                $this->flash->success(t('Task updated successfully.'));
                return $this->response->redirect($this->helper->url->to('TaskCreatedDateController', 'creationdate', array('task_id' => $task["id"] ,'project_id' => $task["project_id"] ,'plugin' => 'TaskCreatedDate')), true);
            } else {
                $this->flash->failure(t('Unable to update your task.'));
                return $this->response->redirect($this->helper->url->to('TaskCreatedDateController', 'creationdate', array('task_id' => $task["id"] ,'project_id' => $task["project_id"] ,'plugin' => 'TaskCreatedDate')), true);
            }   
        }
    }

    /**
     * Updates the general settings
     * 
     * @author  Olavo Alexandrino
     * @return  void
     */       
    public function update()
    {
        $user = $this->getUser();
        $values = $this->request->getValues();
        $values["user_id"] = $user["id"];
        $settings = $this->taskCreatedDateSettingsModel->get();
        
        $aux = false;

        if (is_array($settings)) {
            if ($this->taskCreatedDateSettingsModel->update($values)) {
                $aux = true;
            }
        } else {
            if ($this->taskCreatedDateSettingsModel->insert($values)) {
                $aux = true;
            }
        }

        if ($aux) {
            $this->flash->success(t('General settings has been updated successfully.'));
            return $this->response->redirect($this->helper->url->to('TaskCreatedDateController', 'generalSettings', array('plugin' => 'TaskCreatedDate')), true);
        } else {
            $this->flash->failure(t('Unable to update.'));
        }

    }

    /**
     * Shows the form view to update the creation date of the given task
     * 
     * @author  Olavo Alexandrino
     * @return  void
     */     
    public function creationdate()
    {
        $user = $this->getUser();
        $project = $this->getProject();   
        $task = $this->getTask();

        $this->response->html($this->taskCreatedDateLayoutHelper->show('TaskCreatedDate:task/creationdate', 
        array(
            'user' => $user,
            'project' => $project,  
            'task' => $task,            
            'title' => t('TaskCreatedDate general settings'),
        )));  
    }

  /**
     * Shows the form view to update the creation date of the given task
     * 
     * @author  Olavo Alexandrino
     * @return  void
     */     
    public function warning()
    {
        $user = $this->getUser();
        
        $project = $this->getProject();        

        $this->response->html($this->taskCreatedDateLayoutHelper->show('TaskCreatedDate:task/warning', 
        array(
            'user' => $user,
            'project' => $project,            
            'title' => t('TaskCreatedDate general settings'),
        )));  
    }    
    

    /**
     * Shows the general settings view
     * 
     * @author  Olavo Alexandrino
     * @return  void
     */      
    public function generalSettings() 
    {
        $general_settings = $this->taskCreatedDateSettingsModel->get();
        $user = null;
        if (is_array($general_settings))
        {
            $user = $this->userModel->getById( $general_settings['user_id']);
            $general_settings = array(
                'enabled' => $general_settings['enabled'],
            );            
        }
        else 
        {
            $general_settings = array(
                'enabled' => "0",
            );   
        }
  
        $this->response->html($this->helper->layout->config('TaskCreatedDate:config/general_settings_view', 
        array(
            'title' => t('TaskCreatedDate general settings'),
            'user' => $user,
            'general_settings' => $general_settings,
        )));        
    }
}