<?php   
    echo $this->Html->css('validation.css');
   
   echo $this->Html->script('validationEngine.js');
   echo $this->Html->script('validationEngine-En.js');
   ?>
<script>
$(function()
{
    $('#requestform').validationEngine();    
});
</script>
<div id="left-content">
<div class="cat-header clearfix">
<h2><?php echo ($this->Session->read('lang')=='a')?'(طلب الشيك: (بلادي الرصيد: درهم':"Request Cheque:(My Balance: ".$credit." AED)";?></h2>

</div>
<div class="history">
<form action="" id="requestform" method="post" >
    <input type="text"  value="" name="credit" id="credit" placeholder="<?php echo ($this->Session->read('lang')=='a')?'المبلغ درهم':'Amount in AED';?>" class="validate[required,custom[number]]" />
    <input type="text" value="" name="email" id="email" placeholder="<?php echo ($this->Session->read('lang')=='a')?"باي بال البريد الالكتروني":"Paypal Email";?>" class="validate[required,custom[email]]" />
    <input type="submit" name="submit" value="<?php echo ($this->Session->read('lang')=='a')?'طلب الشيك':'Request Cheque';?>" class="green-btn" />
</form>
</div>

</div>