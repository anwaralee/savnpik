<div id="left-content">
<h2><?php echo ($this->Session->read('lang')=='a')?"اختيار نوع الدفع":'Choose Payment Type';?></h2>

<div class="creditcard" style="display:block;">
<div class="paylist firstl">
    <div class="left radiob"><input type="radio" name="pay" class="pay" id="first" /></div>
    <div class="left mar"><img src="<?php echo $this->webroot;?>img/cc.png" /></div>
    <div class="clearfix"></div>
    <div style="display: none;" class="cc">
        <?php include('buy.php');?>
    </div>
</div>
<div class="paylist secondl">
    <div class="left radiob"><input type="radio" name="pay" class="pay" id="second" /></div>
    <div class="left mar"><img src="<?php echo $this->webroot;?>img/paypal_logo.png" /></div>
    <div class="clearfix"></div>
    <div class="pp" style="display: none;">
        
        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" >
                <div class="chh">
                <input type="checkbox" value="" class="subs" /><label><?php echo($this->Session->read('lang')=='a')?'&nbsp;&nbsp;يرجى البريد الالكتروني لي مع أحدث العروض في مدينتي.&nbsp;&nbsp;':'Please email me with the latest deals in my city.';?></label>
                </div>
                <div class="chh">
                <input type="checkbox" required="required" /><label><?php echo ($this->Session->read('lang')=='e')?"I accept the":'&nbsp;&nbsp;أنا أقبل'?> <a href="<?php echo $this->webroot.'page/Terms_and_Conditions';?>" target="_blank"><?php echo ($this->Session->read("lang")=='e')?'Terms & conditions':'&nbsp;&nbsp;الشروط والأحكام'?></a></label><br />
                </div>
                <input name = "cmd" value = "_cart" type = "hidden">
                <input name = "upload" value = "1" type = "hidden">
                <input name = "no_note" value = "0" type = "hidden">
                <input name = "bn" value = "PP-BuyNowBF" type = "hidden">
                <input name = "tax" value = "0" type = "hidden">
                <input name = "rm" value = "2" type = "hidden">
                 
                <input name = "business" value = "warriorbik123@gmail.com" type = "hidden">
                <input name = "handling_cart" value = "0" type = "hidden">
                <input name = "currency_code" value = "USD" type = "hidden">
                <input name = "lc" value = "US" type = "hidden">
                <input name = "return" value = "http://savnpik.com" type = "hidden">
                <input name = "cbt" value = "Return to Savnpik" type = "hidden">
                
                <input name = "custom" value = "<?php echo $this->Session->read('Auth.User.id')."-".$carts[0]['Cart']['buy_id'];?>" type = "hidden">
            <?php $i= 0;
                foreach($carts as $o){
                $i++;?>
                <input type="hidden" name="amount_<?php echo $i;?>" value="<?php echo $this->requestAction('/dashboard/convertCurrency/'.$o['Deal']['selling_price'].'/AED/USD');?>" />
                <input type="hidden" name="quantity_<?php echo $i;?>"  value="<?php echo $o['Cart']['qty'];?>" />
                <input type="hidden" name="item_name_<?php echo $i;?>" value="<?php echo $o['Deal']['name'];?>" />
            
            <!--<input type="hidden" name="custom" id="cus_<?php echo $o['Cart']['id'];?>" value="<?php echo $o['Cart']['id'];?>"/>-->
            <?php }?>
            
            
              
            
            <input type="hidden" name="cancel_return" value="http://savnpik.com/carts" />
            <input type="hidden" name="notify_url" value ="http://savnpik.com/deals/ipn_test2" />
            
            <input type="submit" value="<?php echo ($this->Session->read('lang')=='e')?'Order Now':"النظام الآن";?>" class="green-btn" name="submit" alt="PayPal - The safer, easier way to pay online!" />
            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
        </form>
    </div>
</div>
<div class="cash1" style="display:block;">
<div class="paylist third1">
    <div class="left radiob"><input type="radio" name="pay" class="pay" id="third" /></div>
    <div class="left mar"><img src="<?php echo $this->webroot;?>img/cow.jpg" /></div>
    <div class="clearfix"></div>
    <div style="display: none;" class="cash">
    <form action="cash" method="post">
        <label><?php echo ($this->Session->read('lang')=='e')?'Contact':'اتصال'?> #:</label><input type="text" required="required" name="contact" value=""/>
        <input type="hidden" name="total" value="<?php echo $amount;?>"/>
        <div class="chh">
        <input type="checkbox" value="" class="subs" /><label><?php echo($this->Session->read('lang')=='a')?'&nbsp;&nbsp;يرجى البريد الالكتروني لي مع أحدث العروض في مدينتي.&nbsp;&nbsp;':'Please email me with the latest deals in my city.';?></label>
        </div>
        <div class="chh">
        <input type="checkbox" required="required" /><label><?php echo ($this->Session->read('lang')=='e')?"I accept the":'&nbsp;&nbsp;أنا أقبل'?> <a href="<?php echo $this->webroot.'page/Terms_and_Conditions';?>" target="_blank"><?php echo ($this->Session->read("lang")=='e')?'Terms & conditions':'&nbsp;&nbsp;الشروط والأحكام'?></a></label><br />
        </div>
        <input type="submit" name="submit" class="green-btn" value="<?php echo ($this->Session->read('lang')=='e')?'Order Now':"النظام الآن";?>" />
    </form>   
    </div>
</div>

</div>


</div>
</div>
<script>
    $(function(){
        $('.subs').click(function(){
        if($(this).is(':checked'))
        {
            var ch = true;
        }    
        else
        var ch = false;
       var em =  '<?php echo $this->Session->read('Auth.User.email');?>';
       if(em=='')
       {
        //
       }
       else
       {
        if(ch){
        $.ajax({
           url:'/deals/subscribe',
           data:'email='+em+'&submit=1',
           type:'post',
           success:function(res)
           {
            //do nothing
           } 
        });
        }
       }
    });
        
        
        $('.pay').click(function(){
           if($(this).attr('id')=='first')
           {
            $('.cc').show();
             $('.cash').hide();
              $('.third1').attr('style','background:#FFF;');
            $('.firstl').attr('style','background:#e5e5e5;');
            $('.pp').hide();
            $('.secondl').attr('style','background:#FFF;');
           } 
           else
           if($(this).attr('id')=='second')
           {
            
           
            $('.pp').show();
            $('.cash').hide();
            $('.secondl').attr('style','background:#e5e5e5;');
            $('.cc').hide();
            $('.firstl').attr('style','background:#FFF;');
            $('.third1').attr('style','background:#FFF;');
            
           }
           else
           {
            $('.cash').show();
            $('.third1').attr('style','background:#e5e5e5;');
            $('.cc').hide();
            $('.pp').hide();
            $('.firstl').attr('style','background:#FFF;');
            $('.secondl').attr('style','background:#FFF;');
           }
        });
    });
</script>