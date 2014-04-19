<?php
require('src/facebook.php');
class UsersController extends AppController {

    //for admin theme
    public $theme = 'admin';
    
    // for pagination
    public $paginate = array(
        'limit' => 1
    );
    
    /*public function beforeFilter() {
        parent::beforeFilter();
          $role = $this->Auth->User('role');
            if($role==1){
            $this->admin_logout();
        }
        
    }*/

    public function admin_index() {
        $this->set('title_for_layout','User List');
       // $this->User->recursive = 0;
        $this->paginate = array('conditions'=>array('User.role'=>'0'));
        $this->set('users', $this->paginate('User'));
    }
    
    
    public function admin_loggedin(){
        
    }

    public function admin_view($id = null) {
        $this->loadModel('RewardFrom');
        $this->loadModel('Payment');
        $this->loadModel('Sale');
        $q = $this->User->findById($id);
        $this->set('user',$q);
        $q2 = $this->RewardFrom->find('all',array('conditions'=>array('user_id'=>$id)));
        $this->set('reward',$q2);
        $q3 = $this->Payment->find('all',array('conditions'=>array('user_id'=>$id)));
        $this->set('payment',$q3);
        $q4 = $this->Sale->find('all',array('conditions'=>array('user_id'=>$id)));
        $this->set('sales',$q4);
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
        if(!$this->request->is('post'))
        $this->redirect('register');
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
    public function fblogin()
    {
       $facebook = new Facebook(array(
          'appId' => '1422309588028572',
          'secret' => 'cad37dfe485ba3ada173ee620c61710c',
          'cookie' => false
        ));
         
        $user = $facebook->getUser();
        if(!$user){
            $scope = array('scope' => 'publish_stream,email');
        $this->redirect($facebook->getLoginUrl($scope));
        
        }
        if($user)
        {
            $this->Session->write('logoutUrl',$facebook->getLogoutUrl());
            $up = $facebook->api('/me');
            $q = $this->User->find('first',array('conditions'=>array('User.fbid'=>$user)));
               if(!$q)
               {
                    $this->User->create();
                    $arr['email'] = $up['email'];
                    $arr['full_name'] = $up['name'];
                    $arr['address'] = $up['hometown']['name'];
                    $arr['role'] = 0;
                    $arr['fbid'] = $user;
                    $arr['status'] = 1;
                    $arr['my_coin'] = '200';
                    $q2 = $this->User->find('first',array('conditions'=>array('User.username'=>$up['name'])));
                    if(!$q2)
                    $arr['username'] = $up['name'];
                    else
                    $arr['username'] = $up['name'].'_'.rand(1000,9999);
                    $this->User->save($arr);
                    $this->Session->write('Auth.User.username',$up['name']);
                    //$this->Session->write('Auth.User.username',$this->request->data['User']['username']);
                    $this->Session->write('Auth.User.email',$up['name']);
                    $this->Session->write('Auth.User.id',$this->User->id);
                    
               }
               else{
               $this->Session->write('Auth.User.username',$up['name']);
                    //$this->Session->write('Auth.User.username',$this->request->data['User']['username']);
                    $this->Session->write('Auth.User.email',$up['name']);
                    $this->Session->write('Auth.User.id',$q['User']['id']);
                    }
                    $this->redirect('/');
               
        }
    }
    public function register(){
        
        $this->layout = 'login';
        $this->theme = 'default';
        $this->set('title_for_layout','Login/Registration');
      if ($this->request->is('post')) {

          $counts = $this->User->find('first', array('fields' => array('MAX(User.id) as max_count')));
          $count = $counts[0]['max_count'];
          $this->request->data['User']['auth_id'] = 'USER_'.($count + 1);
          $this->request->data['User']['role'] = 0;
          $this->request->data['User']['status'] = 1;
          $this->request->data['User']['my_coin'] = '200';
          
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->write('Auth.User.username',$this->request->data['User']['username']);
                $this->Session->write('Auth.User.email',$this->request->data['User']['email']);
                $this->Session->write('Auth.User.id',$this->User->id);
                $this->Session->setFlash('You have been registered succesfully. Please login to continue','alert-box',array('class'=>'alert alert-success alert-dismissable'),'save');
                return $this->redirect('/');
            }
           $this->Session->setFlash('User could not be added','alert-box',array('class'=>'alert alert-warning alert-dismissable'),'warning');
        }
    }
    
     public function logout() {
        return $this->redirect($this->Auth->logout());
    }
    
    public function fblogout()
    {
        $url = $this->Session->read('logoutUrl');
        $this->Session->delete('Auth.User.id');
        $this->Session->delete('Auth.User.email');
        $this->Session->delete('Auth.User.username');
        $this->redirect($url);
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
