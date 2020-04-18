<!DOCTYPE html>

<html lang="en">

<!-- Mirrored from creativethemes.co.in/demo/minion-admin/main/form-pickers.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Jun 2019 10:40:30 GMT -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
<title>Minion Admin - Bootstrap 4 Admin Template</title>

<!-- Bootstrap Core CSS -->
<link href="assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/vendors/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">

<!--editor-->
<link rel="stylesheet" href="assets/vendors/html5-editor/bootstrap-wysihtml5.css" />
<!--editor-->

<!-- Page plugins css -->
<link href="assets/vendors/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
<!-- Color picker plugins css -->
<link href="assets/vendors/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
<!-- Date picker plugins css -->
<link href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<!-- Daterange picker plugins css -->
<link href="assets/vendors/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
<link href="assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<link rel="stylesheet" href="assets/vendors/dropify/dist/css/dropify.min.css">

<!-- Custom CSS -->
<link href="css/master-stylesheet.css" rel="stylesheet">
<!-- You can change the theme colors from here -->
<link href="css/colors/default.css" id="theme" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head><body class="fix-header fix-sidebar card-no-border">
<!-- ============================================================== --> 
<!-- Preloader - style you can find in spinners.css --> 
<!-- ============================================================== --> 
<div class="preloader">
<div class="loader">
<div class="lds-roller">
<div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</div>
</div> 
<!-- ============================================================== --> 
<!-- Main wrapper - style you can find in pages.scss --> 
<!-- ============================================================== -->
<div id="main-wrapper"> 
  <!-- ============================================================== --> 
  <!-- Topbar header - style you can find in pages.scss --> 
  <!-- ============================================================== -->

  <header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light"> 
      <!-- ============================================================== --> 
      <!-- Logo --> 
      <!-- ============================================================== -->
      <div class="navbar-header"> <a class="navbar-brand" href="index.html"> 
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
          <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="icon-Mail"></i>
            <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
            </a>
            <div class="dropdown-menu mailbox dropdown-menu-right animated fadeIn" aria-labelledby="2">
              <ul>
                <li>
                  <div class="drop-title">You have 4 new messages</div>
                </li>
                <li>
                  <div class="message-center"> 
                    <!-- Message --> 
                    <a href="#">
                    <div class="user-img"> <img src="assets/images/users/1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                    <div class="mail-contnet">
                      <h5>Mason Hudson</h5>
                      <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                    </a> 
                    <!-- Message --> 
                    <a href="#">
                    <div class="user-img"> <img src="assets/images/users/2.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                    <div class="mail-contnet">
                      <h5>Pepper Hensen</h5>
                      <span class="mail-desc">Neque porro quisquam est!</span> <span class="time">9:10 AM</span> </div>
                    </a> 
                    <!-- Message --> 
                    <a href="#">
                    <div class="user-img"> <img src="assets/images/users/3.jpg" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                    <div class="mail-contnet">
                      <h5>Steve Carter</h5>
                      <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                    </a> 
                    <!-- Message --> 
                    <a href="#">
                    <div class="user-img"> <img src="assets/images/users/4.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                    <div class="mail-contnet">
                      <h5>Mason Hudson</h5>
                      <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                    </a> </div>
                </li>
                <li> <a class="nav-link text-center" href="javascript:void(0);"> <strong>See all e-Mails</strong> <i class="fa fa-angle-right"></i> </a> </li>
              </ul>
            </div>
          </li>
          <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="icon-Support"></i>
            <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
            </a>
            <div class="dropdown-menu mailbox dropdown-menu-right animated fadeIn" aria-labelledby="3">
              <ul>
                <li>
                  <div class="drop-title">Support</div>
                </li>
                <li>
                  <div class="message-center"> 
                    <!-- Message --> 
                    <a href="#">
                    <div class="user-img"> <img src="assets/images/users/1.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                    <div class="mail-contnet">
                      <h5>Mason Hudson</h5>
                      <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                    </a> 
                    <!-- Message --> 
                    <a href="#">
                    <div class="user-img"> <img src="assets/images/users/2.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                    <div class="mail-contnet">
                      <h5>Pepper Hensen</h5>
                      <span class="mail-desc">Neque porro quisquam est!</span> <span class="time">9:10 AM</span> </div>
                    </a> 
                    <!-- Message --> 
                    <a href="#">
                    <div class="user-img"> <img src="assets/images/users/3.jpg" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                    <div class="mail-contnet">
                      <h5>Steve Carter</h5>
                      <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                    </a> 
                    <!-- Message --> 
                    <a href="#">
                    <div class="user-img"> <img src="assets/images/users/4.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                    <div class="mail-contnet">
                      <h5>Mason Hudson</h5>
                      <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                    </a> </div>
                </li>
                <li> <a class="nav-link text-center" href="javascript:void(0);"> <strong>See all e-Mails</strong> <i class="fa fa-angle-right"></i> </a> </li>
              </ul>
            </div>
          </li>
          <li class="nav-item dropdown"> <a  href="#"  class="nav-link dropdown-toggle waves-effect waves-dark font-weight-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="icon-Information"></i> </a> </li>
          <li>
            <div class="time-date"><i class="fa fa-calendar-o"></i> &nbsp; Sat, 17  jan 2019 <img src="assets/images/sep.png" alt=""> <i class="fa fa-clock-o"></i> &nbsp;  10 : 33 : 22 AM</div>
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
          <li class="nav-item dropdown u-pro"> <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/1.jpg" alt="user" class="" /> <span class="hidden-md-down">Hi, Dave Wiesley &nbsp;<i class="fa fa-angle-down"></i></span> </a>
            <div class="dropdown-menu dropdown-menu-right animated fadeIn">
              <ul class="dropdown-user">
                <li>
                  <div class="dw-user-box">
                    <div class="u-img"><img src="assets/images/users/1.jpg" alt="user"></div>
                    <div class="u-text">
                      <h4>Steave Jobs</h4>
                      <p class="text-muted">michelle@gmail.com</p>
                      <a href="authentication-profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                  </div>
                </li>
                <li role="separator" class="divider"></li>
                <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
                <li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>
                <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#"><i class="fa fa-power-off"></i> Logout</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-gear font-15"></i> <span class="font-14 hidden-md-down">Setting </span>
            <div class="notify"> </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right mailbox animated fadeIn">
              <ul>
                <li>
                  <div class="drop-title">Notifications</div>
                </li>
                <li>
                  <div class="message-center"> 
                    <!-- Message --> 
                    <a href="#">
                    <div class="btn btn-danger btn-circle"><i class="fa fa-link"></i></div>
                    <div class="mail-contnet">
                      <h5>Launch Admin</h5>
                      <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span> </div>
                    </a> 
                    <!-- Message --> 
                    <a href="#">
                    <div class="btn btn-success btn-circle"><i class="ti-calendar"></i></div>
                    <div class="mail-contnet">
                      <h5>Event today</h5>
                      <span class="mail-desc">Just a reminder that you have event</span> <span class="time">9:10 AM</span> </div>
                    </a> 
                    <!-- Message --> 
                    <a href="#">
                    <div class="btn btn-info btn-circle"><i class="ti-settings"></i></div>
                    <div class="mail-contnet">
                      <h5>Settings</h5>
                      <span class="mail-desc">You can customize this template as you want</span> <span class="time">9:08 AM</span> </div>
                    </a> 
                    <!-- Message --> 
                    <a href="#">
                    <div class="btn btn-primary btn-circle"><i class="ti-user"></i></div>
                    <div class="mail-contnet">
                      <h5>Mason Hudson</h5>
                      <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                    </a> </div>
                </li>
                <li> <a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a> </li>
              </ul>
            </div>
          </li>

          <!-- ============================================================== --> 
          <!-- mega menu --> 
          <!-- ============================================================== -->
          <li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-menu"></i></a>
            <div class="dropdown-menu animated fadeIn">
              <ul class="mega-dropdown-menu drop-mega-menu mega-dropdown2">
                <li> <a class="dropdown-item" href="http://creativethemes.co.in/demo/minion-admin/horizontal/index.html"><i class="mdi mdi-chevron-right mr-10"></i> Dashboard Analytical</a></li> <a class="dropdown-item" href="index.html"><i class="mdi mdi-chevron-right mr-10"></i>Dashboard Monitoring</a> <a class="dropdown-item" href="http://creativethemes.co.in/demo/minion-admin/dark/index.html"><i class="mdi mdi-chevron-right mr-10"></i> Dashboard Projects</a> <a class="dropdown-item"  href="http://creativethemes.co.in/demo/minion-admin/rtl/index.html"><i class="mdi mdi-chevron-right mr-10"></i> Dashboard RTL</a> <a class="dropdown-item" href="ecommerce-dashboard.html"><i class="mdi mdi-chevron-right mr-10"></i> Ecommerce Dashboard</a> <a class="dropdown-item" href="ecommerce-products-catalogue.html"><i class="mdi mdi-chevron-right mr-10"></i> Product Catalog </a> </li>
                <li> <a class="dropdown-item" href="am-charts.html"><i class="mdi mdi-chevron-right mr-10"></i> AM Charts</a> <a class="dropdown-item" href="e-charts.html"><i class="mdi mdi-chevron-right mr-10"></i> E-Charts</a> <a class="dropdown-item" href="charts-flot.html"><i class="mdi mdi-chevron-right mr-10"></i> Flot Charts</a> <a class="dropdown-item" href="charts-sparkline.html"><i class="mdi mdi-chevron-right mr-10"></i> Sparkline Charts</a> <a class="dropdown-item" href="charts-knob.html"><i class="mdi mdi-chevron-right mr-10"></i> Knob Charts</a> <a class="dropdown-item" href="map-google.html"><i class="mdi mdi-chevron-right mr-10"></i> Google Maps</a> </li>
                <li> <a class="dropdown-item" href="form-layout.html"><i class="mdi mdi-chevron-right mr-10"></i> Form Layouts</a> <a class="dropdown-item" href="form-pickers.html"><i class="mdi mdi-chevron-right mr-10"></i> Form Pickers & Editors</a> <a class="dropdown-item" href="form-select.html"><i class="mdi mdi-chevron-right mr-10"></i> Select Forms</a> <a class="dropdown-item" href="checkbox-and-radios.html"><i class="mdi mdi-chevron-right mr-10"></i> Checkbox & Radios</a> <a class="dropdown-item" href="authentication-profile.html"><i class="mdi mdi-chevron-right mr-10"></i>Profile</a> <a class="dropdown-item" href="authentication-account-settings.html"><i class="mdi mdi-chevron-right mr-10"></i>Account Settings</a> </li>
                <li> <a class="dropdown-item" href="basic-table.html"><i class="mdi mdi-chevron-right mr-10"></i> Basic Table</a> <a class="dropdown-item" href="data-table.html"><i class="mdi mdi-chevron-right mr-10"></i> Data Table</a> <a class="dropdown-item" href="js-grid-table.html"><i class="mdi mdi-chevron-right mr-10"></i> JS Grid Table</a> <a class="dropdown-item" href="editable-table.html"><i class="mdi mdi-chevron-right mr-10"></i> Editable Table</a> <a class="dropdown-item" href="error-403.html"><i class="mdi mdi-chevron-right mr-10"></i> Error 403</a> <a class="dropdown-item" href="error-404.html"><i class="mdi mdi-chevron-right mr-10"></i> Error 404</a> </li>
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
 
 <!-- ============================================================== --> 
  <!-- End Topbar header --> 
  <!-- ============================================================== --> 
  <!-- ============================================================== --> 
  <!-- Left Sidebar - style you can find in sidebar.scss  --> 
  <!-- ============================================================== -->
  <aside class="left-sidebar"> 
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar"> 
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav">
        <ul id="sidebarnav">
          <li class="nav-small-cap">Basic UI</li>
          <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-apps mr-10"></i><span class="hide-menu">Dashboard Layouts</span></a>
                <ul aria-expanded="false" class="collapse">
			 <li> <a class="has-arrow" href="#" aria-expanded="false">Dashboard Styles</a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="http://creativethemes.co.in/demo/minion-admin/horizontal/index.html">Dashboard Boxed</a></li>
