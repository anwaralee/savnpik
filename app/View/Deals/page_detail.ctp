<div id="left-content">
<h2><?php echo ucwords($content['Page']['title']);?></h2>
<?php echo $content['Page']['desc'];?>
<?php if(strtolower($this->params['pass']['0'])=='contact_us'){
   echo $this->Html->css('validation.css');
   
   //echo $this->Html->script('validationEngine.js');
   //echo $this->Html->script('validationEngine-En.js');
    ?>
<script>
$(function(){
    $('#cform').validationEngine();
})
</script>
<hr />
<div class="col-md-6 ">
                        <h3>Quick contact</h3>
                        <form method="post" action="<?php echo $this->webroot;?>deals/contact" id="cform" name="contactfor1" class="contact-form row">
                            <div class="form-group clearfix">
                                <label for="" class="col-md-12">Name <span>*</span> :</label>
                                <div class="col-md-8">
                                    <input type="text" class=" required form-control" name="name" id="name" >
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label for="" class="col-md-12">E-mail <span>*</span> :</label>
                                <div class="col-md-8">
                                    <input type="text" class="required custom[email]form-control"  name="email" id="email">
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label for="" class="col-md-12">Phone No: </label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="phone" id="phone">
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label for="" class="col-md-12">Message <span>*</span> :</label>
                                <div class="col-md-12">
                                <textarea name="message" id="message" rows="6" class="required form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-send" value="Send Message" id="submit">
                                </div>
                            </div>
                        </form>
                        <div id="msg"></div>
                    </div><!-- Contact Form Ends here -->
                    <?php }?>
</div>