<div id="left-content"> 
              
        <div class="company-header clearfix">
            <div class="company-image"><?php echo $this->Html->image("/img/uploads/companies/".$company['Company']['logo'],
                                                    array('fullBase' =>true,
                                                            'alt'=>'Logo',
                                                            'width'=>146,
                                                            'height'=>47
                                                            ));?></div>
            <div class="company-detail"><h2><?php echo $company['Company']['name'];?></h2><?php echo $company['Company']['desc'];?></div>
        </div>
                    
    <?php if(!empty($cityDeals)) {$cnt = 0;?>
                <div id="block-list" class="clearfix">
                    <?php foreach($cityDeals as $deal ) {
                        //echo $deal['Deal']['id'];?>
                     
                    <div class="event-block">
                    
                        <div class="event-image">
                        <?php for($i = 1 ;$i<=10; $i++){
                            
                            if($deal['Deal']['image'.$i]!="" && file_exists(WWW_ROOT."/files/deals/".$deal['Deal']['image'.$i]))
                            {
                                //echo WWW_ROOT."files/deals/".$deal['Deal']['image'.$i];
                                ?>
                            
                            <a href="javascript.void(0)">
                        <?php echo $this->Html->image("/files/deals/".$deal['Deal']['image'.$i],
                                  array('fullBase' => true,
                                       'alt'=>'Logo',
                                       'height'=>117,
                                       'width'=>348));?></a>
                                
                          <?php 
                            break;
                           }
                          
                        
                        }?>
                        </div>
                        <div class="event-detail">
                            <div class="short-desc">
                            <h2><a href=""><?php echo $deal['Deal']['name'];?></a></h2>
                         <?php echo substr($deal['Deal']['description'],0,150);?>
                            </div>

                            <div class="event-desc clearfix">
                                <div class="time-discount">
                                <div class="time-remaining"><?php difference_time2($deal['Deal']['expiry_date']);?></div> 
                                <div class="save"><?php echo $deal['Deal']['discount']."%";?></div>
                                </div>

                                <a class="bttn" href="#"><span>AED</span> <?php echo $deal['Deal']['marked_price'];?></a>
                            </div>
                        </div>
                    </div>

                    
                    <?php  } ?>
                </div>
                <?php if(isset($count) && $count> 8){?>
                        <div class="pagination clearfix">
                        <?php echo $this->Paginator->prev("Prev", array('class'=>'prev','tag'=>'a'));?>
                        <?php echo str_replace(" | ","",$this->Paginator->numbers(array('tag' => 'a'))); ?>
                        <?php echo $this->Paginator->next("Next",array('class'=>'next','tag'=>'a')); ?>
                </div>
                <?php }?>
    <?php } else { ?>
    <h1>No Deals Found</h1>
    <?php } ?>
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
