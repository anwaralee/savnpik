<?php echo $this->Html->link(
    'Add User',
    array('controller' => 'users', 'action' => 'add'),
    array('class'=>'btn btn-success')
); ?>
<br/><br/>
<?php echo $this->Session->flash('save');?>
<?php echo $this->Session->flash('delete');?>
<?php echo $this->Session->flash('update');?>
<?php echo $this->Session->flash('warning');?>
<table class="table table-bordered table-hover table-striped">
		<tr>
			<th>S.No</th>
			<th>Full Name</th>
            <th>Username</th>
            <th>Email Address</th>
            <th>Actions</th>
        </tr>

		<?php foreach ($users as $user): ?>
			<tr>
				<td><?php echo $user['User']['id']; ?></td>
                <td><?php echo $user['User']['full_name'];?></td>
				<td>
					<?php echo $this->Html->link($user['User']['username'],
						array('controller' => 'users', 'action' => 'view', $user['User']['id'])); ?>
				</td>
                 <td><?php echo $user['User']['email'];?></td>
                <td> 
                    <?php echo $this->Html->link('Edit',
													array('action'=>'edit',$user['User']['id']),
													array('class'=>'btn btn-info'));?> 
					&nbsp;&nbsp;
                    
                    <?php echo $this->Html->link('View',
													array('action'=>'view',$user['User']['id']),
													array('class'=>'btn btn-info'));?>
                                                    
                    &nbsp;&nbsp;
					
                    <?php echo $this->Form->postLink('Delete',
                                                    array('action'=>'delete',$user['User']['id']),
                                                    array('class'=>'btn btn-danger'),
                                                   'Are you sure you want to delete?');?>
                                                    
                </td>
				
			</tr>
		<?php endforeach;?>
		<?php unset($users);?>
	</table>
<?php echo $this->Paginator->numbers(); ?>
