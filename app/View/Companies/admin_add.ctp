<div class="col-lg-6">
<?php echo $this->Form->create('Company',array(
                               'inputDefaults' => array(
                                'class' => 'form-control'
                                ), 'type'=>'file'
                                )); 
    ?>
    <fieldset>
        <legend><?php echo __('Add new Company'); ?></legend>
        <?php  echo $this->Form->input('name'); ?>
        <?php  echo $this->Form->input('desc'); ?>
        <?php  echo $this->Form->input('city_id',array('label'=>'City Name')); ?>
        <?php  echo $this->Form->input('logo',array('type'=>'file')); ?>
        <?php  echo $this->Form->input('website'); ?>
        <?php  echo $this->Form->input('address'); ?>
        <?php  echo $this->Form->input('phone_number'); ?><br/>
        <?php $options = array('1' => ' Enabled', '0' => 'Disabled');
			  $attributes = array('legend' => false,'separator'=>'<br/>');
			echo $this->Form->radio('status', $options, $attributes);?>
        <br/>
    </fieldset>
<?php echo $this->Form->submit('Add Company',array('class'=>'btn btn-success'))?>
<?php echo $this->Form->end(); ?>
</div>
