<?php
ob_start();
session_start();
require_once("../config.php"); // include confog file
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
include_once(MYSQL_CLASS_DIR."DBConnection.php"); // to stablish database connection
include(PHP_FUNCTION_DIR."function.database.php"); // to use user define function like execute query
//include(PHP_FUNCTION_DIR."module_functions.php"); // to use user define function like execute query
//include(PHP_FUNCTION_DIR."server_side_validation.php"); // to use user define function like execute query
$dbObj = new DBConnection(); // to make connection onject
@date_default_timezone_set( date_default_timezone_get());
$mo = (isset($_REQUEST['mo']))?$_REQUEST['mo']:"home"; // to request default page 

?>
<!DOCTYPE html>
<html lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
<title><?=SITE_NAME?></title>
<link href="assets/vendors/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
<!-- This page CSS -->
<!-- chartist CSS -->
<link href="assets/vendors/morrisjs/morris.css" rel="stylesheet">
<!--c3 CSS -->
<link href="assets/vendors/c3-master/c3.min.css" rel="stylesheet">
<!-- flot css -->
<link href="css/pages/float-chart.css" rel="stylesheet">
<!--Toaster Popup message CSS -->
<link href="assets/vendors/toast-master/css/jquery.toast.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/master-stylesheet.css" rel="stylesheet">
<!-- You can change the theme colors from here -->
<!-- Editable CSS -->
<link type="text/css" rel="stylesheet" href="assets/vendors/jsgrid/dist/jsgrid.min.css" />
<link type="text/css" rel="stylesheet" href="assets/vendors/jsgrid/dist/jsgrid-theme.min.css" />

<link href="css/colors/default.css" id="theme" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" src="../editor/ckeditor/ckeditor.js"></script>

<?php 
	// include editor file
	include_once '../editor/ckeditor/ckeditor.php';
	//include_once EDITOR_DIR.'ckeditor/ckeditor.php';
	include_once '../editor/ckfinder/ckfinder.php';
	
?>
<script>
<!--

/*By JavaScript Kit
http://javascriptkit.com
Credit MUST stay intact for use
*/

function show2(){
if (!document.all&&!document.getElementById)
return
thelement=document.getElementById? document.getElementById("tick2"): document.all.tick2
var Digital=new Date()
var hours=Digital.getHours()
var minutes=Digital.getMinutes()
var seconds=Digital.getSeconds()
var dn="PM"
if (hours<12)
dn="AM"
if (hours>12)
hours=hours-12
if (hours==0)
hours=12
if (minutes<=9)
minutes="0"+minutes
if (seconds<=9)
seconds="0"+seconds
var ctime=hours+":"+minutes+":"+seconds+" "+dn
thelement.innerHTML=ctime
setTimeout("show2()",1000)
}
window.onload=show2
//-->
</script>
</head>
<body class="fix-header fix-sidebar card-no-border"> 
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
<?php include(ADMIN_INCLUDE_DIR.'header.php'); ?>
<!-- ============================================================== --> 
<!-- End Topbar header --> 
<!-- ============================================================== -->
  
  <!-- ============================================================== --> 
  <!-- Left Sidebar - style you can find in sidebar.scss  --> 
  <!-- ============================================================== -->
  <?php include(ADMIN_INCLUDE_DIR.'menu.php')?>
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
    <?php include(ADMIN_MODULE_DIR.$mo.'.php') ?>
    <!-- ============================================================== --> 
    <!-- End Container fluid  --> 
    <!-- ============================================================== --> 
    <!-- ============================================================== --> 
    <!-- footer --> 
    <!-- ============================================================== -->
    <footer class="footer">
      <div class="row">
        <div class="col-md-6 col-sm-6 font-12">Copyrights <?=date('Y')?>. Minion Admin. All Rights Reserved</div>
        <div class="col-md-6 col-sm-6 text-right font-12">Designed & Developed by <a href="#" target="_blank" class="text-themecolor"></a></div>
      </div>
    </footer>
    <!-- ============================================================== --> 
    <!-- End footer --> 
    <!-- ============================================================== --> 
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
<!-- Bootstrap popper Core JavaScript --> 
<script src="assets/vendors/bootstrap/js/popper.min.js"></script> 
<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script> 
<!-- slimscrollbar scrollbar JavaScript --> 
<script src="assets/vendors/ps/perfect-scrollbar.jquery.min.js"></script> 
<!--Wave Effects --> 
<script src="js/waves.js"></script> 
<!--Menu sidebar --> 
<script src="js/sidebarmenu.js"></script> 
<!-- Am Charts Resources --> 
<script src="assets/vendors/amcharts/core.js"></script> 
<script src="assets/vendors/amcharts/charts.js"></script> 
<script src="assets/vendors/amcharts/maps.js"></script>
<script src="assets/vendors/amcharts/lib/4/geodata/worldLow.js"></script> 
<script src="js/shipments-map.js"></script> 

<!--sparkline--> 
<script src="assets/vendors/sparkline/jquery.sparkline.min.js"></script> 
<script src="assets/vendors/sparkline/jquery.charts-sparkline.js"></script> 

<!-- capitals-map --> 
<script src="assets/vendors/amcharts/lib/4/themes/animated.js"></script> 

<!--Morris JavaScript --> 
<!--Morris JavaScript --> 
<script src="assets/vendors/raphael/raphael-min.js"></script> 

<script src="assets/vendors/morrisjs/morris.js"></script> 


<script src="js/daliy-progess.js"></script> 
<!--Custom JavaScript --> 
<script src="js/home-page2.js"></script>
<!--Custom JavaScript --> 
<script src="js/custom.min.js"></script> 

<!-- ============================================================== --> 
<!-- This is data table --> 
<script src="assets/vendors/datatables/jquery.dataTables.min.js"></script> 
<!-- start - This is for export functionality only --> 

<script src="assets/vendors/datatables-2/buttons/dataTables.buttons.min.js"></script> 
<script src="assets/vendors/datatables-2/buttons/buttons.flash.min.js"></script> 
<script src="assets/vendors/datatables-2/pdfmake/jszip.min.js"></script> 
<script src="assets/vendors/datatables-2/pdfmake/pdfmake.min.js"></script> 
<script src="assets/vendors/datatables-2/pdfmake/vfs_fonts.js"></script> 
<script src="assets/vendors/datatables-2/buttons/buttons.html5.min.js"></script> 
<script src="assets/vendors/datatables-2/buttons/buttons.print.min.js"></script> 

<!-- end - This is for export functionality only --> 
<script src="js/data-table.js"></script> 
</body>


</html>