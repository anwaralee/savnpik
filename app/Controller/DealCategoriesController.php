<?php
    class DealCategoriesController extends AppController {
		
		public $theme = 'admin';
		public $paginate = array(
        'limit' => 1
		);
		
		public function beforeFilter() {
			parent::beforeFilter();
			$role = $this->Auth->User('role');
            if($role==2||$role==0){
				$this->redirect("/admin/users/login");
			}
        
		}
		
        public function admin_index(){
            
           $this->set('title_for_layout','View Deal Categories');
           $this->set('dealCategories', $this->paginate());
        }
        
        public function admin_add(){
				
			if ($this->request->is('post')) {
				$this->DealCategory->create();
				if ($this->DealCategory->save($this->request->data)) {
					$this->Session->setFlash('Deal Category has been saved.','alert-box',array('class'=>'alert alert-success alert-dismissable'),'save');
                   return $this->redirect(array('action' => 'index'));
				}
				$this->Session->setFlash(__('Unable to add Deal Category.'));
			}
		
		}	
		
		public function admin_edit($id = null){
			 if (!$id) {
				throw new NotFoundException(__('Invalid Deal Category'));
			}
			$deal_category = $this->DealCategory->findById($id);
			
			 if (!$deal_category) {
				throw new NotFoundException(__('Invalid Deal Category'));
			}
			
			 if ($this->request->is(array('post', 'put'))) {
				$this->DealCategory->id = $id;
				
				if ($this->DealCategory->save($this->request->data)) {
					$this->Session->setFlash('Deal Category has been saved.','alert-box',array('class'=>'alert alert-info alert-dismissable'),'update');
					return $this->redirect(array('action' => 'index'));
				}
				
				$this->Session->setFlash('Deal Category could not be updated','alert-box',array('class'=>'alert alert-warning alert-dismissable'),'warning');
			}

			if (!$this->request->data) {
				$this->request->data = $deal_category;
			}
		}
		
		
		public function admin_delete($id){
			 if ($this->request->is('get')) {
				throw new MethodNotAllowedException();
			 }
			 if ($this->DealCategory->delete($id)) {
				 $this->Session->setFlash('Deal Category has been deleted.','alert-box',array('class'=>'alert alert-danger alert-dismissable'),'delete');
			
                return $this->redirect(array('action' => 'admin_index'));
            }
		
		}
        
       
    }
?>
