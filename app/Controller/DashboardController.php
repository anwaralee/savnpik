<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class DashboardController extends AppController
{
    function beforeFilter()
    {
        if(!$this->Session->read('Auth.User.username'))
        $this->redirect('/users/register');
        $this->loadModel('User');
        $this->loadModel('Sale');
    }
    public function index()
    {
        $carts = $this->Sale->find('all',array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id'))) );
        $this->set('carts',$carts);
    }
    function setting()
    {
        //var_dump($_POST);die();
        $passwordHasher = new SimplePasswordHasher();
        if(isset($_POST)&& $_POST)
        {
            $q = $this->User->find('first',array('conditions'=>array('username'=>$this->Session->read('Auth.User.username'))));
           if(isset($_POST['password'])){ 
           $pass = $passwordHasher->hash(
            $_POST['password']
        );
           
           if($q['User']['password']==$pass)
           {
              foreach($_POST['data']['User'] as $k=>$v)
              {
                $arr[$k] = $v;
                $passwordHasher = new SimplePasswordHasher();
        $arr['password'] = $passwordHasher->hash(
            $_POST['npassword']
        );
                //$arr['password'] = md5($_POST['npassword']);
                $this->User->id = $q['User']['id'];
                $this->User->save($arr);
                //$this->Session->setFlash('good','Data updates successfully!');
                $this->Session->setFlash('Data updates successfully!', 'default', array(), 'good');
                $this->redirect('setting');
              }
           }
           else
           {
            $this->Session->setFlash('Old Password do not match.', 'default', array(), 'bad');
            //$this->Session->setFlash('bad','Old Password do not match');
           // unset($_POST);
           $this->redirect('setting');
           }
           }
           else
           {
            foreach($_POST['data']['User'] as $k=>$v)
              {
                $arr[$k] = $v;
                //$arr['password'] = md5($_POST['npassword']);
                $this->User->id = $q['User']['id'];
                $this->User->save($arr);
                //$this->Session->setFlash('good','Data updates successfully!');
                $this->Session->setFlash('Data updates successfully!', 'default', array(), 'good');
                $this->redirect('setting');
              }
           }
        }
        $this->request->data = $this->User->find('first',array('conditions'=>array('User.username'=>$this->Session->read('Auth.User.username'))));
        //$this->set('model',$q);
        
    }
}