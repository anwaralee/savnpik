<!--form method="post" action="/deals/admins/dashboard" class="login">
    <p>
      <label for="login">Email:</label>
      <input type="text" name="login" id="login" value="name@example.com">
    </p>

    <p>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" value="4815162342">
    </p>

    <p class="login-submit">
      <button type="submit" class="login-button">Login</button>
    </p>

    <p class="forgot-password"><a href="index.html">Forgot your password?</a></p>
  </form-->

<?php echo $this->Form->create(false,array('class'=>'login','url' => array('controller' => 'admins', 'action' => 'dashboard')));?>
<p>
      
    <?php echo $this->Form->input('login',array('type'=>'text','div'=>false,'id'=>'login'));?>
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