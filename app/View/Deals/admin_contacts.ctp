<div class="deals index">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover table-striped">
	<tr><td>S.No.</td><td>Contact #</td><td>Refrence No.</td><td>Total Amount</td><td>On Date</td><td>Status</td></tr>
    <?php 
    $i=0;
    foreach($contacts as $contact)
    {?>
        <tr><td><?php echo ++$i;?></td><td><?php echo $contact['Cash']['contact'];?></td><td><?php echo $contact['Cash']['refrence_no'];?></td><td><?php echo $contact['Cash']['total']." AED";?></td><td><?php echo $contact['Cash']['ondate'];?></td>
            <td><?php  if($contact['Cash']['stat']=='0')echo $this->Html->link("Approve","/deals/approved_cash/".$contact['Cash']['id'], array("class"=>'btn btn-success'),"Are you sure that you want to approve this payment?");else echo "Approved";?></td></tr>     
    <?php
    }?>
    
    </table>
</div>