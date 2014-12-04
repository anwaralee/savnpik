 <footer id="footer">
            <div class="mid-content">
            <div class="top-footer clearfix">
                <div class="footer1">
                    <div class="footer1-inner">
                    <h2><?php if($this->Session->read('lang')=='a'){?> Savnpik حول<?php }elseif($this->Session->read('lang')=='a'){?>About Savnpik<?php }else{?>Om Savnpik<?php }?></h2>
                    <?php 
                        echo $this->requestAction(array('controller'=>'deals','action'=>'get_content','9'));?> 
                    
                    </div>
                </div>

                <div class="footer2">
                    <h2><?php if($this->Session->read('lang')=='a'){?>شركة<?php }elseif($this->Session->read('lang')=='e'){?>Company<?php }else{?>Företag<?php }?></h2>
                    <ul>
                    <?php
                            if($this->Session->read('lang')=='a')
                                $ar = "_arabic";
                            elseif($this->Session->read('lang')=='g')
                                $ar = "_german";                                
                            else
                                $ar = "";
                             $company = $this->requestAction(array('controller'=>'deals','action'=>'get_page_by_category','9'));
                            
                            foreach($company as $c)
                            { ?>
                             <li><a href="<?php echo $this->webroot;?>page/<?php echo $c['Page']['slug'];?>"><?php echo $c['Page']['title'.$ar];?></a></li>   
                    <?php
                            }
                    ?>
                        
                        <!--<li><a href="<?php echo $this->webroot;?>">About us</a></li>
                        <li><a href="">Contact us</a></li>
                        <li><a href="">Advertise with us</a></li>
                        <li><a href="">Job opportunities</a></li>
                        <li><a href="">Term and Conditions</a></li>
                        <li><a href="">Privacy Policy</a></li>-->
                    </ul>
                </div>

                <div class="footer3">
                    <h2><?php if($this->Session->read('lang')=='a'){?>مساعدة<?php }elseif($this->Session->read('lang')=='e'){?>Help<?php }else{?>Hjälp<?php }?></h2>
                    <ul>
                    <?php $help = $this->requestAction(array('controller'=>'deals','action'=>'get_page_by_category','8'));
                            foreach($help as $c)
                            { ?>
                             <li><a href="<?php echo $this->webroot;?>page/<?php echo $c['Page']['slug'];?>"><?php echo $c['Page']['title'.$ar];?></a></li>   
                    <?php
                            }
                    ?>
                        <!--<li><a href="">FAQ</a></li>
                        <li><a href="">Customer Support</a></li>
                        <li><a href="">Advertise with us</a></li>
                        <li><a href="">How it works</a></li>
                        <li><a href="">For business owners</a></li>-->
                    </ul>
                </div>

                <div class="footer4">
                    <h2><?php if($this->Session->read('lang')=='a'){?>نحن نقبل<?php }elseif($this->Session->read('lang')=='e'){?>We accept<?php }else{?>vi accepterar<?php }?></h2>
                    <?php echo $this->Html->image("cards.png",array('fullBase' => true));?>
                    

                    <div class="socials">
                    <h2><?php if($this->Session->read('lang')=='a'){?>نحن الاجتماعية<?php }elseif($this->Session->read('lang')=='e'){?>We are social<?php }else{?>Vi är sociala<?php }?></h2>
                    
                    <a href="https://developers.facebook.com/" class="facebook">Facebook</a>
                    <a href="https://dev.twitter.com/‎" class="twitter">Twitter</a>
                    <a href="https://developers.google.com/‎" class="gplus">Google Plus</a>
                    </div>
                </div>
                </div>

                
                <div class="bottom-footer" style="direction: ltr;">
                    <div class="footer-logo">
                        <a href="<?php echo $this->webroot;?>deals/city/<?php echo $this->Session->read('city');?>"><?php echo $this->Html->image("logo.png",array('fullBase' => true));?></a>
                    </div>

                    <p class="copyright">COPYRIGHT © 2014 BY SAVNPIK.<br />
                    ALL RIGHTS RESERVED.</p>
                    <div class="developed">Development by: incircletech</div>
                </div>
            </div>
        </footer>       
