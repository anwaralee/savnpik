<div id="left-content" class="paddingbot">
<?php echo $this->Form->create('User',array(
                               'inputDefaults' => array(
                                'class' => 'form-control',
                                ),'type'=>'file')); ?>
	<fieldset>
		<legend><?php echo __('Account Setting'); ?></legend>
	<?php
		echo $this->Form->input('full_name');
		echo $this->Form->input('username',array('disabled'=>'disabled','class'=>'disabled'));
		echo $this->Form->input('email');
        echo $this->Form->input('phone');
		echo $this->Form->input('address');
        
		?>
        <div class="clearfix"></div>
        <?php if($fb_id==""){?><a href="javascript:void(0);" onclick="showfields();">Change Password</a><?php }?>
        <div style="dsiplay:none;" class="passwords" style="display: block;padding:10px 0;"></div>
        <br/>
	
	</fieldset>

   <?php echo $this->Form->submit('Update',array('class'=>'green-btn','onclick'=>'return checkPass()'));?>
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