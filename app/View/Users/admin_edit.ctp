<div class="col-lg-6">
<?php echo $this->Form->create('User',array(
                               'inputDefaults' => array(
                                'class' => 'form-control'
                                )
                                )); 
    ?>
    <fieldset>
        <legend><?php echo __('Update User'); ?></legend>
        <?php  echo $this->Form->input('full_name'); ?> <br/>
        <?php echo $this->Form->input('username'); ?> <br/>
       <?php  echo $this->Form->input('password'); ?> <br/>
        <?php  echo $this->Form->input('email'); ?> <br/>
        <?php echo $this->Form->input('role', array(
            'options' => array('1' => 'Admin')
        ));
        ?>
			<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
        <br/>
    </fieldset>
<?php echo $this->Form->submit('Update User',array('class'=>'btn btn-info'))?>
<?php echo $this->Form->end(); ?>
</div>
