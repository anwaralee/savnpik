<?php
    if($this->Session->read('lang')=='e')
    $l='e';
    else
    $l='a';
    ?>
<div id="left-content">
                <div class="coupon-header">
                    <h1><?php
                    if($this->Session->read('lang')=='e')
                    $dn =  $deal['Deal']['name'];
                    else
                    $dn =  $deal['Deal']['name_arabic'];
                    echo strip_tags(substr($dn,0,200));if(strlen($deal['Deal']['name'])>150)echo " ...";?></h1>
                </div>

                <div class="coupon-banner clearfix">
                    <div class="buy-now">
                        <div class="buy"><a href="<?php echo $this->webroot;?>carts/addtocart/<?php echo $deal['Deal']['id']."/".$deal['Deal']['selling_price'];?>" style="color: #FFF;text-decoration: none;"><?php if($this->Session->read('lang')=='e'){?>Buy Now<?php }else{?>&nbsp;شراء الآن&nbsp;<?php }?></a></div>
                        <div class="price"><span><?php if($this->Session->read('lang')=='e'){?>AED<?php }else echo "درهم";?></span><?php echo $deal['Deal']['selling_price']?></div>
                        <div class="deal-end"><?php if($this->Session->read('lang')=='e'){?>This deal ends in<?php }else{echo "هذه الصفقة تنتهي في";}?> <br />
                        <span><?php difference_time($deal['Deal']['expiry_date']);?></span>
                        </div>
                        <div class="discount">
                            <label style="display: inline-block;"><?php if($this->Session->read('lang')=='e'){?>Discount<?php }else echo "خصم";?></label> <strong style="display: inline-block;"><?php echo $deal['Deal']['discount']?>%</strong><br />
                            <label><?php if($this->Session->read('lang')=='e'){?>You save<?php }else echo "يمكنك حفظ";?></label> <span><?php if($this->Session->read('lang')=='e'){?>AED<?php }else echo "&nbsp;درهم&nbsp;";?> <strong><?php echo $deal['Deal']['marked_price']-$deal['Deal']['selling_price'];?></strong></span>
                        </div>

                        <div class="view-bought clearfix">
                            <div class="view">
                                <?php if($this->Session->read('lang')=='e'){?>Viewed:<?php }else echo ":شوهدت";?><br/>
                                <strong><?php if($deal['Deal']['view_count'])echo $deal['Deal']['view_count'];else echo 0;?></strong>
                            </div>

                            <div class="bought">
                                <?php if($this->Session->read('lang')=='e'){?>Bought:<?php }else echo ":اشترى";?><br/>
                                <strong><?php if($deal['Deal']['buy_count'])echo $deal['Deal']['buy_count'];else echo 0;?></strong>
                            </div>
                        </div>

                        <div class="recommend"><a href="javascript:void(0);" onclick="$('.rec').show();"><?php if($this->Session->read('lang')=='e'){?>Recommend to friends<?php }else{?>يوصي أصدقاء<?php }?></a></div>
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
                    <div class="clearfix"></div>
                    <div class="rec">
                    <h2 style="margin-top: 0;color:#DC0A37;">Recommend to friends</h2>
                    <div class="grey1" style="width:63px;">
                        <div class="fb-share-button" data-width="63px" data-href="http://www.savnpik.com/deal/<?php echo $deal['Deal']['slug'];?>" data-type="button"></div>
                    </div>
                    <div class="grey2" style="">
                            <a href="https://twitter.com/share?url=http://www.savnpik.com/deal/<?php echo $deal['Deal']['slug'];?>" class="twitter-share-button" data-lang="en">Tweet</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    </div>
                    <div class="grey3" style="">
                        <strong><em><?php if($this->Session->read('lang')=='a'){?>فصل فاصلة لرسائل البريد الإلكتروني متعددة<?php }else{?>Comma seperated for multiple emails<?php }?></em></strong><br /><br />
                        <input type="text" name="em" class="em" style="width:270px;" /><br /><br />
                        <a href="javascript:void(0);" class="green-btn smaller"><?php if($this->Session->read('lang')=='a'){?>دعا<?php }else{?>Invite<?php }?></a>
                    </div>
                    <div class="clearfix"></div>
                    </div>
                </div>

                <div class="coupon-details">
                <?php
                $sess = $this->Session->read('lang'); 
                ?>
                    <div class="highlights">
                    <h2><?php if($sess=='a'){?>يبرز<?php }else{?>Highlights<?php }?></h2>
                    <div>
                        <?php
                        if($l=='e') 
                        echo $deal['Deal']['highlights'];
                        else
                        echo $deal['Deal']['highlights_arabic'];
                        ?>
                    </div>
                    </div>

                    <div class="conditions">
                    <h2><h2><?php if($sess=='a'){?>الشروط<?php }else{?>Conditions<?php }?></h2></h2>
                    <div>
                        <?php
                        if($l=='e') 
                        echo $deal['Deal']['conditions'];
                        else
                        echo $deal['Deal']['conditions_arabic'];
                        ?>
                    </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="gap"></div>

                    <div class="about-company">
                        <h2><?php if($sess=='a'){?>حول الشركة<?php }else{?>About company<?php }?></h2>
                        <p><?php 
                        if($l=='e') 
                        echo $deal['Company']['desc'];
                        else
                        echo $deal['Company']['desc_arabic'];
                        ?></p>
                    </div>

                    <div class="company-location">
                        <div class="com-logo">
                            <?php echo $this->Html->image("/img/uploads/companies/".$deal['Company']['logo'],
                                  array('fullBase' => true,
                                       'alt'=>'Logo',
                                       'height'=>55,
                                       'width'=>177));?>
                        </div>
                        <h3><?php if($l=='e')echo $deal['Company']['name'];else echo $deal['Company']['name_arabic'];?></h3>
                        <?php if($sess=='a'){?>:موقع الشركة<?php }else{?>Company website:<?php }?> <a href="<?php if(str_replace(array('http://','https://'),array('',''),$deal['Company']['website'])==$deal['Company']['website'])echo 'http://';echo $deal['Company']['website'];?>"><?php echo $deal['Company']['website'];?></a>
                        <br/><br/>
                        <h3><?php if($sess=='a'){?>موقع<?php }else{?>Location<?php }?></h3>
                        <?php if($l=='e')echo $deal['Company']['address'];else echo $deal['Company']['address_arabic'];?>
                    </div>
                <div class="clearfix"></div>    
                </div>

                <div class="realated-deals">
                    <h1><?php if($this->Session->read('lang')=='a'){?>عروض تتعلق<?php }else{?>Related Deals<?php }?></h1>
                </div>
                <div id="block-list" class="clearfix">
                <?php
                $related = $this->requestAction('/deals/get_realated/'.$deal['Deal']['deal_category_id'].'/'.$deal['Deal']['id']);
                //var_dump($related);
                if($related)
                {
                    foreach($related as $d)
                    {
                        //foreach($de as $d){

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
                          
                        
                        }
                        if($l=='e')
                        $rdn = $d['Deal']['name'];
                        else
                        $rdn = $d['Deal']['name_arabic'];
                        ?></div>
                        <div class="event-detail">
                            <div class="short-desc">
                            <h2><?php echo $this->Html->link($rdn,'/deal/'.$d['Deal']['slug']);?></h2>
                            <p><?php if($l=='e')echo substr($d['Deal']['description'],0,150);else echo substr($d['Deal']['description_arabic'],0,150);?></p> 
                            </div>

                            <div class="event-desc clearfix">
                                <div class="time-discount">
                                <div class="time-remaining"><?php difference_time2($d['Deal']['expiry_date'],$this->Session->read('lang'));?></div> 
                                <div class="save">55%</div>
                                </div>

                                <a class="bttn" href="<?php echo $this->webroot;?>deal/<?php echo $d['Deal']['slug'];?>"><span><?php if($this->Session->read('lang')=='e'){?>AED<?php }else echo "درهم";?></span> <?php echo $d['Deal']['selling_price'];?></a>
                            </div>
                        </div>
                        </div>
                        <?php
                    }
                }
                ?>
                    

                    
                </div>
                <a class="more-related" href="<?php echo $this->webroot;?>deals/city/<?php echo $this->Session->read('city');?>/<?php echo $this->requestAction('/deals/get_inflector/'.$deal['Deal']['deal_category_id']);?>"><?php if($this->Session->read('lang')=='a'){?>مزيد من عروض ذات الصلة<?php }else{?>more related deals<?php }?></a>
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
                                    $h1= '<span class="h">0'.$h.'</span>';
                                    else
                                    $h1 = '<span class="h">'.$h.'</span>';
                                    if($m<10)
                                    $h1 = $h1.':<span class="m">0'.$m.'</span>';
                                    else
                                    $h1 = $h1.':<span class="m">'.$m.'</span>';
                                    if($s<10)
                                    $h1 = $h1.':<span class="s">0'.$s.'</span>';
                                    else
                                    $h1 = $h1.':<span class="s">'.$s.'</span>';
                                    
                                    
                                }
                                if($days>0){
                                echo '<span class="d">'.$days.'</span> day';
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
            function difference_time2($expiry,$sess)
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
    $('.smaller').click(function(){
       var em = $('.em').val();
       if(em=='')
       alert('Invalid Email');
       else
       if(em.replace('@','')==em)
       alert('Invalid Email');
       else
    	if(em.replace('.','')==em)
    	alert('Invalid Email'); 
        else
        {
             interval = window.setInterval(function(){
                            var text = $('.smaller').text();
                            if (text.length < 13){
                                $('.smaller').text(text + '.');					
                            } else {
                                $('.smaller').text('Sending');				
                            }
                        }, 200);
            $.ajax({
               url:'<?php echo $this->webroot;?>deals/recommend/<?php echo $deal['Deal']['slug'];?>',
               type:'post',
               data:'email='+em,
               success:function(res)
               {
                            window.clearInterval(interval);
                             $('.smaller').text('Email');
                            
               } 
            });
        }
    });
    setInterval(function(){
        var s= $('.s').text();
        var m= $('.m').text();
        var h= $('.h').text();
        var d= $('.d').text();
        if(s=='00')
        {
            var sec = '59';
            var mi = parseInt(m);
            if(mi==0)
            {
                min = '59';
                var ho = parseInt(h);
                if(ho==0)
                {
                    var hou = '23';
                    var da = parseInt(d);
                    if(da==0)
                    {
                        $('.limit div').html('EXPIRED');
                    }
                    else
                    {
                        da--;
                        $('.d').html(da);
                    }
                } 
                else
                {
                    ho--;
                    if(ho<10)
                    {
                        var hou = '0'+ho;
                    }
                    else
                    var hou = ho;
                }
                $('.h').html(hou);
            }
            else
            {
                mi--;
                if(mi<10)
                {
                    var min = '0'+mi;
                }
                else
                var min = mi;
                
            }
            $('.m').html(min);
                        
        }
        else
        {
            var se = parseInt(s);
            se--;
            if(se<10)
            var sec = '0'+se;
            else
            var sec = se;
            
        }
        //alert(sec);
        $('.s').text(sec);
    },1000);
    
});
</script>
