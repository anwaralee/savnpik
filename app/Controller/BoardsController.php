<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class BoardsController extends AppController{
    
    public $theme = 'admin';
    
    public function beforeFilter() {
        parent::beforeFilter();
          $role = $this->Auth->User('role');
            if($role==0){
            $this->redirect("/admin/users/login");
        }
        
    }
    function admin_index(){
        
        $role = $this->Auth->User('role');
        if($role==1){
            $this->set('title_for_layout','Admin Dashboard');
        }
        else if($role==2){
                $this->set('title_for_layout','Super Admin Dashboard');
        }
        else
        {
            //if($this->Auth->role != 1 && $this->Auth->role!=2)
        $this->redirect('/admin');
        }
        
    }
    function admin_settings()
    {
        $this->loadModel('User');
        $user = $this->User->findById($this->Session->read('Auth.User.id'));
        $this->set('user',$user);
        if(isset($_POST['submit']))
        {
            $un = $_POST['User']['username'];
            $email = $_POST['User']['email'];
            if($this->User->find('first',array('conditions'=>array('username'=>$un,'id <> '.$user['User']['id']))))
            {
                $this->Session->setFlash('Username already taken.Choose a new username.', 'default', array(), 'bad');
                $this->redirect('settings');
                
            }
            elseif($this->User->find('first',array('conditions'=>array('email'=>$email,'id <> '.$user['User']['id']))))
            {
                $this->Session->setFlash('Email already used', 'default', array(), 'bad');
                $this->redirect('settings');
                
            }
            else
            {
                $this->User->id = $user['User']['id'];
                foreach($_POST['User'] as $k=>$v)
                {
                    $arr[$k] = $v;
                    $this->User->save($arr);
                }
                $this->Session->setFlash('User Settings Updated', 'default', array(), 'good');
                $this->redirect('index');
                
            }
        }
        
    }
    function admin_changepassword()
    {
        if(isset($_POST['submit']))
        {
            $this->loadModel('User');
            $user = $this->User->findById($this->Session->read('Auth.User.id'));
            //var_dump($user);die();
            $passwordHasher = new SimplePasswordHasher();
            $pass = $passwordHasher->hash($_POST['User']['oldpassword']);
           //echo "<br>";
           //echo $user['User']['password']; die(); 
           if($user['User']['password']== $pass)
           {
                //die(2);
                $passwordHasher = new SimplePasswordHasher();
                $arr['password'] = $_POST['User']['password'];
                //$arr['password'] = md5($_POST['npassword']);
                $this->User->id = $user['User']['id'];
                $this->User->save($arr);
                //$this->Session->setFlash('good','Data updates successfully!');
                $this->Session->setFlash('Password changed successfully!', 'default', array(), 'good');
                $this->redirect('index');
              
           }
           else
           {
            //die('1');
            
            $this->Session->setFlash('Old Password do not match.', 'default', array(), 'bad');
            //$this->Session->setFlash('bad','Old Password do not match');
           // unset($_POST);
           $this->redirect('changepassword');
           }
            
        }
    }
    
}
?>