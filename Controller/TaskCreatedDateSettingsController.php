<?php
namespace Kanboard\Plugin\TaskCreatedDate\Controller;
use Kanboard\Controller\BaseController;
use Kanboard\Plugin\TaskCreatedDate\Model\taskCreatedDateSettingsModel;

/**
 * TaskCreatedDateSettingsController Controller. It controls everything related to main settings of the plugin.
 * @author   Olavo Alexandrino
 */
class TaskCreatedDateSettingsController extends BaseController
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
            return $this->response->redirect($this->helper->url->to('TaskCreatedDateSettingsController', 'generalSettings', array('plugin' => 'TaskCreatedDate')), true);
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
    public function form()
    {
        $user = $this->getUser();
        
        $project = $this->getProject();        

        $this->response->html($this->taskCreatedDateLayoutHelper->show('TaskCreatedDate:task/creationdate', 
        array(
            'user' => $user,
            'project' => $project,            
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