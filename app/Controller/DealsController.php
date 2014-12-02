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
	public $components = array('Paginator', 'Session','Email');
    
    public $theme = 'admin';
    
     public function beforeFilter() {
			parent::beforeFilter();
			if(!$this->Session->read('lang'))
            $this->Session->write('lang','e');
            $this->Auth->allow('city');
            if(!$this->Session->read('lang'))
                $this->Session->write('lang','en');
                
            
            
            //var_dump($role);die();
            
            //die('2');            
        
		}
    
   
/**
 * index method
 *
 * @return void
 */
 public function sharethis()
    {
        $this->layout ='test';
    }   
	public function index() 
    {
        
		$this->Deal->recursive = 0;
		$this->set('deals', $this->Paginator->paginate());
	}
    
    public function all(){
        $this->loadModel('DealCategory');
        $cat = $this->DealCategory->find('all',array('conditions'=>array('status'=>'1'),'order'=>'name'));
           
           return $cat;
    }
         
    public function deal_count($cat_id)
    {
        $this->loadModel('City');
        $city = $this->City->find('first',array('conditions'=>array('City.name'=>Inflector::humanize(str_replace("-"," ",$this->Session->read('city'))))));
        return $this->Deal->find('count',array('conditions'=>array('deal_category_id'=>$cat_id,
                                                'expiry_date>="'.date('Y-m-d').'"',
                                                'Company.city_id' => $city['City']['id'])));

        
    }
    public function deal_countbycompany($comp_id)
    {
        $this->loadModel('City');
        $city = $this->City->find('first',array('conditions'=>array('City.name'=>Inflector::humanize(str_replace("-"," ",$this->Session->read('city'))))));
        return $this->Deal->find('count',array('conditions'=>array('Deal.company_id'=>$comp_id,
                                                'expiry_date>="'.date('Y-m-d').'"',
                                                'Company.city_id' => $city['City']['id'])));

        
    }
    public function allcompany()
    {
        $this->loadModel('Company');
        $this->loadModel('City');
        $city = $this->City->find('first',array('conditions'=>array('City.name'=>Inflector::humanize(str_replace("-"," ",$this->Session->read('city'))))));
        return $this->Company->find('all',array('conditions'=>array('City.name'=>Inflector::humanize(str_replace("-"," ",$this->Session->read('city')))),'order'=>'Company.name'));
    }
    
    public function listcity()
    {
        $this->loadModel('City');
        return $this->City->find('all');
    }
    
    public function city($city,$cat ="") {
        $cond1= array();
        $this->Session->write('city',$city);
        $this->loadModel('City');
        $this->loadModel('DealCategory');
        $this->theme = 'default';
        $this->set('title_for_layout','Savnpik | Home');
       
        $cityId = $this->City->find('all',array('conditions'=>array('City.name'=>Inflector::humanize(str_replace("-"," ",$city)))));
     if(!empty($cityId)){
        $cond = array('Company.city_id' => $cityId[0]['City']['id']);
        $cond1 = array('Company.city_id' => $cityId[0]['City']['id']);
        array_push($cond, array('Deal.expiry_date >= "'.date('Y-m-d').'"'));
        array_push($cond1, array('Deal.expiry_date >= "'.date('Y-m-d').'"'));
        array_push($cond1, array('Deal.image1 <> ""'));
         if($cat != "")
        {
            $catId = $this->DealCategory->find('first',array('conditions'=>array('DealCategory.name'=>Inflector::humanize(str_replace("-"," ",$cat)))));
            array_push($cond,array('Deal.deal_category_id' => $catId['DealCategory']['id']));
            $this->set('Cat',ucfirst(str_replace("-"," ",$cat)));
              
        }
        else
        {
            //die('here');
            $this->set('nocat',1);
            array_push($cond1,array('is_featured'=>'1')); 
            if($feature =  $this->Deal->find('first',array('conditions'=>$cond1 ,'order' => array('rand()'))))
            {
                
                   $f_id = $feature['Deal']['id']; 
                    array_push($cond ,array('Deal.id <> '.$f_id));         
                $features[0] =$feature;
                $this->set('features',$features);
            }
            else
            $this->set('features',array());

        }
        $this->paginate= array('conditions'=>$cond,'order'=>array('buy_count'=>'desc','is_featured'=>'desc'),'limit'=>'8');
        $deal = $this->paginate('Deal');
        $this->set('count',$this->Deal->find('count',array('conditions'=>$cond)));
        $this->set('cityDeals',$deal);
                                    
                                  
     } else {
        $this->set('cityDeals','');
     }
    }
    public function stores($city,$store ="") {
        $this->Session->write('city',$city);
        $this->loadModel('City');
        $this->loadModel('Company');
        $this->theme = 'default';
        $this->set('title_for_layout','Savnpik | Stores');
       
        //$cityId = $this->Company->find('all',array('conditions'=>array('City.name'=>Inflector::humanize(str_replace("-"," ",$city)))));
        if($store != "")
        {
            $cityId = $this->City->find('first',array('conditions'=>array('City.name'=>Inflector::humanize(str_replace("-"," ",$city)))));
            if(!empty($cityId)){
                $cond = array('Company.city_id'=>$cityId['City']['id']);
                array_push($cond, array('Deal.expiry_date >="'.date('Y-m-d').'"'));
            }
            array_push($cond, array('Company.name'=>Inflector::humanize(str_replace("-"," ",$store))));
            $this->set('company',$this->Company->find('first',
                                array('conditions'=>array('Company.name'=>str_replace("-"," ",$store)))));
        }
        //var_dump( $cond);
        $this->paginate= array('conditions'=>$cond,'order'=>array('buy_count'=>'desc','is_featured'=>'desc'),'limit'=>8);
    if($deal = $this->paginate('Deal'))
    {
        $this->set('cityDeals',$deal);
        $this->set('count',$this->Deal->find('count',array('conditions'=>$cond)));
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
        $deal = $this->Deal->find('first', $options);
        $views = $deal['Deal']['view_count'];
        $views++;
        $this->Deal->id = $deal['Deal']['id'];
        if($deal)
        $this->Deal->saveField('view_count',$views);
		$this->set('deal', $deal);
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
	   $role = $this->Auth->User('role');	   
	   if(isset($role)&& ($role!=1)){
                //die('1');
				$this->redirect("/admin/users/login");
			}	   
    
        $this->Deal->recursive = 0;
        $this->paginate = array('order'=>'Deal.id DESC');
		$this->set('deals', $this->paginate('Deal'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
	   $role = $this->Auth->User('role');	   
	   if(isset($role)&& ($role!=1)){
                //die('1');
				$this->redirect("/admin/users/login");
			}
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
	   $role = $this->Auth->User('role');	   
	   if(isset($role)&& ($role!=1)){
                //die('1');
				$this->redirect("/admin/users/login");
			}
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
                    $e = $this->sendEmails($id);
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
	   $role = $this->Auth->User('role');	   
	   if(isset($role)&& ($role!=1)){
                //die('1');
				$this->redirect("/admin/users/login");
			}
		if (!$this->Deal->exists($id)) {
			throw new NotFoundException(__('Invalid deal'));
		}
        $deal = $this->Deal->findById($id);
		if ($this->request->is(array('post', 'put'))) {
		  //var_dump($this->request->data);die();
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
	   $role = $this->Auth->User('role');	   
	   if(isset($role)&& ($role!=1)){
                //die('1');
				$this->redirect("/admin/users/login");
			}
	
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
 function create_slug2()
    {
        $this->LoadModel('Page');
     $q = $this->Page->find('all',array('conditions'=>array('slug'=>'')));
     foreach($q as $s)
     {
         $slug = $s['Page']['title'];
        
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
             $check = $this->Page->find('first',array('conditions'=>array('Page.slug'=>$slug,'Page.id <>'=>$s['Page']['id'])));
             if($check)
             $slug = $slug.'_'.$s['Page']['id'];                
         }
         $this->Page->id = $s['Page']['id'];
         $this->Page->saveField('slug',$slug);
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
    function get_realated($cid,$id)
    {
        $this->loadModel('City');
        $c = $this->City->find('first',array('conditions'=>array('City.name'=>Inflector::humanize(str_replace("-"," ",$this->Session->read('city'))))));
        $this->loadModel('Company');
        $co = $this->Company->find('all',array('conditions'=>array('city_id'=>$c['City']['id'])));
        $str = "(0";
        if($co)
        {
            
            foreach($co as $cc)
            {
                $str = $str.','.$cc['Company']['id'];
            }
            
        }
        $str = $str.")";
        $final = 'Deal.deal_category_id = '.$cid.' AND Deal.id <>'.$id.' AND company_id IN '.$str;
        $rel1 = $this->Deal->find('all',array('conditions'=>array($final),'limit'=>4));
        
        return $rel1;  
            
    }
    function get_inflector($str)
    {
        $this->loadModel('DealCategory');
        $q = $this->DealCategory->findById($str);
        $str = Inflector::humanize(str_replace(" ","-",$q['DealCategory']['name']));
        return strtolower($str);
    }
    
    public function get_content($pid)
        {
            if($this->Session->read('lang')=='a')
                $ar = "_arabic";
            else
             if($this->Session->read('lang')=='g')
                $ar = "_german";    
            else
                $ar = "";
            $this->loadModel('Page');
            $p = $this->Page->findById($pid);
            return substr($p['Page']['desc'.$ar],0,550).'...'; 
            
        }
        
    public function get_page_by_category($catid)
        {
            
            $this->loadModel('Page');
            return $this->Page->find('all',array('conditions'=>array('page_category_id'=>$catid)));
            
        }
        public function page_detail($slug)
        {
            if($this->Session->read('lang')=='a')
                $ar = "_arabic";
            else
                $ar = "";
            $this->theme = 'default';
            
            $this->loadModel('Page');
            
            $content = $this->Page->findBySlug($slug);
            $this->set('title_for_layout','Savnpik |'.$content['Page']['title'.$ar]);
            $this->set('content',$content); 
            
        }
           
    public function convertCurrency($amount, $from, $to)
    {
        $url  = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
        $data = file_get_contents($url);
        preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
        $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
        return round($converted, 3);
  }
    public function ipn_test()
    {
        $this->loadModel('User');
        $this->loadModel('Payment');
        foreach($_POST as $k=>$p)
        {
        	$a .= $k."=>".$p.", ";
        }
        $payment['user_id'] = $_POST['custom'];
        $payment['on_date'] = date('Y-m-d H:i:s');
        $payment['stat'] = $_POST['payment_status'];
        $payment['info'] = $a;
        $payment['remarks'] = "Amount Added From Paypal.";
        $credit = $this->convertCurrency($_POST['mc_gross'],"USD","AED");
        $payment['amount'] = $credit;
        $this->Payment->create();
        $this->Payment->save($payment);
        
        $u = $this->User->findById($_POST['custom']);
        $old_credit = $u['User']['my_balance'];
        $this->User->id = $_POST['custom'];
        if($_POST['payment_status']=='Completed')
        {
	        $credit = $this->convertCurrency($_POST['mc_gross'],"USD","AED");
            $credit = $credit + $old_credit;
	        $this->User->saveField('my_balance',$credit);
	        
    	}
    	
      }
      
      public function subscribe()
      {
            $this->theme = 'default';
            $this->loadModel('Subscribe');
            if(isset($_POST['submit']))
            {
                $sub['email'] = $_POST['email']; 
                $sub['created_on'] = date('Y-m-d H:i:s');
                if($this->Subscribe->findByEmail($sub['email']))
                {
                    echo "a";die();
                }
                else
                {
                    $this->Subscribe->create();
                    if($this->Subscribe->save($sub))
                    {
                       echo "b";die();
                    }
                }
                die('here');
                $this->redirect(array('controller'=>'deals','action'=>'city',$this->Session->read('city')));   
                
                
            } 
            die(); 
      }
      
      public function contact()
      {
        if(isset($_POST['submit']))
        {
            $email = $_POST['email'];
            $name = $_POST['name'];
            $to = $email;
            $phone = $_POST['phone'];
            $msg = $_POST['msg'];
            $emails = new CakeEmail();
            $emails->to($to);
            $emails->from(array('noreply@savnpik.com'=>'Savnpik'));
            $emails->subject("Contact From Savnpik.com");
            $emails->emailFormat('html');
            $msg = "Hi there,<br/>There is a contact message for you from Savnpik.com.<br/>Here is the detail of contact request.<br/><br/>";
            $msg .= "Name: ".$name."<br/> Email: ".$email."<br/> Phone No: ".$phone."<br/> Message: ".$msg;
            if($emails->send($msg))
            {
                $this->Session->setFlash("Your message has been sent successfully.",'default',array(),'good');
            }
            
            
        }
        else
        {
            $this->Session->setFlash("Sorry, Your message couldnot be sent.",'default',array(),'good');
        }
        $this->redirect(array('controller'=>'deals','action'=>'city',$this->Session->read('city')));
        
      }
       public function checkexp()
        {
            //mail('justdoit2045@gmail.com','test','test');die();
            $qu = $this->Deal->find('all',array('conditions'=>array('Deal.expiry_date <'=>date('Y-m-d'))));
            if($qu)
            foreach($qu as $q)
            {
                //var_dump($q);
                //echo 
                if($q['Deal']['threshold']>$q['Deal']['buy_count'])
                {
                    $id = $q['Deal']['id'];
                    $this->loadModel('Sale');
                    $q2 = $this->Sale->find('all',array('conditions'=>array('Sale.price <>'=>'0','Sale.deals_id'=>$id,'Sale.refund'=>0)));
                    foreach($q2 as $q1)
                    {
                        $amt = $q1['Sale']['price']*$q1['Sale']['qty'];
                        $to = $q1['User']['email'];
                        $detail = 'Refund for:<br/><br/>
                        <table style="width:500px;">
                        <tr><td style="border-top:1px solid: #e5e5e5;border-left:1px solid: #e5e5e5;"><strong>Deal</strong></td><td style="border-top:1px solid: #e5e5e5;border-left:1px solid: #e5e5e5;"><strong>Price</strong></td><td style="border-top:1px solid: #e5e5e5;border-left:1px solid: #e5e5e5;border-right:1px solid #e5e5e5;"><strong>Quantity</strong></td></tr>
                        <tr><td style="border-top:1px solid: #e5e5e5;border-bottom:1px solid #e5e5e5;border-left:1px solid: #e5e5e5;">'.$q1['Deal']['name'].'</td><td style="border-top:1px solid: #e5e5e5;border-bottom:1px solid #e5e5e5;border-left:1px solid: #e5e5e5;">AED '.$q1['Sale']['price'].'</td><td style="border-top:1px solid: #e5e5e5;border-bottom:1px solid #e5e5e5;border-left:1px solid: #e5e5e5;border-right:1px solid #e5e5e5;">'.$q1['Sale']['qty'].'</td></tr>
                        </table><br/><br/><strong>Total: </strong>AED '.$amt;
                        if($q1['User']['email']){
                        $emails = new CakeEmail();
                        $emails->to($to);
                        $emails->from(array('noreply@savnpik.com'=>'Savnpik'));
                        $emails->subject("Refund Made");
                        $emails->emailFormat('html');
                        $msg = "Hi there,<br/><br/>Threshold of one of the deal you purchased was not met. We are refunding the amount you paid for the deal.<br/>Here is the detail of the refund.<br/><br/>";
                        $msg .= $detail."<br/><br/>Regards,<br/>Savnpik.com";
                        if($emails->send($msg))
                        {
                            $this->loadModel('Payment');
                            $this->Payment->create();
                            $arr['user_id'] = $q1['User']['id'];
                            $arr['stat'] = 'Completed';
                            $arr['amount'] = $amt;
                            $arr['info'] = '';
                            $arr['on_date'] = date('Y-m-d H:i:s');
                            $arr['remarks'] = 'Amount refunded for deal "'.$q1['Deal']['name'].'" (Quantity: '.$q1['Sale']['qty'].')';
                            $this->Payment->save($arr);
                            
                            $this->loadModel('User');
                            $this->User->id = $q1['User']['id'];
                            if(!$q1['User']['my_balance'])
                            $q1['User']['my_balance'] = 0;
                            $amt = $amt + $q1['User']['my_balance'];
                            $this->User->saveField('my_balance',$amt);
                            
                            $this->Sale->id = $q1['Sale']['id'];
                            $this->Sale->saveField('refund',1);
                            
                        }
                        }
                                               
    
                    }
                }
            }
            die();
        }
        function recommend($slug)
        {
            $em = $_POST['email'];
            
            $arr = explode(',',$em);
            if(count($arr)>0)
            {
                
                foreach($arr as $a)
                {
                    if(filter_var($a, FILTER_VALIDATE_EMAIL)){
                    $email[] = trim($a);                    
                    }
                }
                //var_dump($email);die();
                $emails = new CakeEmail();
                        $emails->to($email);
                        $emails->from(array('noreply@savnpik.com'=>'Savnpik'));
                        $emails->subject("Savnpic.com - Page recommended");
                        $emails->emailFormat('html');
                        $msg = "Hi there,<br/><br/>One of your friend suggested you to view the deal offered by Savnpik.com<br/>
                        Click on the link below to view the deal:<br/>
                        <a href='http://www.savnpik.com/deal/".$slug."'>http://www.savnpik.com/deal/".$slug."</a>                        
                        <br/><br/>";
                        $msg .= $detail."<br/><br/>Regards,<br/>Savnpik.com";
                        $emails->send($msg);
            }
            die();
            
        }
    public function ipn_test2()
    {
        
        $this->loadModel('Payment');
        $this->loadModel('Sale');
        $this->loadModel('RewardFrom');
        $this->loadModel('Cart');
        $this->loadModel('User');
        
        foreach($_POST as $k=>$p)
        {
        	$a .= $k."=>".$p.", ";
        }
        $cus = explode("-",$_POST['custom']);
        $userid = $cus[0];
        $sessid = $cus[1];
        
        
        $this->Payment->create();
        $arr['info']= $a;
        $arr['user_id'] = $userid;
        $arr['on_date'] = date('Y-m-d H:i:s');
        $arr['remarks'] = "Paid via Paypal";
        $arr['amount'] = $this->convertCurrency($_POST['mc_gross'],"USD","AED");
        $arr['stat'] = $_POST['payment_status'];
        $this->Payment->save($arr); 
        //mail('warriorbik@gmail.com',"testing",$a);
        //$this->->id = $_POST['custom'];
        if($_POST['payment_status']=='Completed')
        {
            $reward['user_id'] = $userid;
	        $carts = $this->Cart->find('all',array('conditions'=>array('user_id'=>$userid,
                                                                'buy_id'=>$sessid)));
            $user = $this->User->findById($userid);
                foreach($carts as $c)
                {
                    $reward['remark'] = "Purchase of ".$c['Deal']['name']." x ".$c['Cart']['qty'];
                    $price = $c['Cart']['price'];
                    $reward['coins'] = $price * $c['Cart']['qty'];
                    $tot = $reward['coins'];
                    $reward['reward_date'] = date('Y-m-d');
                    $this->RewardFrom->create();
                    $this->RewardFrom->save($reward);
                    if($p_d = $this->Sale->find('first', array('conditions'=>array('user_id'=>$userid,'deals_id'=>$c['Cart']['deals_id']))))
                    {
                       $this->Sale->id = $p_d['Sale']['id'];
                       $o_qty = $p_d['Sale']['qty'];
                       $n_qty = $o_qty + $c['Cart']['qty'];
                       $this->Sale->saveField('qty',$n_qty); 
                    }
                    else
                    {
                        $sale['user_id'] = $userid;
                        $sale['deals_id'] = $c['Cart']['deals_id'];
                        $sale['price'] = $c['Cart']['price'];
                        $sale['qty'] = $c['Cart']['qty'];
                        $this->Sale->create();
                        $this->Sale->save($sale);
                    }
                    
                    $deal = $this->Deal->findById($c['Cart']['deals_id']);
                    $this->Deal->id = $c['Cart']['deals_id'];
                    $buy_count = $deal['Deal']['buy_count'];
                    $buy_count = $buy_count+$c['Cart']['qty'];
                    $this->Deal->saveField('buy_count',$buy_count);
                    
                    $this->User->id = $c['Cart']['user_id'];
                    //$this->User->saveField('my_balance',$user['User']['my_balance']-$tot);
                    $my_coins = $user['User']['my_coin']+$tot; 
                    $this->User->saveField('my_coin',$my_coins);
                    
                    
                    $this->Cart->delete($c['Cart']['id']);
                }
	        /*$this->Sale->saveField('info',$a);
	        $this->Sale->saveField('on_date',date('Y-m-d H:i:s'));
	        $this->Sale->saveField('stat',$_POST['payment_status']);*/
    	}
    	else
    		$this->Sale->saveField('stat',"Payment Failed");
      }
      
      
      function createSess($l)
      {
        
        $this->Session->write('lang',$l); 
        die();
      }
      
      function admin_contacts()
      { 
        $this->loadModel("Cash");
        $role = $this->Auth->User('role');
       	   
	   if(isset($role)&& ($role!=1)){
                //die('1');
				$this->redirect("/admin/users/login");
			}	   
    
        $this->Cash->recursive = 0;
        $this->paginate = array('order'=>'Cash.id DESC');
		$this->set('contacts', $this->paginate('Cash'));
        
       
        
      }
       public function approved_cash($cid)
    {
        
        $role = $this->Auth->User('role');
       	   
	   if(isset($role)&& ($role!=1)){
                //die('1');
				$this->redirect("/admin/users/login");
			}
        $this->loadModel('Payment');
        $this->loadModel('Sale');
        $this->loadModel('RewardFrom');
        $this->loadModel('Cart');
        $this->loadModel('User');
        $this->loadModel("Cash");
        
        $ca = $this->Cash->findById($cid);
        
        $this->Payment->create();
        $arr['user_id'] = $ca['Cash']['user_id'];
        $arr['on_date'] = date('Y-m-d H:i:s');
        $arr['remarks'] = "Paid via Cash in hand";
        $arr['amount'] = $ca['Cash']['total'];
        $arr['stat'] = "Completed";
        $this->Payment->save($arr); 
        //mail('warriorbik@gmail.com',"testing",$a);
        //$this->->id = $_POST['custom'];
            $reward['user_id'] = $ca['Cash']['user_id'];
	        $carts = $this->Cart->find('all',array('conditions'=>array('user_id'=>$ca['Cash']['user_id'],
                                                                'buy_id'=>$ca['Cash']['buy_id'])));
            $user = $this->User->findById($ca['Cash']['user_id']);
                foreach($carts as $c)
                {
                    
                    $reward['remark'] = "Purchase of ".$c['Deal']['name']." x ".$c['Cart']['qty'];
                    $price = $c['Cart']['price'];
                    $reward['coins'] = $price * $c['Cart']['qty'];
                    $tot = $reward['coins'];
                    $reward['reward_date'] = date('Y-m-d');
                    $this->RewardFrom->create();
                    $this->RewardFrom->save($reward);
                    if($p_d = $this->Sale->find('first', array('conditions'=>array('user_id'=>$ca['Cash']['user_id'],'deals_id'=>$c['Cart']['deals_id']))))
                    {
                       $this->Sale->id = $p_d['Sale']['id'];
                       $o_qty = $p_d['Sale']['qty'];
                       $n_qty = $o_qty + $c['Cart']['qty'];
                       $this->Sale->saveField('qty',$n_qty); 
                    }
                    else
                    {
                        $sale['user_id'] = $ca['Cash']['user_id'];
                        $sale['deals_id'] = $c['Cart']['deals_id'];
                        $sale['price'] = $c['Cart']['price'];
                        $sale['qty'] = $c['Cart']['qty'];
                        $this->Sale->create();
                        $this->Sale->save($sale);
                    }
                    
                    $deal = $this->Deal->findById($c['Cart']['deals_id']);
                    $this->Deal->id = $c['Cart']['deals_id'];
                    $buy_count = $deal['Deal']['buy_count'];
                    $buy_count = $buy_count+$c['Cart']['qty'];
                    $this->Deal->saveField('buy_count',$buy_count);
                    
                    $this->User->id = $c['Cart']['user_id'];
                    //$this->User->saveField('my_balance',$user['User']['my_balance']-$tot);
                    $my_coins = $user['User']['my_coin']+$tot; 
                    $this->User->saveField('my_coin',$my_coins);
                    
                    
                    $this->Cart->delete($c['Cart']['id']);
                }
            $this->Cash->id =$cid;
            $this->Cash->saveField('stat','1');
            $this->Session->delete('buy_id');
            $this->redirect('/admin/deals/contacts');
	        /*$this->Sale->saveField('info',$a);
	        $this->Sale->saveField('on_date',date('Y-m-d H:i:s'));
	        $this->Sale->saveField('stat',$_POST['payment_status']);*/
    	
      }
      function sendEmails($id)
      {
        $this->loadModel('Subscribe');  
        $deal = $this->Deal->findById($id);
        $img = '';
        for($i=1;$i<=10;$i++)
        {
            if($deal['Deal']['image'.$i]!=''){
            $img = $deal['Deal']['image'.$i];
            $img = "<img src='http://savnpik.com/files/deals/".$img."' width='552' height='342' />";
            }
        }
        
        $q = $this->Subscribe->find('all');
        if($q){
        foreach($q as $s){
                        
                        $email = $s['Subscribe']['email'];
                        if(str_replace('@','',$email)!=$email && str_replace('.','',$email)!=$email){
                        $emails = new CakeEmail();
                        $emails->to($email);
                        $emails->from(array('noreply@savnpik.com'=>'Savnpik'));
                        $emails->subject("Savnpik.com - New deal uploaded");
                        $emails->emailFormat('html');
                        
                        $msg = "Hi there,<br/><br/>A new deal has been uploaded in Savnpik.com<br/>Click <a href='http://savnpik.com/deals/cityredirect/".$deal['Deal']['slug']."'>here</a> to view the deal in your browswer.<br/><br/>
                        <h1 style='font-size:20px;'>".$deal['Deal']['name']."</h1>".$img."
                        <table style='width:70%;'>
                            <tr><td style='padding:5px;border-top:1px solid #f5f5f5;border-left:1px solid #f5f5f5;'><strong>Marked Price</strong></td><td style='padding:5px;border-top:1px solid #f5f5f5;border-left:1px solid #f5f5f5;'><strong>Expires on</strong></td><td style='padding:5px;border-top:1px solid #f5f5f5;border-left:1px solid #f5f5f5;'><strong>Discount(%)</strong></td><td style='padding:5px;border-top:1px solid #f5f5f5;border-left:1px solid #f5f5f5;border-right:1px solid #f5f5f5;'><strong>Selling Price</strong></td></tr>
                            <tr><td style='padding:5px;border-top:1px solid #f5f5f5;border-left:1px solid #f5f5f5;border-bottom:1px solid #f5f5f5;'>AED ".$deal['Deal']['marked_price']."</td><td style='padding:5px;border-top:1px solid #f5f5f5;border-left:1px solid #f5f5f5;border-bottom:1px solid #f5f5f5;'>".$deal['Deal']['expiry_date']."</td><td style='padding:5px;border-top:1px solid #f5f5f5;border-left:1px solid #f5f5f5;border-bottom:1px solid #f5f5f5;'>".$deal['Deal']['discount']."%</td><td style='padding:5px;border-top:1px solid #f5f5f5;border-left:1px solid #f5f5f5;border-bottom:1px solid #f5f5f5;border-right:1px solid #f5f5f5;'>AED ".$deal['Deal']['selling_price']."</td></tr>
                        </table>
                        <br/>
                        <br/>
                        <strong>Highlights:</strong><br/>".$deal['Deal']['highlights']."<br/><br/>
                        <strong>Conditions:</strong><br/>".$deal['Deal']['conditions']."<br/><br/>
                        <strong>Company:</strong><br/><br/><strong>".$deal['Company']['name']."</strong><br/>
                        
                        <img src='http://savnpik.com/img/uploads/companies/".$deal['Company']['logo']."' width='120' /><br/><br/>
                        Regards,<br/>Savnpik.com
                        
                        
                        
                        ";
                        
                        $emails->send($msg);
                        }
            
        }
        }
        return true;            
      }
      function cityredirect($slug)
      {
        $this->loadModel('City');
        $q = $this->Deal->find('first',array('conditions'=>array('slug'=>$slug)));
        $city = $q['Company']['city_id'];
        $c = $this->City->findById($city);
        $ci = trim($c['City']['name']);
        //$ci = strtolower($ci);
        $this->Session->write('city',$ci);
        $this->redirect('/deal/'.$slug);
        
      }            
    
}
