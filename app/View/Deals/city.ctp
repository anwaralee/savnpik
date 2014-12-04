    <?php echo $this->Html->script('jquery.als-1.4.min.js');?>
    <?php echo $this->Html->css('als_demo.css');?>
    
		<script type="text/javascript">
			$(document).ready(function() 
			{
				$("#lista1").als({
					visible_items: 4,
					scrolling_items: 1,
					orientation: "horizontal",
					circular: "yes",
					autoscroll: "yes",
					interval: 5000,
					speed: 500,
					easing: "linear",
					direction: "left",
					start_from: 0
				});
    });
    </script>
    <?php
    if($this->Session->read('lang')=='e')
        $l='e';
    elseif($this->Session->read('lang')=='a')
        $l='a';
    else
        $l='g';    
    ?>
<div id="left-content">
    <?php if(isset($features) || isset($nocat)) {
            //echo count($features);
        if($features && count($features)>1){
        //var_dump($features);
        ?>
	<div id="lista1" class="als-container">
				<!--<span class="als-prev"><img src="img/thin_left_arrow_333.png" alt="prev" title="previous" /></span>-->
				<div class="als-viewport">
					<ul class="als-wrapper">
                    
                    <?php
                    $z=0; 
                    foreach($features as $feature){
                        $z++;
                        ?>
						
                    <?php if($feature['Deal']['image1']!="" ) {?>
                    <li class="als-item">
                    <div id="banner">
                        <?php echo $this->Html->image("/files/deals/".$feature['Deal']['image1'],
                                  array('fullBase' => true,
                                       'alt'=>'Logo',
                                       'height'=>358,
                                       'width'=>717,'url'=>'/deal/'.$feature['Deal']['slug']));?>
                     
                    </div>
                    <div class="absolute">
                        <div class="price"><?php if($this->Session->read('lang')=='e'|| $l =='g'){?>AED<?php }else echo "درهم";?> <strong><?php echo $feature['Deal']['selling_price'];?></strong></div>
                        <div class="discount">
                        <div class="left"><?php if($this->Session->read('lang')=='e'){?>Discount<?php }elseif($this->Session->read('lang')=='g'){echo "rabatt";}else echo "خصم";?><br /><strong><?php echo $feature['Deal']['discount'];?>%</strong></div>
                        <div class="right"><?php if($this->Session->read('lang')=='e'){?>You save<?php }elseif($this->Session->read('lang')=='g'){echo "du sparar";}else echo "يمكنك حفظ";?><br /><?php if($this->Session->read('lang')=='e'){?>AED<?php }elseif($this->Session->read('lang')=='g'){echo "AED";}else echo "&nbsp;درهم&nbsp;";?> <strong><?php echo $feature['Deal']['marked_price']-$feature['Deal']['selling_price'];?></strong></div>
                        <div class="clearfix"></div>
                        </div>
                        <div class="limit">
                            <?php if($l=='e')echo "This deal can be bought over the next";elseif($l=='a')echo 'ويمكن شراء هذه الصفقة على مدى المقبل';else echo "Affären kan köpas över nästa";?>:<br />
                            
                            <div id="counter" class="timer">
                            
                            <?php

                                difference_time($feature['Deal']['expiry_date'],$z);

                            ?>
                                
                            </div>
                        </div>
                        <div class="bought">
                            <div class="left"><?php if($this->Session->read('lang')=='e'){?>Bought:<?php }elseif($this->Session->read('lang')=='g'){echo "köpt";}else echo ":اشترى";?><br /><strong><?php if($feature['Deal']['buy_count'])echo $feature['Deal']['buy_count'];else echo 0;?></strong></div>
                            <div class="right"><?php if($this->Session->read('lang')=='e'){?>Viewed:<?php }elseif($this->Session->read('lang')=='g'){echo "Visad";}else echo ":شوهدت";?><br /><span><?php if($feature['Deal']['view_count'])echo $feature['Deal']['view_count'];else echo 0;?></span></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="buyy">
                            <a href="<?php echo $this->webroot.'deal/'.$feature['Deal']['slug'];?>"><?php echo $this->Html->image("/img/buy.jpg",
                                  array('fullBase' => true,
                                       'alt'=>'Logo'
                                       ));?></a>
                        </div>
                    </div>
                    
                    <?php }?>
                    </li>
                    <?php }?>
                        
						
                    </ul>
				</div>
				<!--<span class="als-next"><?php echo $this->Html->image('thin_right_arrow_333.pgn');?></span>-->
			</div>
              <?php }
              else
              if($features)
              {?>
                <div id="banner">
                        <?php echo $this->Html->image("/files/deals/".$features[0]['Deal']['image1'],
                                  array('fullBase' => true,
                                       'alt'=>'Logo',
                                       'height'=>358,
                                       'width'=>717,'url'=>'/deal/'.$features[0]['Deal']['slug']));?>
                     
                    </div>
                    <div class="absolute">
                        <div class="price"><?php if($this->Session->read('lang')=='e'|| $l=='g'){?>AED<?php }else echo "درهم";?> <strong><?php echo $features[0]['Deal']['selling_price'];?></strong></div>
                        <div class="discount">
                        <div class="left"><?php if($this->Session->read('lang')=='e'){?>Discount<?php }else if($this->Session->read('lang')=='a')echo "خصم";else echo 'Rabatt';?><br /><strong><?php echo $features[0]['Deal']['discount'];?>%</strong></div>
                        <div class="right">
                        <?php if($this->Session->read('lang')=='e'){?>You save<?php }elseif($l=='g')echo "du sparar";else echo "يمكنك حفظ";?><br /><?php if($this->Session->read('lang')=='e'|| $l=='g'){?>AED<?php }else echo "درهم";?> <strong><?php echo $features[0]['Deal']['marked_price']-$features[0]['Deal']['selling_price'];?></strong></div>
                        <div class="clearfix"></div>
                        </div>
                        <div class="limit">
                            <?php if($l=='e')echo "This deal can be bought over the next";elseif($l=='a')echo 'ويمكن شراء هذه الصفقة على مدى المقبل';else echo "Affären kan köpas över nästa";?>:<br />
                            
                            <div id="counter" class="timer">
                            
                            <?php
                                difference_time($features[0]['Deal']['expiry_date'],1,$this->Session->read('lang'));
                            ?>
                                
                            </div>
                        </div>
                        <div class="bought">
                           <div class="left"><?php if($this->Session->read('lang')=='e'){?>Bought:<?php }elseif($this->Session->read('lang')=='g'){echo "köpt";}else echo ":اشترى";?><br /><strong><?php if($feature['Deal']['buy_count'])echo $feature['Deal']['buy_count'];else echo 0;?></strong></div>
                            <div class="right"><?php if($this->Session->read('lang')=='e'){?>Viewed:<?php }elseif($this->Session->read('lang')=='g'){echo "Visad";}else echo ":شوهدت";?><br /><span><?php if($feature['Deal']['view_count'])echo $feature['Deal']['view_count'];else echo 0;?></span></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="buyy">
                            <?php if($this->Session->read('lang')=='e'){?>  
                            <a href="<?php echo $this->webroot.'deal/'.$features[0]['Deal']['slug'];?>"><?php echo $this->Html->image("/img/buy.jpg",
                                  array('fullBase' => true,
                                       'alt'=>'Logo'
                                       ));?></a>
                                       <?php }else{
                                        ?>
                                        <a href="<?php echo $this->webroot.'deal/'.$features[0]['Deal']['slug'];?>"><?php echo $this->Html->image("/img/buy1.png",
                                  array('fullBase' => true,
                                       'alt'=>'Logo'
                                       ));?></a>            
                                        <?php
                                       }?>
                        </div>
                    </div>
              <?php }?>
                    <?php }
                    else
                    { ?>
                    <div class="cat-header clearfix">
                    <h2><?php echo $Cat;?></h2>
                    <a href="<?php echo $this->webroot;?>deals/city/<?php echo $this->Session->read('city');?>" class="back" ><?php if($this->Session->read('lang')=='e')echo "back to home";elseif($this->Session->read('lang')=='g')echo "tillbaka till hemmet";else{echo "العودة إلى المنزل";}?></a>
                    </div>
                    <?php }
                    //var_dump($cityDeals);
                    ?>
    <?php if(!empty($cityDeals) && count($cityDeals)>0) {
        $cnt = 0;?>
                <div id="block-list" class="clearfix">
                    <?php foreach($cityDeals as $deal ) {
                        //echo $deal['Deal']['id'];?>
                     
                    <div class="event-block">
                    
                        <div class="event-image">
                        <?php for($i = 1 ;$i<=10; $i++){
                            
                            if($deal['Deal']['image'.$i]!="" && file_exists(WWW_ROOT."files/deals/".$deal['Deal']['image'.$i]))
                            {
                                //echo WWW_ROOT."files/deals/".$deal['Deal']['image'.$i];
                                ?>
                            
                            <?php echo 
                            $this->Html->image("/files/deals/".$deal['Deal']['image'.$i],
                                  array('fullBase' => true,
                                       'alt'=>'Logo',
                                       'height'=>117,
                                       'width'=>348,'url'=>'/deal/'.$deal['Deal']['slug']));?>
                        
                                
                          <?php 
                            break;
                           }
                          
                        
                        }?>
                        </div>
                        <div class="event-detail">
                            <div class="short-desc">
                            <h2><?php if($l=='e')echo $this->Html->link($deal['Deal']['name'],'/deal/'.$deal['Deal']['slug']);
                                        elseif($l=='g')echo $this->Html->link($deal['Deal']['name_german'],'/deal/'.$deal['Deal']['slug']);
                                        else echo $this->Html->link($deal['Deal']['name_arabic'],'/deal/'.$deal['Deal']['slug']);?></h2>
                         <?php if($l=='e')echo substr($deal['Deal']['description'],0,150);elseif($l=='g')echo substr($deal['Deal']['description_german'],0,150);else echo substr($deal['Deal']['description_arabic'],0,150);?>
                            </div>

                            <div class="event-desc clearfix">
                                <div class="time-discount">
                                <div class="time-remaining"><?php difference_time2($deal['Deal']['expiry_date'],$this->Session->read('lang'));?></div> 
                                <div class="save"><?php echo $deal['Deal']['discount']."%";?></div>
                                </div>

                                <a class="bttn" href="<?php echo $this->webroot;?>deal/<?php echo $deal['Deal']['slug']?>"><span><?php if($this->Session->read('lang')=='e'|| $l == 'g'){?>AED<?php }else echo "درهم";?></span> <?php echo $deal['Deal']['selling_price'];?></a>
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
    <?php }
     else { ?>
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
<script>
$(function(){
    setInterval(function(){
        <?php
        if(count($features)==1)
        {
            $z=1;
        }
        else
        if(count($features)<1)
        {
            $z=0;
        }
        for($i=1;$i<=$z;$i++){
            
        ?>
        var s<?php echo $i?>= $('.s<?php echo $i?>').text();
        var m<?php echo $i?>= $('.m<?php echo $i?>').text();
        var h<?php echo $i?>= $('.h<?php echo $i?>').text();
        var d<?php echo $i?>= $('.d<?php echo $i?>').text();
        if(s<?php echo $i?>=='00')
        {
            var sec<?php echo $i?> = '59';
            var mi<?php echo $i?> = parseInt(m<?php echo $i?>);
            if(mi<?php echo $i?>==0)
            {
                min<?php echo $i?> = '59';
                var ho<?php echo $i?> = parseInt(h<?php echo $i?>);
                if(ho<?php echo $i?>==0)
                {
                    var hou<?php echo $i?> = '23';
                    var da<?php echo $i?> = parseInt(d<?php echo $i?>);
                    if(da<?php echo $i?>==0)
                    {
                        $('.limit div').html('EXPIRED');
                    }
                    else
                    {
                        da<?php echo $i?>--;
                        $('.d<?php echo $i?>').html(da<?php echo $i?>);
                    }
                } 
                else
                {
                    ho<?php echo $i?>--;
                    if(ho<?php echo $i?><10)
                    {
                        var hou<?php echo $i?> = '0'+ho<?php echo $i?>;
                    }
                    else
                    var hou<?php echo $i?> = ho<?php echo $i?>;
                }
                $('.h<?php echo $i?>').html(hou<?php echo $i?>);
            }
            else
            {
                mi<?php echo $i?>--;
                if(mi<?php echo $i?><10)
                {
                    var min<?php echo $i?> = '0'+mi<?php echo $i?>;
                }
                else
                var min<?php echo $i?> = mi<?php echo $i?>;
                
            }
            $('.m<?php echo $i?>').html(min<?php echo $i?>);
                        
        }
        else
        {
            var se<?php echo $i?> = parseInt(s<?php echo $i?>);
            se<?php echo $i?>--;
            if(se<?php echo $i?><10)
            var sec<?php echo $i?> = '0'+se<?php echo $i?>;
            else
            var sec<?php echo $i?> = se<?php echo $i?>;
            
        }
        //alert(sec);
        $('.s<?php echo $i?>').text(sec<?php echo $i?>);
        <?php }?>
    },1000);
    
});
</script> 

