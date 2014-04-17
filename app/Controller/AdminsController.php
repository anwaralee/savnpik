<?php
class AdminsController extends AppController{
    
    public $theme = 'admin';
    
    public function index(){
        
        $this->theme = 'admin-login';
        $this->set('title_for_layout', 'Login | Admin');
    }
    
    public function dashboard(){
              
    }
    
   
}
?>