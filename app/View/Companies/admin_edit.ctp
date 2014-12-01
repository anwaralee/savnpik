<div class="col-lg-6">
<?php echo $this->Form->create('Company',array(
                               'inputDefaults' => array(
                                'class' => 'form-control'
                                ), 'type'=>'file'
                                )); 
    ?>
    <fieldset>
        <legend><?php echo __('Update Company'); ?></legend>
        <?php  echo $this->Form->input('name'); ?>
        <?php  echo $this->Form->input('name_arabic'); ?>
        <?php  echo $this->Form->input('desc'); ?>
        <?php  echo $this->Form->input('desc_arabic'); ?>
        <?php  echo $this->Form->input('city_id',array('label'=>'City Name')); ?> <br/>
        <label>Current Logo: </label>
        <?php echo $this->Html->image("uploads/companies/".$companyById['Company']['logo'],
                                  array('fullBase' => true,
                                       'alt'=>'Logo',
                                       'height'=>40,
                                       'width'=>40));?>
        <br/> <br/>
        <div class="input file">
<label for="CompanyLogo">Update Logo:</label>
<input id="CompanyLogo" class="form-control" type="file" name="data[Company][logo]">
</div>
        <br/>
        
        <?php  echo $this->Form->input('website'); ?>
        <?php  echo $this->Form->input('address'); ?>
        <?php  echo $this->Form->input('address_arabic'); ?>
        <?php  echo $this->Form->input('phone_number'); ?><br/>
        <?php $options = array('1' => ' Enabled', '0' => 'Disabled');
			  $attributes = array('legend' => false,'separator'=>'<br/>');
			echo $this->Form->radio('status', $options, $attributes);?>
        <?php echo $this->Form->input('id', array('type' => 'hidden'));?>
        <br/>
    </fieldset>
<?php echo $this->Form->submit('Update Company',array('class'=>'btn btn-success'))?>
<?php echo $this->Form->end(); ?>
</div>

 