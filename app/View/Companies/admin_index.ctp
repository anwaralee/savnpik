<?php echo $this->Session->flash('save');?>
<?php echo $this->Session->flash('delete');?>
<?php echo $this->Session->flash('update');?>
<?php echo $this->Session->flash('warning');?>
<?php if($companies){?>
<?php echo $this->Html->link(
    'Add Company',
    array('controller' => 'companies', 'action' => 'add'),
    array('class'=>'btn btn-success')
); ?>
<br/><br/>
<table class="table table-bordered table-hover table-striped">
		<tr>
			<th>S.No</th>
            <th>Company Logo</th>
			<th>Company Name</th>
            <th>Company City Name</th>
            <th>Company Status</th>
            <th>Actions</th>
        </tr>
	
		<?php $i = 0;
		foreach ($companies as $company):
			$i++;
			?>
			<tr>
				<td><?php echo $i;?></td>
                <td>
                   <?php  $this->Html->image('uploads/companies/' . $company['Company']['logo']); ?>
                     <?php echo $this->Html->image("uploads/companies/".$company['Company']['logo'],
                                  array('fullBase' => true,
                                       'alt'=>'Logo',
                                       'height'=>40,
                                       'width'=>40));?>
                    </td>
                <td><?php echo $company['Company']['name'];?></td>
				<td><?php echo $company['City']['name'];?></td>
                <td><?php echo ($company['Company']['status']==1) ? 'Enabled' : 'Disabled';?></td>
				<td> 
                    <?php echo $this->Html->link('View',
													array('action'=>'view',$company['Company']['id']),
													array('class'=>'btn btn-primary '));?> 
                    &nbsp;&nbsp;
                    <?php echo $this->Html->link('Edit',
													array('action'=>'edit',$company['Company']['id']),
													array('class'=>'btn btn-info'));?> 
					&nbsp;&nbsp;
					
                    <?php echo $this->Form->postLink('Delete',
                                                    array('action'=>'delete',$company['Company']['id']),
                                                    array('class'=>'btn btn-danger'),
                                                   'Are you sure you want to delete?');?>
                                                
                                                    
                </td>
				
			</tr>
		<?php endforeach;?>
		<?php unset($companies);?>
	</table>
<?php echo $this->Paginator->numbers(); ?>
<?php } else {?>
    <?php echo $this->Html->link(
        'Add Company',
        array('controller' => 'companies', 'action' => 'add'),
        array('class'=>'btn btn-success')
        ); ?>
<br/><br/>
	<div class="jumbotron">
		<h3>No Companies Found</h3></div>
<?php }?>

