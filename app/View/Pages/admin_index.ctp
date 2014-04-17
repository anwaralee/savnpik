<?php echo $this->Html->link(
    'Add Page Items',
    array('controller' => 'pages', 'action' => 'add'),
    array('class'=>'btn btn-success')
); ?>
<br/><br/>
<?php echo $this->Session->flash('save');?>
<?php echo $this->Session->flash('delete');?>
<?php echo $this->Session->flash('update');?>
<?php echo $this->Session->flash('warning');?>
<?php if($pages){?>
<table class="table table-bordered table-hover table-striped">
		<tr>
			<th>S.No</th>
			<th>Page Title</th>
            <th>Page Description</th>
            <th>Page Status</th>
			<th>Page Category</th>
            <th>Actions</th>
        </tr>
	
		<?php $i = 0;
		foreach ($pages as $page):
			$i++;
			?>
			<tr>
				<td><?php echo $i;?></td>
                <td><?php echo $page['Page']['title'];?></td>
				<td><?php echo $page['Page']['desc'];?></td>
                <td><?php echo ($page['Page']['status']==1) ? 'Enabled' : 'Disabled';?></td>
				<td><?php echo $page['PageCategory']['name'];?></td>
				<td> 
                    <?php echo $this->Html->link('Edit',
													array('action'=>'edit',$page['Page']['id']),
													array('class'=>'btn btn-info'));?> 
					&nbsp;&nbsp;
					
                    <?php echo $this->Form->postLink('Delete',
                                                    array('action'=>'delete',$page['Page']['id']),
                                                    array('class'=>'btn btn-danger'),
                                                   'Are you sure you want to delete?' );?>
                                                
                                                    
                </td>
				
			</tr>
		<?php endforeach;?>
		<?php unset($pages);?>
	</table>
<?php echo $this->Paginator->numbers(); ?>
<?php } else {?>
	<div class="jumbotron">
		<h3>No Categories Found</h3></div>
<?php }?>



