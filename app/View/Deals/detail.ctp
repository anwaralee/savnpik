<div id="left-content">
                <div class="coupon-header">
                    <h1><?php echo strip_tags(substr($deal['Deal']['name'],0,200));if(strlen($deal['Deal']['highlights'])>150)echo " ...";?></h1>
                </div>

                <div class="coupon-banner clearfix">
                    <div class="buy-now">
                        <div class="buy"><a href="<?php echo $this->webroot;?>carts/addtocart/<?php echo $deal['Deal']['id']."/".$deal['Deal']['selling_price'];?>">Buy Now</a></div>
                        <div class="price"><span>AED</span><?php echo $deal['Deal']['selling_price']?></div>
                        <div class="deal-end">This deal ends in <br />
                        <span><?php difference_time($deal['Deal']['expiry_date']);?></span>
                        </div>
                        <div class="discount">
                            <label>Discount</label> <strong><?php echo $deal['Deal']['discount']?>%</strong><br />
                            <label>You Save</label> <span>AED <strong><?php echo $deal['Deal']['marked_price']-$deal['Deal']['selling_price'];?></strong></span>
                        </div>

                        <div class="view-bought clearfix">
                            <div class="view">
                                Viewed:<br/>
                                <strong><?php if($deal['Deal']['view_count'])echo $deal['Deal']['view_count'];else echo 0;?></strong>
                            </div>

                            <div class="bought">
                                Bought:<br/>
                                <strong><?php if($deal['Deal']['buy_count'])echo $deal['Deal']['buy_count'];else echo 0;?></strong>
                            </div>
                        </div>

                        <div class="recommend"><a href="">Recommend to friends</a></div>
                    </div>

                    <div class="banner-image">
                    <?php for($i = 1 ;$i<=10; $i++){
                            if($deal['Deal']['image'.$i]!="" && file_exists(WWW_ROOT."files/deals/".$deal['Deal']['image'.$i]))
                            {
                                //echo WWW_ROOT."files/deals/".$deal['Deal']['image'.$i];
                                ?>
                            
                         <?php echo $this->Html->image("/files/deals/".$deal['Deal']['image'.$i],
                                  array('fullBase' => true,
                                       'alt'=>'Logo',
                                       'height'=>342,
                                       'width'=>552));?>
                           <?php 
                           break;
                           }
                           }?>
                    </div>
                </div>

                <div class="coupon-details">
                    <div class="highlights">
                    <h2>Highlights</h2>
                    <div>
                        <?php echo $deal['Deal']['highlights'];?>
                    </div>
                    </div>

                    <div class="conditions">
                    <h2>Conditions</h2>
                    <div>
                        <?php echo $deal['Deal']['conditions'];?>
                    </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="gap"></div>

                    <div class="about-company">
                        <h2>About company</h2>
                        <p><?php echo $deal['Company']['desc'];?></p>
                    </div>

                    <div class="company-location">
                        <div class="com-logo">
                            <?php echo $this->Html->image("/img/uploads/companies/".$deal['Company']['logo'],
                                  array('fullBase' => true,
                                       'alt'=>'Logo',
                                       'height'=>55,
                                       'width'=>177));?>
                        </div>
                        <h3><?php echo $deal['Company']['name'];?></h3>
                        <a href="<?php if(str_replace(array('http://','https://'),array('',''),$deal['Company']['website'])==$deal['Company']['website'])echo 'http://';echo $deal['Company']['website'];?>">Company website: <?php echo $deal['Company']['website'];?></a>
                        <br/><br/>
                        <h3>Location</h3>
                        <?php echo $deal['Company']['address'];?>
                    </div>
                <div class="clearfix"></div>    
                </div>

                <div class="realated-deals">
                    <h1>Related Deals</h1>
                </div>
                <div id="block-list" class="clearfix">
                <?php
                $related = $this->requestAction('/deals/get_realated/'.$deal['Deal']['deal_category_id'].'/'.$deal['Deal']['name'].'/'.$deal['Deal']['id']);
                //var_dump($related);
                if($related)
                {
                    foreach($related as $de)
                    {
                        foreach($de as $d){

                        ?>
                        <div class="event-block">
                        <div class="event-image">
                        <?php for($i = 1 ;$i<=10; $i++){
                            if($d['Deal']['image'.$i]!="" && file_exists(WWW_ROOT."files/deals/".$d['Deal']['image'.$i]))
                            {
                                //echo WWW_ROOT."files/deals/".$deal['Deal']['image'.$i];
                                ?>
                            
                            <?php echo 
                            $this->Html->image("/files/deals/".$d['Deal']['image'.$i],
                                  array('fullBase' => true,
                                       'alt'=>'Logo',
                                       'height'=>117,
                                       'width'=>348,'url'=>'/deal/'.$d['Deal']['slug']));?>
                        
                                
                          <?php 
                            break;
                           }
                          
                        
                        }?></div>
                        <div class="event-detail">
                            <div class="short-desc">
                            <h2><?php echo $this->Html->link($d['Deal']['name'],'/deal/'.$d['Deal']['slug']);?></h2>
                            <p><?php echo substr($d['Deal']['description'],0,150);?></p> 
                            </div>

                            <div class="event-desc clearfix">
                                <div class="time-discount">
                                <div class="time-remaining"><?php difference_time2($d['Deal']['expiry_date']);?></div> 
                                <div class="save">55%</div>
                                </div>

                                <a class="bttn" href="#"><span>AED</span> <?php echo $d['Deal']['selling_price'];?></a>
                            </div>
                        </div>
                        </div>
                        <?php
                    }}
                }
                ?>
                    

                    
                </div>
                <a class="more-related" href="">more related deals</a>
            </div>
            <?php
            function difference_time($expiry)
            {
                
                                date_default_timezone_set('Asia/Kathmandu');
                                                                
                                //echo $seconds_diff = $ts1 - $ts2;
                                $datetime1 = date_create(date('Y-m-d'));
                                $datetime2 = date_create($expiry);
                                $interval = date_diff($datetime1, $datetime2);
                                $days = str_replace('+','',$interval->format('%R%a'));
                                //if((str_replace('+','',$interval->format('%R%a')))!='1' && (str_replace('+','',$interval->format('%R%a')))!='0')
                                //echo "s";
                                //echo " 05:05:02";
                                $hour = date('H');
                                $min = date('i');
                                $sec = date('s');
                                
                                if($hour<24)
                                {
                                    $s = 60-$sec;
                                    $m = 60-$min;
                                    $h = 23-$hour;
                                    
                                    if($s==60){
                                    $m++;
                                    $s=0;
                                    }
                                    if($m==60){
                                    $h++;
                                    $m=0;
                                    }
                                    if($h==24)
                                    {
                                        $h=0;
                                        $days++;
                                    }
                                    if($h<10)
                                    $h1= '0'.$h;
                                    else
                                    $h1 = $h;
                                    if($m<10)
                                    $h1 = $h1.':0'.$m;
                                    else
                                    $h1 = $h1.':'.$m;
                                    if($s<10)
                                    $h1 = $h1.':0'.$s;
                                    else
                                    $h1 = $h1.':'.$s;
                                    
                                    
                                }
                                if($days>0){
                                echo $days.' day';
                                if($days>1)
                                echo 's';
                                echo ' '.$h1;
                                }
                                else
                                echo "EXPIRED";
                                
                            
            }
            function difference_time2($expiry)
            {
                
                                date_default_timezone_set('Asia/Kathmandu');
                                                                
                                //echo $seconds_diff = $ts1 - $ts2;
                                $datetime1 = date_create(date('Y-m-d'));
                                $datetime2 = date_create($expiry);
                                $interval = date_diff($datetime1, $datetime2);
                                $days = str_replace('+','',$interval->format('%R%a'));
                                //if((str_replace('+','',$interval->format('%R%a')))!='1' && (str_replace('+','',$interval->format('%R%a')))!='0')
                                //echo "s";
                                //echo " 05:05:02";
                                $hour = date('H');
                                $min = date('i');
                                $sec = date('s');
                                
                                if($hour<24)
                                {
                                    $s = 60-$sec;
                                    $m = 60-$min;
                                    $h = 23-$hour;
                                    
                                    if($s==60){
                                    $m++;
                                    $s=0;
                                    }
                                    if($m==60){
                                    $h++;
                                    $m=0;
                                    }
                                    if($h==24)
                                    {
                                        $h=0;
                                        $days++;
                                    }
                                    if($h<10)
                                    $h1= '0'.$h;
                                    else
                                    $h1 = $h;
                                    if($m<10)
                                    $h1 = $h1.':0'.$m;
                                    else
                                    $h1 = $h1.':'.$m;
                                    if($s<10)
                                    $h1 = $h1.':0'.$s;
                                    else
                                    $h1 = $h1.':'.$s;
                                    
                                    
                                }
                                if($days>0){
                                echo $days.' day';
                                if($days>1)
                                echo 's';
                                echo ' '.$h.' h remaining';
                                }
                                else
                                echo "EXPIRED";
                                
                            
            }
            ?>
