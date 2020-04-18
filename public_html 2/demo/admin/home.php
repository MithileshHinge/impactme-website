<?php include('configure.php');
include('include/access.php');
$page_title = "Dashboard - ".PROJECT_TITLE ;
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$page_title?> </title>
<?php include('titlebar.php');?>

</head>

<body>
<?php
include('include/header.php');
?>
<div id="cl-wrapper" class="fixed-menu">
<?php
include('include/menubar.php');
?>
<div id="pcont" class="container-fluid">
<h1 style="margin:4% 0 0 4%;">Welcome To <?=PROJECT_TITLE?> Admin Zone</h1><br />

<div class="cl-mcont">
              <!--  <div class="stats_bar">
                  <div data-step="2" data-intro="&lt;strong&gt;Beautiful Elements&lt;/strong&gt; &lt;br/&gt; If you are looking for a different UI, this is for you!." class="butpro butstyle">
                     <div class="sub">
                        <h2>CLIENTS</h2>
                        <span id="total_clientes">170</span>
                     </div>
                     <div class="stat">
                        <span class="spk1">
                           <canvas style="display: inline-block; width: 74px; height: 16px; vertical-align: top;" width="74" height="16"></canvas>
                        </span>
                     </div>
                  </div>
                  <div class="butpro butstyle">
                     <div class="sub">
                        <h2>Sales</h2>
                        <span>$951,611</span>
                     </div>
                     <div class="stat"><span class="up"> 13,5%</span></div>
                  </div>
                  <div class="butpro butstyle">
                     <div class="sub">
                        <h2>VISITS</h2>
                        <span>125</span>
                     </div>
                     <div class="stat"><span class="down"> 20,7%</span></div>
                  </div>
                  <div class="butpro butstyle">
                     <div class="sub">
                        <h2>NEW USERS</h2>
                        <span>18</span>
                     </div>
                     <div class="stat"><span class="equal"> 0%</span></div>
                  </div>
                  <div class="butpro butstyle">
                     <div class="sub">
                        <h2>AVERAGE</h2>
                        <span>3%</span>
                     </div>
                     <div class="stat"><span class="spk2"></span></div>
                  </div>
                  <div class="butpro butstyle">
                     <div class="sub">
                        <h2>Downloads</h2>
                        <span>184</span>
                     </div>
                     <div class="stat"><span class="spk3"></span></div>
                  </div>
               </div>-->
        
               <div class="row dash-cols">
                  <div class="col-sm-6 col-md-6">
                     <div class="widget-block white-box calendar-box">
                        <div class="col-md-6 blue-box calendar no-padding">
                           <div class="padding ui-datepicker"></div>
                        </div>
                        <div class="col-md-6">
                           <div class="padding">
                              <h2 class="text-center"><?=date('M')?></h2>
                              <h1 class="day"><?=date('d')?></h1>
                           </div>
                        </div>
                     </div>
                     <div class="widget-block photo white-box weather-box" style="display:none">
                        <div class="col-md-6 padding photo">
                           <h2 class="text-center"><?=date('M')?></h2>
                           <h1 class="day"><?=date('d-m-Y')?></h1>
                        </div>
                        <div class="col-md-6 red-box">
                           <div class="padding text-center">
                              <canvas id="sun-icon" width="130" height="215"></canvas>
                           </div>
                        </div>
                     </div>
                  </div>
                  
               </div>
               
                      </div>
</div>

</div>

<?php
include('footer_js.php');


?>
 <script src="<?=ADMINPATH?>/assets/lib/skycons/skycons.js" type="text/javascript"></script>
 <script type="text/javascript" src="<?=ADMINPATH?>/assets/lib/jquery.sparkline/jquery.sparkline.min.js"></script>
 <script src="<?=ADMINPATH?>/assets/lib/jquery.easypiechart/jquery.easypiechart.js" type="text/javascript"></script>
 <script type="text/javascript" src="<?=ADMINPATH?>/assets/lib/intro.js/intro.js"></script>
 <script type="text/javascript" src="<?=ADMINPATH?>/assets/lib/jquery.flot/jquery.flot.js"></script>
 <script type="text/javascript" src="<?=ADMINPATH?>/assets/lib/jquery.flot/jquery.flot.pie.js"></script>
 <script type="text/javascript" src="<?=ADMINPATH?>/assets/lib/jquery.flot/jquery.flot.resize.js"></script>
 <script type="text/javascript" src="<?=ADMINPATH?>/assets/lib/jquery-ui/jquery-ui.min.js"></script>
 <script type="text/javascript">$(document).ready(function(){
         //initialize the javascript
         App.init();
         App.dashboard();
         });
 </script>
</body>
</html>