<li><a href="http://creativethemes.co.in/demo/minion-admin/dark/index.html">Dashboard Dark</a></li>
<li><a href="index.html">Dashboard Sidebar</a></li>
<li><a href="http://creativethemes.co.in/demo/minion-admin/rtl/index.html">Dashboard RTL</a></li>
                                    </ul>
                                </li>
              <li><a href="http://creativethemes.co.in/demo/minion-admin/horizontal/index.html">Dashboard Analytical</a></li>
              <li><a href="index.html">Dashboard Monitoring</a></li>
              <li><a href="http://creativethemes.co.in/demo/minion-admin/dark/index.html">Dashboard Projects</a></li>
			  <li><a href="http://creativethemes.co.in/demo/minion-admin/horizontal/index-helpdesk.html">Dashboard Helpdesk</a></li>
            </ul>
          </li>
          <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-settings-variant mr-10"></i><span class="hide-menu">Apps</span></a>
            <ul aria-expanded="false" class="collapse">
              <li><a href="chats-app.html">Chat App</a></li>
<li><a href="calender-app.html">Calender App</a></li>
              <li><a href="support-tickets.html">Support Tickets</a></li>
            </ul>
          </li>
          <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="ti-bar-chart mr-10"></i><span class="hide-menu">Charts</span></a>
            <ul aria-expanded="false" class="collapse">
              <li><a href="am-charts.html">AM Charts</a></li>
              <li><a href="e-charts.html">E-Charts</a></li>
              <li><a href="charts-flot.html">Flot Charts</a></li>
              <li><a href="charts-sparkline.html">Sparkline Charts</a></li>
