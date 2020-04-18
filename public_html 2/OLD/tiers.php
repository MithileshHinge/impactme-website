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
$id = sc_mysql_escape($_REQUEST['id']);
//to get categories
$dbObj->dbQuery = "SELECT * FROM ".PREFIX."tier where id='".$id."'";
$dbCycle = $dbObj->SelectQuery('edithome.php','aboutEdit()');

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."users WHERE id='".sc_mysql_escape($_SESSION['user_id'])."'"; 
$dbUser = $dbObj->SelectQuery('edithome.php','aboutEdit()');

$dbObj->dbQuery = "SELECT * FROM ".PREFIX."tier WHERE userid='".sc_mysql_escape($_SESSION['user_id'])."'"; 
$dbTiers = $dbObj->SelectQuery('edithome.php','aboutEdit()');
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
<script type="text/javascript" src="editor/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="javascript/formValidation.js"></script>
<script type="text/javascript" src="javascript/wordcount.js"></script>
<?php 
	// include editor file
	include_once 'editor/ckeditor/ckeditor.php';
	//include_once EDITOR_DIR.'ckeditor/ckeditor.php';
	include_once 'editor/ckfinder/ckfinder.php';
	
?>
</head>
<body>
<div id="wrapper">
  <?php include('header.php');?>
  <!--end: #header --> 
</div>
<div class="layout-2cols">
  <div class="content grid_12">
    <div class="project-detail">
      <div class="project-tab-detail tabbable accordion edit-about">
        <ul class="tbs clearfix">
          <li ><a href="edit.php" class="be-fc-orange">About</a></li>
          <li class="activet"><a href="#" >Tiers</a></li>
          <li><a href="goals.php" class="be-fc-orange">Goals</a></li>
          <li><a href="thanks.php" class="be-fc-orange">Thanks</a></li>
          <li ><a href="payment.php" class="be-fc-orange">Payment</a></li>
          <li ><a href="post.php" class="be-fc-orange">Manage Your Post</a></li>
        </ul>
        <div class="tab-content">
          <div>
            <h3 class="rs alternate-tab accordion-label ">Tiers</h3>
            <div class="tab-pane accordion-content active">
              <div class="form form-profile">
               <p style="color:#F00"><?=base64_decode($_REQUEST['msg'])?></p>
                <form action="impactmeController.php" name="myForm" method="post" onSubmit="return ckhform()" enctype="multipart/form-data">
                <input type="hidden" name="mode" value="add_tier" />
                <input type="hidden" name="id" value="<?=$id?>" />
                
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_name1">Tier title:</label>
                    <div class="val">
                      <input class="txt" type="text" name="info[tiername]" id="tiername" value="<?=$dbCycle[0]['tiername']?>"  >
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_location">Tier price:</label>
                    <div class="val">
                      <input class="txt" type="text" name="info[tier_price]" id="tier_price" value="<?=$dbCycle[0]['tier_price']?>" >
                    </div>
                  </div>
                  
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_time_zone">Tier description:</label>
                    <div class="val">
                     <textarea name="info[tier_details]" id="summary"  onKeyDown="textCounter(document.myForm.summary,document.myForm.text_count,300)"
onKeyUp="textCounter(document.myForm.summary,document.myForm.text_count,300)" class="txt"><?=$dbCycle[0]['tier_details']?></textarea>
<input type="text" readonly id="text_count" value="300" style="width:30px; border:none; background-color:#fff; color:#F00 "><span style="color:#F00">Characters max</span>
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_time_zone">Impact limit:</label>
                    <div class="val">
                      <input class="txt" type="text" id="impactlimit"  value="<?=$dbCycle[0]['impactlimit']?>" >
                      <label style="font-size: 11px;    margin: -18px 0 41px 49px;">Limit number of impact.</label>
                      <br>
                    </div>
                  </div>
                  <p class="wrap-btn-submit rs ta-r">
                    
                    <button class="btn btn-red btn-submit-all">Submit Tiers</button>
                  </p>
                   
                </form>
              </div>
              <div class="col-md-12 " style="padding:0; background-color:#fff;">
              <? for($i=0;$i<count($dbTiers);$i++){?>
            <div class="col-md-4 become-telegram" style="width:32.75%; padding-bottom:10px;">
            <p class="faccio-become" style="text-align:center;"> <? if(!empty($dbTiers[$i]['image'])){ ?>
                  <img src="cms_images/user/original/<?=$dbTiers[$i]['image']?>" width="200px">
                  <? } ?></p>
              <h3 class="livello-1-become"><?=$dbTiers[$i]['tiername']?></h3>
              <h2 class="doller-become"><?=$dbTiers[$i]['tier_price']?> INR</h2>
              <p class="doller-permonth">PER MONTH</p>
              
              <p class="faccio-become"><?=stripslashes(nl2br($dbTiers[$i]['tier_details']))?></p>
             <div align="center"><a href="tiers.php?id=<?=$dbTiers[$i]['id']?>" class="btn btn-red btn-submit-all" >Edit</a><a href="javascript:void(0);" onClick="deleteRecoed(<?=$dbTiers[$i]['id']?>)" class="btn btn-red btn-submit-all" style="margin-left:10px;" >Delete</a></div>
              
              </div>
              <? }?>
               
               
              
          </div>
          <div class="col-md-12 " style="padding:0; background-color:#fff; height:100px;">&nbsp;
          </div>
            </div>
            <!--end: .tab-pane --> 
            
          </div>
          
        </div>
      </div>
      <!--end: .project-tab-detail --> 
    </div>
  </div>
  <!--end: .content -->
  
  <div class="clear"></div>
