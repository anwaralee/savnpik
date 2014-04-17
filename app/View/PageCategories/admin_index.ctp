<?php echo $this->Html->link(
    'Add Category',
    array('controller' => 'pageCategories', 'action' => 'add'),
    array('class'=>'btn btn-success')
); ?>
<br/><br/>
<?php echo $this->Session->flash('save');?>
<?php echo $this->Session->flash('delete');?>
<?php echo $this->Session->flash('update');?>
<?php echo $this->Session->flash('warning');?>
<?php if($pageCategories){?>
<table class="table table-bordered table-hover table-striped">
		<tr>
			<th>S.No</th>
			<th>Category Name</th>
            <th>Category Description</th>
            <th>Category Status</th>
            <th>Actions</th>
        </tr>
	
		<?php $i = 0;
		foreach ($pageCategories as $pageCategory):
			$i++;
			?>
			<tr>
				<td><?php echo $i;?></td>
                <td><?php echo $pageCategory['PageCategory']['name'];?></td>
				<td><?php echo $pageCategory['PageCategory']['desc'];?></td>
                <td><?php echo ($pageCategory['PageCategory']['status']==1) ? 'Enabled' : 'Disabled';?></td>
				<td> 
                    <?php echo $this->Html->link('Edit',
													array('action'=>'edit',$pageCategory['PageCategory']['id']),
													array('class'=>'btn btn-info'));?> 
					&nbsp;&nbsp;
					
                    <?php echo $this->Form->postLink('Delete',
                                                    array('action'=>'delete',$pageCategory['PageCategory']['id']),
                                                    array('class'=>'btn btn-danger'),
                                                   'Are you sure you want to delete?' );?>
					&nbsp;&nbsp;
					<?php echo $this->Html->link('All Pages',
													array('action'=>'findAllPages',$pageCategory['PageCategory']['id']),
													array('class'=>'btn btn-warning'));?> 
               
                                                    
                </td>
				
			</tr>
		<?php endforeach;?>
		<?php unset($pageCategories);?>
	</table>
<?php echo $this->Paginator->numbers(); ?>
<?php } else {?>
	<div class="jumbotron">
		<h3>No Categories Found</h3></div>
<?php }?>


