<div class="left">
    <h2><?php echo $user['User']['full_name'];?></h2>
    <div class="lists">
    <div class="left"><strong>Username</strong></div><div class="right"><?php echo $user['User']['username'];?></div><div class="clearfix"></div>    
    </div>
    <div class="lists">
    <div class="left"><strong>Email</strong></div><div class="right"><?php echo $user['User']['email'];?></div><div class="clearfix"></div>    
    </div>
    <div class="lists">
    <div class="left"><strong>Phone</strong></div><div class="right"><?php echo $user['User']['phone'];?></div><div class="clearfix"></div>    
    </div>
    <div class="lists">
    <div class="left"><strong>Address</strong></div><div class="right"><?php echo $user['User']['address'];?></div><div class="clearfix"></div>    
    </div>
    <div class="lists">
    <div class="left"><strong>Total Coin</strong></div><div class="right"><?php echo $user['User']['my_coin'];?></div><div class="clearfix"></div>    
    </div>
    <div class="lists">
    <div class="left"><strong>Balance</strong></div><div class="right"><?php echo $user['User']['my_balance'];?></div><div class="clearfix"></div>    
    </div>    
</div>
<div class="left">
    <h2 style="margin-left: 25px;">Reward History</h2>
    <div class="lists2">
        <table class="table table-striped table-bordered">
            <tr><th>Reward for</th><th>Reward date</th><th>(+)</th><th>(-)</th></tr>
            <?php
            foreach($reward as $r)
            {
                ?>
                <tr><td><?php echo $r['RewardFrom']['remark'];?></td><td><?php echo $r['RewardFrom']['reward_date'];?></td><td><?php if($r['RewardFrom']['coins']>0)echo $r['RewardFrom']['coins'];else echo '-';?></td><td><?php if($r['RewardFrom']['coins']<0)echo $r['RewardFrom']['coins'];else echo '-';?></td></tr>
                <?php
            } 
            ?>
        </table>
    </div>
</div>
<div class="left">
    <h2 style="margin-left: 25px;">Payment History</h2>
    <div class="lists2">
        <table class="table table-striped table-bordered">
            <tr><th>Date</th><th>Amount</th></tr>
            <?php
            foreach($payment as $r)
            {
                ?>
                <tr><td><?php echo $r['Payment']['on_date'];?></td><td><?php echo $r['Payment']['amount'];?></td></tr>
                <?php
            } 
            ?>
        </table>
    </div>
</div>
<div class="clearfix"></div>
<div class="left">
    <h2 style="">Sales History</h2>
    <div class="lists2" style="margin-left: 0;">
        <table class="table table-striped table-bordered">
            <tr><th>Deal</th><th>Price</th><th>Quantity</th><th>Total</th></tr>
            <?php
            foreach($sales as $r)
            {
                ?>
                <tr><td><?php echo $r['Deal']['name'];?></td><td><?php echo $r['Sale']['price'];?></td><td><?php echo $r['Sale']['qty'];?></td><td><strong><?php echo $r['Sale']['price']*$r['Sale']['qty'];?></strong></td></tr>
                <?php
            } 
            ?>
        </table>
    </div>
</div>
<div class="clearfix"></div>