<li><a href="charts-chartjs.html">Charts JS</a></li>
              <li><a href="charts-knob.html">Knob Charts</a></li>
            </ul>
          </li>
          <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="ti-map-alt mr-10"></i><span class="hide-menu">Maps</span></a>
            <ul aria-expanded="false" class="collapse">
              <li><a href="map-google.html">Google Maps</a></li>
              <li><a href="map-vector.html">Vector Maps</a></li>
            </ul>
          </li>
          <li class="nav-small-cap">Admin UI</li>
          <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="icon-Duplicate-Window mr-10"></i> <span class="hide-menu">Forms</span></a>
            <ul aria-expanded="false" class="collapse">
              <li><a href="form-layout.html">Form Layouts</a></li>
              <li><a href="form-pickers.html">Form Pickers & Editors</a></li>
              <li><a href="form-select.html">Select Forms</a></li>
<li><a href="form-wizard.html">Form Wizard</a></li>
              <li><a href="checkbox-and-radios.html">Checkbox & Radios</a></li>
            </ul>
          </li>
          <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-table-large mr-10"></i><span class="hide-menu">Tables</span></a>
            <ul aria-expanded="false" class="collapse">
              <li><a href="basic-table.html">Basic Table</a></li>
              <li><a href="data-table.html">Data Table</a></li>
              <li><a href="js-grid-table.html">JS Grid Table</a></li>
              <li><a href="editable-table.html">Editable Table</a></li>
            </ul>
          </li>
          <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-cellphone-android mr-10"></i> <span class="hide-menu">Widgets</span></a>
            <ul aria-expanded="false" class="collapse">
              <li><a href="dragula.html">Dragula</a></li>
              <li><a href="context-menu.html">Context Menu</a></li>
              <li><a href="sliders.html">Sliders</a></li>
              <li><a href="carousel.html">Carousel</a></li>
              <li><a href="clipboard.html">Clipboard</a></li>
              <li><a href="cards.html">Cards</a></li>
              <li><a href="loaders.html">Loaders</a></li>
            </ul>
          </li>
          <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-cart-outline mr-10"></i><span class="hide-menu">Ecommerce</span></a>
            <ul aria-expanded="false" class="collapse">
