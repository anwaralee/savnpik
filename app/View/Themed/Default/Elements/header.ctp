<?php
if($this->Session->read('lang')=='a')
{
    ?>
    <style>
 @font-face
{
font-family: cocon;
src: url(http://savnpik.com/cocon.otf);
}   
  body
{
direction:rtl!important;
font-family:cocon;
} 
.sidebar-list ul li span{float: left!important;}
.dayss{width:70px!important;}
#main-menu ul li:last-child{background:url("<?php echo $this->webroot;?>img/menu-border.png") no-repeat scroll right center rgba(0, 0, 0, 0)!important;}
#main-menu ul li{padding:0 17.5px!important;}
#login-account .logins{width:310px!important;}
#create-account .logins{width:340px!important;}
#login-account h2, #login-account .logins,#create-account h2, #create-account .logins,#login-account form,#create-account form{padding-right: 10px;}
.customStyleSelectBox{direction:ltr!important;}
    </style>
    <?php
}
?>
<script>
    function changecity(city)
    {
        
        window.location = "<?php echo $this->webroot;?>deals/city/"+city;
    }
    $(function(){
        $('.submitsub').click(function(){
       var em =  $('.subem').val();
       if(em=='')
       alert('Invalid Email');
       else
       if(em.replace('@','')==em)
       alert('Invalid Email');
       else
	if(em.replace('.','')==em)
	alert('Invalid Email');
       else
       {
        $.ajax({
           url:'<?php echo $this->webroot;?>deals/subscribe',
           data:'email='+em+'&submit=1',
           type:'post',
           success:function(res)
           {
            if(res=='a'){
            $('.messages').addClass('mred');
            $('.messages').text('Email Already Subscribed!');
            }
            else{
           
            $('.messages').text('Email Subscribed Successfully!');
            }
            $('.messages').slideDown();
             setTimeout( delayit2, 4000 );
            
           } 
        });
       }
    });
    });
    function delayit2()
        {
            
            $('.messages').slideUp(1000);
            setTimout(del2,1000);
             
        }
        function del2()
        {
            $('.messages').removeClass('mred');
        }
</script>

<header id="branding">
            <div id="top-head">
            <div class="mid-content clearfix">
                <div class="change-city">
                    <?php if($this->Session->read('lang')=='a')echo "تغيير المدينة";elseif($this->Session->read('lang')=='e')echo 'Change City';else echo 'Ändra stad';?>&nbsp;:
                    <select onchange="changecity(this.value)">
                    <?php $cities = $this->requestAction(array('controller'=>'deals','action'=>'listcity'));
                        foreach($cities as $city)
                        {?>
                            <option <?php if($this->Session->read('city')==str_replace(" ","-",$city['City']['name'])) echo "selected='selected'";?> value="<?php echo str_replace(" ","-",$city['City']['name']);?>"><?php if($this->Session->read('lang')=='a')echo $city['City']['name_arabic'];elseif($this->Session->read('lang')=='g')echo $city['City']['name_german'];else echo $city['City']['name'];?></option>       
                     <?php
                        }
                    ?>
                    </select>
                </div>
                <?php if($this->Session->read('lang')=='a')$logout='تسجيل الخروج';elseif($this->Session->read('lang')=='e')$logout = 'Log Out';else{$logout='Logga ut';} ?>
                <div class="login-register">
                
                <div class="change-city" style="margin-right: 25px;">
                    
                    <select onchange="changelang(this.value)" style="direction:ltr!important">
                        <option style="direction:ltr!important" value="e" <?php if($this->Session->read('lang')=='e'){?>selected="selected"<?php }?>>English</option>
                        <option style="direction:ltr!important" value="a" <?php if($this->Session->read('lang')=='a'){?>selected="selected"<?php }?>>العربية</option>
                        <option style="direction:ltr!important" value="g" <?php if($this->Session->read('lang')=='g'){?>selected="selected"<?php }?>>Svenska</option>
                    </select>
                </div>
					 <?php if($this->Session->read('Auth.User.username') && $this->Session->read('Auth.User.role')=='0'){
                        if($this->Session->read('lang')=='a')echo "ترحيب";elseif($this->Session->read('lang')=='e')echo 'Welcome';else echo 'Välkommen'; echo " , ".ucfirst($this->Session->read('Auth.User.username'));
                     ?>&nbsp;|&nbsp;<?php if(!$this->Session->read('logoutUrl') && !$this->Session->read('gplus')){echo $this->Html->link(
                                    $logout,
                                        array('full_base' => true,
                                            'controller' => 'users',
                                            'action' => 'logout',
                                            )
                                        );}
                                        else
                                        if(!$this->Session->read('gplus'))                                        
                                        {
                                            echo $this->Html->link($logout,'/users/fblogout');                                       
                                        }
                                        else
                                        {
                                            echo $this->Html->link($logout,'#',array('class'=>'gplus'));
                                                                                    
                                        }                                                                                
                                        ?>   
                    <?php } else { ?>
                   
                    <?php echo $this->Html->link(
                                    ($this->Session->read('lang')=='a')?'دخول':(($this->Session->read('lang')=='g')?'inloggning':'Login'),
                                        array('full_base' => true,
                                            'controller' => 'users',
                                            'action' => 'login'
                                           )
                                        );?> | 
                   <?php echo $this->Html->link(
                                    ($this->Session->read('lang')=='a')?'تسجيل':(($this->Session->read('lang')=='g')?'Registrera':'Register'),
                                        array('full_base' => true,
                                            'controller' => 'users',
                                            'action' => 'register'
                                           )
                                        );?>
                    <!-- a href=""><img src="img/lang.png"></a-->
                    <?php /*$dis = ($this->Session->read('lang')&& $this->Session->read('lang')=='en')?'display:inline-block':'display:none';?>
                    <?php echo $this->Html->link($this->Html->image("lang.png",array('fullBase' => true)), "javascript:void(0)",array('escape'=>FALSE,'class'=>'trans',"id"=>"ar",'style'=>$dis));?>
                    <a href="javascript:void(0)" id="en" class="trans" translate="no" style="display: <?php echo ($this->Session->read('lang')&& $this->Session->read('lang')=='ar')?'inline-block':'none';?>;" >English</a>
                
<?php */?>
                    
                <?php } ?>
                
                <?php /*if($this->Session->read('lang')=='e')echo $this->Html->link($this->Html->image("lang.png",array('fullBase' => true)), "javascript:void(0)",array('escape'=>FALSE,'class'=>'trans',"id"=>"ar",'style'=>''));
                    else
                    echo $this->Html->link($this->Html->image("eng.jpg",array('fullBase' => true)), "javascript:void(0)",array('escape'=>FALSE,'class'=>'trans',"id"=>"ar",'style'=>''));*/
                    ?>
                    
                <?php if($this->Session->read('Auth.User.username')&& $this->Session->read('Auth.User.role')=='0'){?>&nbsp;|&nbsp;<?php echo $this->Html->image('/img/account_and_control.png',array('url'=>'/dashboard'),array('width'=>'20px'));} ?>&nbsp;|&nbsp;<?php echo $this->Html->image('/img/carts.png',array('url'=>array('controller'=>'carts','action'=>'index')),array('width'=>'20px'));?>  

                </div>
            </div>
            </div>

            <div id="header" class="mid-content clearfix">
                <div id="logo">
                <a href="<?php echo $this->webroot;?>deals/city/<?php echo $this->Session->read('city');?>"><?php echo $this->Html->image("logo.png");?></a>
                </div>
                
                <div id="suscribe">
                    <div class="sus-text"><?php if($this->Session->read('lang')=='e'){?>Subscribe your email for daily deal alerts<?php }else if($this->Session->read('lang')=='a'){?>الاشتراك بريدك الإلكتروني للتنبيهات صفقة يوميا<?php }else{?>Prenumerera din e-post för daglig deal varningar<?php }?></div>
                    <div class="form">
                        <input type="email" placeholder="<?php if($this->Session->read('lang')=='e'){?>Enter your email please<?php }elseif($this->Session->read('lang')=='a'){?>ادخل عنوان البريد الإلكتروني الذي<?php }else{?>Ange din e-postadress<?php }?>" name="email" class="subem">
                        <input type="button" class="submitsub" value="<?php if($this->Session->read('lang')=='a'){?>اشترك الآن<?php }elseif($this->Session->read('lang')=='e'){?>Subscribe Now<?php }else{?>Prenumerera nu<?php }?>">
                    </div>
                    <div class="messages"></div>
                </div>    
            </div>

            <nav id="main-menu" class="mid-content">
            <div class="toggle-menu">Menu</div>
                <ul>
                    <li <?php if(!isset($this->params['pass'][1]))echo "class='active'";?> >
                    <?php
                    if($this->Session->read('lang')=='e') 
                    echo $this->Html->link("Deals",array('controller'=>'deals','action'=>"city",$this->Session->read('city')),array('escape' => FALSE));
                    elseif($this->Session->read('lang')=='a')
                    echo $this->Html->link("عروض",array('controller'=>'deals','action'=>"city",$this->Session->read('city')),array('escape' => FALSE));
                    else
                    echo $this->Html->link("erbjudandena",array('controller'=>'deals','action'=>"city",$this->Session->read('city')),array('escape' => FALSE));?>
                        </li>
                <?php
                     $category = $this->requestAction(array('controller' => 'deals', 'action' => 'all'));
                     //echo $this->params['pass'][1];
                     foreach($category as $cat){
                        $array = array('Events','Food & Drink','Beauty','Fitness','Electronics','Furniture','Fashion','Shopping','Home & Garden','Autos','Travel');
                        if(in_array($cat['DealCategory']['name'],$array)){
                    ?>
                        <li <?php
                        if($this->Session->read('lang')=='g')
                        {
                            ?>
                            style="font-size: 13px;"
                            <?php 
                        }
                        if($this->Session->read('lang')=='e')
                        $cat_name = $cat['DealCategory']['name'];
                        else
                        if($this->Session->read('lang')=='a')
                         $cat_name = $cat['DealCategory']['name_arabic'];
                         else
                         $cat_name = $cat['DealCategory']['name_german'];
                        if(isset($this->params['pass'][1]) && str_replace("-" ," ",$this->params['pass'][1]) == strtolower($cat['DealCategory']['name'])){echo "class='active'";}?> ><?php echo $this->Html->link($cat_name,
                            array('controller'=>'deals','action'=>"city",$this->Session->read('city'),strtolower(str_replace(" ","-",$cat['DealCategory']['name']))),array('escape' => FALSE));?></li>
                        
                    <?php }}?>
                    
                </ul>
            </nav>

        </header>  
        <script>
        function changelang(l){
               $.ajax({
                url:'<?php echo $this->webroot?>deals/createSess/'+l,
                success:function(){
                    window.location = '';
                }
               }); 
            }
        $(function(){
            
           $('.gplus').click(function(){
              window.open('https://mail.google.com/mail/u/0/?logout&hl=en','_blank');
              $.ajax({
                url:'<?php echo $this->webroot?>users/gpluslogout'
              });
              setTimeout( delayit, 3000 );
                
           }); 
        });
        function delayit()
        {
            window.location = '<?php echo $this->webroot;?>users/register';
        }
        </script>
