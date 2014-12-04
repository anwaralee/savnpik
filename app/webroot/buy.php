<?php # buy.php 
// Created by Larry Ullman, www.larryullman.com, @LarryUllman
// Posted as part of the series "Processing Payments with Stripe"
// http://www.larryullman.com/series/processing-payments-with-stripe/
// Last updated February 20, 2013
// The class names are based upon Twitter Bootstrap (http://twitter.github.com/bootstrap/)

// This page is used to make a purchase.

// Every page needs the configuration file:
//require('config.inc.php');

// Uses sessions to test for duplicate submissions:
//session_start();

?>
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <?php 

// Set the Stripe key:
// Uses STRIPE_PUBLIC_KEY from the config file.
echo '<script type="text/javascript">Stripe.setPublishableKey("' . STRIPE_PUBLIC_KEY . '");</script>';

// Check for a form submission:


?>



	<form action="buy" method="POST" id="payment-form">

		<?php // Show PHP errors, if they exist:
		if (isset($errors) && !empty($errors) && is_array($errors)) {
			echo '<div class="alert alert-error"><h4>Error!</h4>The following error(s) occurred:<ul>';
			foreach ($errors as $e) {
				echo "<li>$e</li>";
			}
			echo '</ul></div>';	
		}?>

		<div id="payment-errors"></div>

		

		<!--<div class="alert alert-info"><h4>JavaScript Required!</h4>For security purposes, JavaScript is required in order to complete an order.</div>-->
        <input type="hidden" value="<?php echo $amount;?>" name="amount" />
        <div class="pl">
    		<div class="<?php if($this->Session->read('lang')=='e'||$this->Session->read('lang')=='g'){?>left<?php }else{?>right<?php }?> fw"><strong><?php if($this->Session->read('lang')=='a'){?>اسم حامل البطاقة<?php }elseif($this->Session->read('lang')=='g')echo "Kortinnehavarens namn";else{?>Card Holder's Name<?php }?>:</strong></div>
            <div class="<?php if($this->Session->read('lang')=='e'||$this->Session->read('lang')=='g'){?>left<?php }else{?>right<?php }?> mar">
        		<input type="text" name="email" required="required"  />
            </div>
            <div class="clearfix"></div>
        </div>
		<div class="pl">
            <div class="<?php if($this->Session->read('lang')=='e'||$this->Session->read('lang')=='g'){?>left<?php }else{?>right<?php }?> fw"><strong><?php if($this->Session->read('lang')=='a'){?>عدد بطاقة<?php }elseif($this->Session->read('lang')=='g')echo "Kortnummer";else{?>Card Number<?php }?>:</strong></div>
            <div class="<?php if($this->Session->read('lang')=='e'||$this->Session->read('lang')=='g'){?>left<?php }else{?>right<?php }?> mar">
        		<input type="text" size="20" autocomplete="off" class="card-number input-medium">
                <!--<span class="help-block">Enter the number without spaces or hyphens.</span>-->
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="pl">
    		<div class="<?php if($this->Session->read('lang')=='e'||$this->Session->read('lang')=='g'){?>left<?php }else{?>right<?php }?> fw"><strong><?php if($this->Session->read('lang')=='a'){?>صالحة حتى<?php }elseif($this->Session->read('lang')=='g')echo "gäller till";else{?>Valid Until<?php }?>:</strong></div>
            <div class="<?php if($this->Session->read('lang')=='e'||$this->Session->read('lang')=='g'){?>left<?php }else{?>right<?php }?> mar">
                <select class="card-expiry-month input-mini" >
                    <option><?php if($this->Session->read('lang')=='a'){?>شهر<?php }elseif($this->Session->read('lang')=='g')echo "";else{?>Month<?php }?></option>
                    <?php for($i=1;$i<=12;$i++)
                    {?>
                    <option value="<?php echo ($i<10)?'0'.$i:$i;?>"><?php echo ($i<10)?'0'.$i:$i;?></option>    
                    <?php 
                    } 
                    ?>
                </select>
                <select class="card-expiry-year input-mini" >
                    <option><?php if($this->Session->read('lang')=='a'){?>عام<?php }elseif($this->Session->read('lang')=='g')echo "år";else{?>Year<?php }?></option>
                    <?php for($i=2014;$i<=2024;$i++)
                    {?>
                    <option value="<?php echo ($i<10)?'0'.$i:$i;?>"><?php echo ($i<10)?'0'.$i:$i;?></option>    
                    <?php 
                    } 
                    ?>
                </select>
        		<!--<input type="text" size="2" class="card-expiry-month input-mini" placeholder="MM">
        		
        		<input type="text" size="4" class="card-expiry-year input-mini" placeholder="YYYY">-->
            </div>
            <div class="clearfix"></div>
        </div>
        
        <div class="pl">
            <div class="<?php if($this->Session->read('lang')=='e'||$this->Session->read('lang')=='g'){?>left<?php }else{?>right<?php }?> fw"><strong><?php if($this->Session->read('lang')=='a'){?>سي<?php }else{?>CVC<?php }?></strong></div>
            <div class="<?php if($this->Session->read('lang')=='e'||$this->Session->read('lang')=='g'){?>left<?php }else{?>right<?php }?> mar">        		
        		<input type="text" size="4" autocomplete="off" class="card-cvc input-mini">
            </div>
            <div class="clearfix"></div>
        </div>
        
        
        
        
        <div class="chh">
                <input type="checkbox" value="" class="subs" /><label><?php echo($this->Session->read('lang')=='a')?'&nbsp;&nbsp;يرجى البريد الالكتروني لي مع أحدث العروض في مدينتي.&nbsp;&nbsp;':(($this->Session->read('lang')=='g')?'Vänligen maila mig med de senaste erbjudanden i min stad.':'Please email me with the latest deals in my city.');?></label>
                </div>
                <div class="chh">
                <input type="checkbox" required="required" /><label><?php echo ($this->Session->read('lang')=='e')?"I accept the":(($this->Session->read('lang')=='g')?"Jag accepterar":'&nbsp;&nbsp;أنا أقبل')?> <a href="<?php echo $this->webroot.'page/Terms_and_Conditions';?>" target="_blank"><?php echo ($this->Session->read("lang")=='e')?'Terms & conditions':(($this->Session->read("lang")=='g')?'Villkor':'&nbsp;&nbsp;الشروط والأحكام')?></a></label><br />
                </div>                
		<button type="submit" class="green-btn" id="submitBtn"><?php if($this->Session->read('lang')=='a'){?>يقدم الدفع<?php }elseif($this->Session->read('lang')=='g')echo "Skicka Betalning";else{?>Submit Payment<?php }?></button>

	</form>
    <?php echo $this->Html->script('buy');?>
	
