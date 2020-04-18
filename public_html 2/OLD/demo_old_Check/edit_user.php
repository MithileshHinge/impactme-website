<?php include('admin_path.php'); 
include('include/access.php');
?>
<?php
$image_save_folder = "user";

$page_title = "About | ".PROJECT_TITLE;

if(strlen($row_user->cover_image_path)>0)
 $cover_image = IMAGEPATH.$row_user->cover_image_path;
else
 $cover_image = IMAGEPATH.'background.jpg'; 


if(strlen($row_user->image_path)>0)
 $user_image = IMAGEPATH.$row_user->image_path;
else
 $user_image = IMAGEPATH.'icon_man.png'; 
 
 if($_REQUEST['mode']=="profile")
 {
  	
  if($_FILES['image']['tmp_name']!="")
  {
  
	 $baseimg = $image_folder_name."/";	
      unlink($baseimg.$row_user->image_path);
      $main_path = $image_folder_name."/".$image_save_folder."/";
      $thumb = $main_path."thumbs/";
      $upload_img = $db_query->cwUpload('image',$main_path,'',TRUE,$thumb,'100','75');
      $_REQUEST[image_path] =  $image_save_folder."/".$upload_img; 	
  }	    
  else
  {
     $_REQUEST[image_path] =  $row_user->image_path; 
  }
     if($_FILES['coverimage']['tmp_name']!="")
  {
  
	 $baseimg = $image_folder_name."/";	
      unlink($baseimg.$row_user->cover_image_path);
      $main_path = $image_folder_name."/".$image_save_folder."/";
      $thumb = $main_path."thumbs/";
      $upload_img = $db_query->cwUpload('coverimage',$main_path,'',TRUE,$thumb,'100','75');
      $_REQUEST[cover_image_path] =  $image_save_folder."/".$upload_img; 	
  }	    
  else
  {
     $_REQUEST[cover_image_path] =  $row_user->cover_image_path; 
  }
 
 $db->updateArray("impact_user",$_REQUEST,"user_id=".$row_user->user_id);
 header('location:'.BASEPATH.'/edit/about/');
 
 
 }
 
 if(isset($_GET['uid']))
 {
   $uid = $_GET['uid'];
   $sql_del = $db_query->runQuery("delete from social_users where user_id='$row_user->user_id' and oauth_uid='$uid' and oauth_provider='facebook'");
   header('location:'.BASEPATH.'/edit/about/');
 
 }
 
 if(isset($_GET['gid']))
 {
   $uid = $_GET['gid'];
   $sql_del = $db_query->runQuery("delete from social_users where user_id='$row_user->user_id' and oauth_uid='$uid' and oauth_provider='google'");
   header('location:'.BASEPATH.'/edit/about/');
 
 }
 
 
 
?>

<!DOCTYPE html>
<html>
<head>
 <title><?=$page_title?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=$sql_web->meta_description?>" /> 
    <meta name="title" content="<?=$sql_web->meta_title?>" />
    
    
    
    <meta name="keywords" content="<?=$sql_web->meta_keyword?>" />

<meta name="author" content="<?=PROJECT_TITLE?>" />
<meta name="copyright" content="<?=PROJECT_TITLE?>" />
<meta name="application-name" content="<?=PROJECT_TITLE?>" />

<!-- For Facebook -->
<meta property="og:title" content="<?=$sql_web->meta_title?>" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?=IMAGEPATH.$row_user->image_path?>" />
<meta property="og:url" content="<?=$_SERVER['REQUEST_URI']?>" />
<meta property="og:description" content="<?=$sql_web->meta_description?>" />

<!-- For Twitter -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?=$sql_web->meta_title?>" />
<meta name="twitter:description" content="<?=$sql_web->meta_description?>" />
<meta name="twitter:image" content="<?=IMAGEPATH.$row_user->image_path?>" />


    <?php include('include/titlebar.php'); ?>
    <style>
	.active {
    border: 0px solid;
    margin: 6px 0 10% 0px;
}
	
	</style>
</head>

<body>
<div id="wrapper">
<?php include('include/header.php'); ?>

