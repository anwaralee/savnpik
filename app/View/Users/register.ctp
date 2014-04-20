<div id="login-account">
                <h2>LOGIN TO YOUR ACCOUNT</h2>
                <a href="<?php echo $this->webroot;?>users/fblogin" class="facebook-signin" style="margin-bottom: 10px;">Sign in with Facebook</a><br />
                <span id="signinButton">
                  <span
                    class="g-signin"
                    data-callback="signinCallback"
                    data-clientid="15907068473-5vbustaejid5ieik57dkv2j1qo0cie2k.apps.googleusercontent.com"
                    data-cookiepolicy="single_host_origin"
                    data-scope="https://www.googleapis.com/auth/userinfo.email"
                    data-height="short"
                    >
                  </span>
                </span>
                <!--<a href="" class="twitter-signin">Sign in with Twitter</a>-->
            
                <div class="form-wrap">
                     <?php echo $this->Form->create('User',array('action'=>'login')); ?>
                            <fieldset>
                                 <?php echo $this->Form->input('username',array('div'=>array('class'=>'form-row'))); ?>
                                <?php  //echo $this->Form->input('password',array('div'=>array('class'=>'form-row'))); ?>
                                
                                <div class="form-row">
                    <label>Your Password <a href="" class="forgot-password">forgot password?</a></label>
                    <input id="UserPassword" type="password" required="required" name="data[User][password]">
                    </div>

                    
                                
                               
                        </fieldset>
                    <?php echo $this->Form->submit('Login',array('class'=>'green-btn'))?>
                        <?php echo $this->Form->end(); ?>
                </div>
            </div>

            <div id="create-account">

                <h2>REGISTER YOUR ACCOUNT</h2>
                
                <a href="<?php echo $this->webroot;?>users/fblogin" class="facebook-signin">Sign in with Facebook</a>
                <!--<a href="" class="twitter-signin">Sign in with Twitter</a>-->
                
                <div class="form-wrap">
                        <?php echo $this->Form->create('User',array('action'=>'register')); ?>
                            <fieldset>
                                <?php  echo $this->Form->input('full_name',array('div'=>array('class'=>'form-row'))); ?>
                                <?php echo $this->Form->input('email',array('div'=>array('class'=>'form-row'),'label'=>'Email Address','type'=>'text')); ?> 
                                <?php echo $this->Form->input('phone',array('div'=>array('class'=>'form-row'),'label'=>'Phone no','type'=>'text')); ?>
                                <?php echo $this->Form->input('address',array('div'=>array('class'=>'form-row'),'type'=>'text')); ?>
                                <?php echo $this->Form->input('username',array('div'=>array('class'=>'form-row'))); ?>
                               <?php  echo $this->Form->input('password',array('div'=>array('class'=>'form-row'))); ?>
                                <?php  echo $this->Form->input('confirm_password',array('div'=>array('class'=>'form-row'),'type'=>'password')); ?>
                                
                             <br/>
                             
                    <div class="form-row">
                        <label class="checkbox"><input type="checkbox" name="check_field" class="chh" onchange="if($('.chh').is(':checked'))$('.sbmt').removeAttr('disabled');else{$('.sbmt').attr('disabled','');}"/>I certify I am at least 18 years old and I have read & agree to the <a href="">Privacy Policy</a> and <a href="">Terms & Conditions</a></label>
                    </div>
                    </fieldset>
                        <div class="submit">
                        <input class="green-btn sbmt" type="submit" value="Register" disabled="">
                        </div>  
                        <?php echo $this->Form->end(); ?>
            </div>
        </div>
<script>
 function signinCallback(authResult) {
  if (authResult['status']['signed_in']) {gapi.client.load('oauth2', 'v2', function() {
                gapi.client.oauth2.userinfo.get().execute(function(resp){
                    email = resp.email; //get user email
                    given_name = resp.given_name; //get user email
                    family_name=resp.family_name;
                    id=resp.id;
                    $.ajax({
                       data:'email='+email+'&name='+given_name+' '+family_name,
                       url:'<?php echo $this->webroot?>users/gplus',
                       type:'post',
                       success:function(res)
                       {
                        
                        window.location = '<?php echo $this->webroot?>';
                       }
                        
                    });
                });
            });
  } else {
    // Update the app to reflect a signed out user
    // Possible error values:
    //   "user_signed_out" - User is signed-out
    //   "access_denied" - User denied access to your app
    //   "immediate_failed" - Could not automatically log in the user
    console.log('Sign-in state: ' + authResult['error']);
  }
}
 </script>       
