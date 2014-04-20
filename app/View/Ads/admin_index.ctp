<?php echo $this->Html->link(
    'Add Advertisement',
    array('controller' => 'ads', 'action' => 'add'),
    array('class'=>'btn btn-success')
); ?>
<br/><br/>
<?php echo $this->Session->flash('save');?>
<?php echo $this->Session->flash('delete');?>
<?php echo $this->Session->flash('update');?>
<?php echo $this->Session->flash('warning');?>
<?php if($ads){?>
<table class="table table-bordered table-hover table-striped">
		<tr>
			<th>S.No</th>
			<th>Ads Image</th>
            <th>Ads Url</th>
            <th>Ads Description</th>
			<th>Ads Start Date</th>
            <th>Ads End Date</th>
            <th>Actions</th>
        </tr>
	
		<?php $i = 0;
		foreach ($ads as $page):
			$i++;
			?>
			<tr>
				<td><?php echo $i;?></td>
                <td><?php echo $page['Ads']['image'];?></td>
				<td><?php echo $page['Ads']['url'];?></td>
                <td><?php echo $page['Ads']['alt']?></td>
				<td><?php echo $page['Ads']['start_date'];?></td>
                <td><?php echo $page['Ads']['end_date'];?></td>
				<td> 
                    <?php echo $this->Html->link('Edit',
													array('action'=>'edit',$page['Ads']['id']),
													array('class'=>'btn btn-info'));?> 
					&nbsp;&nbsp;
					
                    <?php echo $this->Form->postLink('Delete',
                                                    array('action'=>'delete',$page['Ads']['id']),
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



