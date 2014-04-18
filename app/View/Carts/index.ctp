<script>
$(function(){
    var tot = 0;
   $('.sum').each(function(){
        var s = $(this).text();
        var sp = s.split(" AED");
        tot = Number(tot)+Number(sp[0]);
   }) 
   $('.total').html('<strong>'+tot+' AED</strong>');
   $('.grand').val(tot);
   
   $('.qty').change(function(){
         var tot = 0;
       $('.sum').each(function(){
            var s = $(this).text();
            var sp = s.split(" AED");
            tot = Number(tot)+Number(sp[0]);
       }) 
       $('.total').html('<strong>'+tot+' AED</strong>');
       $('.grand').val(tot);
        
   })
});
</script>
<div id="left-content">

<div class="cat-header clearfix">
                    <h2>My Cart</h2>
                    <a href="<?php echo $this->webroot;?>" class="back " >Continue Shopping</a>
                    </div>
<?php if(count($carts)>0){?>
<form action="<?php echo $this->webroot;?>carts/checkout" method="post">
    <table class="table">
        <thead><th>Description</th><th>Price</th><th>Amount</th><th>Sum</th><th></th></thead>

        <?php foreach($carts as $cart)
        {?>
            <input type="hidden" name="cart_id[]" value="<?php echo $cart['Cart']['id'];?>"/>
            
            <tr>
                <td><?php echo $this->Html->link($cart['Deal']['name'], array('controller'=>'deal','action'=>$cart['Deal']['slug']),array('target' => '_blank'));?></td>
                <td><?php echo $cart['Deal']['selling_price']." AED"; ?></td>
                <td><select class="qty" name="qty[]" onchange="$('#sum_<?php echo $cart['Cart']['id'];?>').text(Number(<?php echo $cart['Deal']['selling_price'];?>)*Number($(this).val())+' AED')">
                        <?php for($i=1;$i<=30;$i++)
                        {?>
                            <option value="<?php echo $i;?>" <?php if($i == $cart['Cart']['qty'])echo "selected='selected'";?>><?php echo $i;?></option>    
                        <?php
                        }?>
                    </select>
                </td>
                <td id="sum_<?php echo $cart['Cart']['id'];?>" class="sum"><?php echo $cart['Cart']['price']*$cart['Cart']['qty']. " AED";?></td>
                <td><?php echo $this->Html->link($this->Html->image('/img/trash.png',array('width'=>'20px')),array('controller'=>'carts','action'=>'delete',$cart['Cart']['id']), array('escape'=>FALSE),
    "Are you sure you wish to delete this deal?");?></td>
            </tr>    
            
        <?php 
        } ?>
        <input type="hidden" name="total" class="grand" value=""  />
        <tr><td colspan="3"></td><td><strong>Total</strong></td><td class="total"></td></tr>
        <tr class="last"><td colspan="4"></td><td><input type="submit" class="continue" value="Proceed To payment" name="submit"/></td></tr>
    </table>
    <?php }
    else
    {
         echo "<h3>Cart Is Empty</h3>";
    }?>
</div>