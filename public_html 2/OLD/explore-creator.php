<?php
ob_start();
session_start();
require_once("config.php"); // include confog file
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
include_once(MYSQL_CLASS_DIR."DBConnection.php"); // to stablish database connection
include(PHP_FUNCTION_DIR."function.database.php"); // to use user define function like execute query
$dbObj = new DBConnection(); // to make connection onject
if(!isset($_SESSION['is_user_login']) && !isset($_SESSION['user_id'])){
	$_SESSION['loginerror'] = 'Please Login...';
	header('Location:login.php');
	exit();
}

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."users WHERE id!='".sc_mysql_escape($_SESSION['user_id'])."'"; 
$dbUser = $dbObj->SelectQuery('edithome.php','aboutEdit()');
?>
<!DOCTYPE html>

<html>
<head>
<title>Welcome to Impactme</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/normalize.css"/>
<link rel="stylesheet" href="css/jquery.sidr.light.css"/>
<link rel="stylesheet" href="css/animate.min.css"/>
<link rel="stylesheet" href="css/md-slider.css"/>
<link rel="stylesheet" href="css/style.css"/>
<link rel="stylesheet" href="css/responsive.css"/>
<script type="text/javascript" src="js/raphael-min.js"></script>
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="js/jquery.touchwipe.min.js"></script>
<script type="text/javascript" src="js/md_slider.min.js"></script>
<script type="text/javascript" src="js/jquery.sidr.min.js"></script>

<!-- <script type="text/javascript" src="js/jquery.tweet.min.js"></script> -->

<script type="text/javascript" src="js/pie.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</head>

<body>
<div id="wrapper">
  <?php include('header.php');?>
  <!--end: #header --> 
  
</div>
<div class="col-md-12 user-photo" style="background-image:url(header-bg-1.png)" >
  <p class="gio" style="top:50%; left:25%; color:rgb(36, 30, 18)"> There are a million ways to use impactMe</p>
</div>
<div class="clr"></div>
<div class="clr"></div>
<section style="background-color: white;">
  <div class="container become-conter">
    <div class="col-md-12 ">
    <? for($i=0;$i<count($dbUser);$i++){?>
      <div class="col-md-4 "  >
        <div class="colcss">
          <div display="flex" class="sc-cSHVUG bmaBYi">
            <div display="block" src="https://c5.patreon.com/external/explore/doughboys.png" class="sc-bdVaJa loxRON"></div>
            <div class="sc-cSHVUG jojKnz"><span color="dark" class="sc-htpNat fucUEQ">Doughboys</span></div>
          </div>
          <p class="faccio-become">Questa donazione dimostra che tieni alle cose che faccio, quindi il tuo nome verrà pubblicato direttamente nei crediti a fine video!</p>
          <a href="#" class="select-become-tier" >See All Tiers</a></div>
      </div>
      <? }?>
    </div>
  </div>
</section>
</body>
</html>