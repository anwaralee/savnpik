<div class="col-lg-6">
<?php echo $this->Form->create('City',array(
                               'inputDefaults' => array(
                                'class' => 'form-control'
                                )
                                )); 
    ?>
    <fieldset>
        <legend><?php echo __('Add City'); ?></legend>
        <?php  echo $this->Form->input('name'); ?> <br/>
        <?php  echo $this->Form->input('name_arabic'); ?> <br/>
        <?php $options = array('1' => ' Enabled', '0' => 'Disabled');
			  $attributes = array('legend' => false,'separator'=>'<br/>');
			echo $this->Form->radio('status', $options, $attributes);?>
        <br/>
    </fieldset>
<?php echo $this->Form->submit('Add City',array('class'=>'btn btn-success'))?>
<?php echo $this->Form->end(); ?>
</div>
