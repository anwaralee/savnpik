 <footer id="footer">
            <div class="mid-content">
            <div class="top-footer clearfix">
                <div class="footer1">
                    <div class="footer1-inner">
                    <h2>About Savnpik</h2>
                    <?php 
                        echo $this->requestAction(array('controller'=>'deals','action'=>'get_content','9'));?> 
                    
                    </div>
                </div>

                <div class="footer2">
                    <h2>Company</h2>
                    <ul>
                    <?php $company = $this->requestAction(array('controller'=>'deals','action'=>'get_page_by_category','9'));
                            foreach($company as $c)
                            { ?>
                             <li><a href="<?php echo $this->webroot;?>page/<?php echo $c['Page']['slug'];?>"><?php echo $c['Page']['title'];?></a></li>   
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
                    <h2>Help</h2>
                    <ul>
                    <?php $help = $this->requestAction(array('controller'=>'deals','action'=>'get_page_by_category','8'));
                            foreach($help as $c)
                            { ?>
                             <li><a href="<?php echo $this->webroot;?>page/<?php echo $c['Page']['slug'];?>"><?php echo $c['Page']['title'];?></a></li>   
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
                    <h2>We accept</h2>
                    <?php echo $this->Html->image("cards.png",array('fullBase' => true));?>
                    

                    <div class="socials">
                    <h2>We are social</h2>
                    
                    <a href="" class="facebook">Facebook</a>
                    <a href="" class="twitter">Twitter</a>
                    <a href="" class="gplus">Google Plus</a>
                    </div>
                </div>
                </div>

                
                <div class="bottom-footer">
                    <div class="footer-logo">
                        <a href="<?php echo $this->webroot;?>deals/city/<?php echo $this->Session->read('city');?>"><?php echo $this->Html->image("logo.png",array('fullBase' => true));?></a>
                    </div>

                    <p class="copyright">COPYRIGHT © 2014 BY SAVENPIK.<br />
                    ALL RIGHTS RESERVED.</p>
                    <div class="developed">Development by: incircletech</div>
                </div>
            </div>
        </footer>       
