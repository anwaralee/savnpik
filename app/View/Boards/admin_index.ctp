<?php $role = $this->Session->read('Auth.User.role');
    if($role==2){
        $superadmin = true;
    }else {
        $superadmin= false;
    }
?>
<div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
Welcome to Admin Dashboard. Please use the panel to the left to navigate
</div>
<ul>
    <?php if($superadmin){ ?>  
    <li class="dash-icon">
		<a href="#">
			 <?php echo $this->Html->image("dashicons/user management.png", array('fullBase' => true,
                    'alt' => 'Logo',
                    'url' => array('controller' => 'users', 'action' => 'index','admin'=>true)
));?>
			<br />
			<span class="dash-link">Users</span>
		</a>
	</li>
	 <li class="dash-icon">
		<a href="#">
			 <?php echo $this->Html->image("dashicons/set_grading.png", array('fullBase' => true,
                    'alt' => 'Logo',
                    'url' => array('controller' => 'cities', 'action' => 'index','admin'=>true)
));?>
			<br />
			<span class="dash-link">Cities</span>
		</a>
	</li>
     
     <li class="dash-icon">
		<a href="#">
			 <?php echo $this->Html->image("dashicons/set_grading.png", array('fullBase' => true,
                    'alt' => 'Logo',
                    'url' => array('controller' => 'pages', 'action' => 'index','admin'=>true)
));?>
			<br />
			<span class="dash-link">Pages</span>
		</a>
	</li>
    
    <li class="dash-icon">
		<a href="#">
			 <?php echo $this->Html->image("dashicons/set_grading.png", array('fullBase' => true,
                    'alt' => 'Logo',
                    'url' => array('controller' => 'pageCategories', 'action' => 'index','admin'=>true)
));?>
			<br />
			<span class="dash-link">Page Categories</span>
		</a>
	</li>
     
    <?php } else { ?>
    
    <!-- For Admins -->
	<li class="dash-icon">
		<a href="#">
			 <?php echo $this->Html->image("dashicons/news.png", array('fullBase' => true,
                    "alt" => "Logo",
                    'url' => array('controller' => 'dealCategories', 'action' => 'index','admin'=>true)
));?>
			<br />
			<span class="dash-link">Deal Categories</span>
		</a>
	</li>
    <li class="dash-icon">
		<a href="#">
			 <?php echo $this->Html->image("dashicons/batch.png", array('fullBase' => true,
                    "alt" => "Company",
                    'url' => array('controller' => 'companies', 'action' => 'index','admin'=>true)
));?>
			<br />
			<span class="dash-link">Companies</span>
		</a>
	</li>
    <li class="dash-icon">
		<a href="#">
			 <?php echo $this->Html->image("dashicons/travel_management.png", array('fullBase' => true,
                    "alt" => "Deals",
                    'url' => array('controller' => 'deals', 'action' => 'index','admin'=>true)
));?>
			<br />
			<span class="dash-link">Deals Module</span>
		</a>
	</li>
    <?php } ?>
    <li class="dash-icon">
		<a href="#">
			 <?php echo $this->Html->image("dashicons/settings.png", array('fullBase' => true,
                    "alt" => "Logo",
                    'url' => array('controller' => 'boards', 'action' => 'index','admin'=>true)
));?>
			<br />
			<span class="dash-link">Settings</span>
		</a>
	</li>
</ul>
