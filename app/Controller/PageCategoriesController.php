<?php
class PagesController extends AppController{
	
		public $theme = 'admin';
	
		public $paginate = array(
        'limit' => 1
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
            
           $this->set('title_for_layout','Page Items');
           $this->set('pages', $this->paginate());
        }
        
        public function admin_add(){
			$this->set('pageCategories',$this->PageCategory->find('list'));
			
			if ($this->request->is('post')) {
				$this->Page->create();
				if ($this->Page->save($this->request->data)) {
					$this->Session->setFlash('Page has been saved.','alert-box',array('class'=>'alert alert-success alert-dismissable'),'save');
                   return $this->redirect(array('action' => 'index'));
				}
				$this->Session->setFlash(__('Unable to add Page .'));
			}
		
		}	
		
		public function admin_edit($id = null){
			 if (!$id) {
				throw new NotFoundException(__('Invalid Page'));
			}
			$Page = $this->Page->findById($id);
			$this->set('pageCategories',$this->PageCategory->find('list'));
			
			 if (!$Page) {
				throw new NotFoundException(__('Invalid Page'));
			}
			
			 if ($this->request->is(array('post', 'put'))) {
				$this->Page->id = $id;
				
				if ($this->Page->save($this->request->data)) {
					$this->Session->setFlash('Page has been saved.','alert-box',array('class'=>'alert alert-info alert-dismissable'),'update');
					return $this->redirect(array('action' => 'index'));
				}
				
				$this->Session->setFlash('Page could not be updated','alert-box',array('class'=>'alert alert-warning alert-dismissable'),'warning');
			}

			if (!$this->request->data) {
				$this->request->data = $Page;
			}
		}
		
		
		public function admin_delete($id){
			 if ($this->request->is('get')) {
				throw new MethodNotAllowedException();
			 }
			 if ($this->Page->delete($id)) {
				 $this->Session->setFlash('Page has been deleted.','alert-box',array('class'=>'alert alert-danger alert-dismissable'),'delete');
			
        return $this->redirect(array('action' => 'admin_index'));
    }
		
		}
        
    function generate_slug($title)
    {
        
      $slug = $title;
      $whiteSpace = '';  //if you dnt even want to allow white-space set it to ''
            $pattern = '/[^a-zA-Z0-9-'  . $whiteSpace . ']/u';
            $slug = preg_replace($pattern, '_', (string) $slug);
            for($i=0;$i<5;$i++)
            {
                $slug = str_replace('__','',$slug);
                $last = substr($slug, -1);
                if($last == '_')
                {
                    $slug = str_replace('_',' ',$slug);
                    $slug = trim($slug);
                    $slug = str_replace(' ','_',$slug);
                }
                $check = $this->Page->find('first',array('conditions'=>array('slug'=>$slug)));
                if($check)
                $slug = $slug.'_'.rand('1000,9999');                
            }
            return $slug;  
    }
    
        
        

}
?>