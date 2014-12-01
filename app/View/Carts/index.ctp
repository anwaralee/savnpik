<?php if($this->Session->read('lang')=='e')
    {
        $aed = " AED";
        $on = "On";
        $off = "Off";
        $ar = "";
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
   $('.grand').val(tot);
   
   $('.qty').change(function(){
         var tot = 0;
       $('.sum').each(function(){
            var s = $(this).text();
            var sp = s.split(aed);
            tot = Number(tot)+Number(sp[0]);
       }) 
       $('.total').html('<strong>'+tot+aed+'</strong>');
       $('.grand').val(tot);
        
   })
});
</script>
<div id="left-content">

<div class="cat-header clearfix">
                    <h2><?php echo ($this->Session->read('lang')=='a')?"عربتي":'My Cart'?></h2>
                    <a href="<?php echo $this->webroot;?>deals/city/<?php echo $this->Session->read('city');?>" class="back " ><?php echo ($this->Session->read('lang')=='a')?"مواصلة التسوق":'Continue Shopping'?></a>
                    </div>
<?php if(count($carts)>0){?>
<form action="<?php echo $this->webroot;?>carts/payment" method="post">
    <table class="table">
        <thead><th><?php echo ($this->Session->read('lang')=='a')?"وصف":"Description";?></th><th><?php echo ($this->Session->read('lang')=='a')?"السعر":'Price';?></th><th><?php echo ($this->Session->read('lang')=='a')?"مبلغ":"Amount";?></th><th><?php echo ($this->Session->read('lang')=='a')?"مجموع":"Sum";?></th><th></th></thead>

        <?php foreach($carts as $cart)
        {?>
            <input type="hidden" name="cart_id[]" value="<?php echo $cart['Cart']['id'];?>"/>
            
            <tr>
                <td><?php echo $this->Html->link($cart['Deal']['name'.$ar], array('controller'=>'deal','action'=>$cart['Deal']['slug']),array('target' => '_blank'));?></td>
                <td><?php echo $cart['Deal']['selling_price'].$aed; ?></td>
                <td><select class="qty" name="qty[]" onchange="$('#sum_<?php echo $cart['Cart']['id'];?>').text(Number(<?php echo $cart['Deal']['selling_price'];?>)*Number($(this).val())+' AED')">
                        <?php for($i=1;$i<=30;$i++)
                        {?>
                            <option value="<?php echo $i;?>" <?php if($i == $cart['Cart']['qty'])echo "selected='selected'";?>><?php echo $i;?></option>    
                        <?php
                        }?>
                    </select>
                </td>
                <td id="sum_<?php echo $cart['Cart']['id'];?>" class="sum"><?php echo $cart['Cart']['price']*$cart['Cart']['qty'].$aed;?></td>
                <td><?php echo $this->Html->link($this->Html->image('/img/trash.png',array('width'=>'20px')),array('controller'=>'carts','action'=>'delete',$cart['Cart']['id']), array('escape'=>FALSE),
    ($this->Session->read('lang')=='e')?"Are you sure you wish to delete this deal?":"هل أنت متأكد أنك تريد حذف هذه الصفقة؟");?></td>
            </tr>    
            
        <?php 
        } ?>
        <input type="hidden" name="total" class="grand" value=""  />
        <tr><td colspan="3"></td><td><strong><?php echo ($this->Session->read('lang')=='a')?'مجموع':'Total';?></strong></td><td class="total"></td></tr>
        <tr class="last"><td colspan="5" style="text-align: right;padding-right:0;"><input type="submit" class="green-btn" value="<?php echo ($this->Session->read('lang')=='a')?"الشروع في دفع":'Proceed To payment';?>" name="submit" style="float: right;"/><div class="clear"></div></td></tr>
    </table>
    <?php }
    else
    {
         echo "<h3>";
         echo ($this->Session->read('lang')=='a')? "السلة فارغة":"Cart Is Empty";
         "</h3>";
    }?>
</div>