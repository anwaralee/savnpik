<div id="left-content">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=1422309588028572";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
window.fbAsyncInit = function() {
  FB.Event.subscribe('edge.create', function(response) {
    $.ajax({
       url:'<?php echo $this->webroot;?>dashboard/like' 
    });
  });
  FB.Event.subscribe('edge.remove', function(response) {
    $.ajax({
       url:'<?php echo $this->webroot;?>dashboard/unlike' 
    });
  });
}

</script>

    <div class="cat-header clearfix">
        <h2>My Credit : <?php echo $tot.$this->Html->image('/img/Coins.png',array('width'=>'20px'));?></h2>
                                
    </div>
    
    <div class="history">
    <table class="table">
    
            <?php
            $i=0;
                foreach($credit as $q)
                {
                    $i++;
                    if($i==1){
                    //$tot = $q['User']['my_coin'];
                    ?>
                    <thead><th>Reward for</th><th>(+)</th><th>(-)</th></thead>
                    <?php 
                    }
                    ?>
                           <tr><td><?php echo $q['RewardFrom']['remark']?></td><td><?php if($q['RewardFrom']['coins']>0)echo $q['RewardFrom']['coins'].$this->Html->image('/img/Coins.png',array('width'=>'20px'));else echo '-'?></td><td><?php if($q['RewardFrom']['coins']<0)echo $q['RewardFrom']['coins'].$this->Html->image('/img/Coins.png',array('width'=>'20px'));else echo '-';?></td></tr>
                    <?php
                }        
            ?>
            
     </table>       
    </div> 
    <h2>Earn More</h2> 
    <div class="earnmore">
        <div class="fourblock left">
            <div class="blockimage">
                <?php echo $this->Html->image('/img/signup.png');?>
            </div>
            <div class="blockbtn done">Done</div>
            200<?php echo $this->Html->image('/img/Coins.png',array('width'=>'20px'));?>
        </div>
        <div class="fourblock left">
            <div class="blockimage">
                <?php echo $this->Html->image('/img/share.png');?>
            </div>
            <div class="blockbtn bi"><a href="<?php echo $this->webroot;?>dashboard/fbshare"><?php echo $this->Html->image('/img/fbshare.png');?></a></div>
            200<?php echo $this->Html->image('/img/Coins.png',array('width'=>'20px'));?>
        </div>
        <div class="fourblock left">
            <div class="blockimage">
                <?php echo $this->Html->image('/img/like.png');?>
            </div>
            <div class="blockbtn bi">
            <div class="fb-like" data-href="http://savnpik.com/" data-width="100" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>
            </div>
            500<?php echo $this->Html->image('/img/Coins.png',array('width'=>'20px'));?>
        </div>
        <div class="fourblocklast left">
            <div class="blockimage">
                <?php echo $this->Html->image('/img/purchase.png');?>
            </div>
            <div class="blockbtn done2"><a href="<?php echo $this->webroot;?>">Purchase</a></div>
            <span>Euqual to <br/>cost (AED)</span><?php echo $this->Html->image('/img/Coins.png',array('width'=>'20px'));?>
        </div>
        <div class="clearfix"></div>
    </div>  
</div>