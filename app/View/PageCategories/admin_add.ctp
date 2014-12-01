<!-- TinyMce Plugins -->
<?php echo $this->Html->script('tiny_mce/tiny_mce.js',array('fullBase'=>true));?>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<?php echo $this->Html->script('morris/chart-data-morris',array('fullBase'=>true));?>
<div class="col-lg-6">
<?php echo $this->Form->create('PageCategory',array(
                               'inputDefaults' => array(
                                'class' => 'form-control'
                                )
                                )); 
    ?>
    <fieldset>
        <legend><?php echo __('Add Category'); ?></legend>
        <?php  echo $this->Form->input('name',array('label'=>'Category Name')); ?> <br/>
        <?php  echo $this->Form->input('name_arabic',array('label'=>'Category Name Arabic')); ?> <br/>
		<?php  echo $this->Form->input('desc',array('label'=>'Category Description')); ?> <br/>
        <?php  echo $this->Form->input('desc_arabic',array('label'=>'Category Description Arabic')); ?> <br/>
        <?php $options = array('1' => ' Enabled', '0' => 'Disabled');
			  $attributes = array('legend' => 'Category Status','separator'=>'<br/>');
			echo $this->Form->radio('status', $options, $attributes);?>
        <br/>
    </fieldset>
<?php echo $this->Form->submit('Add Category',array('class'=>'btn btn-success'))?>
<?php echo $this->Form->end(); ?>
</div>