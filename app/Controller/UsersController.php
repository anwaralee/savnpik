<?php
class UsersController extends AppController {

    //for admin theme
    public $theme = 'admin';
    
    // for pagination
    public $paginate = array(
        'limit' => 1
    );
    
    public function beforeFilter() {
        parent::beforeFilter();
          $role = $this->Auth->User('role');
            if($role==1){
            $this->admin_logout();
        }
        
    }

    public function admin_index() {
        $this->set('title_for_layout','Administrators List');
       // $this->User->recursive = 0;
        $this->set('users', $this->paginate('User'));
    }
    
    public function admin_loggedin(){
        
    }

    public function admin_view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    public function admin_add() {
        $this->theme = 'admin';
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('User has been added succesfully.','alert-box',array('class'=>'alert alert-success alert-dismissable'),'save');
                return $this->redirect(array('action' => 'index'));
            }
           $this->Session->setFlash('User could not be added','alert-box',array('class'=>'alert alert-warning alert-dismissable'),'warning');
        }
    }

    public function admin_edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
               $this->Session->setFlash('User has been updated succesfully.','alert-box',array('class'=>'alert alert-info alert-dismissable'),'update');
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash('User could not be updated','alert-box',array('class'=>'alert alert-warning alert-dismissable'),'warning');
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function admin_delete($id = null) {
        $this->request->onlyAllow('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
          $this->Session->setFlash('User has been deleted succesfully.','alert-box',array('class'=>'alert alert-danger alert-dismissable'),'delete');
            return $this->redirect(array('action' => 'index'));
        }
          $this->Session->setFlash('User could not be deleted','alert-box',array('class'=>'alert alert-warning alert-dismissable'),'warning');
        return $this->redirect(array('action' => 'index'));
    }
    
    
    public function admin_login() {
        $this->theme = 'admin-login';
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }
          
    public function index(){
            
    } 
    
    public function login() {
		 $this->layout = 'login';
        $this->theme = 'default';
        $this->set('title_for_layout','Login/Registration');
       if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }
    
    public function register(){
        $this->layout = 'login';
        $this->theme = 'default';
        $this->set('title_for_layout','Login/Registration');
      if ($this->request->is('post')) {
          //$count = $this->User->find('first', array('fields' => array('MAX(User.id) as max_count')))[0]['max_count'];
          $this->request->data['User']['auth_id'] = 'USER_'.($count + 1);
          $this->request->data['User']['role'] = 0;
          $this->request->data['User']['status'] = 1;
          
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('You have been registered succesfully. Please login to continue','alert-box',array('class'=>'alert alert-success alert-dismissable'),'save');
                return $this->redirect(array('action' => 'login'));
            }
           $this->Session->setFlash('User could not be added','alert-box',array('class'=>'alert alert-warning alert-dismissable'),'warning');
        }
    }
    
     public function logout() {
        return $this->redirect($this->Auth->logout());
    }
    
    public function admin_logout() {
        return $this->redirect($this->Auth->logout());
    }
    
    public function opauth_complete() {
		//print_r($this->data['auth']['info']);
		if($this->data['auth']['uid']==1251717032){
			echo "User Exists";
		}
		else {
				$this->set('opauth_data', $this->data);
		}
		$this->set('opauth_data', $this->data);
		
		
	}
    
        
}
?>
