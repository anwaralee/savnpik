<!-- TinyMce Plugins -->
<?php echo $this->Html->script('tiny_mce/tiny_mce.js',array('fullBase'=>true));?>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
    function calculatePrice(){
    var discount = document.getElementById('DealDiscount').value;
    var markedPrice =  document.getElementById('DealMarkedPrice').value;    
    var sellingPrice = markedPrice - Math.round((discount*markedPrice/100),2);
    document.getElementById('DealSellingPrice').value = sellingPrice;
    }
</script>
<div class="deals form">
<?php echo $this->Form->create('Deal',array(
                               'inputDefaults' => array(
                                'class' => 'form-control'
                                ),'type'=>'file')); ?>
	<fieldset>
		<legend><?php echo __('Edit Deal'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('deal_category_id');
		echo $this->Form->input('company_id');
		echo $this->Form->input('highlights');
		echo $this->Form->input('conditions');
		echo $this->Form->input('threshold');
		echo $this->Form->input('marked_price',array('onchange'=>'calculatePrice()'));
		echo $this->Form->input('discount',array('onchange'=>'calculatePrice()','label'=>'Discount %'));
		echo $this->Form->input('selling_price',array('disabled="disabled"'));
		echo $this->Form->input('expiry_date');
		echo $this->Form->input('image1',array('type'=>'file'));
		echo $this->Form->input('image2',array('type'=>'file'));
		echo $this->Form->input('image3',array('type'=>'file'));
		echo $this->Form->input('image4',array('type'=>'file'));
		echo $this->Form->input('image5',array('type'=>'file'));
		echo $this->Form->input('image6',array('type'=>'file'));
		echo $this->Form->input('image7',array('type'=>'file'));
		echo $this->Form->input('image8',array('type'=>'file'));
		echo $this->Form->input('image9',array('type'=>'file'));
		echo $this->Form->input('image10',array('type'=>'file')); ?>
        <br/>
	<?php $options = array('1' => ' Enabled', '0' => 'Disabled');
			  $attributes = array('legend' => false,'separator'=>'<br/>');
			echo $this->Form->radio('status', $options, $attributes);?>
          <br/>
    <?php echo $this->Form->input('is_featured',array('type'=>'checkbox','label'=>'Featured?'));?>
	</fieldset>

   <?php echo $this->Form->submit('Update Deal',array('class'=>'btn btn-success','onclick'=>'$("#DealSellingPrice").removeAttr("disabled")'))?>
<?php echo $this->Form->end(); ?>
</div>
