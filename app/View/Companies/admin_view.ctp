<h3><?php echo $company['Company']['name']; ?></h3>
<table class="table table-bordered table-hover table-striped">
    <tr>
        <td colspan="2">
            <?php echo $this->Html->image("uploads/companies/".$company['Company']['logo'],
                                  array('fullBase' => true,
                                       'alt'=>'Logo',
                                       'height'=>80,
                                       'width'=>80));?>
        </td>
    </tr>
    <tr>
        <td>Name:</td>
        <td><?php echo $company['Company']['name']; ?></td>
    </tr>
    <tr>
         <td>Description: </td>      
         <td><?php echo $company['Company']['desc'];  ?></td>
    </tr>
      <tr>
         <td>City Name: </td>      
          <td><?php echo $this->CityDB->getCityName($company['Company']['city_id'])['City']['name'];?></td>
    </tr>
     <tr>
         <td>Website: </td>      
           <td><?php echo $company['Company']['website'];  ?></td>
    </tr>
    <tr>
         <td>Address: </td>      
           <td><?php echo $company['Company']['address'];  ?></td>
    </tr>
    <tr>
         <td>Phone Number: </td>      
           <td><?php echo $company['Company']['phone_number'];  ?></td>
    </tr>
    <tr>
         <td>Status: </td>      
        <td><?php echo ($company['Company']['status']==1) ? 'Enabled' : 'Disabled';?></td>
    </tr>
</table>

		
