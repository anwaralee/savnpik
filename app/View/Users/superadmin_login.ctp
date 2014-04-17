<?php echo $this->Session->flash('auth'); ?>
<?php print_r($this->Form->create('User',array('class'=>'login')));?>
<?php echo $this->Form->create('User',array('class'=>'login'));?>
<p>
      
    <?php echo $this->Form->input('username',array('type'=>'text','div'=>false,'id'=>'login'));?>
</p>
<p>
    
    <?php echo $this->Form->input('password',array('type'=>'password','div'=>false));?>
</p>
      <p class="login-submit">
               <button type="submit" class="login-button">Login</button>
          <?php $this->Form->submit('Login',array('div'=>false,'class' => 'login-button')
                                         ); ?>
        </p>
    <p class="forgot-password"><a href="index.html">Forgot your password?</a></p>
    <?php echo $this->Form->end();?>