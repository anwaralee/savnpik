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
<div id="left-content">
    <?php if(isset($features)) {
            //echo count($features);
        if(count($features)>1){
        //var_dump($features);
        ?>
	<div id="lista1" class="als-container">
				<span class="als-prev"><img src="img/thin_left_arrow_333.png" alt="prev" title="previous" /></span>
				<div class="als-viewport">
					<ul class="als-wrapper">
                    <?php foreach($features as $feature){?>
						
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
                        <div class="price">AED <strong><?php echo $feature['Deal']['selling_price'];?></strong></div>
                        <div class="discount">
                        <div class="left">Discount<br /><strong><?php echo $feature['Deal']['discount'];?>%</strong></div>
                        <div class="right">You save<br />AED <strong><?php echo $feature['Deal']['marked_price']-$feature['Deal']['selling_price'];?></strong></div>
                        <div class="clearfix"></div>
                        </div>
                        <div class="limit">
                            This deal can be bought over the next:<br />
                            
                            <div id="counter" class="timer">
                            
                            <?php
                                //difference_time($feature['Deal']['expiry_date']);
                            ?>
                                
                            </div>
                        </div>
                        <div class="bought">
                            <div class="left">Bought<br /><strong><?php if($feature['Deal']['buy_count'])echo $feature['Deal']['buy_count'];else echo 0;?></strong></div>
                            <div class="right">Viewed<br /><span><?php if($feature['Deal']['view_count'])echo $feature['Deal']['view_count'];else echo 0;?></span></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="buyy">
                            <a href="<?php echo $this->webroot.'carts/addtocart/'.$feature['Deal']['id']."/".$feature['Deal']['selling_price'];?>"><?php echo $this->Html->image("/img/buy.jpg",
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
				<span class="als-next"><?php echo $this->Html->image('thin_right_arrow_333.pgn');?><!--<img src="<?php echo $this->webroot;?>/thin_right_arrow_333.png" alt="next" title="next" />--></span>
			</div>
              <?php }
              else
              {?>
                <div id="banner">
                        <?php echo $this->Html->image("/files/deals/".$features[0]['Deal']['image1'],
                                  array('fullBase' => true,
                                       'alt'=>'Logo',
                                       'height'=>358,
                                       'width'=>717,'url'=>'/deal/'.$features[0]['Deal']['slug']));?>
                     
                    </div>
                    <div class="absolute">
                        <div class="price">AED <strong><?php echo $features[0]['Deal']['selling_price'];?></strong></div>
                        <div class="discount">
                        <div class="left">Discount<br /><strong><?php echo $features[0]['Deal']['discount'];?>%</strong></div>
                        <div class="right">You save<br />AED <strong><?php echo $features[0]['Deal']['marked_price']-$features[0]['Deal']['selling_price'];?></strong></div>
                        <div class="clearfix"></div>
                        </div>
                        <div class="limit">
                            This deal can be bought over the next:<br />
                            
                            <div id="counter" class="timer">
                            
                            <?php
                                //difference_time($feature['Deal']['expiry_date']);
                            ?>
                                
                            </div>
                        </div>
                        <div class="bought">
                            <div class="left">Bought<br /><strong><?php if($features[0]['Deal']['buy_count'])echo $features[0]['Deal']['buy_count'];else echo 0;?></strong></div>
                            <div class="right">Viewed<br /><span><?php if($features[0]['Deal']['view_count'])echo $features[0]['Deal']['view_count'];else echo 0;?></span></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="buyy">
                            <a href="<?php echo $this->webroot.'carts/addtocart/'.$features[0]['Deal']['id']."/".$features[0]['Deal']['selling_price'];?>"><?php echo $this->Html->image("/img/buy.jpg",
                                  array('fullBase' => true,
                                       'alt'=>'Logo'
                                       ));?></a>
                        </div>
                    </div>
              <?php }?>
                    <?php }
                    else
                    { ?>
                    <div class="cat-header clearfix">
                    <h2><?php echo $Cat;?></h2>
                    <a href="<?php echo $this->webroot;?>" class="back" >back to home</a>
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
                            <h2><?php echo $this->Html->link($deal['Deal']['name'],'/deal/'.$deal['Deal']['slug']);?></h2>
                         <?php echo substr($deal['Deal']['description'],0,150);?>
                            </div>

                            <div class="event-desc clearfix">
                                <div class="time-discount">
                                <div class="time-remaining"><?php difference_time2($deal['Deal']['expiry_date']);?></div> 
                                <div class="save"><?php echo $deal['Deal']['discount']."%";?></div>
                                </div>

                                <a class="bttn" href="<?php echo $this->webroot;?>carts/addtocart/<?php echo $deal['Deal']['id']."/".$deal['Deal']['selling_price'];?>"><span>AED</span> <?php echo $deal['Deal']['selling_price'];?></a>
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
                                if($days>0)
                                {
                                    echo $days.' day';
                                    if($days>1)
                                        echo 's';
                                    echo ' '.$h1;
                                }
                                elseif($days==0)
                                {
                                    echo $h1;
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
                                elseif($days==0)
                                {
                                    echo ' '.$h.' h remaining';
                                }
                                else
                                echo "EXPIRED";
                                
                            
            }
            ?>
