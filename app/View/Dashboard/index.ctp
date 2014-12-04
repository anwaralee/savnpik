<?php if($this->Session->read('lang')=='e')
    {
        $aed = " AED";
        $on = "On";
        $off = "Off";
        $ar = "";
    }
    elseif($this->Session->read('lang')=='g')
    {
        $aed = " AED";
        $on = "på";
        $off = "Off";
        $ar = "_german";
    }
    else
    {
        $aed = " درهم";
        $on = "في";
        $off = "بعيدا";
        $ar = "_arabic";
    }   
        ;?>
<script>
$(function(){
    var tot = 0;
    var aed = "<?php echo $aed;?>";
   $('.sum').each(function(){
        var s = $(this).text();
        var sp = s.split(aed);
        tot = Number(tot)+Number(sp[0]);
   }) 
   $('.total').html('<strong>'+tot+aed+'</strong>');
   
   $('.qty').change(function(){
         var tot = 0;
       $('.sum').each(function(){
            var s = $(this).text();
            var sp = s.split(aed);
            tot = Number(tot)+Number(sp[0]);
       }) 
       $('.total').html('<strong>'+tot+aed+'</strong>');
        
   })
});
</script>
<div id="left-content">

<div class="cat-header clearfix">
                    <h2><?php echo ($this->Session->read('lang')=='a')?'بلدي عروض':(($this->Session->read('lang')=='g')?'Mina erbjudanden':'My Deals');?></h2>
                    
</div>
<?php if(count($carts)>0){?>
    <table class="table">
        <thead><th><?php echo ($this->Session->read('lang')=='a')?'وصف':(($this->Session->read('lang')=='g')?'Beskrivning':'Description');?></th>
        <th><?php echo ($this->Session->read('lang')=='a')?'السعر':(($this->Session->read('lang')=='g')?'pris':'Price');?></th>
        <th><?php echo ($this->Session->read('lang')=='a')?'مبلغ':(($this->Session->read('lang')=='g')?'Mängd':'Amount');?></th>
        <th><?php echo ($this->Session->read('lang')=='a')?'مجموع':(($this->Session->read('lang')=='g')?'Sum':'Sum');?></th>
        <th><?php echo ($this->Session->read('lang')=='a')?'عتبة / الحالة':(($this->Session->read('lang')=='g')?'Tröskel / Status':'Threshold/Status');?></th></thead>

        <?php foreach($carts as $cart)
        {?>
            <tr>
                <td><?php echo $this->Html->link($cart['Deal']['name'.$ar], array('controller'=>'deal','action'=>$cart['Deal']['slug']),array('target' => '_blank'));?></td>
                <td><?php echo $cart['Deal']['selling_price'].$aed; ?></td>
                <td><?php echo $cart['Sale']['qty'];?>
                </td>
                <td id="sum_<?php echo $cart['Sale']['id'];?>" class="sum"><?php echo $cart['Sale']['price']*$cart['Sale']['qty'].$aed;?></td>
                <td>
                <?php
                if(!$cart['Deal']['buy_count'])
                $cart['Deal']['buy_count']=0;
                    
                //if($h==) 
                echo $cart['Deal']['buy_count'].'/'.$cart['Deal']['threshold']. ' | ';if(strtotime($cart['Deal']['expiry_date'].' 00:00:01')>=strtotime(date('Y-m-d H:i:s')))echo $on;else echo $off;?></td>
            </tr>    
            
        <?php 
        } ?>
        <tr><td colspan="3"></td><td><strong><?php echo ($this->Session->read('lang')=='a')?'مجموع':(($this->Session->read('lang')=='g')?'Totalt':'Total');?></strong></td><td class="total"></td></tr>
        <tr class="last"><td colspan="5"></td></tr>
    </table>
    <?php
     if(isset($count) && $count> 8){?>
                        <div class="pagination clearfix">
                        <?php echo $this->Paginator->prev("Prev", array('class'=>'prev','tag'=>'a'));?>
                        <?php echo str_replace(" | ","",$this->Paginator->numbers(array('tag' => 'a'))); ?>
                        <?php echo $this->Paginator->next("Next",array('class'=>'next','tag'=>'a')); ?>
                </div>
                <?php 
                }
    } 
    else
    {
         echo "<h3>".($this->Session->read('lang')=='a')?'لا يوجد لديك الصفقات.':(($this->Session->read('lang')=='g')?"Du har inga erbjudanden":"You have no deals")."</h3>";
    }?>
</div>