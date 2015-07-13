<header class="header bg-dark navbar navbar-inverse">
  <div class="collapse navbar-collapse pull-in">
    
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Hello, 
          Admin <b class="caret"></b>
        </a>
        <ul class="dropdown-menu animated fadeInLeft">
          <li><a href="<?php echo base_url()._INDEX; ?>admin/update_profile">Profile</a></li>
          <li><a href="<?php echo base_url()._INDEX; ?>admin/change_password">Change Password</a></li>
          <li class="divider"></li>
          <li><a href="<?php echo base_url()._INDEX."admin/logout"?>">Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</header>