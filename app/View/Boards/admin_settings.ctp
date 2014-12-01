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
    <form action="" method="post" enctype="multipart/form-data"  id="AdminSettings">
    
    <fieldset>
        
        
        <div class="input text">
            <label for="username">Username </label>
            <input type="text" name="User[username]" id="username" class="validate[required] form-control" value="<?php if(isset($user))echo $user['User']['username'];?>" />
        </div><br />
        <div class="input text">
            <label for="email">Email</label>
            <input type="text" name="User[email]" id="email" class="validate[required,custom[email]] form-control" value="<?php if(isset($user))echo $user['User']['email'];?>" />
        </div><br />
        
         
    </fieldset>
<?php echo $this->Form->submit('Update Settings',array('class'=>'btn btn-success','name'=>'submit'))?>
<?php echo $this->Form->end(); ?>
</div>
