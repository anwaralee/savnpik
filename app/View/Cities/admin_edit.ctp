<div class="col-lg-6">
<?php echo $this->Form->create('City',array(
                               'inputDefaults' => array(
                                'class' => 'form-control'
                                )
                                )); 
    ?>
    <fieldset>
        <legend><?php echo __('Update City'); ?></legend>
        <?php  echo $this->Form->input('name'); ?> <br/>
        <?php  echo $this->Form->input('name_arabic'); ?> <br/>
        <?php  echo $this->Form->input('name_german',array('label' => 'Name Swedish')); ?> <br/>
        <?php $options = array('1' => ' Enabled', '0' => 'Disabled');
			  $attributes = array('legend' => false,'separator'=>'<br/>');
			echo $this->Form->radio('status', $options, $attributes);?>
			<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
        <br/>
    </fieldset>
<?php echo $this->Form->submit('Update City',array('class'=>'btn btn-info'))?>
<?php echo $this->Form->end(); ?>
</div>
