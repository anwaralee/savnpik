<?php
class BoardsController extends AppController{
    
    public $theme = 'admin';
    
    function admin_index(){
        $role = $this->Auth->User('role');
        if($role==1){
            $this->set('title_for_layout','Admin Dashboard');
        }
        else if($role==2){
                $this->set('title_for_layout','Super Admin Dashboard');
        }
        
    }
}
?>