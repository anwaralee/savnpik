<script>
    function changecity(city)
    {
        
        window.location = "/deals/city/"+city;
    }
</script>
<header id="branding">
            <div id="top-head">
            <div class="mid-content clearfix">
                <div class="change-city">
                    Change City:
                    <select onchange="changecity(this.value)">
                    <?php $cities = $this->requestAction(array('controller'=>'deals','action'=>'listcity'));
                        foreach($cities as $city)
                        {?>
                            <option <?php if($this->Session->read('city')==str_replace(" ","-",$city['City']['name'])) echo "selected='selected'";?> value="<?php echo str_replace(" ","-",$city['City']['name']);?>"><?php echo $city['City']['name'];?></option>       
                     <?php
                        }
                    ?><!--
                    <select name="">
                        <option>Abu Dhabi</option>
                        <option>Dubai</option>
                        <option>Patlia</option>
                        <option>Yoman</option>-->
                    </select>
                </div>
                
                <div class="login-register">
					 <?php if($this->Session->read('Auth.User.username')){
                        echo 'Welcome, '.ucfirst($this->Session->read('Auth.User.username'));
                     ?>
                    <?php echo $this->Html->link(
                                    'Log Out',
                                        array('full_base' => true,
                                            'controller' => 'users',
                                            'action' => 'logout',
                                            )
                                        );?>   
                    <?php } else { ?>
                   
                    <?php echo $this->Html->link(
                                    'Login',
                                        array('full_base' => true,
                                            'controller' => 'users',
                                            'action' => 'login'
                                           )
                                        );?> | 
                   <?php echo $this->Html->link(
                                    'Register',
                                        array('full_base' => true,
                                            'controller' => 'users',
                                            'action' => 'register'
                                           )
                                        );?>  |
                    <!-- a href=""><img src="img/lang.png"></a-->
                <?php echo $this->Html->image("lang.png",array('fullBase' => true));?>
                <?php } ?>    
                </div>
            </div>
            </div>

            <div id="header" class="mid-content clearfix">
                <div id="logo">
                <a href=""><?php echo $this->Html->image("logo.png");?></a>
                </div>
                
                <div id="suscribe">
                    <div class="sus-text">Subscribe your email for daily deal alerts</div>
                    <form action="">
                        <input type="text" placeholder="Enter your email please">
                        <input type="submit">
                    </form>
                </div>    
            </div>

            <nav id="main-menu" class="mid-content">
            <div class="toggle-menu">Menu</div>
                <ul>
                    <li><?php echo $this->Html->link("All Deal",
                            array('controller'=>'deals','action'=>"city",$this->Session->read('city')),array('escape' => FALSE));?>
                        </li>
                <?php
                     $category = $this->requestAction(array('controller' => 'deals', 'action' => 'all'));
                     //var_dump($category);
                     foreach($category as $cat){
                    ?>
                        <li><?php echo $this->Html->link($cat['DealCategory']['name'],
                            array('controller'=>'deals','action'=>"city",$this->Session->read('city'),strtolower(str_replace(" ","-",$cat['DealCategory']['name']))),array('escape' => FALSE));?>
                        
                    <?php }?>
                    <!--
                    <li><a href="#">All Deals</a></li>
                    <li><a href="#">Food &amp; Drink</a></li>
                    <li><a href="#">Events</a></li>
                    <li><a href="#">Beauty</a></li>
                    <li><a href="#">Fitness</a></li>
                    <li><a href="#">Electronics</a></li>
                    <li><a href="#">Furniture</a></li>
                    <li><a href="#">Fashion</a></li>
                    <li><a href="#">Shopping</a></li>
                    <li><a href="#">Home &amp; Garden</a></li>
                    <li><a href="#">Autos</a></li>
                    <li><a href="#">Travel</a></li>-->
                </ul>
            </nav>

        </header>  
