<?php
class AdsController extends AppController{
	
		public $theme = 'admin';
	
		public $paginate = array(
        'limit' => 10
		);
	
		public $uses = array('Ad');
		
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
        
        public function admin_add()
        {
            if($this->request->is('post'))
            {
                var_dump($this->request->is('post'));die();
                if(!empty($this->data['Ad']['image']['name']))
                    {
                        $file = $this->data['Ad']['image']; //put the data into a var for easy use

                        $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                        $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions
                    
                        //only process if the extension is valid
                        if(in_array($ext, $arr_ext))
                        {
                                //do the actual uploading of the file. First arg is the tmp name, second arg is 
                                //where we are putting it
                                $uniqFileName = uniqid('COMP_').$file['name'];
                                
                                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'files/ads/'.$uniqFileName);
                                //pr($uniqFileName);
                                //prepare the filename for database entry
                                $this->request->data['Ad']['image'] = $uniqFileName;
                        }else{
                              $this->Session->setFlash('Advertisement Images could not be added. Please select a valid image','alert-box',array('class'=>'alert alert-warning alert-dismissable'),'warning');
                          return $this->redirect(array('action' => 'index'));    
                        
                        }
                    }else {
                        $this->request->data['Ad']['image'] = '';
                    }
                $this->Ad->create();
				if ($this->Ad->save($this->request->data)) {
					$this->Session->setFlash('Advertisement has been saved.','alert-box',array('class'=>'alert alert-success alert-dismissable'),'save');
                   return $this->redirect(array('action' => 'index'));
				}
				$this->Session->setFlash(__('Unable to add Advertisement .'));
            }
            
            
        }
    	public function admin_delete($id){
    	   $ad = $this->Ad->findById($id);
		 if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		 }
		 if ($this->Ad->delete($id)) {
		      $file = $ad['AD']['image'];
                        $filePath = WWW_ROOT . 'files/ads/'.$file;
            if (is_file($filePath))
                {
                   unlink($filePath);
                }
			 $this->Session->setFlash('Ads has been deleted.','alert-box',array('class'=>'alert alert-danger alert-dismissable'),'delete');
    		
            return $this->redirect(array('action' => 'admin_index'));
            }
    	
		}
  }
 ?>