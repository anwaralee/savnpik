<?php
class AdsController extends AppController{
	
		public $theme = 'admin';
	
		public $paginate = array(
        'limit' => 10
		);
	
		public $uses = array('Page', 'PageCategory');
		
		public function beforeFilter() {
			parent::beforeFilter();
			$role = $this->Auth->User('role');
            if($role!=2){
				$this->redirect($this->Auth->logout());
			}
        
		}
        
         public function admin_index(){
            
           $this->set('title_for_layout','Adverstisement');
           $this->set('ads', $this->paginate());
        }
  }
 ?>