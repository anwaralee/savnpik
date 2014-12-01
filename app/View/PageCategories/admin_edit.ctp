<!-- TinyMce Plugins -->
<?php echo $this->Html->script('tiny_mce/tiny_mce.js',array('fullBase'=>true));?>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme : "simple"
	});
</script>
<div class="col-lg-6">
<?php echo $this->Form->create('PageCategory',array(
                               'inputDefaults' => array(
                                'class' => 'form-control'
                                )
                                )); 
    ?>
    <fieldset>
        <legend><?php echo __('Update Category'); ?></legend>
        <?php  echo $this->Form->input('name'); ?> <br/>
        <?php  echo $this->Form->input('name_arabic'); ?> <br/>
		<?php  echo $this->Form->input('desc'); ?> <br/>
        <?php  echo $this->Form->input('desc_arabic'); ?> <br/>
        <?php $options = array('1' => ' Enabled', '0' => 'Disabled');
			  $attributes = array('legend' => false,'separator'=>'<br/>');
			echo $this->Form->radio('status', $options, $attributes);?>
			<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
        <br/>
    </fieldset>
<?php echo $this->Form->submit('Update Category',array('class'=>'btn btn-info'))?>
<?php echo $this->Form->end(); ?>
</div>
