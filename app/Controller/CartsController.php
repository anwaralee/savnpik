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
    
    
    public function addtocart($deal_id,$price)
    {
        //$this->Session->destroy('buy_id');
        if(!$this->Session->read('buy_id'))
        {
            $buy_id = "SESS_".rand(3000,9999)."_".time();
            $this->Session->write('buy_id',$buy_id);
        }
        //echo $this->Session->read('buy_id');die();
        $cart['deals_id'] = $deal_id;
        if($c = $this->Cart->find('first',array('conditions'=>array('deals_id'=>$deal_id,'user_id'=>$this->Session->read('Auth.User.id'),'buy_id'=>$this->Session->read('buy_id')))))
        {
            //echo $c['Cart']['qty']+1;die();
            $qty = $c['Cart']['qty'];
            $qty = $qty++;
            $price = $qty*$c['Deal']['selling_price'];
            $this->Cart->id =$c['Cart']['id'];
            $this->Cart->saveField('qty',$qty);
            $this->Cart->saveField('price',$price);
        }
        else
        {
            $cart['buy_id'] = $this->Session->read('buy_id');
            $cart['qty'] = '1';
            $cart['price'] = $price;
            $cart['user_id'] = $this->Session->read('Auth.User.id');
        
            $this->Cart->create();
            $this->Cart->save($cart);
        }
        $this->redirect('index');
        
    }
    
    public function delete($cid)
    {
        $this->Cart->delete($cid);
         $this->redirect('index');
        
        
    }


}

?>