<li><a href="ecommerce-dashboard.html">Dashboard</a></li>
<li><a href="ecommerce-orders.html">Order Status</a></li>
<li><a href="ecommerce-products-catalogue.html">Products Catalogue</a></li>
<li><a href="ecommerce-product-list.html">Product List</a></li>
<li><a href="ecommerce-products-details.html">Product Details</a></li>
<li><a href="ecommerce-add-edit-products.html">Add/Edit Products</a></li>
<li><a href="ecommerce-view-customers.html">View Customers</a></li>
<li><a href="ecommerce-invoice.html">Invoice</a></li>
<li><a href="ecommerce-shipments.html">Shipments</a></li>
<li><a href="ecommerce-reviews.html">Reviews</a></li>
            </ul>
          </li>
          <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"> <i class="mdi mdi-chart-gantt mr-10"></i><span class="hide-menu">Bootstrap Elements</span></a>
            <ul aria-expanded="false" class="collapse">
              <li><a href="badges-and-buttons.html">Badges & Buttons</a></li>
              <li><a href="pagination-and-popovers.html">Pagination & Popovers</a></li>
              <li><a href="typography-and-grids.html">Typography & Grids</a></li>
              <li><a href="progress-bars.html">Progress Bars</a></li>
            </ul>
          </li>
          <li class="nav-small-cap">Miscellaneous</li>   <li> <a class="has-arrow waves-effect waves-dark" href="authentication-login.html" aria-expanded="false"> <i class="mdi mdi-login-variant"></i> <span class="hide-menu">Authentication</span></a>
            
            
            <ul aria-expanded="false" class="collapse">          
