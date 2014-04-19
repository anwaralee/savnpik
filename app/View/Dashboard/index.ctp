<script>
$(function(){
    var tot = 0;
   $('.sum').each(function(){
        var s = $(this).text();
        var sp = s.split(" AED");
        tot = Number(tot)+Number(sp[0]);
   }) 
   $('.total').html('<strong>'+tot+' AED</strong>');
   
   $('.qty').change(function(){
         var tot = 0;
       $('.sum').each(function(){
            var s = $(this).text();
            var sp = s.split(" AED");
            tot = Number(tot)+Number(sp[0]);
       }) 
       $('.total').html('<strong>'+tot+' AED</strong>');
        
   })
});
</script>
<div id="left-content">

<div class="cat-header clearfix">
                    <h2>My Deals</h2>
                    
                    </div>
<?php if(count($carts)>0){?>
    <table class="table">
        <thead><th>Description</th><th>Price</th><th>Amount</th><th>Sum</th><th>Threshold/Status</th></thead>

        <?php foreach($carts as $cart)
        {?>
            <tr>
                <td><?php echo $this->Html->link($cart['Deal']['name'], array('controller'=>'deal','action'=>$cart['Deal']['slug']),array('target' => '_blank'));?></td>
                <td><?php echo $cart['Deal']['selling_price']." AED"; ?></td>
                <td><?php echo $cart['Sale']['qty'];?>
                </td>
                <td id="sum_<?php echo $cart['Sale']['id'];?>" class="sum"><?php echo $cart['Sale']['price']. " AED";?></td>
                <td>
                <?php
                if(!$cart['Deal']['buy_count'])
                $cart['Deal']['buy_count']=0;
                    
                //if($h==) 
                echo $cart['Deal']['buy_count'].'/'.$cart['Deal']['threshold']. ' | ';if(strtotime($cart['Deal']['expiry_date'].' 00:00:01')>=strtotime(date('Y-m-d H:i:s')))echo 'On';else echo 'Off';?></td>
            </tr>    
            
        <?php 
        } ?>
        <tr><td colspan="3"></td><td><strong>Total</strong></td><td class="total"></td></tr>
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
         echo "<h3>You have no deals.</h3>";
    }?>
</div>