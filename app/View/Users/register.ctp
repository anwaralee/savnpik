<?php $sess=$this->Session->read('lang');?>
<div id="login-account">
                <h2><?php if($sess == 'e'){?>LOGIN TO YOUR ACCOUNT<?php }else{echo "تسجيل الدخول إلى حسابك";}?></h2>
                <div class="logins">
                <div class="fblogindiv">
                <a href="<?php echo $this->webroot;?>users/fblogin<?php if(isset($_GET['url']))echo '?url='.$_GET['url'];?>" class="facebook-signin" style="margin-bottom: 10px;">Sign in with Facebook</a>
                </div>
                <div class="gpluslogindiv">
                <span id="signinButton">
                  <span
                    class="g-signin"
                    data-callback="signinCallback"
                    data-clientid="15907068473-5vbustaejid5ieik57dkv2j1qo0cie2k.apps.googleusercontent.com"
                    data-cookiepolicy="single_host_origin"
                    data-scope="https://www.googleapis.com/auth/userinfo.email"
                    data-height="short"
                    >
                    <img src="<?php echo $this->webroot;?>img/gpl.png" style="cursor: pointer;"/>
                  </span>
                </span>
                </div>
                <div class="clearfix"></div>
                </div>
                <!--<a href="" class="twitter-signin">Sign in with Twitter</a>-->
            
                <div class="form-wrap">
                     <?php echo $this->Form->create('User',array('action'=>(isset($_GET['url']))?'login?url='.$_GET['url']:'login','id'=>'UserLoginForm')); ?>
                            <fieldset>
                                 <?php if($this->Session->read('lang')=='e')echo $this->Form->input('username',array('div'=>array('class'=>'form-row')));
                                       else echo $this->Form->input('username',array('div'=>array('class'=>'form-row'),'label'=>'اسم المستخدم'));
                                  ?>
                                <?php  //echo $this->Form->input('password',array('div'=>array('class'=>'form-row'))); ?>
                                
                                <div class="form-row">
                    <label><?php if($this->Session->read('lang')=='a'){?>كلمة السر<?php }else{?>Your Password<?php }?> <a href="<?php echo $this->webroot?>users/forgot" class="forgot-password"><?php if($this->Session->read('lang')=='a'){?>نسيت كلمة المرور؟<?php }else{?>forgot password?<?php }?></a></label>
                    <input id="UserPassword" type="password" required="required" name="data[User][password]">
                    </div>

                    
                                
                               
                        </fieldset>
                    <?php
                    if($this->Session->read('lang')=='e') 
                    echo $this->Form->submit('Login',array('class'=>'green-btn'));
                    else
                    echo $this->Form->submit('دخول',array('class'=>'green-btn'));
                    echo $this->Form->end(); ?>
                </div>
            </div>

            <div id="create-account">

                <h2><?php if($sess=='e'){?>REGISTER YOUR ACCOUNT<?php }else{?>تسجيل حسابك<?php }?></h2>
                
                <div class="logins">
                <div class="fblogindiv">
                <a href="<?php echo $this->webroot;?>users/fblogin" class="facebook-register" style="margin-bottom: 10px;">Sign in with Facebook</a>
                </div>
                <div class="gpluslogindiv">
                <span id="signinButton">
                  <span
                    class="g-signin"
                    data-callback="signinCallback"
                    data-clientid="15907068473-5vbustaejid5ieik57dkv2j1qo0cie2k.apps.googleusercontent.com"
                    data-cookiepolicy="single_host_origin"
                    data-scope="https://www.googleapis.com/auth/userinfo.email"
                    data-height="short"
                    ><img src="<?php echo $this->webroot;?>img/gp.png" style="cursor: pointer;"/>
                  </span>
                </span>
                </div>
                <div class="clearfix"></div>
                </div>
                <div class="form-wrap">
                        <?php echo $this->Form->create('User'); ?>
                            <fieldset>
                                <?php
                                if($sess=='e')  
                                echo $this->Form->input('full_name',array('div'=>array('class'=>'form-row'))); 
                                else
                                echo $this->Form->input('full_name',array('div'=>array('class'=>'form-row'),'label'=>'الاسم الكامل'));
                                
                                ?>
                                <?php
                                if($sess=='e') 
                                echo $this->Form->input('email',array('div'=>array('class'=>'form-row'),'label'=>'Email Address','type'=>'text'));
                                else
                                echo $this->Form->input('email',array('div'=>array('class'=>'form-row'),'label'=>'عنوان البريد الإلكتروني','type'=>'text')); 
                                ?> 
                                <?php
                                if($sess=='e') 
                                echo $this->Form->input('phone',array('div'=>array('class'=>'form-row'),'label'=>'Phone no','type'=>'text'));
                                else
                                 echo $this->Form->input('phone',array('div'=>array('class'=>'form-row'),'label'=>'رقم الهاتف','type'=>'text'));
                                ?>
                                
                                <?php
                                if($sess=='e') 
                                echo $this->Form->input('address',array('div'=>array('class'=>'form-row'),'type'=>'text'));
                                else
                                 echo $this->Form->input('address',array('div'=>array('class'=>'form-row'),'type'=>'text','label'=>'عنوان'));
                                ?>
                                <?php 
                                if($sess=='e')
                                echo $this->Form->input('username',array('div'=>array('class'=>'form-row')));
                                else
                                echo $this->Form->input('username',array('div'=>array('class'=>'form-row'),'label'=>'اسم المستخدم')); 
                                ?>
                               <?php
                               if($sess=='e')  
                               echo $this->Form->input('password',array('div'=>array('class'=>'form-row')));
                               else
                                echo $this->Form->input('password',array('div'=>array('class'=>'form-row'),'label'=>'كلمة السر'));
                               ?>
                                <?php
                                if($sess=='e')  
                                echo $this->Form->input('confirm_password',array('div'=>array('class'=>'form-row'),'type'=>'password')); 
                                else
                                echo $this->Form->input('confirm_password',array('div'=>array('class'=>'form-row'),'label'=>'تأكيد كلمة المرور','type'=>'password'));
                                ?>
                                
                             <br/>
                             
                    <div class="form-row">
                        <label class="checkbox"><input type="checkbox" name="check_field" class="chh" onchange="if($('.chh').is(':checked'))$('.sbmt').removeAttr('disabled');else{$('.sbmt').attr('disabled','');}"/>
                        <?php 
                        if($this->Session->read('lang')=='e'){?>I certify I am at least 18 years old and I have read & agree to the <a href="">Privacy Policy</a> and <a href="">Terms & Conditions</a><?php }else{?>أشهد أنا لا يقل عن 18 سنة ولقد قرأت وأوافق على سياسة الخصوصية والشروط والأحكام<?php }?>
                        </label>
                    </div>
                    </fieldset>
                        <div class="submit">
                        <input class="green-btn sbmt" type="submit" value="<?php if($sess=='e'){?>Register<?php }else{?>تسجيل<?php }?>" disabled="">
                        </div>  
                        <?php echo $this->Form->end(); ?>
            </div>
        </div>
