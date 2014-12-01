<div id="left-content" class="paddingbot">
<?php echo $this->Form->create('User',array(
                               'inputDefaults' => array(
                                'class' => 'form-control',
                                ),'type'=>'file')); ?>
	<fieldset>
    <div class="cat-header clearfix">
		<h2><?php echo ($this->Session->read('lang')=='a')?'إعدادات الحساب':'Account Settings';?></h2>
    </div>
	<?php
		echo $this->Form->input('full_name',array('label'=>($this->Session->read('lang')=='e')?"Full Name":"الاسم الكامل"));
		echo $this->Form->input('username',array('disabled'=>'disabled','class'=>'disabled','label'=>($this->Session->read('lang')=='e')?"User Name":"اسم المستخدم"));
		echo $this->Form->input('email', array('label'=>($this->Session->read('lang')=='e')?"Email":"البريد الالكتروني"));
        echo $this->Form->input('phone',array('label'=>($this->Session->read('lang')=='e')?"Phone":"هاتف"));
		echo $this->Form->input('address',array('label'=>($this->Session->read('lang')=='e')?"Address":"عنوان"));
        
		?>
        <div class="clearfix"></div>
        <?php if($fb_id==""){?><a href="javascript:void(0);" onclick="showfields();"><?php echo ($this->Session->read('lang')=='e')?'Change Password':'تغيير كلمة المرور';?></a><?php }?>
        <div style="dsiplay:none;" class="passwords" style="display: block;padding:10px 0;"></div>
        <br/>
	
	</fieldset>

   <?php echo $this->Form->submit(($this->Session->read('lang')=='e')?'Update':'التحديث',array('class'=>'green-btn','onclick'=>'return checkPass()'));?>
<?php echo $this->Form->end(); ?>
</div>
<script>
    function showfields()
    {
        $('.passwords').show();
        $('.passwords').html('<div class="input text required">'+
            '<label for="UserPassword">Old Password</label>'+
            '<input id="UserPassword" class="form-control" type="password" required="required" value="" maxlength="110" name="password"/>'+
            '</div>'+
        
        '<div class="clearfix"></div>'+
        
            '<div class="input text required">'+
            '<label for="newpass">New Password</label>'+
            '<input id="newpass" class="form-control" type="password" required="required" value="" maxlength="110" name="npassword"/>'+
            '</div>'+
        
            '<div class="input text required">'+
            '<label for="cpass">Confirm Password</label>'+
            '<input id="cpass" class="form-control" type="password" required="required" value="" maxlength="110" name="cpassword"/>'+
            '</div><div class="clearfix"></div><div style="display:none;padding-top:10px;color:red;" class="mismatch">Password Mismatch</div>');
    }
    function checkPass()
    {
        if($('.passwords').html()=='')
        {
            return true;
        }
        else
        if($('#cpass').val()==$('#newpass').val())
        return true;
        else{
            $('.mismatch').show();
        return false;
        
        }
    }
</script>