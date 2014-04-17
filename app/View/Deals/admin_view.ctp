<h3><?php echo $deal['Deal']['name']; ?></h3>
<table class="table table-bordered table-hover table-striped">
    <tr>
        <td>Name:</td>
        <td><?php echo $deal['Deal']['name']; ?></td>
    </tr>
    <tr>
         <td>Deal Category: </td>      
         <td><?php echo $deal['DealCategory']['name'];  ?></td>
    </tr>
      <tr>
         <td>Company Name: </td>      
           <td><?php echo $deal['Company']['name'];  ?></td>
     <tr>
         <td>Highlights: </td>      
           <td><?php echo $deal['Deal']['highlights'];  ?></td>
    </tr>
    <tr>
         <td>Conditions: </td>      
           <td><?php echo $deal['Deal']['conditions'];  ?></td>
    </tr>
    <tr>
         <td>Threshold Value: </td>      
           <td><?php echo $deal['Deal']['threshold'];  ?></td>
    </tr>
     <tr>
         <td>Marked Price: </td>      
           <td><?php echo $deal['Deal']['marked_price'];  ?></td>
    </tr>
    <tr>
    <td>Discount %: </td>      
           <td><?php echo $deal['Deal']['discount'];  ?></td>
    </tr>
    <tr>
    <td>Selling Price: </td>      
           <td><?php echo $deal['Deal']['selling_price'];  ?></td>
    </tr>
    <tr>
    <td>Expiry Date: </td>      
           <td><?php echo $deal['Deal']['expiry_date'];  ?></td>
    </tr>
    
    <tr>
         <td>Status: </td>      
        <td><?php echo ($deal['Deal']['status']==1) ? 'Enabled' : 'Disabled';?></td>
    </tr>
    <tr>
        <td colspan="2">Image Gallery</td>
    </tr>
        
      <tr>
            <td colspan="2">
    <?php for($i=1;$i<=10;$i++){?>
  
        
            <?php echo $this->Html->image("/files/deals/".$deal['Deal']['image'.$i],
                                  array('fullBase' => true,
                                       'alt'=>'',
                                       'height'=>80,
                                       'width'=>80));?>
      

   
    <?php } ?>
                  </td>
     </tr>
    </table>

		