<script>
var tester =true;
 function signinCallback(authResult) {
    
  if (authResult['status']['signed_in'] && !tester) {gapi.client.load('oauth2', 'v2', function() {
    
                gapi.client.oauth2.userinfo.get().execute(function(resp){
                    email = resp.email; //get user email
                    given_name = resp.given_name; //get user email
                    family_name=resp.family_name;
                    id=resp.id;
                    //alert(email);return;
                    if(email){
                    $.ajax({
                       data:'email='+email+'&name='+given_name+' '+family_name,
                       url:'<?php echo $this->webroot?>users/gplus',
                       type:'post',
                       success:function(res)
                       {
                        //alert(res);return;
                        if(res=='already'){
                        alert('The email address associated to your gmail account is already in use');    
                        return;
                        }
                        <?php
                        if(isset($_GET['url']))
                {
                    
                    $url = ($_GET['url']);
                    $url = str_replace(array("http:/",urlencode("http:/")),array("",""),$url);
                    if(str_replace(array("http://",urlencode("http://")),array("",""),$url)==$url)
                        $url = "http://".$url;
                   else
                        $url = $url;
                        //echo $url;
                    $url = urldecode($url);
                    //die($url);     
                   ?>
                   window.location ="<?php echo $url;?>";
                <?php }else{?>
                        window.location = '<?php echo $this->webroot?>carts';
                        <?php }?>
                       }
                        
                    });
                    }
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
  tester = false;
}
 </script>       
