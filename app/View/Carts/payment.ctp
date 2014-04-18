<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top" id="form<?php echo $o['Product']['id'];?>">
    <input type="hidden" name="cmd" value="_xclick" />                                
    <input type="hidden" name="return" value="http://web-nepal.com/onesies" />
    <input type="hidden" name="amount" value="<?php echo $p = $o['Product']['price'];?>" />
    <input type="hidden" name="quantity" id="quantity<?php echo $o['Product']['id'];?>" value="" />
    <input type="hidden" name="item_name" id="item<?php echo $i = $o['Product']['id'];?>" value="">
    <input type="hidden" name="custom" id="cus_<?php echo $i;?>" value="<?php echo $i;?>"/>
    <input type="hidden" name="business" value="warriorbik123@gmail.com" />   
    <input type="hidden" name="shipping" value ="5" />
    <input type="hidden" name="cancel_return" value="http://web-nepal.com/onesies" />
    <input type="hidden" name="notify_url" value ="http://web-nepal.com/onesies/pages/ipn_test" />
    <input type="hidden" name ="tax_rate" value ="13" />
    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" onclick="return check(<?php echo $o['Product']['id'];?>)"/>
    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>