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
                    <h2>My Cart</h2>
                    <a href="<?php echo $this->webroot;?>" class="back continue" >Continue Shopping</a>
                    </div>
<?php if(count($carts)>0){?>
    <table class="table">
        <thead><th>Description</th><th>Price</th><th>Amount</th><th>Sum</th><th>Threshold/Status</th></thead>

        <?php foreach($carts as $cart)
        {?>
            <tr>
                <td><?php echo $this->Html->link($cart['Deal']['name'], array('controller'=>'deal','action'=>$cart['Deal']['slug']),array('target' => '_blank'));?></td>
                <td><?php echo $cart['Deal']['selling_price']." AED"; ?></td>
                <td><select class="qty" onchange="$('#sum_<?php echo $cart['Cart']['id'];?>').text(Number(<?php echo $cart['Deal']['selling_price'];?>)*Number($(this).val())+' AED')">
                        <?php for($i=1;$i<=30;$i++)
                        {?>
                            <option value="<?php echo $i;?>" <?php if($i == $cart['Sale']['qty'])echo "selected='selected'";?>><?php echo $i;?></option>    
                        <?php
                        }?>
                    </select>
                </td>
                <td id="sum_<?php echo $cart['Sale']['id'];?>" class="sum"><?php echo $cart['Sale']['price']. " AED";?></td>
                <td>
                <?php
                $h = date('H');
                $m=date('i');
                $s=date('s');
                if($h<24)
                $st = 'On'; 
                echo $cart['Deal']['buy_count'].'/'.$cart['Deal']['buy_count']. ' | ';if(strtotime($cart['Deal']['expiry_time'])>=strtotime(date('Y-m-d')))?></td>
            </tr>    
            
        <?php 
        } ?>
        <tr><td colspan="3"></td><td><strong>Total</strong></td><td class="total"></td></tr>
        <tr class="last"><td colspan="4"></td><td><a href="<?php echo $this->webroot;?>carts/payment" class="continue">Proceed To payment</a></td></tr>
    </table>
    <?php }
    else
    {
         echo "<h3>Cart Is Empty</h3>";
    }?>
</div>