<div class="deals view">
<h2><?php echo __('Deal'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deal Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($deal['DealCategory']['name'], array('controller' => 'deal_categories', 'action' => 'view', $deal['DealCategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company'); ?></dt>
		<dd>
			<?php echo $this->Html->link($deal['Company']['name'], array('controller' => 'companies', 'action' => 'view', $deal['Company']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Highlights'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['highlights']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Conditions'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['conditions']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Threshold'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['threshold']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Marked Price'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['marked_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Discount'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['discount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Selling Price'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['selling_price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Expiry Date'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['expiry_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Buy Count'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['buy_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('View Count'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['view_count']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image1'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['image1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image2'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['image2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image3'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['image3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image4'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['image4']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image5'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['image5']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image6'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['image6']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image7'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['image7']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image8'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['image8']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image9'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['image9']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image10'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['image10']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($deal['Deal']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Deal'), array('action' => 'edit', $deal['Deal']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Deal'), array('action' => 'delete', $deal['Deal']['id']), null, __('Are you sure you want to delete # %s?', $deal['Deal']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Deals'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Deal'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Deal Categories'), array('controller' => 'deal_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Deal Category'), array('controller' => 'deal_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies'), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('controller' => 'companies', 'action' => 'add')); ?> </li>
	</ul>
</div>