<div class="layout-2cols">
  <div class="content grid_12">
    <div class="project-detail">
      <div class="project-tab-detail tabbable accordion edit-about">
        <ul class="tbs clearfix">
          <li class="activet"><a href="<?=BASEPATH?>/edit/about/">About</a></li>
          <li><a href="<?=BASEPATH?>/edit/tiers/" class="be-fc-orange">Tiers</a></li>
          <li><a href="<?=BASEPATH?>/edit/goals/" class="be-fc-orange">Goals</a></li>
          <li><a href="<?=BASEPATH?>/edit/thanks/" class="be-fc-orange">Thanks</a></li>
          <li ><a href="<?=BASEPATH?>/edit/payment/" class="be-fc-orange">Payment</a></li>
          <?php if($row_user->review_status==1) {?>
          <li ><a href="<?=BASEPATH?>/edit/post/" class="be-fc-orange">Manage Your Post</a></li>
          <?php } ?>
           <?php if($row_user->review_status==0) {?>
          <li ><a href="<?=BASEPATH?>/edit/review/" class="submit_review"><?php if($row_user->review_submit_status==0) {?>Submit for review<?php }else { ?> Review Status <?php } ?></a></li>
          <?php } ?>
        </ul>
        
        
        
        <div class="tab-content">
          <div>
            <h3 class="rs alternate-tab accordion-label">About</h3>
            <div class="tab-pane accordion-content active">
              <div class="form form-profile">
                <form action="<?=$_SERVER['PHP_SELF']?>" name="profile" method="post" enctype="multipart/form-data">
               <?php if(isset($msg)){?> <div  id="err_msg"><?=$msg?></div> <?php } ?>
                <input type="hidden" name="mode" value="profile" />
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_name1">Name of Impact Page:</label>
                    <div class="val">
                      <input class="txt" type="text" id="impact_name" value="<?=$row_user->impact_name?>" onBlur="setText(this.value)" onKeyUp="setText(this.value)" name="impact_name" >
                      <p class="rs description-input">Your name is displayed on your profile.</p>
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_location">What are you creating? :</label>
                    <div class="val">
                      <input class="txt" type="text" id="creating_for" value="<?=$row_user->creating_for?>" onBlur="setWord(this.value)" onKeyUp="setWord(this.value)" name="creating_for" >
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_time_zone">Which sounds are correct? :</label>
                    <div class="val">
                    <?php
					$val1 = $row_user->impact_name.' is creating '.$row_user->creating_for;
					$val2 = $row_user->impact_name.' are creating '.$row_user->creating_for;
					
					?>
                      <label style="font-size: 16px;margin: 9px 0 0 20px;"> <input  type="radio" name="tag_line" <?=($row_user->creating_for==$val1)?'checked':'checked'?>  id="tagline1" value="<?=$val1?>">
                     <span id="txt1"><?=$row_user->impact_name?></span> is creating <span id="wrd1"><?=$row_user->creating_for?></span></label>
                      <br>
                       <label style="font-size: 16px;margin: 9px 0 0 20px;"><input  type="radio" name="tag_line" id="tagline2" <?=($row_user->creating_for==$val2)?'checked':''?> value="<?=$val2?>" >
                     <span id="txt2"><?=$row_user->impact_name?></span> are creating <span id="wrd2"><?=$row_user->creating_for?></span></label>
                    </div>
                  </div>
                  <div class="row-item clearfix">
              
                  
                 
                    <label class="lbl" for="txt_bio">Profile Photo:</label><input type="file" name="image" />
                        <?php if(strlen($row_user->image_path)>0) {
				     $profile_image = IMAGEPATH.$row_user->image_path;
					 echo '<img src="'.$profile_image.'" width="200px">';
					 }
					 else
					 echo '';
					  ?>
                    
                  </div>
                  <div class="row-item clearfix">
                  
                    <label class="lbl" for="txt_name2">Profile URL:</label>
                    <div class="val">
                      
                      <input class="txt" type="text" id="slug"  name="slug" value="<?=$row_user->slug?>" placeholdertext="John Doe">
                      <p class="rs display-val" style="margin-left:19%"><a href="#" class="be-fc-orange"><?=BASEPATH?>profile/<?=$row_user->slug?></a></p>
                      <span id="slug_err" style="color:red;margin-left:19%"></span>
                      <p class="rs description-input" style="margin-left:19%">You can set a vanity URL here/ Ince set. this vanity URL can not be changed.</p>
                    </div>
                  </div>
                  <div class="row-item clearfix">
             
                    <label class="lbl" for="txt_web">Cover Photo:</label>
                    <input type="file" name="coverimage" />
                     <?php if(strlen($row_user->cover_image_path)>0) {
				     $profile_image = IMAGEPATH.$row_user->cover_image_path;
					 echo '<img src="'.$profile_image.'" width="200px">';
					 }
					 else
					 echo '';
					  ?>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_time_zone">Earning Visibility:</label>
                    <div class="val" style="margin-left:170px;">
                      <label style="font-size: 15px;    margin: -28px 0 35px 70px"> <input  type="radio" value="1" name="earning_visibility" <?=($row_user->earning_visibility==1)?'checked':'checked'?>  >
                    &nbsp;&nbsp; Public (recommended)<br>
                        Anyone who visits your page will see how much you earn per month.</label>
                      <br>
                    <label style="font-size: 15px;    margin: -28px 0 35px 70px;">  <input  type="radio" value="0" name="earning_visibility" <?=($row_user->earning_visibility==0)?'checked':''?> >
                     &nbsp;&nbsp; Private<br>
                        Only you can see how much you earn. Your earnings will be hidden from your page and goals.</label>
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_time_zone">Patronage Visibility:</label>
                    <div class="val" style="margin-left:170px;">
                     <label style="font-size: 15px;    margin: -28px 0 35px 70px;"> <input  type="radio" value="1" name="patronage_visibility" <?=($row_user->patronage_visibility==1)?'checked':'checked'?>  >
                      &nbsp;&nbsp;Public (recommended)<br>
                        Anyone who visits your page will see how many patrons you have. We recommend this so that fans know there are others supporting you.</label>
                      <br>
                     <label style="font-size: 15px;    margin: -28px 0 35px 70px;"> <input  type="radio" value="0" name="patronage_visibility" <?=($row_user->patronage_visibility==0)?'checked':''?>>
                      &nbsp;&nbsp;Private<br>
                        Only you can see how many patrons you have. The number of patrons you have will be hidden from your page and goals.</label>
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" style="width:100%; text-align:left" for="txt_location">About your impact page:</label>
                    <br>
                    <br>
                    <p class="frist-potet">This is the first thing potential patrons will see when they land on your page, so make sure you paint a compelling picture of how they can join you on this journey.</p>
                    <div class="val" style="    margin: 28px 0 0 0;">
                     <textarea  class="form-control" name="about_page" id="about_page" parsley-trigger="change"  > <?=trim(stripslashes($row_user->about_page))?>
                              </textarea>
                              
                              <script>
	CKEDITOR.replace('about_page',{
                       
                       filebrowserWindowWidth: '900',
					   filebrowserWindowHeight: '400',
					   filebrowserBrowseUrl : '<?=ADMINPATH?>/ckfinder/ckfinder.html',
					   filebrowserImageBrowseUrl : '<?=ADMINPATH?>/ckfinder/ckfinder.html?type=Images',
					   filebrowserFlashBrowseUrl : '<?=ADMINPATH?>/ckfinder/ckfinder.html?type=Flash',
					   filebrowserUploadUrl : '<?=ADMINPATH?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
					   filebrowserImageUploadUrl : '<?=ADMINPATH?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
					   filebrowserFlashUploadUrl : '<?=ADMINPATH?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
	} );
