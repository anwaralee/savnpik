<div id="right-content">
<?php
if($this->params['controller']!='dashboard'){
?>
                <div id="ads">
                    <div class="ad-banner"><?php echo $this->Html->image("sharing.jpg",array('fullBase' => true));?></div>
                    <div class="ad-banner"><?php echo $this->Html->image("dubai.jpg",array('fullBase' => true));?></div>
                </div>

                <div class="social-counts">
                    <a href="" title="Facebook" class="facebook-count"><span>142K</span></a>
                    <a href="" title="Twitter" class="twitter-count"><span>253K</span></a>
                    <a href="" title="Google Plus" class="gplus-count"><span>253K</span></a>
                </div>

                <div class="sidebar-list">
                    <h1>COUPONS BY CATEGORY</h1>
                    <ul>
                    <?php
                     $category = $this->requestAction(array('controller' => 'deals', 'action' => 'all'));
                     //var_dump($category);
                     foreach($category as $cat){
                    ?>
                        <li><?php echo $this->Html->link($cat['DealCategory']['name']." <span>(".$cat['DealCategory']['deal_count'].")</span>",
                            array('controller'=>'deals','action'=>"city",$this->Session->read('city'),strtolower(str_replace(" ","-",$cat['DealCategory']['name']))),array('escape' => FALSE));?>
                        <!--<a href="<?php //echo Route::url('/deals/city/'.$city."/".$cat['DealCategory']['name']);?>"><?php echo $cat['DealCategory']['name']."<span>(".$cat['DealCategory']['deal_count'].")</span>";?></a></li>-->
                    <?php }?>
                    </ul>
                    <!--<ul>
                        <li><a href="">Food & Drink<span>(54)</span></a></li>       
                        <li><a href="">Events<span>(14)</span></a></li>       
                        <li><a href="">Beauty<span>(140)</span></a></li>       
                        <li><a href="">Fitness<span>(24)</span></a></li>       
                        <li><a href="">Electronics<span>(14)</span></a></li>       
                        <li><a href="">Furniture<span>(45)</span></a></li>       
                        <li><a href="">Fashion<span>(77)</span></a></li>       
                        <li><a href="">Shopping<span>(27)</span></a></li>       
                        <li><a href="">Home & Garden<span>(104)</span></a></li>     
                        <li><a href="">Autos<span>(141)</span></a></li>
                        <li><a href="">Travel<span>(74)</span></a></li>
                    </ul>-->
                </div>

                <div class="sidebar-list">
                    <h1>COUPONS BY STORES</h1>
                    <ul>
                    <?php
                     $stores = $this->requestAction(array('controller' => 'deals', 'action' => 'allcompany'));
                     //var_dump($stores);
                     foreach($stores as $store){
                    ?>
                        <li><?php echo $this->Html->link($store['Company']['name']." <span>(".$store['Company']['deal_count'].")</span>",
                            array('controller'=>'deals','action'=>"stores",$this->Session->read('city'),strtolower(str_replace(" ","-",$store['Company']['name']))),array('escape' => FALSE));?>
                        <!--<a href="<?php //echo Route::url('/deals/city/'.$city."/".$cat['DealCategory']['name']);?>"><?php echo $store['Company']['name']."<span>(".$cat['DealCategory']['deal_count'].")</span>";?></a></li>-->
                    <?php }?>
                    <!--
                        <li><a href="">Hushpapies<span>(52)</span></a></li>
                        <li><a href="">Splash<span>(532)</span></a></li>
                        <li><a href="">Max<span>(12)</span></a></li>
                        <li><a href="">Saloon<span>(22)</span></a></li>
                        <li><a href="">BigBus<span>(32)</span></a></li>
                        <li><a href="">Emax<span>(42)</span></a></li>
                        <li><a href="">Karachi darbar<span>(552)</span></a></li>
                        <li><a href="">Fish point<span>(652)</span></a></li>
                        <li><a href="">Homes r us<span>(572)</span></a></li>
                        <li><a href="">PEN Emirates<span>(152)</span></a></li>-->
                    </ul>
                </div>
                <?php 
                }
                else
                {
                    ?>
                    <div class="sidebar-list">
                    <h1>User Control</h1>
                    <ul>
                        <li><a href="<?php echo $this->webroot;?>dashboard">My Deals</a></li>
                        <li><a href="<?php echo $this->webroot;?>dashboard/setting">Account Settings</a></li>
                        <li><a href="<?php echo $this->webroot;?>dashboard/mycredit">My Credit</a></li>
                        <li><a href="#">Exchange/Deposit</a></li>
                        <li><a href="#">Request Cheque</a></li>
                        
                        <li style="background: #41BA33;"> </li>                   
                    </ul>
                </div>
                    <?php
                }
                ?>
            </div>
