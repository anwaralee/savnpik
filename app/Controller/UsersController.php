<?php
require('src/facebook.php');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class UsersController extends AppController {
    public $components = array('Email');
    //for admin theme
    public $theme = 'admin';
    
    // for pagination
    public $paginate = array(
        'limit' => 1
    );
    
    public function beforeFilter() {
        parent::beforeFilter();
        if(!$this->Session->read('lang'))
            $this->Session->write('lang','e');
          $role = $this->Auth->User('role');
            if($role==1)
            {
            //$this->admin_logout();
            }
        
    }

    public function admin_index() {
        $this->set('title_for_layout','User List');
       // $this->User->recursive = 0;
        $this->paginate = array('conditions'=>array('User.role'=>'0'));
        $this->set('users', $this->paginate('User'));
    }
    
    
    public function admin_loggedin()
    {
        
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
          
    public function index()
    {
            
    } 
    
    public function login() {
        if(isset($_GET['url']))
        {
            
            $url = ($_GET['url']);
            $url = str_replace(array("http:/",urlencode("http:/")),array("",""),$url);
            if(str_replace(array("http://",urlencode("http://")),array("",""),$url)==$url)
                $url = "http://".$url;
           else
                $url = $url;
                //echo $url;
            //$url = urldecode($url);
                
            
        }
        if(!$this->request->is('post'))
        $this->redirect('register');
		 $this->layout = 'login';
        $this->theme = 'default';
        $this->set('title_for_layout','Login/Registration');
       if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->write('role',$this->Auth->User('role'));
                if(isset($_GET['url']))
                {
                    
                    $url = ($_GET['url']);
                    $url = str_replace(array("http:/",urlencode("http:/")),array("",""),$url);
                    if(str_replace(array("http://",urlencode("http://")),array("",""),$url)==$url)
                        $url = "http://".$url;
                   else
                        $url = $url;
                        //echo $url;
                    $url = urldecode($url);
                    //die($url);     
                    $this->redirect($url);
                }
                else
                     $this->redirect("/carts");
                
            }
            $this->Session->setFlash('Invalid username or password, try again','default',array(),'bad');
            if(isset($url))
                $u = "?url=".$url;
            else
                $u = "";
            $this->redirect('register'.$u);
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
                    $q =  $this->User->find('first',array('conditions'=>array('User.email'=>$up['email'])));
                    if(!$q)
                    {
                        $arr['email'] = $up['email'];
                    }
                    else
                    {
                        
                    }
                    
                    $arr['full_name'] = $up['name'];
                    //$arr['email'] = $up['email'];
                    if(isset($up['hometown']['name']))
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
                    $this->Session->write('Auth.User.username',$arr['username']);
                    //$this->Session->write('Auth.User.username',$this->request->data['User']['username']);
                    
                    $this->Session->write('Auth.User.id',$this->User->id);
                    $this->Session->write('Auth.User.email',$up['email']);
                    $this->Session->write('Auth.User.role',0);
                    $this->loadModel('RewardFrom');
                    $arr2['user_id'] = $this->User->id;
                    $arr2['coins'] = '200';
                    $arr2['reward_date'] = date('Y-m-d');
                    $arr2['remark'] = 'Registration';
                    $this->RewardFrom->create();
                    $this->RewardFrom->save($arr2); 
                    
               }
               else{
               $this->Session->write('Auth.User.username',$up['name']);
                    //$this->Session->write('Auth.User.username',$this->request->data['User']['username']);
                    $this->Session->write('Auth.User.email',$up['email']);
                    $this->Session->write('Auth.User.id',$q['User']['id']);
                    $this->Session->write('Auth.User.role',0);
               }
               if(isset($_GET['url']))
                {
                    
                    $url = ($_GET['url']);
                    $url = str_replace(array("http:/",urlencode("http:/")),array("",""),$url);
                    if(str_replace(array("http://",urlencode("http://")),array("",""),$url)==$url)
                        $url = "http://".$url;
                   else
                        $url = $url;
                        //echo $url;
                    $url = urldecode($url);
                    //die($url);     
                    $this->redirect($url);
                }
                else
                    $this->redirect('/carts');
               
        }
    }
    public function register(){
        
        $this->layout = 'login';
        $this->theme = 'default';
        $this->set('title_for_layout','Login/Registration');
        if(isset($_GET['url']))
        {
            
            $url = ($_GET['url']);
            $url = str_replace(array("http:/",urlencode("http:/")),array("",""),$url);
            if(str_replace(array("http://",urlencode("http://")),array("",""),$url)==$url)
                $url = "http://".$url;
           else
                $url = $url;
                //echo $url;
            //$url = urldecode($url);
                
            
        }
      if ($this->request->is('post')) {
          $q =  $this->User->find('first',array('conditions'=>array('User.email'=>$this->request->data['User']['email'])));
            if($q)
            {
                $this->Session->setFlash('The email address is already in use','default',array(),'bad');
                if(isset($url))
                    $u = "?url=".$url;
                else
                    $u = "";
                $this->redirect('register'.$u);
            }
          $counts = $this->User->find('first', array('fields' => array('MAX(User.id) as max_count')));
          $count = $counts[0]['max_count'];
          $this->request->data['User']['auth_id'] = 'USER_'.($count + 1);
          $this->request->data['User']['role'] = 0;
          $this->request->data['User']['status'] = 1;
          $this->request->data['User']['my_coin'] = '200';
          
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                
                $this->loadModel('RewardFrom');
                    $arr2['user_id'] = $this->User->id;
                    $arr2['coins'] = '200';
                    $arr2['reward_date'] = date('Y-m-d');
                    $arr2['remark'] = 'Registration';
                    $this->RewardFrom->create();
                    $this->RewardFrom->save($arr2);
                
                
                $this->Session->write('Auth.User.username',$this->request->data['User']['username']);
                $this->Session->write('Auth.User.email',$this->request->data['User']['email']);
                $this->Session->write('Auth.User.id',$this->User->id);
                $this->Session->write('Auth.User.role',0);
                $this->Session->setFlash('You have been registered succesfully. Please login to continue','alert-box',array('class'=>'alert alert-success alert-dismissable'),'save');
                if(isset($_GET['url']))
                {
                    
                    $url = ($_GET['url']);
                    $url = str_replace(array("http:/",urlencode("http:/")),array("",""),$url);
                    if(str_replace(array("http://",urlencode("http://")),array("",""),$url)==$url)
                        $url = "http://".$url;
                   else
                        $url = $url;
                        //echo $url;
                    $url = urldecode($url);
                    //die($url);     
                    $this->redirect($url);
                }
                else
                return $this->redirect('/carts');
            }
           $this->Session->setFlash('User could not be added','alert-box',array('class'=>'alert alert-warning alert-dismissable'),'warning');
        }
    }
    
     public function logout() {
         $city = $this->Session->read('city');
          $role = $this->Session->read('Auth.User.role');
         //die('here');
        $this->Session->destroy();
        $this->Session->write('city',$city);
        if($role ==1 || $role == 2)
            $url = "/admin";
        else
            $url= "register";
        $this->redirect($url);
    }
    
    public function fblogout()
    {
        
        $city = $this->Session->read('city');
        $this->Session->destroy();
        $this->Session->write('city',$city);
        if($url = $this->Session->read('logoutUrl'))
            $this->redirect($url);
        else
            $this->redirect('/');
    }
    
    public function admin_logout() {
        $city = $this->Session->read('city');
         $role = $this->Session->read('Auth.User.role');
         //die('here');
        $this->Session->destroy();
        $this->Session->write('city',$city);
        if($role ==1 || $role == 2)
            $url = "/admin";
        else
            $url= "register";
        $this->redirect($url);
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
    public function gplus(){
        //die('here');
        $arr['email'] = $_POST['email'];
        $arr['full_name'] = $_POST['name'];
        //$arr['username'] = $_POST['name'];
        $arr['fbid'] = 'gplus';
        $q2 = $this->User->find('first',array('conditions'=>array('User.username'=>$_POST['name'])));
        $q1 = $this->User->find('first',array('conditions'=>array('User.email'=>$_POST['email'],'fbid'=>$arr['fbid'])));
        
        $q =  $this->User->find('first',array('conditions'=>array('User.email'=>$_POST['email'],'fbid'=>'')));
        if($q)
        {
            //$this->Session->setFlash('The email address associated to your gmail account is already in use','default',array(),'bad');
            echo "already";
            die();
        }
                    if(!$q1)
                    $this->User->create();                    
                    //$arr['email'] = $arr['email'];
                    //$arr['full_name'] = $up['name'];
                    //$arr['address'] = $up['hometown']['name'];
                    $arr['role'] = 0;
                    
                    $arr['status'] = 1;
                    $arr['my_coin'] = '200';
                    
                    if(!$q2)
                    $arr['username'] = $_POST['name'];
                    else
                    $arr['username'] = $_POST['name'].'_'.rand(1000,9999);
                    if(!$q1){
                    $this->User->save($arr);
                    
                    $this->loadModel('RewardFrom');
                    $arr2['user_id'] = $this->User->id;
                    $arr2['coins'] = '200';
                    $arr2['reward_date'] = date('Y-m-d');
                    $arr2['remark'] = 'Registration';
                    $this->RewardFrom->create();
                    $this->RewardFrom->save($arr2);
                    
                    }
                    
                    $this->Session->write('gplus','1');
                    
                    $this->Session->write('Auth.User.username',$arr['username']);
                    $this->Session->write('Auth.User.role',0);
                    //$this->Session->write('Auth.User.username',$this->request->data['User']['username']);
                    $this->Session->write('Auth.User.email',$arr['email']);
                    if(!$q1)
                    $this->Session->write('Auth.User.id',$this->User->id);
                    else
                    $this->Session->write('Auth.User.id',$q1['User']['id']);
                    
                    die();
    }
    public function gpluslogout()
    {
        $city = $this->Session->read('city');
        $this->Session->destroy();
        $this->Session->write('city',$city);
        die('here');      
        
    }
    function forgot()
    {
        $this->layout = 'login';
        $this->theme = 'default';
        $this->set('title_for_layout','Forgot Password');
        if(isset($_POST['email']))
        {
            $q = $this->User->find('first',array('conditions'=>array('email'=>$_POST['email'],'fbid'=>'')));
            if($q)
            {
                $r = rand(100000,999999);
                $emails = new CakeEmail();
                $emails->to($_POST['email']);
                $emails->from(array('noreply@savnpik.com'=>'Savnpik'));
                $emails->subject("Recover Password");
                $emails->emailFormat('html');
                $msg = "Hi there,<br/><br/>We recently received a request from you to change your SAVNPIK.COM account password. <br/>Here is your new login detail:<br/>
                Username : ".$q['User']['username']."<br/>
                Password : ".$r."<br/>
                <br/><br/>";
                $msg .= "Regards,<br/>SAVNPIK.COM";
                $emails->send($msg);
                $this->User->id = $q['User']['id'];
                $passwordHasher = new SimplePasswordHasher();
                $pass = $passwordHasher->hash($r);
                $this->User->id = $q['User']['id'];
                $this->User->saveField('password',$r);
                $this->Session->setFlash('New password has been sent to '.$_POST['email'],'default',array(),'good');
            }
            else
            {
                $this->Session->setFlash('We could not find the email associated to SAVNPIK.COM','default',array(),'bad');
            }
            $this->redirect('forgot');
        }
    }
    
    function admin_forgotpass()
    {
        //die('2');
        //$this->layout = 'login';
        $this->theme = 'admin-login';
        $this->set('title_for_layout','Forgot Password');
        if(isset($_POST['email']))
        {
            $q = $this->User->find('first',array('conditions'=>array('email'=>$_POST['email'],'fbid'=>'')));
            if($q)
            {
                $r = rand(100000,999999);
                $emails = new CakeEmail();
                $emails->to($_POST['email']);
                $emails->from(array('noreply@savnpik.com'=>'Savnpik'));
                $emails->subject("Recover Password");
                $emails->emailFormat('html');
                $msg = "Hi there,<br/><br/>We recently received a request from you to change your SAVNPIK.COM account password. <br/>Here is your new login detail:<br/>
                        Username : ".$q['User']['username']."<br/>
                        Password : ".$r."<br/>
                        <br/><br/>";
                $msg .= "Regards,<br/>SAVNPIK.COM";
                $emails->send($msg);
                $this->User->id = $q['User']['id'];
                $passwordHasher = new SimplePasswordHasher();
                $pass = $passwordHasher->hash($r);
                $this->User->id = $q['User']['id'];
                $this->User->saveField('password',$r);
                $this->Session->setFlash('New password has been sent to '.$_POST['email'],'default',array(),'good');
            }
            else
            {
                $this->Session->setFlash('We could not find the email associated to SAVNPIK.COM','default',array(),'bad');
            }
            $this->redirect('forgotpass');
        }
    }
    
        
}
?>
