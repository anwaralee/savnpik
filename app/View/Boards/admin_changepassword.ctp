<script>
    $(function(){
       
        $('#AdminSettings').validationEngine();
    })
</script>
<div class="col-lg-6">
<?php /*echo $this->Form->create('Ad',array(
                               'inputDefaults' => array(
                                'class' => 'form-control'
                                ),'type'=>'file')); */
    ?>
    <legend>Admin Settings</legend>
    <form action="" method="post"   id="AdminSettings">
    
    <fieldset>
        
        <div class="input text">
            <label for="password">Old Password</label>
        <input type="password" name="User[oldpassword]" id="password" value="" class="validate[required] form-control" class="validate[required]"  />
        </div><br />
        
        <div class="input text">
            <label for="newpassword">New Password</label>
        <input type="password" name="User[password]" id="newpassword" class="validate[required] form-control" value="" />
        </div><br />
        <div class="input text">
            <label for="confirmpassword">Confirm Password</label>
            <input type="password" name="confirmpassword" id="confirmpassword" class="validate[required,equals[newpassword]] form-control" value="" />
        </div><br />
     </fieldset>
<?php echo $this->Form->submit('Change Password',array('class'=>'btn btn-success','name'=>'submit'))?>
<?php echo $this->Form->end(); ?>
</div>