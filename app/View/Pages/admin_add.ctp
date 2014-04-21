<!-- TinyMce Plugins -->
<?php echo $this->Html->script('tiny_mce/tiny_mce.js',array('fullBase'=>true));?>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<div class="col-lg-6">
<?php echo $this->Form->create('Page',array(
                               'inputDefaults' => array(
                                'class' => 'form-control'
                                )
                                )); 
    ?>
    <fieldset>
        <legend><?php echo __('Add Page'); ?></legend>
        <?php  echo $this->Form->input('title',array('label'=>'Page Title')); ?> <br/>
		<div class="input textarea">
<label for="PageDesc">Page Description</label>
<textarea id="PageDesc" class="form-control ckeditor" rows="6" cols="30" name="data[Page][desc]"></textarea>
</div>
<br>

		<?php  echo $this->Form->input('page_category_id'); ?>
		
		
        <?php $options = array('1' => 'Enabled', '0' => 'Disabled');
			  $attributes = array('legend' => 'Page Status','separator' => '<br/>');
			echo $this->Form->radio('status', $options, $attributes);?>
        <br/>
    </fieldset>
<?php echo $this->Form->submit('Add Page',array('class'=>'btn btn-success'))?>
<?php echo $this->Form->end(); ?>
</div>
