<div class="left-content">
    <table class="table">
        <thead><th>Description</th><th>Price</th><th>Amount</th><th>Sum</th></thead>
        <?php foreach($carts as $cart)
        {?>
            <tr>
                <td><?php echo $this->Html->link($cart['Deal']['name'], array('controller'=>'deal','action'=>$cart['Deal']['slug']),array('target' => '_blank'));?></td>
                <td><?php echo $cart['Deal']['selling_price']; ?></td>
                <td><select onchange="$('#sum_<?php echo $cart['Cart']['id'];?>').val(Number(<?php echo $cart['Deal']['selling_price'];?>)*Number($(this).value))">
                        <?php for($i=1;$i<=30;$i++)
                        {?>
                            <option value="<?php echo $i;?>"><?php echo $i;?></option>    
                        <?php
                        }?>
                    </select>
                </td>
                <td id="sum_<?php echo $cart['Cart']['id'];?>"><?php echo $cart['Deal']['selling_price'];?></td>
            </tr>    
            
        <?php 
        } ?>
    </table>
</div>