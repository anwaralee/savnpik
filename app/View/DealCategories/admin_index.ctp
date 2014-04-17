<?php echo $this->Session->flash('save');?>
<?php echo $this->Session->flash('delete');?>
<?php echo $this->Session->flash('update');?>
<?php echo $this->Session->flash('warning');?>
<?php if($dealCategories){?>
<?php echo $this->Html->link(
    'Add Deal Category',
    array('controller' => 'dealCategories', 'action' => 'add'),
    array('class'=>'btn btn-success')
); ?>
<br/><br/>
<table class="table table-bordered table-hover table-striped">
		<tr>
			<th>S.No</th>
			<th>Deal Category Name</th>
            <th>Deal Category Description</th>
            <th>Deal Category Status</th>
            <th>Actions</th>
        </tr>
	
		<?php $i = 0;
		foreach ($dealCategories as $dealCat):
			$i++;
			?>
			<tr>
				<td><?php echo $i;?></td>
                <td><?php echo $dealCat['DealCategory']['name'];?></td>
                <td><?php echo $dealCat['DealCategory']['desc'];?></td>
                <td><?php echo ($dealCat['DealCategory']['status']==1) ? 'Enabled' : 'Disabled';?></td>
				<td> 
                    <?php echo $this->Html->link('Edit',
													array('action'=>'edit',$dealCat['DealCategory']['id']),
													array('class'=>'btn btn-info'));?> 
					&nbsp;&nbsp;
					
                    <?php echo $this->Form->postLink('Delete',
                                                    array('action'=>'delete',$dealCat['DealCategory']['id']),
                                                    array('class'=>'btn btn-danger'),
                                                   'Are you sure you want to delete?');?>
                                                
                                                    
                </td>
				
			</tr>
		<?php endforeach;?>
		<?php unset($dealCategories);?>
	</table>
<?php echo $this->Paginator->numbers(); ?>
<?php } else {?>
    <?php echo $this->Html->link(
        'Add Deal Category',
        array('controller' => 'dealCategories', 'action' => 'add'),
        array('class'=>'btn btn-success')
        ); ?>
<br/><br/>
	<div class="jumbotron">
		<h3>No Deal Categories Found</h3></div>
<?php }?>

