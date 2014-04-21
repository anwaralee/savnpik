<script>
    $(function(){
        $('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' });
        $('#AdAdminAddForm').validationEngine();
    })
</script>
<div class="col-lg-6">
<?php /*echo $this->Form->create('Ad',array(
                               'inputDefaults' => array(
                                'class' => 'form-control'
                                ),'type'=>'file')); */
    ?>
    <legend><?php if(isset($ad))echo 'Update Advertisement'; else echo 'Add Advertisement'; ?></legend>
    <form action="" method="post" enctype="multipart/form-data" class="form-control" id="AdAdminAddForm">
    
    <fieldset>
        
        <div class="input text">
            <label for="Image">Image (Note:Use image 273x245)</label>
            <input type="file" name="image" id="Image" class="<?php if(!isset($ad))echo 'validate[required]';?>"  class="form-control"  />
            <?php if(isset($ad)) echo $this->Html->image("/files/ads/".$ad['Ad']['image'],array('height'=>53,'width'=>63));?>
        </div><br />
        <div class="input text">
            <label for="url">Url </label>
            <input type="text" name="Ad[url]" id="url" class="validate[custom[url]] form-control" value="<?php if(isset($ad))echo $ad['Ad']['url'];?>" />
        </div><br />
        <div class="input text">
            <label for="alt">Short Description</label>
        <input type="text" name="Ad[alt]" id="alt" value="<?php if(isset($ad))echo $ad['Ad']['alt'];?>" class="form-control"  />
        </div><br />
        <div class="input text">
            <label for="startdate">Start Date</label>
        <input type="text" name="Ad[start_date]" id="startdate" class="datepicker validate[required] form-control" value="<?php if(isset($ad))echo $ad['Ad']['start_date'];?>" />
        </div><br />
        <div class="input text">
            <label for="enddate">End Date</label>
            <input type="text" name="Ad[end_date]" id="enddate" class="datepicker validate[required] form-control" value="<?php if(isset($ad))echo $ad['Ad']['end_date'];?>" />
        </div><br />
        
        <br/>
    </fieldset>
<?php echo $this->Form->submit((isset($ad))? 'Update Advertisement' : 'Add Advertisement',array('class'=>'btn btn-success'))?>
<?php echo $this->Form->end(); ?>
</div>
