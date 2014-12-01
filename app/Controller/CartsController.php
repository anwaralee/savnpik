<?php
App::uses('AppController', 'Controller');
include('config.inc.php');
class CartsController extends AppController {
	public $components = array('Paginator', 'Session');
    public $theme = 'default';
    


     public function beforeFilter() {
			parent::beforeFilter();
			if(!$this->Session->read('lang'))
                $this->Session->write('lang','e');
            if($this->Session->read('Auth.User.role')!='0'){
                if($this->params['action']=='addtocart')
                {
                    $url = urlencode("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
                    $this->redirect("/users/register?url=".$url);
                }
                else
				    $this->redirect("/users/register");
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
    public function payment ()
    {
        if(isset($_POST['submit']) && $_POST['total']!=0 && $_POST['total']!="")
        {
             $tot = $_POST['total'];
            foreach($_POST['cart_id'] as $k=>$v)
            {
                $this->Cart->id = $v;
                $this->Cart->saveField('qty',$_POST['qty'][$k]);
            }
            $c = $this->Cart->find('all',array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id'),
                                                                'buy_id'=>$this->Session->read('buy_id'))));
        $this->set('carts',$c);
        $this->set('amount',$tot);
        }
        else
        {
           $this->redirect("index");
        }
           
         
        
    }
    public function checkout()
    {
        if(isset($_POST['submit']))
        {
            $tot = $_POST['total'];
            //die($tot);
            foreach($_POST['cart_id'] as $k=>$v)
            {
                $this->Cart->id = $v;
                $this->Cart->saveField('qty',$_POST['qty'][$k]);
                
                
            }
            $this->loadModel("User");
            $user = $this->User->findById($this->Session->read('Auth.User.id'));
            //var_dump($user);die();
            if($tot > $user['User']['my_balance'])
            {
                $this->Session->setFlash('InSufficent funds! Please add  more funds');
                $this->redirect(array('controller'=>'dashboard','action'=>'deposit'));
            }
            else
            {
                $this->loadModel("Sale");
                $this->loadModel("Deal");
                $this->loadModel('RewardFrom');
                $reward['user_id'] = $this->Session->read('Auth.User.id');
                
                $carts = $this->Cart->find('all',array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id'),
                   
                                                              'buy_id'=>$this->Session->read('buy_id'))));
                foreach($carts as $c)
                {
                    $reward['remark'] = "Purchase of ".$c['Deal']['name']."x ".$c['Cart']['qty'];
                    $reward['coins'] = $c['Cart']['price']*$c['Cart']['qty'];
                    $reward['reward_date'] = date('Y-m-d');
                    $this->RewardFrom->create();
                    $this->RewardFrom->save($reward);
                    if($p_d = $this->Sale->find('first', array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id'),'deals_id'=>$c['Cart']['deals_id']))))
                    {
                       $this->Sale->id = $p_d['Sale']['id'];
                       $o_qty = $p_d['Sale']['qty'];
                       $n_qty = $o_qty + $c['Cart']['qty'];
                       $this->Sale->saveField('qty',$n_qty); 
                    }
                    else
                    {
                        $sale['user_id'] = $this->Session->read('Auth.User.id');
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
                    $this->User->saveField('my_balance',$user['User']['my_balance']-$tot);
                    $my_coins = $user['User']['my_coin']+$tot; 
                    $this->User->saveField('my_coin',$my_coins);
                    
                    
                    $this->Cart->delete($c['Cart']['id']);
                }
                $this->redirect(array('controller'=>'dashboard'));
                
            }
            
        }
        
    }
     public function ipn_test()
    {
        $this->loadModel('Payment');
        foreach($_POST as $k=>$p)
        {
        	$a .= $k."=>".$p.", ";
        }
        $this->Payment->create();
        $arr['info']= $a;
        $this->Payment->save($arr); 
        mail('warriorbik@gmail.com',"testing",$a);
        //$this->->id = $_POST['custom'];
        if($_POST['payment_status']=='Completed')
        {
	        
	        /*$this->Sale->saveField('info',$a);
	        $this->Sale->saveField('on_date',date('Y-m-d H:i:s'));
	        $this->Sale->saveField('stat',$_POST['payment_status']);*/
    	}
    	else
    		$this->Sale->saveField('stat',"Payment Failed");
      }
      
      public function buy(){
        $this->loadModel('Payment');
        $this->loadModel('Sale');
        $this->loadModel('User');
        $this->loadModel('RewardFrom');
        $this->loadModel('Deal');
        $amount = 0;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
        	// Stores errors:
        	$errors = array();
        	// Need a payment token:
        	if (isset($_POST['stripeToken'])) {
        		$token = $_POST['stripeToken'];
        		
        		// Check for a duplicate submission, just in case:
        		// Uses sessions, you could use a cookie instead.
        		if (isset($_SESSION['token']) && ($_SESSION['token'] == $token)) {
        			$errors['token'] = 'You have apparently resubmitted the form. Please do not do that.';
        		} else { // New submission.
        			$_SESSION['token'] = $token;
        		}		
        		
        	} else {
        		$errors['token'] = 'The order cannot be processed. Please make sure you have JavaScript enabled and try again.';
        	}
        	
        	// Set the order amount somehow:
        	$amount = $_POST['amount']*100; 
            $email = $_POST['email'];
            
        	// Validate other form data!
        
        	// If no errors, process the order:
        	if (empty($errors)) {
        		
        		// create the charge on Stripe's servers - this will charge the user's card
        		try {
        			
        			// Include the Stripe library:
        			require_once('lib/Stripe.php');
        
        			// set your secret key: remember to change this to your live secret key in production
        			// see your keys here https://manage.stripe.com/account
        			Stripe::setApiKey(STRIPE_PRIVATE_KEY);
        
        			// Charge the order:
        			$charge = Stripe_Charge::create(array(
        				"amount" => $amount, // amount in cents, again
        				"currency" => "aed",
        				"card" => $token,
        				"description" => $email
        				)
        			);
        
        			// Check that it was paid:
        			if ($charge->paid == true) {
        			     /*foreach($charge as $k=>$v)
                         {
                            $a .= $k."=>".$v.", "; 
                         }*/
                         
                         $userid = $this->Session->read('Auth.User.id');
                         $sessid = $this->Session->read('buy_id');
                        $this->Payment->create();
                        //$arr['info']= $a;
                        $arr['user_id'] = $userid;
                        $arr['on_date'] = date('Y-m-d H:i:s');
                        $arr['remarks'] = "Paid via Credit Card";
                        $arr['amount'] = $_POST['amount'];
                        $arr['stat'] = "Completed";
                        $this->Payment->save($arr);
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
                        	
        		  	   //mail('warriorbik@gmail.com','paid',"thankyou");
                    	// Store the order in the database.
        				// Send the email.
        				// Celebrate!
        			     $this->Session->setFlash('Payment Successfull.','default',array(),'good');
                         $this->Session->delete('buy_id');
                         $this->redirect('/dashboard');	
        			} else {
        			     // Charge was not paid!	
        				$this->Session->setFlash('Payment System Error!</h4>Your payment could NOT be processed (i.e., you have not been charged) because the payment system rejected the transaction. You can try again or use another card.','default',array(),'bad');
                        //echo '<div class="alert alert-error"><h4>Payment System Error!</h4>Your payment could NOT be processed (i.e., you have not been charged) because the payment system rejected the transaction. You can try again or use another card.</div>';
        			}
        			
        		} catch (Stripe_CardError $e) {
        		    // Card was declined.
        			$e_json = $e->getJsonBody();
        			$err = $e_json['error'];
        			$errors['stripe'] = $err['message'];
        		} catch (Stripe_ApiConnectionError $e) {
        		    // Network problem, perhaps try again.
        		} catch (Stripe_InvalidRequestError $e) {
        		    // You screwed up in your programming. Shouldn't happen!
        		} catch (Stripe_ApiError $e) {
        		    // Stripe's servers are down!
        		} catch (Stripe_CardError $e) {
        		    // Something else that's not the customer's fault.
        		}
        
        	   } // A user form submission error occurred, handled below.
    	
         } // Form submission.
        $this->set('errors',$errors);
        $c = $this->Cart->find('all',array('conditions'=>array('user_id'=>$this->Session->read('Auth.User.id'),
                                                                'buy_id'=>$this->Session->read('buy_id'))));
        $this->set('carts',$c);
        $this->set('amount',$amount);
        //$this->Session->setFlash($errors,'default',array(),'bad');
        $this->render('payment');
      }


    public function cash()
    {
        $this->loadModel('Cash');
        if(isset($_POST['submit']))
        {
            $arr['contact'] = $_POST['contact'];
            $arr['user_id'] = $this->Session->read('Auth.User.id');
            $arr['buy_id'] = $this->Session->read('buy_id');
            $arr['total'] = $_POST['total'];
            $arr['ondate'] = date("Y-m-d H:i:s");
            $arr['refrence_no'] = $arr['user_id'].rand(100,999).time();
            if($this->Cash->save($arr))
            {
                $this->Session->setFlash('Thankyou, We will contact you soon.','default',array(),'good');
                $this->Session->delete('buy_id');
                $this->redirect('/dashboard');
            }
            else
            {
                $this->Session->setFlash('Sorry, your request could not be completed. Please try again.','default',array(),'bad');
                $this->redirect('index');
            }
            
        }
    }

}

?>