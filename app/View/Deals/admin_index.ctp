<?php echo $this->Session->flash('save');?>
<?php echo $this->Session->flash('delete');?>
<?php echo $this->Session->flash('update');?>
<?php echo $this->Session->flash('warning');?>
<?php if(!empty($deals)){?>

 <?php echo $this->Html->link(
        'Add new Deal',
        array('controller' => 'deals', 'action' => 'add'),
        array('class'=>'btn btn-success')
        ); ?>
<br/><br/>
<div class="deals index">
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover table-striped">
	<tr>
			<th>S.No</th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('deal_category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('company_id'); ?></th>
			<th><?php echo $this->Paginator->sort('threshold'); ?></th>
			<th><?php echo $this->Paginator->sort('selling_price'); ?></th>
			<th><?php echo $this->Paginator->sort('expiry_date'); ?></th>
			<th><?php echo $this->Paginator->sort('Featured?'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
    $s = 0; 
    foreach ($deals as $deal):
    
    ?>
    
	<tr>
		<td><?php $s++;  echo $s;?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($deal['DealCategory']['name'], array('controller' => 'deal_categories', 'action' => 'view', $deal['DealCategory']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($deal['Company']['name'], array('controller' => 'companies', 'action' => 'view', $deal['Company']['id'])); ?>
		</td>
		<td><?php echo h($deal['Deal']['threshold']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['selling_price']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['expiry_date']); ?>&nbsp;</td>
		 <td><?php echo (h($deal['Deal']['is_featured']==1)) ? 'Yes' : 'No';?></td>
        <td><?php echo (h($deal['Deal']['status']==1)) ? 'Enabled' : 'Disabled';?></td>
		<td> 
                    <?php echo $this->Html->link('View',
													array('action'=>'view',$deal['Deal']['id']),
													array('class'=>'btn btn-primary '));?> 
               
                    <?php echo $this->Html->link('Edit',
													array('action'=>'edit',$deal['Deal']['id']),
													array('class'=>'btn btn-info'));?> 
			
					
                    <?php echo $this->Form->postLink('Delete',
                                                    array('action'=>'delete',$deal['Deal']['id']),
                                                    array('class'=>'btn btn-danger'),
                                                   'Are you sure you want to delete?');?>
                                                
                                                    
         </td>
	</tr>
<?php endforeach; ?>
	</table>

<div class="pagination pagination-large">
    <ul class="pagination">
            <?php
                echo $this->Paginator->first(__('<<'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                echo $this->Paginator->prev(__('<'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));         
                echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                echo $this->Paginator->next(__('>'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                echo $this->Paginator->last(__('>>'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            ?>
        </ul>
    </div>
    </div>
<?php } else { ?>
 <?php echo $this->Html->link(
        'Add new Deal',
        array('controller' => 'deals', 'action' => 'add'),
        array('class'=>'btn btn-success')
        ); ?>
<br/><br/>
	<div class="jumbotron">
		<h3>No Deals Found</h3></div>
<?php }?>
 