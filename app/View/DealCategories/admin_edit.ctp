<div class="col-lg-6">
<?php echo $this->Form->create('DealCategory',array(
                               'inputDefaults' => array(
                                'class' => 'form-control'
                                )
                                )); 
    ?>
    <fieldset>
        <legend><?php echo __('Update Deal Category'); ?></legend>
            <?php  echo $this->Form->input('name'); ?>
            <?php  echo $this->Form->input('name_arabic'); ?><br/>
            <?php  echo $this->Form->input('name_german'); ?><br/>
            <?php $options = array('1' => ' Enabled', '0' => 'Disabled');
			  $attributes = array('legend' => false,'separator'=>'<br/>');
			         echo $this->Form->radio('status', $options, $attributes);?>
			<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
        <br/>
    </fieldset>
<?php echo $this->Form->submit('Update',array('class'=>'btn btn-info'))?>
<?php echo $this->Form->end(); ?>
</div>
