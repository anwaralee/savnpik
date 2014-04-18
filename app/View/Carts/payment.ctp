<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" >
        <input name = "cmd" value = "_cart" type = "hidden">
        <input name = "upload" value = "1" type = "hidden">
        <input name = "no_note" value = "0" type = "hidden">
        <input name = "bn" value = "PP-BuyNowBF" type = "hidden">
        <input name = "tax" value = "0" type = "hidden">
        <input name = "rm" value = "2" type = "hidden">
         
        <input name = "business" value = "warriorbik123@gmail.com" type = "hidden">
        <input name = "handling_cart" value = "0" type = "hidden">
        <input name = "currency_code" value = "AED" type = "hidden">
        <input name = "lc" value = "AED" type = "hidden">
        <input name = "return" value = "http://savnpik/carts" type = "hidden">
        <input name = "cbt" value = "Return to Savnpik" type = "hidden">
        <input name = "cancel_return" value = "http://savnpik/carts" type = "hidden">
        <input name = "custom" value = "" type = "hidden">
    <?php $i= 0;
        foreach($carts as $o){
        $i++;?>
        <input type="hidden" name="amount_<?php echo $i;?>" value="<?php echo $o['Deal']['selling_price'];?>" />
    <input type="hidden" name="quantity_<?php echo $i;?>"  value="<?php echo $o['Cart']['qty'];?>" />
    <input type="hidden" name="item_name_<?php echo $i;?>" value="<?php echo $o['Deal']['name'];?>" />
    <!--<input type="hidden" name="custom" id="cus_<?php echo $o['Cart']['id'];?>" value="<?php echo $o['Cart']['id'];?>"/>-->
    <?php }?>
    
    
      
    
    <input type="hidden" name="cancel_return" value="http://savpik.com/carts" />
    <input type="hidden" name="notify_url" value ="http://http://savpik.com/carts/ipn_test" />
    
    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" onclick="return check(<?php echo $o['Product']['id'];?>)"/>
    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>