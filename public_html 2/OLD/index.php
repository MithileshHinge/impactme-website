<?php

ob_start();
session_start();
require_once("config.php"); // include confog file
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
include_once(MYSQL_CLASS_DIR."DBConnection.php"); // to stablish database connection
include(PHP_FUNCTION_DIR."function.database.php"); // to use user define function like execute query
$dbObj = new DBConnection(); // to make connection onject
?>
<!DOCTYPE html>
<html>

<head>
<title>Welcome to Impactme</title>
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
  <div class="col-md-12 platform">
    <div class="col-md-6" >
      <h1 class="indepedent">Indepedent<br>
        Membership Platfrom <br>
        For Content Creater </h1>
      <p class="way">Easiest way to turn your passion into income. <br>
        start a membership bussiness and develop a deep and direct relationship with your biggest fans </p>
      <hr style="border: 1px solid #e2e0e0;width: 50%;">
      <a href="#" class="slider-page">Create my Page</a> </div>
    <div class="col-md-6  landing-image"></div>
  </div>
  <div class=" col-md-12 object" style="background-color: white;">
    <h2>Why IMPACT ME</h2>
    <h4>Build community around your work. Let your fans feel the pride of supporting your work<br>
      directly.Give them a peek behind the scenes, or other reward that they would love</h4>
    <div class="col-md-1"></div>
    <div class="col-md-3 fair">
      <div class="col-md-6" > <img src="images/flexible.png"> </div>
      <div class="col-md-12">
        <h3>Indepedent and Flexibility</h3>
      </div>
      <div class="col-md-12">
        <p>Become financially secure by generating a predictable revenue. Gain freedom having to reply on sponsorships </p>
      </div>
    </div>
    <div class="col-md-3 fair">
      <div class="col-md-6" > <img src="images/fair.png"> </div>
      <div class="col-md-12">
        <h3>Transparent and <br>
          Fair</h3>
      </div>
      <div class="col-md-12">
        <p>ImpactME Charge a transparent and absoutly minimal fee of 5% on every transcation.Fair and Square. </p>
      </div>
    </div>
    <div class="col-md-3 fair">
      <div class="col-md-6" > <img src="images/safe.png"> </div>
      <div class="col-md-12">
        <h3>Safe and <br>
          Secure</h3>
      </div>
      <div class="col-md-12">
        <p>With leading payment gateway partner like BillDesk, Paytm and Lotuspay, you can rest assured about security. </p>
      </div>
    </div>
    <div class="col-md-1"></div>
    <div class="clr"></div>
  </div>
  <div class="col-md-12 phone">
    <div style="padding: 0px;" class="container">
      <h2>Who uses ImpactMe</h2>
      <div class="col-md-6  podcasters" >
        <ul >
          <li><a href="#" id="pod" onmouseover="mouseOverPodcasters()">Podcasters</a></li>
          <li><a href="#" id="vid" onmouseover="mouseOverVideoCreators()">Video Creators</a></li>
          <li><a href="#" id="mus" onmouseover="mouseOverMusicians()">Musicians</a></li>
          <li><a href="#" id="vis" onmouseover="mouseOverVisualArtists()">Visual Artists</a></li>
          <li><a href="#" id="com" onmouseover="mouseOverCommunities()">Communities</a></li>
          <li><a href="#" id="wri" onmouseover="mouseOverWriters()">Writers & Journalists</a></li>
          <li><a href="#" id="cre" onmouseover="mouseOverCreators()">Creators-of-all-kinds</a></li>
        </ul>
      </div>
      <div class="col-md-6" > <img id="pic" src="images/post3.png"  alt=""> </div>
    </div >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
    <script type="text/javascript">
            var timeoutID = setTimeout(function() {
                  $('#pod').trigger('onmouseover');
                }, 400);
            function mouseOverPodcasters(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#pod').trigger('onmouseover');
                }, 400);
                document.getElementById("pic").src='images/post2.png'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }
            function mouseOverVideoCreators(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#vid').trigger('onmouseover');
                }, 400);
                document.getElementById("pic").src='images/post3.png'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }

            function mouseOverMusicians(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#mus').trigger('onmouseover');
                }, 400);
                document.getElementById("pic").src='images/post4.png'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }
            function mouseOverVisualArtists(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#vis').trigger('onmouseover');
                }, 400);
                document.getElementById("pic").src='images/post5.png'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }
            function mouseOverCommunities(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#com').trigger('onmouseover');
                }, 400);
                document.getElementById("pic").src='images/post6.png'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }
            function mouseOverWriters(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#wri').trigger('onmouseover');
                }, 400);
                document.getElementById("pic").src='images/post7.png'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }
            function mouseOverCreators(){
                clearTimeout(timeoutID);
                timeoutID = setTimeout(function() {
                  $('#cre').trigger('onmouseover');
                }, 400);
                document.getElementById("pic").src='images/post8.png'; document.images['pic'].style.width='100%'; document.images['pic'].style.height='auto';
            }
        </script> 
  </div>
  <div class="col-md-12 object" style="background-color: white;">
    <h2>How?</h2>
    <!-- <div class="col-md-1"></div> -->
    <div class="col-md-4 step">
      <div class="col-md-6" > <img src="images/flexible.png" style="width: 70%"> </div>
      <div class="col-md-12">
        <h3>Step 1</h3>
      </div>
      <div class="col-md-12">
        <p>Stepup your page, membership tiers and launch your page. </p>
      </div>
    </div>
    <div class="col-md-4 step">
      <div class="col-md-6" > <img src="images/fair.png" style="width: 70%"> </div>
      <div class="col-md-12">
        <h3>Step 2</h3>
      </div>
      <div class="col-md-12">
        <p>Tell your fansabout your page on this platfrom. </p>
      </div>
    </div>
    <div class="col-md-4 step">
      <div class="col-md-6" > <img src="images/safe.png" style="width: 70%"> </div>
      <div class="col-md-12">
        <h3>Step 3</h3>
      </div>
      <div class="col-md-12">
        <p>Develop and grow along with your fanbase. </p>
      </div>
    </div>
    <!-- <div class="col-md-1"></div> -->
    <div class="clr"></div>
  </div>
  <div class="col-md-12 boss" style="border-bottom: 1px solid #c3c1c18f;">
    <h2>Low , Simple and Transparent Fees Structure</h2>
    <div class="col-md-1"></div>
    <div class="col-md-10 upload"> <img src="images/impactme-amountchart.png" class="fact"> </div>
  </div>
  <div class="col-md-12 terms">
    <div class="col-md-1"></div>
    <div class="col-md-10 upload"> 
      <!--  <img src="images/piechart.png" class="fact"> -->
      
      <h2>Are you ready to <br>
        create on your own terms?</h2>
      <a href="#" class="mty create">Create My Page</a> </div>
  </div>
  <footer class="col-md-12 landing-footer">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <p class="copy-right">Contact us: care@impactme.in</p>
      <hr style="color: black;">
      <p class="address">205,Vedant Diamond Apt, New Sneh Nagar Nagpur<br>
        <span class="copy-right">&copy; 2018 Industrio.</span></p>
    </div>
    <div class="col-md-4"></div>
  </footer>
  <!--end: #footer --> 
</div>
</body>
</html>