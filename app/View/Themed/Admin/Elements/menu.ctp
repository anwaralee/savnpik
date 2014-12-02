   
<?php $role = $this->Session->read('Auth.User.role');
	$superadmin = ($role==2)? true : false;
?>
<!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <?php echo $this->Html->image("logo.png",
                                  array('fullBase' => true,
                                       'url' => array('controller' => 'boards', 'action' => 'index','admin'=>true),
                                       'alt'=>'Logo',
                                       'height'=>40,
                                       'width'=>140));?>
       
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li class="active">
                <?php echo $this->Html->link(
                                    'Dashboard',
                                        array('full_base' => true,'controller' => 'boards',
                                            'action' => 'index',
                                            'admin' => true
                                        )
                                        );?>    
            </li>
            <li></li>  
            <!--li> </li-->
            <!--li><a href="tables.html"><i class="fa fa-table"></i> Tables</a></li>
            <li><a href="forms.html"><i class="fa fa-edit"></i> Forms</a></li>
            <li><a href="typography.html"><i class="fa fa-font"></i> Typography</a></li>
            <li><a href="bootstrap-elements.html"><i class="fa fa-desktop"></i> Bootstrap Elements</a></li>
            <li><a href="bootstrap-grid.html"><i class="fa fa-wrench"></i> Bootstrap Grid</a></li>
            <li><a href="blank-page.html"><i class="fa fa-file"></i> Blank Page</a></li-->
            <?php if($superadmin) { ?>
            asdasd
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><?php echo $this->Html->link(
                                    'Add User',
                                        array('full_base' => true,
                                            'controller' => 'users',
                                            'action' => 'add',
                                            'admin' => true
                                        )
                                        );?>
                 </li>
                  <li><?php echo $this->Html->link(
                                    'View Users',
                                        array('full_base' => true,
                                            'controller' => 'users',
                                            'action' => 'index',
                                            'admin' => true
                                        )
                                        );?>
                 </li>
                
              </ul>
            </li>
             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cities <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><?php echo $this->Html->link(
                                    'Add City',
                                        array('full_base' => true,
                                            'controller' => 'cities',
                                            'action' => 'add',
                                            'admin' => true
                                        )
                                        );?>
                 </li>
                  <li><?php echo $this->Html->link(
                                    'View Cities',
                                        array('full_base' => true,
                                            'controller' => 'cities',
                                            'action' => 'index',
                                            'admin' => true
                                        )
                                        );?>
                 </li>
                
              </ul>
            </li>
              
             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><?php echo $this->Html->link(
                                    'Add Page',
                                        array('full_base' => true,
                                            'controller' => 'pages',
                                            'action' => 'add',
                                            'admin' => true
                                        )
                                        );?>
                 </li>
                  <li><?php echo $this->Html->link(
                                    'View Pages',
                                        array('full_base' => true,
                                            'controller' => 'pages',
                                            'action' => 'index',
                                            'admin' => true
                                        )
                                        );?>
                 </li>
                
              </ul>
            </li>
              
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Page Categories <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><?php echo $this->Html->link(
                                    'Add Page Categories',
                                        array('full_base' => true,
                                            'controller' => 'pageCategories',
                                            'action' => 'add',
                                            'admin' => true
                                        )
                                        );?>
                 </li>
                  <li><?php echo $this->Html->link(
                                    'View Page Categories',
                                        array('full_base' => true,
                                            'controller' => 'pageCategories',
                                            'action' => 'index',
                                            'admin' => true
                                        )
                                        );?>
                 </li>
                
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Advertisements <b class="caret"></b></a>
              <ul class="dropdown-menu"> 
                <li><?php echo $this->Html->link(
                                    'Add Advertisement',
                                        array('full_base' => true,
                                            'controller' => 'ads',
                                            'action' => 'add',
                                            'admin' => true
                                        )
                                        );?>
                 </li>
                 <li><?php echo $this->Html->link(
                                    'List Advertisement',
                                        array('full_base' => true,
                                            'controller' => 'ads',
                                            'action' => 'index',
                                            'admin' => true
                                        )
                                        );?>
                 </li>
                 
              </ul> 
            </li>
              
            <?php } else { ?>
            
            <!-- For Admins-->  
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Deal Categories <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><?php echo $this->Html->link(
                                    'Add Deal Category',
                                        array('full_base' => true,
                                            'controller' => 'dealCategories',
                                            'action' => 'add',
                                            'admin' => true
                                        )
                                        );?>
                 </li>
                  <li><?php echo $this->Html->link(
                                    'View Deal Categories',
                                        array('full_base' => true,
                                            'controller' => 'dealCategories',
                                            'action' => 'index',
                                            'admin' => true
                                        )
                                        );?>
                 </li>
                
              </ul>
            </li>
              
              <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Company <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><?php echo $this->Html->link(
                                    'Add new Company',
                                        array('full_base' => true,
                                            'controller' => 'companies',
                                            'action' => 'add',
                                            'admin' => true
                                        )
                                        );?>
                 </li>
                  <li><?php echo $this->Html->link(
                                    'View Companies',
                                        array('full_base' => true,
                                            'controller' => 'companies',
                                            'action' => 'index',
                                            'admin' => true
                                        )
                                        );?>
                 </li>
                
              </ul>
            </li>
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Deals <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><?php echo $this->Html->link(
                                    'Add a new Deal',
                                        array('full_base' => true,
                                            'controller' => 'deals',
                                            'action' => 'add',
                                            'admin' => true
                                        )
                                        );?>
                 </li>
                  <li><?php echo $this->Html->link(
                                    'View All Deals',
                                        array('full_base' => true,
                                            'controller' => 'deals',
                                            'action' => 'index',
                                            'admin' => true
                                        )
                                        );?>
                 </li>
                
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cash on hand <b class="caret"></b></a>
              <ul class="dropdown-menu">
                 <li><?php echo $this->Html->link(
                                    'View All Contacts',
                                        array('full_base' => true,
                                            'controller' => 'deals',
                                            'action' => 'contacts',
                                            'admin' => true
                                        )
                                        );?>
                 </li>
                
              </ul>
            </li>
              <?php } ?>
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <!--<li class="dropdown messages-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">7</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">7 New Messages</li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name">John Smith:</span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name">John Smith:</span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li class="message-preview">
                  <a href="#">
                    <span class="avatar"><img src="http://placehold.it/50x50"></span>
                    <span class="name">John Smith:</span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
                <li><a href="#">View Inbox <span class="badge">7</span></a></li>
              </ul>
            </li>
            <li class="dropdown alerts-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Default <span class="label label-default">Default</span></a></li>
                <li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>
                <li><a href="#">Success <span class="label label-success">Success</span></a></li>
                <li><a href="#">Info <span class="label label-info">Info</span></a></li>
                <li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>
                <li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>
                <li class="divider"></li>
                <li><a href="#">View All</a></li>
              </ul>
            </li>-->
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-user"></i><?php echo ucfirst($this->Session->read('Auth.User.username'));?><b class="caret"></b></a>
              <ul class="dropdown-menu">
                <!--<li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>-->
                <li><a href="/admin/boards/settings"><i class="fa fa-gear"></i> Settings</a></li>
                <li><a href="/admin/boards/changepassword"><i class="fa fa-gear"></i> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa fa-power-off"></i>
                <?php echo $this->Html->link(
                                    'Log Out',
                                        array('full_base' => true,
                                            'controller' => 'users',
                                            'action' => 'logout',
                                            'admin' => true
                                        )
                                        );?>    
                </a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
