<div class="col-lg-6">
<?php echo $this->Form->create('DealCategory',array(
                               'inputDefaults' => array(
                                'class' => 'form-control'
                                )
                                )); 
    ?>
    <fieldset>
        <legend><?php echo __('Add Deal Category'); ?></legend>
        <?php  echo $this->Form->input('name'); ?>
        <?php  echo $this->Form->input('name_arabic'); ?>
        <?php  echo $this->Form->input('name_german'); ?><br/>
        <?php  //echo $this->Form->input('desc'); ?>
        <?php $options = array('1' => ' Enabled', '0' => 'Disabled');
			  $attributes = array('legend' => false,'separator'=>'<br/>');
			echo $this->Form->radio('status', $options, $attributes);?>
        <br/>
    </fieldset>
<?php echo $this->Form->submit('Add Deal Category',array('class'=>'btn btn-success'))?>
<?php echo $this->Form->end(); ?>
</div>
