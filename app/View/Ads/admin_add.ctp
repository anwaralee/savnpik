<script>
    $(function(){
        $('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' });
        $('#AdAdminAddForm').validationEngine();
    })
</script>
<div class="col-lg-6">
<?php echo $this->Form->create('Ad',array(
                               'inputDefaults' => array(
                                'class' => 'form-control'
                                ),'type'=>'file'
                                )); 
    ?>
    <fieldset>
        <legend><?php echo __('Add Advertisement'); ?></legend>
        <div class="input text">
            <label for="Image">Image (Note:Use image 273x245)</label>
            <input type="file" name="Ad[image]" id="Image" class="validate[required]" />
        </div><br />
        <div class="input text">
            <label for="url">Url </label>
            <input type="text" name="Ad[url]" id="url" class="validate[custom[url]]" />
        </div><br />
        <div class="input text">
            <label for="alt">Short Description</label>
        <input type="text" name="Ad[alt]" id="alt"  />
        </div><br />
        <div class="input text">
            <label for="startdate">Start Date</label>
        <input type="text" name="Ad[start_date]" id="startdate" class="datepicker validate[required]" />
        </div><br />
        <div class="input text">
            <label for="enddate">End Date</label>
            <input type="text" name="Ad[end_date]" id="enddate" class="datepicker validate[required]" />
        </div><br />
        
        <br/>
    </fieldset>
<?php echo $this->Form->submit('Add Advertisement',array('class'=>'btn btn-success'))?>
<?php echo $this->Form->end(); ?>
</div>
