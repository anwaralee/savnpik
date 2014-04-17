<?php
App::uses('AppController', 'Controller');
/**
 * Deals Controller
 *
 * @property Deal $Deal
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DealsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
    
    public $theme = 'admin';
    
    public function beforeFilter() {
			parent::beforeFilter();
			$role = $this->Auth->User('role');
            if($role==2){
				$this->redirect($this->Auth->logout());
			}
        
		}
   
/**
 * index method
 *
 * @return void
 */
	public function index() 
    {
        
		$this->Deal->recursive = 0;
		$this->set('deals', $this->Paginator->paginate());
	}
    
    public function all(){
        $this->loadModel('DealCategory');
        $cat = $this->DealCategory->find('all',array('conditions'=>array('status'=>'1')));
           
           return $cat;
    }
    public function allcompany()
    {
        $this->loadModel('Company');
        $this->loadModel('City');
        $city = $this->City->find('first',array('conditions'=>array('City.name'=>Inflector::humanize(str_replace("-"," ",$this->Session->read('city'))))));
        return $this->Company->find('all',array('conditions'=>array('City.name'=>Inflector::humanize(str_replace("-"," ",$this->Session->read('city'))))));
    }
    
    public function listcity()
    {
        $this->loadModel('City');
        return $this->City->find('all');
    }
    
    public function city($city,$cat ="") {
        $this->Session->write('city',$city);
        $this->loadModel('City');
        $this->loadModel('DealCategory');
        $this->theme = 'default';
        $this->set('title_for_layout','Savnpik | Home');
       
        $cityId = $this->City->find('all',array('conditions'=>array('City.name'=>Inflector::humanize(str_replace("-"," ",$city)))));
     if(!empty($cityId)){
        $cond = array('Company.city_id' => $cityId[0]['City']['id']);
        $cond1 = array('Company.city_id' => $cityId[0]['City']['id']);
        array_push($cond, array('Deal.expiry_date >="'.date('Y-m-d').'"'));
        array_push($cond1, array('Deal.expiry_date >="'.date('Y-m-d').'"'));
         if($cat != "")
        {
            $catId = $this->DealCategory->find('first',array('conditions'=>array('DealCategory.name'=>Inflector::humanize(str_replace("-"," ",$cat)))));
            array_push($cond,array('Deal.deal_category_id' => $catId['DealCategory']['id']));
              
        }
        else
        {
            array_push($cond1,array('is_featured'=>'1'));            
            $this->set('feature',$this->Deal->find('first',array('conditions'=>$cond1)));
        }
        $this->set('cityDeals',$this->Deal->find('all', array(
        'conditions' => $cond,
        'order'=>array('buy_count'=>'desc','is_featured'=>'desc') 
            )));
                                    
                                  
     } else {
        $this->set('cityDeals','');
     }
    }
    public function stores($city,$store ="") {
        $this->Session->write('city',$city);
        $this->loadModel('City');
        $this->loadModel('Company');
        $this->theme = 'default';
        $this->set('title_for_layout','Savnpik | Home');
       
        //$cityId = $this->Company->find('all',array('conditions'=>array('City.name'=>Inflector::humanize(str_replace("-"," ",$city)))));
        if($store != "")
        {
            $cityId = $this->City->find('first',array('conditions'=>array('City.name'=>Inflector::humanize(str_replace("-"," ",$city)))));
            if(!empty($cityId)){
            $cond = array('Company.city_id'=>$cityId['City']['id']);
            array_push($cond, array('Deal.expiry_date >="'.date('Y-m-d').'"'));
            }
            array_push($cond, array('Company.name'=>Inflector::humanize(str_replace("-"," ",$store))));
            $this->set('company',$this->Company->find('first',array('conditions'=>array('Company.name'=>str_replace("-"," ",$store)))));
        }
     if($deals = $this->Deal->find('all', array(
        'conditions' => $cond,
        'order'=>array('buy_count'=>'desc','is_featured'=>'desc') 
            )))
        {
            $this->set('cityDeals',$deals);                        
            
                        
                                
     } 
     else 
     {
        $this->set('cityDeals','');
     }
    }
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Deal->exists($id)) {
			throw new NotFoundException(__('Invalid deal'));
		}
		$options = array('conditions' => array('Deal.' . $this->Deal->primaryKey => $id));
		$this->set('deal', $this->Deal->find('first', $options));
	}
    
    public function detail($slug = null) {
		$this->theme = 'default';
		$options = array('conditions' => array('Deal.slug' => $slug));
		$this->set('deal', $this->Deal->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Deal->create();
			if ($this->Deal->save($this->request->data)) {
				$this->Session->setFlash(__('The deal has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The deal could not be saved. Please, try again.'));
			}
		}
		$dealCategories = $this->Deal->DealCategory->find('list');
		$companies = $this->Deal->Company->find('list');
		$this->set(compact('dealCategories', 'companies'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Deal->exists($id)) {
			throw new NotFoundException(__('Invalid deal'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Deal->save($this->request->data)) {
				$this->Session->setFlash(__('The deal has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The deal could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Deal.' . $this->Deal->primaryKey => $id));
			$this->request->data = $this->Deal->find('first', $options);
		}
		$dealCategories = $this->Deal->DealCategory->find('list');
		$companies = $this->Deal->Company->find('list');
		$this->set(compact('dealCategories', 'companies'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Deal->id = $id;
		if (!$this->Deal->exists()) {
			throw new NotFoundException(__('Invalid deal'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Deal->delete()) {
			$this->Session->setFlash(__('The deal has been deleted.'));
		} else {
			$this->Session->setFlash(__('The deal could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
    
        $this->Deal->recursive = 0;
		$this->set('deals', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Deal->exists($id)) {
			throw new NotFoundException(__('Invalid deal'));
		}
		$options = array('conditions' => array('Deal.' . $this->Deal->primaryKey => $id));
		$this->set('deal', $this->Deal->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
			if ($this->request->is('post')) {
                for($i=1;$i<=10;$i++) {
                        
                        //$oldmask = umask(0);
                        //mkdir("\files\deals\\".$this->data['Deal']['name'], 0777);
                        //umask($oldmask);
                        
                if(!empty($this->data['Deal']['image'.$i]['name']))
                    {
                        $file = $this->data['Deal']['image'.$i]; //put the data into a var for easy use

                        $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                        $arr_ext = array('jpg', 'jpeg', 'gif'); //set allowed extensions
                    
                        //only process if the extension is valid
                        if(in_array($ext, $arr_ext))
                        {
                                //do the actual uploading of the file. First arg is the tmp name, second arg is 
                                //where we are putting it
                                $uniqFileName = uniqid('COMP_').$file['name'];
                                
                                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'files/deals/'.$uniqFileName);
                                //pr($uniqFileName);
                                //prepare the filename for database entry
                                $this->request->data['Deal']['image'.$i] = $uniqFileName;
                        }else{
                              $this->Session->setFlash('Deal Images could not be added. Please select a valid image','alert-box',array('class'=>'alert alert-warning alert-dismissable'),'warning');
                          return $this->redirect(array('action' => 'index'));    
                        
                        }
                    }else {
                        $this->request->data['Deal']['image'.$i] = '';
                    }
                }
                  $this->Deal->create();
              if ($this->Deal->save($this->request->data)) {
                    $id = $this->Deal->id;
                    $this->Deal->id = $id;
                    
                    $this->Deal->saveField('slug',$this->generate_slug($this->request->data['Deal']['name']));
					$this->Session->setFlash('Deals has been saved.','alert-box',array('class'=>'alert alert-success alert-dismissable'),'save');
                   return $this->redirect(array('action' => 'index'));
				}
            
				$this->Session->setFlash(__('Unable to add a new Deal.'));
            
			}
        
        
		$dealCategories = $this->Deal->DealCategory->find('list');
		$companies = $this->Deal->Company->find('list');
		$this->set(compact('dealCategories', 'companies'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Deal->exists($id)) {
			throw new NotFoundException(__('Invalid deal'));
		}
        $deal = $this->Deal->findById($id);
		if ($this->request->is(array('post', 'put'))) {
            $this->Deal->id = $id;
            for($i=1;$i<=10;$i++){
				if(empty($this->request->data['Deal']['image'.$i]['name'])){
                    $this->request->data['Deal']['image'.$i] = $deal['Deal']['image'.$i];
                   
                }
                else {
                        $file = $this->data['Deal']['image'.$i]; //put the data into a var for easy use

                        $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                        $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions

                        //only process if the extension is valid
                        if(in_array($ext, $arr_ext))
                        {
                                //do the actual uploading of the file. First arg is the tmp name, second arg is 
                                //where we are putting it
                                $uniqFileName = uniqid('COMP_').$file['name'];
                                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'files/deals/' .$uniqFileName);

                                //prepare the filename for database entry
                                $this->request->data['Deal']['image'.$i] = $uniqFileName;
                             $file = $deal['Deal']['image'.$i];
                            $filePath = WWW_ROOT . 'files/deals/'.$file;
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
        }
			if ($this->Deal->save($this->request->data)) {
				$this->Session->setFlash(__('The deal has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The deal could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Deal.' . $this->Deal->primaryKey => $id));
			$this->request->data = $this->Deal->find('first', $options);
		}
        
        
		$dealCategories = $this->Deal->DealCategory->find('list');
		$companies = $this->Deal->Company->find('list');
		$this->set(compact('dealCategories', 'companies'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
	
        $deal = $this->Deal->findById($id);
   
      
	 if ($this->request->is('get')) {
				throw new MethodNotAllowedException();
			 }
			 if ($this->Deal->delete($id)) {
                    for($i=1;$i<=10;$i++) {
                        $file = $deal['Deal']['image'.$i];
                        $filePath = WWW_ROOT . 'files/deals/'.$file;
            if (is_file($filePath))
                {
                   unlink($filePath);
                }
        }
				 $this->Session->setFlash('Deal has been deleted.','alert-box',array('class'=>'alert alert-danger alert-dismissable'),'delete');
			
        return $this->redirect(array('action' => 'admin_index'));
		
	}
    }
    function create_slug()
    {
     $q = $this->Deal->find('all',array('conditions'=>array('slug'=>'')));
     foreach($q as $s)
     {
         $slug = $s['Deal']['name'];
        
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
             $check = $this->Deal->find('first',array('conditions'=>array('Deal.slug'=>$slug,'Deal.id <>'=>$s['Deal']['id'])));
             if($check)
             $slug = $slug.'_'.$s['Deal']['id'];                
         }
         $this->Deal->id = $s['Deal']['id'];
         $this->Deal->saveField('slug',$slug);
     }
    die();
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
                $check = $this->Deal->find('first',array('conditions'=>array('slug'=>$slug)));
                if($check)
                $slug = $slug.'_'.rand('1000,9999');                
            }
            return $slug;  
    }
    function get_realated($cid,$name='',$id)
    {
        $filter = array('the','The','in','In','on','On','for','For','of','Of','A','a','an','An');
        $arr = explode(' ',$name);
        $i=0;
        $final = 'Deal.deal_category_id = '.$cid.' AND Deal.id <>'.$id;
        $fin = '';
        foreach($arr as $a)
        {
            $i++;
            if(!in_array($a,$filter))
            if($i==1)
            $fin = $fin." AND (Deal.name like '%$a%'";
            else
            $fin = $fin.' OR '."Deal.name like '%$a%'";
            
        }
        if(!empty($arr))
        $fin = $fin.')';
        $final = $final.$fin;
        $rel1 = $this->Deal->find('all',array('conditions'=>array($final),'limit'=>4));
        
        if(count($rel1)==4)
        {
            return $rel1;
        }
        else{
        $count = count($rel1);
        $count = 4-$count;
        }
        $final2 = 'Deal.deal_category_id = '.$cid;

        $rel2 = $this->Deal->find('all',array('conditions'=>array($final2,'Deal.id NOT IN (SELECT id FROM deals WHERE '.$final.')'),'limit'=>$count));

        array_push($rel1,$rel2);
        if(count($rel2) == $count)
        {
            return $rel1;
        }
        else
        $count = $count-count($rel2);
        //$final2 = 'Deal.deal_category_id = '.$cid;
        if(!empty($arr))
        $rel3 = $this->Deal->find('all',array('conditions'=>array(str_replace(' AND ','',$fin),'Deal.id NOT IN (SELECT id FROM deals WHERE '.$final.')','Deal.id NOT IN (SELECT id From deals where '.$final2.' AND Deal.id NOT IN (SELECT id FROM deals WHERE '.$final.'))'),'limit'=>$count));
        array_push($rel1,$rel3);        
        return $rel1;  
            
    }
}