<li><a href="authentication-profile.html">Profile</a></li>
<li><a href="mailbox.html">Mailbox</a></li>	
<li><a href="authentication-account-settings.html">Account Settings</a></li>
<li><a href="authentication-login.html">Login</a></li>
<li><a href="authentication-register.html">Register</a>	</li>
<li><a href="password-recovery.html">Password Recovery</a></li>
<li><a href="lockscreen.html">Lockscreen</a></li>		
</ul>
            
        </li>

<li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-clock-fast"></i> <span class="hide-menu">Faq & Error</span></a>
<ul aria-expanded="false" class="collapse">
<li><a href="faq.html">Faq</a></li>
<li><a href="error-403.html">Error 403</a></li>
<li><a href="error-404.html">Error 404</a></li>
<li><a href="error-501.html">Error 501</a></li>
<li><a href="error-505.html">Error 505</a></li>
</ul>
</li>


        </ul>
      </nav>
      <!-- End Sidebar navigation --> 
    </div>
    <!-- End Sidebar scroll--> 
  </aside>
  <!-- ============================================================== --> 
  <!-- End Left Sidebar - style you can find in sidebar.scss  --> 
  <!-- ============================================================== --> 
  <!-- ============================================================== --> 
  <!-- Page wrapper  --> 
  <!-- ============================================================== -->
  <div class="page-wrapper"> 
    <!-- ============================================================== --> 
    <!-- Container fluid  --> 
    <!-- ============================================================== -->
    <div class="container-fluid"> 
      <!-- ============================================================== --> 
      <!-- Bread crumb and right sidebar toggle --> 
      <!-- ============================================================== -->
      <div class="row page-titles">
        <div class="col-6 align-self-center">
          <h3>Form Pickers & Editors</h3>
        </div>
        <div class="col-6 text-right font-12"> <a href="index.html">Admin</a>  &gt; Form Pickers</div>
        <div class="">
          <button class="right-side-toggle waves-effect waves-light bg-primary btn btn-circle btn-sm pull-right ml-10"><i class="ti-settings text-white"></i></button>
        </div>
      </div>
      
      <!-- ============================================================== --> 
      <!-- Start Page Content --> 
      <!-- ============================================================== -->
      <div class="row">
        <div class="col-lg-4 col-md-12"> 
          <!-- Card -->
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-uppercase">Date picker</h4>
              <h6 class="card-subtitle">Use <code>.bootstrapMaterialDatePicker</code> to create it.</h6>
              <div class="row">
                <div class="col-md-12">
                  <label class="mt-10 font-12">Default Material Date Picker</label>
                  <input type="text" class="form-control" placeholder="2017-06-04" id="mdate">
                </div>
                <div class="col-md-12">
                  <label class="mt-10 font-12">Min Date set</label>
                  <input type="text" class="form-control" placeholder="set min date" id="min-date">
                </div>
              </div>
            </div>
          </div>
          <!-- Card --> 
          
        </div>
        <div class="col-lg-4 col-md-12"> 
          <!-- Card -->
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-uppercase">Clock Picker</h4>
              <h6 class="card-subtitle">Use <code>.clockpicker</code> to create it.</h6>
              <div class="row">
                <div class="col-md-12">
                  <label class="mt-10 font-12">Default Clock Picker</label>
                  <div class="input-group clockpicker">
                    <input type="text" class="form-control" value="09:30">
                    <div class="input-group-append"> <span class="input-group-text"><i class="fa fa-clock-o"></i></span> </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <label class="mt-10 font-12">Now time</label>
                  <div class="input-group">
                    <input class="form-control" id="single-input" value="" placeholder="Now">
                    <div class="input-group-append">
                      <button type="button" id="check-minutes" class="btn waves-effect waves-light btn-success font-14">Check the minutes</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Card --> 
          
        </div>
        <div class="col-lg-4 col-md-12"> 
          <!-- Card -->
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-uppercase">Date Range picker</h4>
              <h6 class="card-subtitle">Use <code>.daterange-datepicker</code> to create it.</h6>
              <div class="row">
                <div class="col-md-12">
                  <div class="example">
                    <label class="mb-10 font-12">Date Range Pick</label>
                    <input class="form-control input-daterange-datepicker" type="text" name="daterange" value="01/01/2015 - 01/31/2015" />
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="example">
                    <label class="mb-10 mt-20 font-12">Limit Selectable Dates</label>
                    <input class="form-control input-limit-datepicker" type="text" name="daterange" value="06/01/2015 - 06/07/2015" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Card --> 
          
        </div>
        <div class="col-lg-8">
          <div class="row">
            <div class="col-lg-6">
              <div class="card min-height-div">
                <div class="card-body">
                  <h4 class="card-title text-uppercase">Simple mode</h4>
                  <p class="text-muted mb-20">just add class <code>.colorpicker</code></p>
                  <input type="text" class="colorpicker form-control" value="#7ab2fa" />
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card min-height-div">
                <div class="card-body">
                  <h4 class="card-title text-uppercase">Complex mode</h4>
                  <p class="text-muted mb-20">just add class <code>.complex-colorpicker</code></p>
                  <input type="text" class="complex-colorpicker form-control" value="#fa7a7a" />
                </div>
              </div>
            </div>
            <div class="col-md-12"> 
              <!-- Card -->
              <div class="card min-height-div">
                <div class="card-body">
                  <h4 class="card-title text-uppercase">Date Range picker</h4>
                  <p class="text-muted mb-20">just add id <code>#date-range</code> to create it.</p>
                  <div class="input-daterange input-group" id="date-range">
                    <input type="text" class="form-control" name="start" />
                    <div class="input-group-append"> <span class="input-group-text bg-info b-0 text-white">TO</span> </div>
                    <input type="text" class="form-control" name="end" />
                  </div>
                </div>
              </div>
              <!-- Card --> 
              
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-uppercase">Datepicker Inline</h4>
              <p class="text-muted mb-20 font-12">You also can set the datepicker to be inline and flat.</p>
              <div class="clear"></div>
              <div id="datepicker-inline"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-uppercase">File Upload (Dropify)</h4>
              <input type="file" id="input-file-now" class="dropify" />
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title text-uppercase">Bootstrap html5 editor</h4>
              <form method="post">
                <div class="form-group">
                  <textarea class="textarea_editor form-control" rows="15" placeholder="Enter text ..."></textarea>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      
      <!-- ============================================================== --> 
      <!-- End PAge Content --> 
      <!-- ============================================================== --> 
      
      <!-- ============================================================== --> 
      <!-- Right sidebar --> 
      <!-- ============================================================== --> 
      <!-- .right-sidebar -->
      <div class="right-sidebar">
        <div class="slimscrollright">
          <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
          <div class="r-panel-body">
            <ul id="themecolors" class="mt-20">
              <li><b>With Light sidebar</b></li>
              <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
              <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
              <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
              <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme">4</a></li>
              <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
              <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
              <li class="d-block mt-30"><b>With Dark sidebar</b></li>
              <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme working">7</a></li>
              <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
              <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
              <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
              <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
              <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- ============================================================== --> 
      <!-- End Right sidebar --> 
      <!-- ============================================================== --> 
    </div>
    <!-- ============================================================== --> 
    <!-- End Container fluid  --> 
    <!-- ============================================================== --> 
    <!-- ============================================================== --> 
    <!-- footer --> 
    <!-- ============================================================== -->
    <footer class="footer">
      <div class="row">
        <div class="col-md-6 col-sm-6 font-12">Copyrights 2019. Minion Admin. All Rights Reserved</div>
        <div class="col-md-6 col-sm-6 text-right font-12">Designed & Developed by <a href="#" target="_blank" class="text-themecolor"></a></div>
      </div>
    </footer>
    <!-- ============================================================== --> 
    <!-- End Page wrapper  --> 
    <!-- ============================================================== --> 
  </div>
  <!-- ============================================================== --> 
  <!-- End Wrapper --> 
  <!-- ============================================================== --> 
