<div class="deals index">
	<h2><?php echo __('Deals'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('deal_category_id'); ?></th>
			<th><?php echo $this->Paginator->sort('company_id'); ?></th>
			<th><?php echo $this->Paginator->sort('highlights'); ?></th>
			<th><?php echo $this->Paginator->sort('conditions'); ?></th>
			<th><?php echo $this->Paginator->sort('threshold'); ?></th>
			<th><?php echo $this->Paginator->sort('marked_price'); ?></th>
			<th><?php echo $this->Paginator->sort('discount'); ?></th>
			<th><?php echo $this->Paginator->sort('selling_price'); ?></th>
			<th><?php echo $this->Paginator->sort('expiry_date'); ?></th>
			<th><?php echo $this->Paginator->sort('buy_count'); ?></th>
			<th><?php echo $this->Paginator->sort('view_count'); ?></th>
			<th><?php echo $this->Paginator->sort('image1'); ?></th>
			<th><?php echo $this->Paginator->sort('image2'); ?></th>
			<th><?php echo $this->Paginator->sort('image3'); ?></th>
			<th><?php echo $this->Paginator->sort('image4'); ?></th>
			<th><?php echo $this->Paginator->sort('image5'); ?></th>
			<th><?php echo $this->Paginator->sort('image6'); ?></th>
			<th><?php echo $this->Paginator->sort('image7'); ?></th>
			<th><?php echo $this->Paginator->sort('image8'); ?></th>
			<th><?php echo $this->Paginator->sort('image9'); ?></th>
			<th><?php echo $this->Paginator->sort('image10'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($deals as $deal): ?>
	<tr>
		<td><?php echo h($deal['Deal']['id']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($deal['DealCategory']['name'], array('controller' => 'deal_categories', 'action' => 'view', $deal['DealCategory']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($deal['Company']['name'], array('controller' => 'companies', 'action' => 'view', $deal['Company']['id'])); ?>
		</td>
		<td><?php echo h($deal['Deal']['highlights']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['conditions']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['threshold']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['marked_price']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['discount']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['selling_price']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['expiry_date']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['buy_count']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['view_count']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['image1']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['image2']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['image3']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['image4']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['image5']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['image6']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['image7']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['image8']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['image9']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['image10']); ?>&nbsp;</td>
		<td><?php echo h($deal['Deal']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $deal['Deal']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $deal['Deal']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $deal['Deal']['id']), null, __('Are you sure you want to delete # %s?', $deal['Deal']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Deal'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Deal Categories'), array('controller' => 'deal_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Deal Category'), array('controller' => 'deal_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies'), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('controller' => 'companies', 'action' => 'add')); ?> </li>
	</ul>
</div>
