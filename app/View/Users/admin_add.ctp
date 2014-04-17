<div class="col-lg-6">
<?php echo $this->Form->create('User',array(
                               'inputDefaults' => array(
                                'class' => 'form-control'
                                )
                                )); 
    ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php  echo $this->Form->input('full_name'); ?> <br/>
        <?php echo $this->Form->input('username'); ?> <br/>
       <?php  echo $this->Form->input('password'); ?> <br/>
        <?php  echo $this->Form->input('email'); ?> <br/>
        <?php echo $this->Form->input('role', array(
            'options' => array('1' => 'Admin')
        ));
        ?> <br/>
    </fieldset>
<?php echo $this->Form->submit('Add User',array('class'=>'btn btn-success'))?>
<?php echo $this->Form->end(); ?>
</div>