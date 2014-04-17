<?php
class PageCategoriesController extends AppController{
	
		public $theme = 'admin';
	
		public $paginate = array(
        'limit' => 1
		);
		
		public function beforeFilter() {
			parent::beforeFilter();
			$role = $this->Auth->User('role');
            if($role!=2){
				$this->redirect($this->Auth->logout());
			}
        
		}
		
        public function admin_index(){
            
           $this->set('title_for_layout','Categories');
           $this->set('pageCategories', $this->paginate());
        }
        
        public function admin_add(){
				
			if ($this->request->is('post')) {
				$this->PageCategory->create();
				if ($this->PageCategory->save($this->request->data)) {
					$this->Session->setFlash('PageCategory has been saved.','alert-box',array('class'=>'alert alert-success alert-dismissable'),'save');
                   return $this->redirect(array('action' => 'index'));
				}
				$this->Session->setFlash(__('Unable to add PageCategory.'));
			}
		
		}	
		
		public function admin_edit($id = null){
			 if (!$id) {
				throw new NotFoundException(__('Invalid PageCategory'));
			}
			$pageCategory = $this->PageCategory->findById($id);
			
			 if (!$pageCategory) {
				throw new NotFoundException(__('Invalid PageCategory'));
			}
			
			 if ($this->request->is(array('post', 'put'))) {
				$this->PageCategory->id = $id;
				
				if ($this->PageCategory->save($this->request->data)) {
					$this->Session->setFlash('PageCategory has been saved.','alert-box',array('class'=>'alert alert-info alert-dismissable'),'update');
					return $this->redirect(array('action' => 'index'));
				}
				
				$this->Session->setFlash('PageCategory could not be updated','alert-box',array('class'=>'alert alert-warning alert-dismissable'),'warning');
			}

			if (!$this->request->data) {
				$this->request->data = $pageCategory;
			}
		}
		
		
		public function admin_delete($id){
			 if ($this->request->is('get')) {
				throw new MethodNotAllowedException();
			 }
			 if ($this->PageCategory->delete($id)) {
				 $this->Session->setFlash('PageCategory has been deleted.','alert-box',array('class'=>'alert alert-danger alert-dismissable'),'delete');
			
        return $this->redirect(array('action' => 'admin_index'));
    }
		
		}
	  protected function __findAllPages($id){
		//$pages = $this->Post->findByCategory_Id($id);
	  	return $this->redirect(array('action' => 'admin_index'));
	  }

}
?>