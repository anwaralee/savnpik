<?php
App::uses('AppController', 'Controller');

class CartsController extends AppController {
	public $components = array('Paginator', 'Session');
    public $theme = 'default';


     public function beforeFilter() {
			parent::beforeFilter();
			
            if(!$this->Session->read('Auth.User.id')){
				$this->redirect($this->Auth->logout());
			}
        
		}
    public function index()
    {
        $carts = $this->Cart->find('all',array('conditions'=>array('buy_id'=>$this->Session->read('buy_id'),
                                                                    'user_id'=>$this->Session->read('Auth.User.id'))) );
        $this->set('carts',$carts);
    }
    
    
    public function addtocart($deal_id)
    {
        //$this->Session->destroy('buy_id');
        if(!$this->Session->read('buy_id'))
        {
            $buy_id = "SESS_".rand(3000,9999)."_".time();
            $this->Session->write('buy_id',$buy_id);
        }
        //echo $this->Session->read('buy_id');die();
        $cart['deals_id'] = $deal_id;
        $cart['buy_id'] = $this->Session->read('buy_id');
        $cart['qty'] = '1';
        $cart['user_id'] = $this->Session->read('Auth.User.id');
        
        $this->Cart->create();
        $this->Cart->save($cart);
        $this->redirect('index');
        
    }


}

?>