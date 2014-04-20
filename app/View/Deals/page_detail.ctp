<div id="left-content">
<h2><?php echo ucwords($content['Page']['title']);?></h2>
<?php echo $content['Page']['desc'];?>
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
                        <h3>Quick contact</h3>
                        <form method="post" action="<?php echo $this->webroot;?>deals/contact" id="cform" name="contactfor1" class="contact-form row">
                            <div class="form-row clearfix">
                                <label for="" class="col-md-12">Name <span>*</span> :</label>
                                <div class="col-md-8">
                                    <input type="text" class="validate[required] form-control" name="name" id="name" >
                                </div>
                            </div>
                            <div class="form-row clearfix">
                                <label for="" class="col-md-12">E-mail <span>*</span> :</label>
                                <div class="col-md-8">
                                    <input type="text" class="validate[required,custom[email]]form-control"  name="email" id="email">
                                </div>
                            </div>
                            <div class="form-row clearfix">
                                <label for="" class="col-md-12">Phone No: </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="phone" id="phone">
                                </div>
                            </div>
                            <div class="form-row clearfix">
                                <label for="" class="col-md-12">Message <span>*</span> :</label>
                                <div class="col-md-12">
                                <textarea name="msg" id="message" rows="6" class="validate[required] form-control" style="width: 390px; padding:3px 6px;"></textarea>
                                </div>
                            </div>
                            <div class="form-row clearfix">
                                <div class="col-md-12">
                                    <input type="submit" class="green-btn" value="Send Message" id="submit" name="submit">
                                </div>
                            </div>
                        </form>
                        <div id="msg"></div>
                    </div><!-- Contact Form Ends here -->
                    <?php }?>
</div>