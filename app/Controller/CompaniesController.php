<?php
    class CompaniesController extends AppController {
		
		public $theme = 'admin';
		public $paginate = array(
        'limit' => 1
		);
		var $uses = array('Company','City');
        
		public function beforeFilter() {
			parent::beforeFilter();
			$role = $this->Auth->User('role');
            if($role==2||$role==0){
				$this->redirect($this->Auth->logout());
			}
        
		}
		
        public function admin_index(){
            
           $this->set('title_for_layout','View Companies / Providers');
           $this->set('companies', $this->paginate());
        }
        
        public function admin_add(){
				
			if ($this->request->is('post')) {
                if(!empty($this->data['Company']['logo']['name']))
                    {
                        $file = $this->data['Company']['logo']; //put the data into a var for easy use

                        $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                        $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions

                        //only process if the extension is valid
                        if(in_array($ext, $arr_ext))
                        {
                                //do the actual uploading of the file. First arg is the tmp name, second arg is 
                                //where we are putting it
                                $uniqFileName = uniqid('COMP_').$file['name'];
                                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/uploads/companies/' .$uniqFileName);

                                //prepare the filename for database entry
                                $this->request->data['Company']['logo'] = $uniqFileName;
                        }
                    }
                  
                    $this->Company->create();
				if ($this->Company->save($this->request->data)) {
					$this->Session->setFlash('Company has been saved.','alert-box',array('class'=>'alert alert-success alert-dismissable'),'save');
                   return $this->redirect(array('action' => 'index'));
				}
            
				$this->Session->setFlash(__('Unable to add a new Company.'));
			}
		  
            $this->set('cities',$this->City->find('list'));
		}	
		
    public function admin_edit($id = null) {
			 if (!$id) {
				throw new NotFoundException(__('Invalid Company'));
			}
        
			$company = $this->Company->findById($id);
			//this->request->data['Company']['logo'] = $company['Company']['logo'];
		
            if (!$company) {
				throw new NotFoundException(__('Invalid Company'));
			}
			
			 if ($this->request->is(array('post', 'put'))) {
				$this->Company->id = $id;
				if(empty($this->request->data['Company']['logo']['name'])){
                    $this->request->data['Company']['logo'] = $company['Company']['logo'];
                   
                }
                else {
                        $file = $this->data['Company']['logo']; //put the data into a var for easy use

                        $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                        $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions

                        //only process if the extension is valid
                        if(in_array($ext, $arr_ext))
                        {
                                //do the actual uploading of the file. First arg is the tmp name, second arg is 
                                //where we are putting it
                                $uniqFileName = uniqid('COMP_').$file['name'];
                                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/uploads/companies/' .$uniqFileName);

                                //prepare the filename for database entry
                                $this->request->data['Company']['logo'] = $uniqFileName;
                             $file = $company['Company']['logo'];
                            $filePath = WWW_ROOT . 'img/uploads/companies/'.$file;
                            if (is_file($filePath))
                            {
                                unlink($filePath);
                            }
                        }
                    else {
                        $this->Session->setFlash('Company could not be updated. Please select a valid image','alert-box',array('class'=>'alert alert-warning alert-dismissable'),'warning');
                        return $this->redirect(array('action' => 'index'));
                    }
                    }
           
                 
              if ($this->Company->save($this->request->data)) {
                
					$this->Session->setFlash('Company has been saved.','alert-box',array('class'=>'alert alert-info alert-dismissable'),'update');
					return $this->redirect(array('action' => 'index'));
				}
				
				$this->Session->setFlash('Company could not be updated','alert-box',array('class'=>'alert alert-warning alert-dismissable'),'warning');
			}
            $this->set('cities',$this->City->find('list'));
            $this->set('companyById',$company);
                
			if (!$this->request->data) {
				$this->request->data = $company;
			}
		}
		
		
		public function admin_delete($id){
            
            $company = $this->Company->findById($id);
      
            $file = $company['Company']['logo'];
            $filePath = WWW_ROOT . 'img/uploads/companies/'.$file;
      
			 if ($this->request->is('get')) {
				throw new MethodNotAllowedException();
			 }
			 if ($this->Company->delete($id)) {
                  if (is_file($filePath))
                {
                    unlink($filePath);
                }
				 $this->Session->setFlash('Company has been deleted.','alert-box',array('class'=>'alert alert-danger alert-dismissable'),'delete');
			
        return $this->redirect(array('action' => 'admin_index'));
    }
		
		}
        
    public function admin_view($id=null){
        
        $this->set('title_for_layout','Company Details');
		if(!$id){
			throw new NotFoundException(__('Invalid Post'));
		}

		$company = $this->Company->findById($id);
		if(!$company){
			throw new NotFoundException(__('Invalid Company'));
		}
		$this->set('company',$company);
	}
 }
?>