</div>
</div>
<footer id="footer" class="col-md-12">
  <div class="container_12 main-footer">
    <div class="grid_3 about-us">
      <h3 class="rs title">About</h3>
      <p class="rs description">Donec rutrum elit ac arcu bibendum rhoncus in vitae turpis. Quisque fermentum gravida eros non faucibus. Curabitur fermentum, arcu sed cursus commodo.</p>
      <p class="rs email"><a class="fc-default  be-fc-orange" href="http://envato.megadrupal.com/cdn-cgi/l/email-protection#b2dbdcd4ddf2dfd7d5d3d6c0c7c2d3de9cd1dddf"><span class="__cf_email__" data-cfemail="bbd2d5ddd4fbd6dedcdadfc9cecbdad795d8d4d6">[email&#160;protected]</span></a></p>
      <p class="rs">+1 (555) 555 - 55 - 55</p>
    </div>
    <!--end: .contact-info -->
    <div class="grid_3 recent-tweets">
      <h3 class="rs title">Recent Tweets</h3>
      <div class="lst-tweets" id="sys_lst_tweets"> </div>
    </div>
    <!--end: .recent-tweets -->
    <div class="clear clear-2col"></div>
    <div class="grid_3 email-newsletter">
      <h3 class="rs title">Newsletter Signup</h3>
      <div class="inner">
        <p class="rs description">Nam aliquet, velit quis consequat interdum, odio dolor elementum.</p>
        <form action="#">
          <div class="form form-email">
            <label class="lbl" for="txt-email">
              <input id="txt-email" type="text" class="txt fill-width" placeholder="Enter your e-mail address"/>
            </label>
            <button class="btn btn-green" type="submit">Submit</button>
          </div>
        </form>
      </div>
    </div>
    <!--end: .email-newsletter -->
    <div class="grid_3">
      <h3 class="rs title">Discover &amp; Create</h3>
      <div class="footer-menu">
        <ul class="rs">
          <li><a class="be-fc-orange" href="#">What is Kickstars</a></li>
          <li><a class="be-fc-orange" href="#">Start a project</a></li>
          <li><a class="be-fc-orange" href="#">Project Guidlines</a></li>
          <li><a class="be-fc-orange" href="#">Press</a></li>
          <li><a class="be-fc-orange" href="#">Stats</a></li>
        </ul>
        <ul class="rs">
          <li><a class="be-fc-orange" href="#">Staff Picks</a></li>
          <li><a class="be-fc-orange" href="#">Popular</a></li>
          <li><a class="be-fc-orange" href="#">Recent</a></li>
          <li><a class="be-fc-orange" href="#">Small Projects</a></li>
          <li><a class="be-fc-orange" href="#">Most Funded</a></li>
        </ul>
        <div class="clear"></div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
  <div class="copyright">
    <div class="container_12">
      <div class="grid_12"> <a class="logo-footer" href="index.php"><img src="images/logo-3.png" alt="$SITE_NAME"/></a> </div>
      <div class="clear"></div>
    </div>
  </div>
</footer>
<script type="text/javascript">
function ckhform(){
	if(isEmpty("Tier Name",document.getElementById("tiername").value)){
		document.getElementById("tiername").focus();
		return false;
	}
	if(isEmpty("Tier Price",document.getElementById("tier_price").value)){
		document.getElementById("tier_price").focus();
		return false;
	}
	if(!hasOnlyNumericAndDot("Tier Price",document.getElementById("tier_price").value)){
		document.getElementById("tier_price").focus();
		return false;
	}
	if(isEmpty("Tier Description",document.getElementById("summary").value)){
		document.getElementById("summary").focus();
		return false;
	}
	
	
	
	return true;
}

function deleteRecoed(recordId){
	
	var r = confirm("Do you really want to remove this record?");
	if (r == true) {
		window.location.href = "impactmeController.php?mode=delete_tirer&id="+recordId;
	} 
}

</script>
</body>
</html>
