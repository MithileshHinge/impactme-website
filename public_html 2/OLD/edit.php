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
$dbObj->dbQuery = "SELECT * FROM ".PREFIX."users WHERE id='".sc_mysql_escape($_SESSION['user_id'])."'"; 
$dbUser = $dbObj->SelectQuery('edithome.php','aboutEdit()');


$dbObj->dbQuery = "SELECT count(*) c, u.* FROM users u WHERE u.oauth_provider='facebook' and u.user_id='".sc_mysql_escape($_SESSION['user_id'])."'"; 
$dbFacebookSocialUser = $dbObj->SelectQuery('edithome.php','aboutEdit()');



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

<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '178844232447987',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
</script>
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
          <li class="activet"><a href="edit.php">About</a></li>
          <li><a href="tiers.php" class="be-fc-orange">Tiers</a></li>
          <li><a href="goals.php" class="be-fc-orange">Goals</a></li>
          <li><a href="thanks.php" class="be-fc-orange">Thanks</a></li>
          <li ><a href="payment.php" class="be-fc-orange">Payment</a></li>
          <li ><a href="post.php" class="be-fc-orange">Manage Your Post</a></li>
        </ul>
        <div class="tab-content">
          <div>
            <h3 class="rs alternate-tab accordion-label">About</h3>
            <div class="tab-pane accordion-content active">
              <div class="form form-profile">
                <form action="impactmeController.php" name="profile" method="post" onSubmit="return chkprofile()" enctype="multipart/form-data">
                <p style="color:#F00"><?=base64_decode($_REQUEST['msg'])?></p>
                <input type="hidden" name="mode" value="profile" />
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_name1">Name of Imapact page:</label>
                    <div class="val">
                      <input class="txt" type="text" id="impactname" value="<?=$dbUser[0]['impactname']?>" onBlur="setText(this.value)" name="info[impactname]" >
                      <p class="rs description-input">Your name is displayed on your profile.</p>
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_location">what are you creating:</label>
                    <div class="val">
                      <input class="txt" type="text" id="wcreator" value="<?=$dbUser[0]['wcreator']?>" onBlur="setWord(this.value)" name="info[wcreator]" >
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_time_zone">which sound are correct:</label>
                    <div class="val">
                    <?php
					$val1 = $dbUser[0]['impactname'].' is creating '.$dbUser[0]['wcreator'];
					$val2 = $dbUser[0]['impactname'].' are creating '.$dbUser[0]['wcreator'];
					?>
                      <input  type="radio" name="info[tagline]" <?=($dbUser[0]['wcreator']==$val1)?'checked':'checked'?>  id="tagline1" value="<?=$val1?>">
                      <label style="font-size: 16px;margin: 9px 0 0 20px;"><span id="txt1"><?=$dbUser[0]['impactname']?></span> is creating <span id="wrd1"><?=$dbUser[0]['wcreator']?></span></label>
                      <br>
                      <input  type="radio" name="info[tagline]" id="tagline2" <?=($dbUser[0]['wcreator']==$val2)?'checked':''?> value="<?=$val2?>" >
                      <label style="font-size: 16px;margin: 9px 0 0 20px;"><span id="txt2"><?=$dbUser[0]['impactname']?></span> are creating <span id="wrd2"><?=$dbUser[0]['wcreator']?></span></label>
                    </div>
                  </div>
                  <div class="row-item clearfix">
                  <? if(!empty($dbUser[0]['pimage']) && $dbUser[0]['user_type']=='web'){ ?>
                  <img src="cms_images/user/original/<?=$dbUser[0]['pimage']?>" width="200px">
                  <? } else if($dbUserProfileImage[0]['oauth_provider']=='facebook'){
					  
					  if(!empty($dbUserProfileImage[0]['pimage']))
		$urle = "cms_images/user/original/".$dbUserProfileImage[0]['pimage'];
		else
		$urle = 	$dbUserProfileImage[0]['fbimage'];
					  
					  ?>
                  <img src="<?=$urle?>" width="200px">
                  <? } else { echo "";}?>
                    <label class="lbl" for="txt_bio">Profile Photo:</label><input type="file" name="image" />
                    
                    
                  </div>
                  <div class="row-item clearfix">
                  
                    <label class="lbl" for="txt_name2">Profile URL:</label>
                    <div class="val">
                      <p class="rs display-val"><a href="#" class="be-fc-orange"><?=HTACCESS_URL?>profile/<?=$dbUser[0]['url']?></a></p>
                      <input class="txt" type="text" id="url"  name="info[url]" value="<?=$dbUser[0]['url']?>" placeholdertext="John Doe">
                      <p class="rs description-input">You can set a vanity URL here/ Ince set. this vanity URL can not be changed.</p>
                    </div>
                  </div>
                  <div class="row-item clearfix">
                   <? if(!empty($dbUser[0]['coverimage'])){ ?>
                  <img src="cms_images/user/original/<?=$dbUser[0]['coverimage']?>" width="200px">
                  <? } ?>
                    <label class="lbl" for="txt_web">Cover Photo:</label>
                    <input type="file" name="coverimage" />
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_time_zone">Earnings Visibility:</label>
                    <div class="val">
                      <input  type="radio" value="1" name="info[earningv]" <?=($dbUser[0]['earningv']==1)?'checked':'checked'?>  >
                      <label style="font-size: 16px;    margin: -18px 0 41px 49px;">Public (recommended)<br>
                        Anyone who visits your page will see how much you earn per month.</label>
                      <br>
                      <input  type="radio" value="0" name="info[earningv]" <?=($dbUser[0]['earningv']==0)?'checked':''?> >
                      <label style="font-size: 16px;    margin: -18px 0 0 49px;">Private<br>
                        Only you can see how much you earn. Your earnings will be hidden from your page and goals.</label>
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_time_zone">Patronage Visibility:</label>
                    <div class="val">
                      <input  type="radio" value="1" name="info[pvisibility]" <?=($dbUser[0]['pvisibility']==1)?'checked':'checked'?>  >
                      <label style="font-size: 16px;    margin: -18px 0 41px 49px;">Public (recommended)<br>
                        Anyone who visits your page will see how many patrons you have. We recommend this so that fans know there are others supporting you.</label>
                      <br>
                      <input  type="radio" value="0" name="info[pvisibility]" <?=($dbUser[0]['pvisibility']==1)?'checked':''?>>
                      <label style="font-size: 16px;    margin: -18px 0 0 49px;">Private<br>
                        Only you can see how many patrons you have. The number of patrons you have will be hidden from your page and goals.</label>
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" style="width:100%; text-align:left" for="txt_location">About your impact page:</label>
                    <br>
                    <br>
                    <p class="frist-potet">This is the first thing potential patrons will see when they land on your page, so make sure you paint a compelling picture of how they can join you on this journey.</p>
                    <div class="val" style="    margin: 28px 0 0 0;">
                      <?php
				$ckeditor = new CKEditor();
				$ckeditor->config['toolbar'] = 'Basic';
				$ckeditor->basePath = 'editor/ckeditor/';
				$ckfinder = new CKFinder();
				$ckfinder->BasePath = 'editor/ckfinder/'; // Note: the BasePath property in the CKFinder class starts with a capital letter.
				$ckfinder->SetupCKEditorObject($ckeditor);
				$ckeditor->editor('info[aboutt]',html_entity_decode($dbUser[0]['aboutt']));
				?>
                    </div>
                    <p class="frist-potet">Many creators on Patreon have both a text and video description for their page. This combo is incredibly motivating for fans — it shows how real this is to you and how much you value their participation in your journey.</p>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_location">Intro Video:</label>
                    <p style="font-size: 13px;">Make the best intro video with our guide.</p>
                    <div class="val">
                   <? if(!empty($dbUser[0]['introvideo'])){?>
                    <img src="<? getYoutubeImage($dbUser[0]['introvideo'])?>" alt="">
                    <? }?>
                      <input class="txt" type="text" id="introvideo" value="<?=$dbUser[0]['introvideo']?>" name="info[introvideo]" >
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_location">Social Media:</label>
                    <br>
                    <br>
                    <p style="    font-size: 13px;">Give your patrons confidence - securely verify your accounts and display links on your page. We’ll never post on your behalf.</p>
                    <div class="social"> <span class="facebook"><i class="fa fa-facebook-square" style="    margin: 0 12px 0 0;"></i>Facebook</span> <span class="connect">
                    <?php if($facebook_connect==0) {?>
                    <a href="<?=$facebook_log_in_url?>" class="connecting">Connect</a>
                    <?php } else { ?>
                    <a href="#" class="connecting">Disonnect</a>
                    
                    <?php } ?>
                    
                    </span> </div>
                    
                    
                    
                    
                    <!--<div class="social"> <span class="facebook"><i class="fa fa-instagram" style="    margin: 0 12px 0 0;"></i>instagram</span> <span class="connect"><a href="" class="connecting">Connect</a></span> </div>
                    <div class="social"> <span class="facebook"><i class="fa fa-twitter-square" style="    margin: 0 12px 0 0;"></i>twitter</span> <span class="connect twitter" ><a href="" class="connecting">Connect</a></span> </div>-->
                    <div class="social"> <span class="facebook"><i class="fa fa-youtube" style="    margin: 0 12px 0 0;"></i>youtube</span> <span class="connect youtube" ><a href="login-with.php?provider=Google" class="connecting">Connect</a></span> </div>
                  </div>
                  <div class="row-item clearfix">
                  
                    <button class="btn btn-red btn-submit-all newtier">Save all </button>
                  </div>
                  <div class="row-item clearfix">&nbsp;</div>
                </form>
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
</div></div>
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
      <div class="grid_12"> <a class="logo-footer" href="index.html"><img src="images/logo-3.png" alt="$SITE_NAME"/></a> </div>
      <div class="clear"></div>
    </div>
  </div>
</footer>
<script type="text/javascript">
function chkprofile(){
	if(isEmpty("Name of Imapact page",document.getElementById("impactname").value)){
		document.getElementById("impactname").focus();
		return false;
	}
	if(isEmpty("what are you creating",document.getElementById("wcreator").value)){
		document.getElementById("wcreator").focus();
		return false;
	}
	if(document.getElementById('introvideo').value!='') {
	        var url = document.getElementById("introvideo").value;
        var pattern = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
        if (pattern.test(url)) {
            //alert("Url is valid");
            return true;
        } else {
            alert("Video link is not valid!, Only youtube video link allow here.");
            return false;
		}
	}	
}

function setText(txtval){
	document.getElementById('txt1').innerHTML=txtval;
	document.getElementById('txt2').innerHTML=txtval;	
}
function setWord(wrdval){
	document.getElementById('wrd1').innerHTML=wrdval;
	document.getElementById('wrd2').innerHTML=wrdval;	
	document.getElementById('tagline1').value = document.getElementById('impactname').value+' is creating '+document.getElementById('wcreator').value;
	document.getElementById('tagline2').value = document.getElementById('impactname').value+' are creating '+document.getElementById('wcreator').value;
}
</script>
</body>
</html>