</script>
                    </div>
                    <p class="frist-potet">Many creators on Patreon have both a text and video description for their page. This combo is incredibly motivating for fans — it shows how real this is to you and how much you value their participation in your journey.</p>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_location">Intro Video:</label>
                    <p style="font-size: 13px;">Make the best intro video with our guide.</p>
                    <div class="val">
                   <?php if(!empty($dbUser[0]['intro_video'])){?>
                    <img src="<?=$db_query->getYoutubeImage($row_user->intro_video)?>" alt="">
                    <?php }?>
                      <input class="txt" type="text" id="introvideo" value="<?=$row_user->intro_video?>" name="intro_video" >
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_location">Social Media:</label>
                    <br>
                    <br>
                    <p style="    font-size: 13px;">Give your patrons confidence - securely verify your accounts and display links on your page. We’ll never post on your behalf.</p>
                    
                     <?php
				   $sql_facebook = $db_query->fetch_object("select count(*) c, oauth_uid oid from social_users where user_id='$row_user->user_id' and oauth_provider='facebook'");
					   if($sql_facebook->c==0)
					   {
						   include('social_login_load.php');
						   $_SESSION['connect_type'] = "facebook";
						   $facebookURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
						   $facebook_button_name = "Connect";
					   }
				       else
					   {
					   $_SESSION['connect_type']="";
						 $facebookURL = BASEPATH."/edit/about/?uid=".$sql_facebook->oid;
						 $facebook_button_name = "Disconnect";
						}
                    ?>
                    
                    
                    <div class="social"> 
                    <span class="facebook"><i class="fa fa-facebook-square" style="    margin: 0 12px 0 0;"></i>Facebook</span> 
                    <span class="connect"><a href="<?=htmlspecialchars($facebookURL)?>" class="connecting"><?=$facebook_button_name?></a></span> 
                    </div>
                    
                   <?php
				   $sql_google = $db_query->fetch_object("select count(*) c,oauth_uid oid  from social_users where user_id='$row_user->user_id' and oauth_provider='google'");
					   if($sql_google->c==0)
					   {
						   include('social_login_load.php');
						  $_SESSION['youtube_connect_type'] = "google";
					//$loginURL="";
						   $authUrl = $googleClient->createAuthUrl();
                           $googleURL = filter_var($authUrl, FILTER_SANITIZE_URL);

 $google_button_name = "Connect";
					   }
				       else
					   {
					    $_SESSION['youtube_connect_type'] = "";
						 $googleURL = BASEPATH."/edit/about/?gid=".$sql_google->oid;
						 $google_button_name = "Disconnect";
						}
                    ?>
                    
                    <!--<div class="social"> <span class="facebook"><i class="fa fa-instagram" style="    margin: 0 12px 0 0;"></i>instagram</span> <span class="connect"><a href="" class="connecting">Connect</a></span> </div>
                    <div class="social"> <span class="facebook"><i class="fa fa-twitter-square" style="    margin: 0 12px 0 0;"></i>twitter</span> <span class="connect twitter" ><a href="" class="connecting">Connect</a></span> </div>-->
                    
                    <div class="social"> 
                    <span class="facebook"><i class="fa fa-youtube" style="    margin: 0 12px 0 0;"></i>youtube</span> 
                    <span class="connect youtube" ><a href="<?=htmlspecialchars($googleURL)?>" class="connecting"><?=$google_button_name?></a></span>
                    </div>
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
</div>


