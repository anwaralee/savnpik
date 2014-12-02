<?php echo $this->Html->link(
    'Add City',
    array('controller' => 'cities', 'action' => 'add'),
    array('class'=>'btn btn-success')
); ?>
<br/><br/>
<?php echo $this->Session->flash('save');?>
<?php echo $this->Session->flash('delete');?>
<?php echo $this->Session->flash('update');?>
<?php echo $this->Session->flash('warning');?>
<?php if($cities){?>
<table class="table table-bordered table-hover table-striped">
		<tr>
			<th>S.No</th>
			<th>City Name</th>
            <th>City Name (Ar.)</th>
            <th>City Name (Sw.)</th>
            <th>City Status</th>
            <th>Actions</th>
        </tr>
	
		<?php $i = 0;
		foreach ($cities as $city):
			$i++;
			?>
			<tr>
				<td><?php echo $i;?></td>
                <td><?php echo $city['City']['name'];?></td>
                <td><?php echo $city['City']['name_arabic'];?></td>
                <td><?php echo $city['City']['name_german'];?></td>
                <td><?php echo ($city['City']['status']==1) ? 'Enabled' : 'Disabled';?></td>
				<td> 
                    <?php echo $this->Html->link('Edit',
													array('action'=>'edit',$city['City']['id']),
													array('class'=>'btn btn-info'));?> 
					&nbsp;&nbsp;
					
                    <?php echo $this->Form->postLink('Delete',
                                                    array('action'=>'delete',$city['City']['id']),
                                                    array('class'=>'btn btn-danger'),
                                                   'Are you sure you want to delete?');?>
                                                
                                                    
                </td>
				
			</tr>
		<?php endforeach;?>
		<?php unset($cities);?>
	</table>
<?php echo $this->Paginator->numbers(); ?>
<?php } else {?>
	<div class="jumbotron">
		<h3>No Cities Found</h3></div>
<?php }?>

