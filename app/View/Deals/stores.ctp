<?php
if($this->Session->read('lang')=='a')
    $ar = "_arabic";
elseif($this->Session->read('lang')=='g')
    $ar = "_german";
else
    $ar = "";
?>

<div id="left-content"> 
              
        <div class="company-header clearfix">
            <div class="company-image"><?php echo $this->Html->image("/img/uploads/companies/".$company['Company']['logo'],
                                                    array('fullBase' =>true,
                                                            'alt'=>'Logo',
                                                            'width'=>146,
                                                            'height'=>47
                                                            ));?></div>
            <div class="company-detail"><h2><?php echo $company['Company']['name'.$ar];?></h2><?php echo $company['Company']['desc'.$ar];?></div>
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
                            
                           
                        <?php echo $this->Html->image("/files/deals/".$deal['Deal']['image'.$i],
                                  array('fullBase' => true,
                                       'alt'=>'Logo',
                                       'height'=>117,
                                       'width'=>348,
                                       'url' =>'/deal/'.$deal['Deal']['slug']
                                       ));?>
                                
                          <?php 
                            break;
                           }
                          
                        
                        }?>
                        </div>
                        <div class="event-detail">
                            <div class="short-desc">
                            <h2><?php echo $this->Html->link($deal['Deal']['name'.$ar],'/deal/'.$deal['Deal']['slug']);?></a></h2>
                         <?php echo substr($deal['Deal']['description'.$ar],0,150);?>
                            </div>

                            <div class="event-desc clearfix">
                                <div class="time-discount">
                                <div class="time-remaining"><?php difference_time2($deal['Deal']['expiry_date'],$this->Session->read('lang'));?></div> 
                                <div class="save"><?php echo $deal['Deal']['discount']."%";?></div>
                                </div>

                                <a class="bttn" href="<?php echo $this->webroot;?>deal/<?php echo $deal['Deal']['slug'];?>"><span><?php if($this->Session->read('lang')=='e'|| $l == 'g'){?>AED<?php }else echo "درهم";?></span> <?php echo $deal['Deal']['selling_price'];?></a>
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
    <h1><?php echo ($this->Session->read('lang')=='a')?"لم يتم العثور عروض":(($l=='g')?"Inga erbjudandena Funnet":"No Deals Found");?></h1>
    <?php } ?>
            </div>
                      <?php
            function difference_time($expiry,$z=null,$sess)
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
                                    $h1= '<span class="h'.$z.'">0'.$h.'</span>';
                                    else
                                    $h1 = '<span class="h'.$z.'">'.$h.'</span>';
                                    if($m<10)
                                    $h1 = $h1.':<span class="m'.$z.'">0'.$m.'</span>';
                                    else
                                    $h1 = $h1.':<span class="m'.$z.'">'.$m.'</span>';
                                    if($s<10)
                                    $h1 = $h1.':<span class="s'.$z.'">0'.$s.'</span>';
                                    else
                                    $h1 = $h1.':<span class="s'.$z.'">'.$s.'</span>';
                                    
                                    
                                }

                                if($days>0){
                                if($sess=='e')    
                                    $ddd = '<span style="display:inline-block;"><span class="d'.$z.'">'.$days.'</span> day';
                                elseif($sess=='g')    
                                    $ddd = '<span style="display:inline-block;"><span class="d'.$z.'">'.$days.'</span> dag';
                                
                                else
                                    $ddd = '<span style="display:inline-block;width:78px;"><span class="d'.$z.'">'.$days.'</span> يوم';
                                if($days>1){
                                $ddd = $ddd. 's</span>';
                                }
                                else
                                $ddd = $ddd. '</span>';
                                if($sess=='a')
                                    $ddd = str_replace(array('days','day'),array('<span class="left" style="display:inline-block;">يوما&nbsp;</span>','<span class="left" style="display:inline-block;">اليوم&nbsp;</span>'),$ddd);                              
                                if($sess=='g')
                                    $ddd = str_replace(array('days','day'),array('<span class="left" style="display:inline-block;">dagar&nbsp;</span>','<span class="left" style="display:inline-block;">dag&nbsp;</span>'),$ddd);                              
                                
                                echo $ddd;
                                echo ' '.$h1;
                                }
                                elseif($days==0)
                                {
                                    echo "<span style='display:inline:block;'>".$h1."</span>";

                                }
                                else
                                    echo "<span style='display:inline:block;'>EXPIRED</span>";
                                
                            
            }
            function difference_time2($expiry,$sess)
            {
                
                                date_default_timezone_set('Asia/Dubai');
                                                                
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
                                if($sess=='e'){
                                if($days>0){
                                    echo $days.' day';
                                    if($days>1)
                                        echo 's';
                                    echo ' '.$h.' h remaining';
                                }
                                elseif($days==0)
                                {
                                    echo ' '.$h.' h remaining';
                                }
                                else
                                    echo "EXPIRED";
                                }
                                elseif($sess=='g'){
                                    if($days>0){
                                        echo $days.' dag';
                                        if($days>1)
                                            echo 's';
                                        echo ' '.$h.' h återstående';
                                    }
                                    elseif($days==0)
                                    {
                                        echo ' '.$h.' h återstående';
                                    }
                                    else
                                        echo "TILLÄNDALUPEN";
                                }
                                else
                                {
                                    
                                    if($days>0){
                                    ?>
                                    <span style="display: inline-block;">ساعة المتبقية</span>
                                    <span style="display: inline-block;">&nbsp;<?php echo $h?>&nbsp;</span>
                                    <?php
                                    if($days>1)
                                    {
                                        ?>
                                        <span style="display: inline-block;">أيام</span>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <span style="display: inline-block;">يوم</span>
                                        
                                        <?php
                                    }
                                    echo "<span style='display:inline-block;'>&nbsp;".$days."</span>"; 
                                    
                                    }
                                    elseif($days==0)
                                    {
                                        echo ' <span style="display: inline-block;">ساعة المتبقية</span><span style="display:inline-block">&nbsp;'.$h.'</span>';
                                    }
                                    else
                                    echo "EXPIRED";
                                }
                                
                            
            }
            ?>