</div>
<?php include('include/footer.php');
include('include/footer_js.php');?>


</div>

<script type="text/javascript">
function chkprofile(){
	if(isEmpty("Name of Imapact Page",document.getElementById("impact_name").value)){
		document.getElementById("impact_name").focus();
		return false;
	}
	if(isEmpty("What are you creating",document.getElementById("creating_for").value)){
		document.getElementById("creating_for").focus();
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
	document.getElementById('tagline1').value = document.getElementById('impact_name').value+' is creating '+document.getElementById('creating_for').value;
	document.getElementById('tagline2').value = document.getElementById('impact_name').value+' are creating '+document.getElementById('creating_for').value;
}
</script>

<script>

 $(document).ready(function() {

$("#slug").keyup(function(){

    
      var slug = $("#slug").val();
  
	  
	  if(slug != "") {

      $.ajax({
        type:"POST",
        url : "<?=BASEPATH?>/ajax/search_user.php",
		data: {Slug:slug},
		
        dataType: 'json',
        async: false,
        success : function(result) {

         var count = result[0]['c'];
         if(count>0)
		 {
		   $("#slug_err").fadeIn().html("URL Already taken");
		 //  $("#slug").val("");
		//	setTimeout(function(){ $("#slug_err").fadeOut(); }, 3000);
			$("#slug").focus();
			return false; 
		 }
		 else
		 {
		 $("#slug_err").fadeIn().html("");
	
		 }
		
           
        },
    });
 }

});
	
	});



</script>

</body>
</html>
