<div id="right-content">
<?php
if($this->params['controller']!='dashboard'){
?>
                <div id="ads">
                <a href="javascript:void(0);" style="display: block;text-decoration:none;text-align: center;" class="sharing">
                    <div class="ad-banner" style="width: 100%;background:#DD0A37;"><div style="padding: 8px;">
                        <h1 style="color: #FFF;margin:0 0 5px 0;<?php if($this->Session->read('lang')=='g'){?>font-size: 21px;<?php }else{?>font-size: 26px;<?php }?>"><?php if($this->Session->read('lang')=='e'){?>SHARING IS CARING<?php }elseif($this->Session->read('lang')=='a'){?>تقاسم يرعى<?php }else{?>Delning är omtänksam<?php }?></h1>
                        <span style="color: #FFF;"><?php if($this->Session->read('lang')=='a'){?>مشاركة SAVNPIK وكسب النقاط<?php }else{?>SHARE SAVNPIK AND EARN POINT<?php }?></span>
                        <div style="text-align: center;padding: 10px 0;font-weight:bold;color:#333;font-size: 20px;"><?php if($this->Session->read('lang')=='a'){?>انقر هنا لكسب نقطة<?php }else{?>click here to earn point<?php }?></div>
                        </div></div>
                        </a>
                   <!-- <div class="ad-banner" style="width: 100%;background:#DD0A37;"><?php echo $this->Html->link($this->Html->image("sharing.jpg",array('fullBase' => true)),'#',array('escape'=>FALSE,'class'=>'sharing'));?></div>-->
                    <div class="ad-banner">
                        <?php if($ad = $this->requestAction(array('controller'=>'ads','action'=>'get_ad')))
                                    {?>
                                    <a href="<?php echo $ad['Ad']['url'];?>" target="_blank"><?php echo $this->Html->image("/files/ads/".$ad['Ad']['image'],
                                        array('fullBase' => true,
                                        'alt'=>$ad['Ad']['alt'],
                                       'height'=>245,
                                       
                                       'width'=>273,));?>
                                       </a>
                                       <?php
                                       }
                                else
                                if($this->Session->read('lang')!='g')
                            echo "<a href='#' targt='_blank' >".$this->Html->image("dubai.jpg",array('fullBase' => true))."</a>";
                            else
                            echo "<a href='#' targt='_blank' >".$this->Html->image("dubai_german.jpg",array('fullBase' => true))."</a>";
                            ?></div>
                </div>

                <div class="social-counts">
                <a class="facebook-count" title="Facebook" href="">
                <span><?php
                $fb = 'https://developers.facebook.com'; 
                $fbcount = simplexml_load_file('https://api.facebook.com/method/fql.query?query=select%20%20like_count%20from%20link_stat%20where%20url=%22'.$fb.'%22');
                //print_r($fbcount); 
                echo cust_number($fbcount->link_stat->like_count);                   
                ?></span>
                </a>
                <a class="twitter-count" title="Twitter" href="">
                <?php
                $twit = 'http://urls.api.twitter.com/1/urls/count.json?url='.urlencode('https://dev.twitter.com/?');
                $twitter = json_decode(file_get_contents($twit));
                
                ?>
                <span><?php echo cust_number($twitter->count);?></span>
                </a>
                <a class="gplus-count" title="Google Plus" href="">
                <span>
                <?php
                echo cust_number(get_plusones('https://developers.google.com/'));
                ?>
                </span>
                </a>
                

                </div>

                <div class="sidebar-list">
                    <h1 style="font-size: 19px;"><?php echo ($this->Session->read('lang')=='a')?'كوبونات حسب الفئة':($this->Session->read('lang')=='e')?'COUPONS BY CATEGORY':'KUPONGER PER KATEGORI';?></h1>
                    <ul>
                    <?php
                     $category = $this->requestAction(array('controller' => 'deals', 'action' => 'all'));
                     //var_dump($category);
                     foreach($category as $cat){
                        if($this->Session->read('lang')=='e')
                        $categ = $cat['DealCategory']['name'];
                        else
                        if($this->Session->read('lang')=='a')
                        $categ = $cat['DealCategory']['name_arabic'];
                        else
                        $categ = $cat['DealCategory']['name_german'];
                    ?>
                        <li <?php if(isset($this->params['pass'][1]) && str_replace("-" ," ",$this->params['pass'][1]) == strtolower($cat['DealCategory']['name'])){echo "class='active'";}?>><?php echo $this->Html->link($categ." 
                                        <span>(".$this->requestAction(array('controller'=>'deals','action'=>'deal_count',$cat['DealCategory']['id'])).")</span>",
                            array('controller'=>'deals','action'=>"city",$this->Session->read('city'),strtolower(str_replace(" ","-",$cat['DealCategory']['name']))),array('escape' => FALSE));?></li>
                        <!--<a href="<?php //echo Route::url('/deals/city/'.$city."/".$cat['DealCategory']['name']);?>"><?php echo $cat['DealCategory']['name']."<span>(".$cat['DealCategory']['deal_count'].")</span>";?></a></li>-->
                    <?php }?>
                    </ul>
                </div>

                <div class="sidebar-list">
                    <h1><?php echo ($this->Session->read('lang')=='a')?'كوبونات من قبل مخازن':'COUPONS BY STORES';?></h1>
                    <ul>
                    <?php
                     $stores = $this->requestAction(array('controller' => 'deals', 'action' => 'allcompany'));
                     //var_dump($stores);
                     foreach($stores as $store){
                        if($this->Session->read('lang')=='e')
                        $comp = $store['Company']['name'];
                        else
                        if($this->Session->read('lang')=='a')
                        $comp = $store['Company']['name_arabic'];
                        else
                        $comp = $store['Company']['name_german'];
                    ?>
                        <li <?php if(isset($this->params['pass'][1]) && str_replace("-" ," ",$this->params['pass'][1]) == strtolower($store['Company']['name'])){echo "class='active'";}?>><?php echo $this->Html->link($comp.
                                                                " <span>(".$this->requestAction(array('controller'=>'deals','action'=>'deal_countbycompany',$store['Company']['id'])).")</span>",
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
                    <h1><?php echo ($this->Session->read('lang')=='a')?'تحكم المستخدم':(($this->Session->read('lang')=='g')?'Användarkontroll':'User Control');?></h1>
                    <ul>
                        <li><a href="<?php echo $this->webroot;?>dashboard"><?php echo ($this->Session->read('lang')=='a')?'بلدي عروض':(($this->Session->read('lang')=='g')?'Mina erbjudanden':'My Deals');?></a></li>
                        <li><a href="<?php echo $this->webroot;?>dashboard/setting"><?php echo ($this->Session->read('lang')=='a')?'إعدادات الحساب':(($this->Session->read('lang')=='g')?'Kontoinställningar':'Account Settings');?></a></li>
                        <li><a href="<?php echo $this->webroot;?>dashboard/mycredit"><?php echo ($this->Session->read('lang')=='a')?'بلدي الائتمان':(($this->Session->read('lang')=='g')?'min kredit':'My Credit');?></a></li>
                        <li><a href="<?php echo $this->webroot;?>dashboard/deposit"><?php echo ($this->Session->read('lang')=='a')?'صرف عملة':(($this->Session->read('lang')=='g')?'Börs':'Exhange');?></a></li>
                        <!--<li><a href="<?php echo $this->webroot;?>dashboard/request"><?php echo ($this->Session->read('lang')=='a')?'طلب شيك':(($this->Session->read('lang')=='g')?'Begär Check':'Request Cheque');?></a></li>-->
                        
                        <li style="background: #41BA33;"> </li>                   
                    </ul>
                </div>
                    <?php
                }
                ?>
            </div>
            <?php
            function get_plusones($url)  {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"'.rawurldecode($url).'","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
            $curl_results = curl_exec ($curl);
            curl_close ($curl);
            $json = json_decode($curl_results, true);
            return isset($json[0]['result']['metadata']['globalCounts']['count'])?intval( $json[0]['result']['metadata']['globalCounts']['count'] ):0;
            }
            function cust_number($number)
            {
                if($number>=1000 && $number < 1000000)
                return number_format(($number/1000),1)."K";
                else
                return number_format(($number/1000000),1)."M";
            }
            ?>
            <script>
                $(function(){
                   $('.sharing').live('click',function(){
                    //alert('test');
         $('.dialog-modal').load('<?php echo $this->webroot?>deals/sharethis');
               $('.dialog-modal').dialog({
                    
                    width: 285,
                    title:'Sharing is caring',
                    
               });
               }); 
                });
            </script>
            
