<div id="left-content">
<div class="cat-header clearfix">
<h2>Deposit:(My Balance: <?php echo $credit." AED";?>)</h2>

</div>
<div class="history">
<?php if(isset($payment) && count($payment)>0){?>
    <table class="table">
    
            <?php
            $i=0;
                foreach($payment as $q)
                {
                    $i++;
                    if($i==1){
                    //$tot = $q['User']['my_coin'];
                    ?>
                    <thead><th>Detail</th><th>Amount</th><th>On Date</th></thead>
                    <?php 
                    }
                    ?>
                           <tr><td><?php echo $q['Payment']['remarks'];?></td><td><?php echo $q['Payment']['amount']. " AED";?></td><td><?php echo $q['Payment']['on_date'];?></td></tr>
                    <?php
                }        
            ?>
            
     </table>
     <?php
     if(isset($count) && $count> 2){?>
                        <div class="pagination clearfix">
                        <?php echo $this->Paginator->prev("Prev", array('class'=>'prev','tag'=>'a'));?>
                        <?php echo str_replace(" | ","",$this->Paginator->numbers(array('tag' => 'a'))); ?>
                        <?php echo $this->Paginator->next("Next",array('class'=>'next','tag'=>'a')); ?>
                </div>
                <?php }?>
     <?php }
     else
        echo "No Payment History.";
     ?>       
    </div>  
    <div class="earnmore">
    <h2>Deposit</h2>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="warriorbik123@gmail.com">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="item_name" value="Deposit in Account">
<input type="hidden" name="item_number" value="<?php echo $this->Session->read('Auth.User.id');?>">
<input type="text" name="amount" value="" placeholder="Amount In USD">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="custom" value="<?php echo $this->Session->read('Auth.User.id');?>" />
<input type="hidden" name="return" value="http://www.savnpik.com" />
<input type="hidden" name="cbt" value="Return To Savnpik.com" />
<input type="hidden" name="cancel_return" value="http://www.savnpik.com/dashboard/deposit" />
<input type="hidden" name="notify_url" value='http://www.savnpik.com/deals/ipn_test'/>
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</div>
<div class="earnmore">
<h2>Exchange (<?php echo $tot;?> <?php echo $this->Html->image('/img/Coins.png',array('width'=>'20px'));?>)</h2>
        <div class="threeblock left">
            <div class="blockimage">
                <?php echo $this->Html->image('/img/35.png');?>
            </div>
            <div class="blockbtn">Exchange for <strong>50,000 </strong><?php echo $this->Html->image('/img/Coins.png',array('width'=>'20px'));?></div>
            <hr />
            <?php if((50000-$tot)>0){?><strong><?php echo (50000-$tot);echo '</strong> '.$this->Html->image('/img/Coins.png',array('width'=>'20px'));?> more to go.
            <?php 
            }
            else
            {
                ?>
                <a href="<?php echo $this->webroot;?>dashboard/exchange/50000"><?php echo $this->Html->image('/img/exchange.png');?></a>
                <?php
            }
            ?>
        </div>
        <div class="threeblock left">
            <div class="blockimage">
                <?php echo $this->Html->image('/img/10.png');?>
            </div>
            <div class="blockbtn">Exchange for <strong>18,000</strong> <?php echo $this->Html->image('/img/Coins.png',array('width'=>'20px'));?></div>
            <hr />
            <?php if((18000-$tot)>0){?><strong><?php echo (18000-$tot);echo '</strong> '.$this->Html->image('/img/Coins.png',array('width'=>'20px'));?> more to go.
            <?php 
            }
            else
            {
                ?>
                <a href="<?php echo $this->webroot;?>dashboard/exchange/18000"><?php echo $this->Html->image('/img/exchange.png');?></a>
                <?php
            }
            ?>
        </div>
        <div class="threeblocklast left">
            <div class="blockimage">
                <?php echo $this->Html->image('/img/5.png');?>
            </div>
            <div class="blockbtn">Exchange for <strong>10,000</strong> <?php echo $this->Html->image('/img/Coins.png',array('width'=>'20px'));?></div>
            <hr />
            <?php if((10000-$tot)>0){?><strong><?php echo (10000-$tot);echo '</strong> '.$this->Html->image('/img/Coins.png',array('width'=>'20px'));?> more to go.
            <?php 
            }
            else
            {
                ?>
                <a href="<?php echo $this->webroot;?>dashboard/exchange/10000"><?php echo $this->Html->image('/img/exchange.png');?></a>
                <?php
            }
            ?>
        </div>
        <div class="clearfix"></div>
    </div>

</div>