</div>
<!-- ============================================================== --> 
<!-- All Jquery --> 
<!-- ============================================================== --> 
<script src="assets/vendors/jquery/jquery.min.js"></script> 
<!-- Bootstrap tether Core JavaScript --> 
<script src="assets/vendors/bootstrap/js/popper.min.js"></script> 
<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script> 
<!-- slimscrollbar scrollbar JavaScript --> 
<script src="assets/vendors/ps/perfect-scrollbar.jquery.min.js"></script> 
<!--Wave Effects --> 
<script src="js/waves.js"></script> 
<!--Menu sidebar --> 
<script src="js/sidebarmenu.js"></script> 
<!--stickey kit --> 
<script src="assets/vendors/sticky-kit-master/dist/sticky-kit.min.js"></script> 
<script src="assets/vendors/sparkline/jquery.sparkline.min.js"></script> 
<!--Custom JavaScript --> 
<script src="js/custom.min.js"></script> 
<!-- ============================================================== --> 
<!-- Plugins for this page --> 
<!-- ============================================================== --> 
<!-- Plugin JavaScript --> 
<script src="assets/vendors/moment/moment.js"></script> 
<script src="assets/vendors/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script> 
<!-- Clock Plugin JavaScript --> 
<script src="assets/vendors/clockpicker/dist/jquery-clockpicker.min.js"></script> 
<!-- Color Picker Plugin JavaScript --> 
<script src="assets/vendors/jquery-asColorPicker-master/libs/jquery-asColor.js"></script> 
<script src="assets/vendors/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script> 
<script src="assets/vendors/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script> 
<!-- Date Picker Plugin JavaScript --> 
<script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script> 
<!-- Date range Plugin JavaScript --> 
<script src="assets/vendors/timepicker/bootstrap-timepicker.min.js"></script> 
<script src="assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script> 

<!-- jQuery file upload --> 
<script src="assets/vendors/dropify/dist/js/dropify.min.js"></script> 

<!-- wysuhtml5 Plugin JavaScript --> 
<script src="assets/vendors/html5-editor/wysihtml5-0.3.0.js"></script> 
<script src="assets/vendors/html5-editor/bootstrap-wysihtml5.js"></script> 
<!-- ============================================================== --> 
<!-- Style switcher --> 
<!-- ============================================================== --> 
<script src="assets/vendors/styleswitcher/jQuery.style.switcher.js"></script> 
<script src="js/form-pickers.js"></script>
</body>

<!-- Mirrored from creativethemes.co.in/demo/minion-admin/main/form-pickers.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Jun 2019 10:40:49 GMT -->
</html>