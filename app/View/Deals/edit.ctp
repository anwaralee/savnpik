<div class="deals form">
<?php echo $this->Form->create('Deal'); ?>
	<fieldset>
		<legend><?php echo __('Edit Deal'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('deal_category_id');
		echo $this->Form->input('company_id');
		echo $this->Form->input('highlights');
		echo $this->Form->input('conditions');
		echo $this->Form->input('threshold');
		echo $this->Form->input('marked_price');
		echo $this->Form->input('discount');
		echo $this->Form->input('selling_price');
		echo $this->Form->input('expiry_date');
		echo $this->Form->input('buy_count');
		echo $this->Form->input('view_count');
		echo $this->Form->input('image1');
		echo $this->Form->input('image2');
		echo $this->Form->input('image3');
		echo $this->Form->input('image4');
		echo $this->Form->input('image5');
		echo $this->Form->input('image6');
		echo $this->Form->input('image7');
		echo $this->Form->input('image8');
		echo $this->Form->input('image9');
		echo $this->Form->input('image10');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Deal.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Deal.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Deals'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Deal Categories'), array('controller' => 'deal_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Deal Category'), array('controller' => 'deal_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies'), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('controller' => 'companies', 'action' => 'add')); ?> </li>
	</ul>
</div>
