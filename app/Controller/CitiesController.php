<?php
    class CitiesController extends AppController {
		
		public $theme = 'admin';
		public $paginate = array(
        'limit' => 1
		);
		
		public function beforeFilter() {
			parent::beforeFilter();
			$role = $this->Auth->User('role');
            if($role==1){
				$this->redirect($this->Auth->logout());
			}
        
		}
		
        public function admin_index(){
            
           $this->set('title_for_layout','View Cities');
           $this->set('cities', $this->paginate());
        }
        
        public function admin_add(){
				
			if ($this->request->is('post')) {
				$this->City->create();
				if ($this->City->save($this->request->data)) {
					$this->Session->setFlash('City has been saved.','alert-box',array('class'=>'alert alert-success alert-dismissable'),'save');
                   return $this->redirect(array('action' => 'index'));
				}
				$this->Session->setFlash(__('Unable to add City.'));
			}
		
		}	
		
		public function admin_edit($id = null){
			 if (!$id) {
				throw new NotFoundException(__('Invalid City'));
			}
			$city = $this->City->findById($id);
			
			 if (!$city) {
				throw new NotFoundException(__('Invalid City'));
			}
			
			 if ($this->request->is(array('post', 'put'))) {
				$this->City->id = $id;
				
				if ($this->City->save($this->request->data)) {
					$this->Session->setFlash('City has been saved.','alert-box',array('class'=>'alert alert-info alert-dismissable'),'update');
					return $this->redirect(array('action' => 'index'));
				}
				
				$this->Session->setFlash('City could not be updated','alert-box',array('class'=>'alert alert-warning alert-dismissable'),'warning');
			}

			if (!$this->request->data) {
				$this->request->data = $city;
			}
		}
		
		
		public function admin_delete($id){
			 if ($this->request->is('get')) {
				throw new MethodNotAllowedException();
			 }
			 if ($this->City->delete($id)) {
				 $this->Session->setFlash('City has been deleted.','alert-box',array('class'=>'alert alert-danger alert-dismissable'),'delete');
			
        return $this->redirect(array('action' => 'admin_index'));
    }
		
		}
    }
?>
