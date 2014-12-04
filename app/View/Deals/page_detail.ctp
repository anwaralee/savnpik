<div id="left-content">
<div class="cat-header clearfix">
<?php if($this->Session->read('lang')=='a')
        $ar = "_arabic";
    elseif($this->Session->read('lang')=='g')
        $ar = "_german";
      else
        $ar = "";
?>
<h2><?php echo ucwords($content['Page']['title'.$ar]);?></h2>
<a href="<?php echo $this->webroot;?>deals/city/<?php echo $this->Session->read('city');?>" class="back" ><?php if($this->Session->read('lang')=='e')echo "back to home";elseif($this->Session->read('lang')=='g')echo "tillbaka till hemmet";else{echo "العودة إلى المنزل";}?></a>
</div>
<div class="pages clearfix" style="margin: 10px 0; line-height: 25px;">
<?php echo $content['Page']['desc'.$ar];?>
<?php if(strtolower($this->params['pass']['0'])=='contact_us'){
   echo $this->Html->css('validation.css');
   
   echo $this->Html->script('validationEngine.js');
   echo $this->Html->script('validationEngine-En.js');
    ?>
<script>
$(function(){
    $('#cform').validationEngine();
})
</script>
<hr />
<div class="col-md-6 " id="login-account">
                        <h3><?php if($this->Session->read('lang')=='a')echo "اتصال سريع";elseif($this->Session->read('lang')=='g') echo "snabb kontakt";else echo 'Quick contact';?></h3>
                        <form method="post" action="<?php echo $this->webroot;?>deals/contact" id="cform" name="contactfor1" class="contact-form row">
                            <div class="form-row clearfix">
                                <label for="" class="col-md-12"><?php if($this->Session->read('lang')=='a')echo "اسم";elseif($this->Session->read('lang')=='g') echo "namn";else echo 'Name';?> <span>*</span> :</label>
                                <div class="col-md-8">
                                    <input type="text" class="validate[required] form-control" name="name" id="name" >
                                </div>
                            </div>
                            <div class="form-row clearfix">
                                <label for="" class="col-md-12"><?php if($this->Session->read('lang')=='a')echo "البريد الإلكتروني";elseif($this->Session->read('lang')=='g') echo "Emailens";else echo 'E-mail';?> <span>*</span> :</label>
                                <div class="col-md-8">
                                    <input type="text" class="validate[required,custom[email]]form-control"  name="email" id="email">
                                </div>
                            </div>
                            <div class="form-row clearfix">
                                <label for="" class="col-md-12"><?php if($this->Session->read('lang')=='a')echo "رقم الهاتف";elseif($this->Session->read('lang')=='g') echo "Telefon nr";else echo 'Phone No';?>: </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="phone" id="phone">
                                </div>
                            </div>
                            <div class="form-row clearfix">
                                <label for="" class="col-md-12"><?php if($this->Session->read('lang')=='a')echo "رسالة";elseif($this->Session->read('lang')=='g') echo "meddelande";else echo 'Message';?> <span>*</span> :</label>
                                <div class="col-md-12">
                                <textarea name="msg" id="message" rows="6" class="validate[required] form-control" style="width: 390px; padding:3px 6px;"></textarea>
                                </div>
                            </div>
                            <div class="form-row clearfix">
                                <div class="col-md-12">
                                    <input type="submit" class="green-btn" value="<?php if($this->Session->read('lang')=='a')echo "إرسال رسالة";elseif($this->Session->read('lang')=='g') echo "Skicka meddelande";else echo 'Send Message';?>" id="submit" name="submit">
                                </div>
                            </div>
                        </form>
                        <div id="msg"></div>
                    </div><!-- Contact Form Ends here -->
                    <?php }?>
    </div>
</div>