<header class="topbar">
  <nav class="navbar top-navbar navbar-expand-md navbar-light">
    <!-- ============================================================== -->
    <!-- Logo -->
    <!-- ============================================================== -->
    
    <div class="navbar-header"> <a class="navbar-brand" href="index.php"> 
      <!-- Logo icon --> 
      <b> 
      <!--You can put here icon as well // <i class="wi wi-sunset"></i> //--> 
      <!-- Dark Logo icon --> 
      <img src="assets/images/logo-light-icon.png" alt="homepage" class="dark-logo" /> 
      <!-- Light Logo icon --> 
      <img src="assets/images/logo-light-icon.png" alt="homepage" class="light-logo" /> </b> 
      <!--End Logo icon --> 
      <!-- Logo text --> 
      <span> 
      <!-- dark Logo text --> 
      <img src="assets/images/logo-light-text.png" alt="homepage" class="dark-logo" /> 
      <!-- Light Logo text --> 
      <img src="assets/images/logo-light-text.png" class="light-logo" alt="homepage" /></span> </a> </div>
    <!-- ============================================================== --> 
    <!-- End Logo --> 
    <!-- ============================================================== -->
    <div class="navbar-collapse"> 
      <!-- ============================================================== --> 
      <!-- toggle and nav items --> 
      <!-- ============================================================== -->
      <ul class="navbar-nav mr-auto">
        <!-- This is  -->
        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="sl-icon-menu"></i></a> </li>
        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="sl-icon-menu"></i></a> </li>
        <!-- ============================================================== -->
        
        <li style="margin-left:20px;">
          <div class="time-date"><i class="fa fa-calendar-o"></i> &nbsp;
            <?=date("l jS \of F Y");?>
            <img src="assets/images/sep.png" alt=""> <i class="fa fa-clock-o"></i> &nbsp; <span id="tick2"></span></div>
        </li>
      </ul>
      <!-- ============================================================== --> 
      <!-- User profile and search --> 
      <!-- ============================================================== -->
      <ul class="navbar-nav my-lg-0">
        <!-- ============================================================== --> 
        <!-- Comment --> 
        <!-- ============================================================== --> 
        
        <!-- ============================================================== --> 
        <!-- Profile --> 
        <!-- ============================================================== -->
        <li class="nav-item dropdown u-pro"> <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/1.jpg" alt="user" class="" /> <span class="hidden-md-down">Hi,<?=ucwords($_SESSION['admin_name'])?> &nbsp;<i class="fa fa-angle-down"></i></span> </a>
          <div class="dropdown-menu dropdown-menu-right animated fadeIn">
            <ul class="dropdown-user">
              <li>
                <div class="dw-user-box">
                  <div class="u-img"><img src="assets/images/users/1.jpg" alt="user"></div>
                  <div class="u-text">
                    <h4><?=ucwords($_SESSION['admin_name'])?></h4>
                    <p class="text-muted"><?=$_SESSION['admin_email']?></p>
                    <a href="#" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                </div>
              </li>
              <li role="separator" class="divider"></li>
              <li><a href="#"><i class="ti-user"></i> Change Password</a></li>
              
              
              <li role="separator" class="divider"></li>
              
              <li><a href="loginController.php?mode=logout"><i class="fa fa-power-off"></i> Logout</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    </li>
    <!-- ============================================================== --> 
    <!-- End mega menu --> 
    <!-- ============================================================== --> 
    
    <!-- ============================================================== --> 
    <!-- End Comment --> 
    <!-- ============================================================== -->
    </ul>
    </div>
  </nav>
</header>