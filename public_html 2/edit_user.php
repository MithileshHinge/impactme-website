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
 $row_user->image_path = $db_query->assign_default_profile_image($row_user->email_id); 
 
 if($_REQUEST['mode']=="profile")
 {
 
 
 if($_REQUEST['tag_type'] == 1)
					{
                    $_REQUEST['tag_line'] = $_REQUEST['impact_name'] .' is creating '. $_REQUEST['creating_for'];
					}
					else
					{
					$_REQUEST['tag_line'] = $_REQUEST['impact_name'] .' are creating '. $_REQUEST['creating_for'];
					}
  	
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
 header('location:'.BASEPATH.'/edit/about?msg=1');
 
 
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
 
 
  if($_GET['delete']==1)
 {
 
  $sql_delete = $db_query->Query("delete from impact_user where user_id='$row_user->user_id'");
  header('location:'.BASEPATH);
 }
 
 
?>

<!DOCTYPE html>
<html>
<head>
 <title><?=$page_title?></title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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

<!--body style="background:url('<?=BASEPATH?>/images/settings-back-transparent.png') 0 0%, url('<?=BASEPATH?>/images/settings-back-transparent.png') 82% 105%,url('<?=BASEPATH?>/images/settings-back-transparent.png') 94% 112.7%, url('<?=BASEPATH?>/images/settings-back-transparent.png') 121% 112.8%, #0c2f43; "-->
<body class="body-bg">
<div id="wrapper" >
<?php include('include/header.php'); ?>

<div class="modal fade" id="modalProfilePic" tabindex="-1" role="dialog" aria-labelledby="modalProfilePicLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:400px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalProfilePicLabel">Change Profile Picture</h5>
      </div>
      <div id="modalProfilePicBody" class="modal-body">
      </div>
      <div class="modal-footer">
        <button id="cancel-profile-pic" type="button" class="btn btn-secondary">Cancel</button>
        <button id="save-profile-pic" type="button" class="btn btn-primary" style="color:#fff;">Save</button>
      </div>
    </div>
    <div class="loading-profile-spinner"></div>
  </div>
</div>


<div class="modal fade" id="modalCoverPic" tabindex="-1" role="dialog" aria-labelledby="modalCoverPicLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:600px; max-width:initial;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCoverPicLabel">Change Cover Picture</h5>
      </div>
      <div id="modalCoverPicBody" class="modal-body">
      </div>
      <div class="modal-footer">
        <button id="cancel-cover-pic" type="button" class="btn btn-secondary">Cancel</button>
        <button id="save-cover-pic" type="button" class="btn btn-primary" style="color:#fff;">Save</button>
      </div>
    </div>
    <div class="loading-cover-spinner"></div>
  </div>
</div>

<div class="modal fade" id="modalConfirmDel" tabindex="-1" role="dialog" aria-labelledby="modalConfirmDelLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:400px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalConfirmDelLabel">Confirm Delete?</h5>
      </div>
      <div id="modalConfirmDelBody" class="modal-body">This will permanently delete your Creator page. This operation cannot be undone. Do you wish to continue?
        <br>Note: This will only delete your Creator page. If you want to permanently delete or temporarily de-activate your account, please visit <a href="<?=BASEPATH.'/settings/'?>" style="text-decoration:underline;">Profile Settings</a> page.
      </div>
      <div class="modal-footer">
        <button id="confirm-del-no" type="button" class="btn btn-primary" style="color:#fff;" data-dismiss="modal">No</button>
        <button id="confirm-del-yes" type="button" style="color:#fff;" class="btn btn-secondary">Yes</button>
      </div>
    </div>
  </div>
</div>

<div class="layout-2cols">
  <div class="content grid_12">
    <div class="project-detail">
      <div class="project-tab-detail tabbable accordion edit-about">
       <?php include('include/user_menu.php');?>
        
        
        
        <div class="tab-content">
          <div>
            <h3 class="rs alternate-tab accordion-label">About</h3>
            <div class="tab-pane accordion-content active">
              <div class="form form-profile">
                <form action="<?=$_SERVER['PHP_SELF']?>" name="profile" id="uploadForm" method="post" enctype="multipart/form-data" id="edit-createrform" >
                <input type="hidden" name="mode" value="profile" />
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_name1">Name of your page:</label>
                    <div class="val">
                      <input class="txt" type="text" id="impact_name" required value="<?=$row_user->impact_name?>" onBlur="javascript:setText(this.value);" onKeyUp="javascript:setText(this.value);"  onKeyPress="javascript:setText(this.value);" onClick="javascript:setText(this.value);" name="impact_name"/>
                      
                    </div> 
                  
					
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_location">What are you creating? :</label>
                    <div class="val">
                      <input class="txt" type="text" id="creating_for" required value="<?=$row_user->creating_for?>" onBlur="setWord(this.value)" onKeyUp="setWord(this.value)" name="creating_for"/>
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_time_zone" style="    padding-top: 26px;">Which sounds correct? :</label>
                    <div class="val">
                    <?php
					
					$val1 = $row_user->impact_name.' is creating '.$row_user->creating_for;
					$val2 = $row_user->impact_name.' are creating '.$row_user->creating_for;
					
					?>
                      <label style="font-size: 16px;margin: 23px 0 0 0px;"> <input  type="radio" name="tag_type" <?=($row_user->tag_type==1)?'checked':'checked'?>  id="tagline1" value="1">
                     <span id="txt1"><?=$row_user->impact_name?></span> is creating <span id="wrd1"><?=$row_user->creating_for?></span></label>
                      <br>
                       <label style="font-size: 16px;margin: 9px 0 0 0px;"><input  type="radio" name="tag_type" id="tagline2" <?=($row_user->tag_type==2)?'checked':''?> value="2" >
                     <span id="txt2"><?=$row_user->impact_name?></span> are creating <span id="wrd2"><?=$row_user->creating_for?></span></label>
                    </div>
                  </div>
                  <?php 
					if(strlen($row_user->image_path)>0) 
					{
						
				       $profile_image = IMAGEPATH.$row_user->image_path;
					   if (@file_get_contents($profile_image, 0, NULL, 0, 1)) 
					   {
					      $profile_image = $profile_image;
					   }
					   else
					   {
					     $profile_image ='';
					   }
					}
					 else
					   $profile_image ='';
					  ?>
                      
                      
                  <div class="row-item clearfix">
              
                  
                 
                    <label class="lbl" for="txt_bio">Profile Photo:</label>
                   
                  <div class="profo-image" id="imgArea" style="border-radius:50%"><img src="<?=$profile_image?>" style="border-radius:50%">
                    
                          <div class="progressBar">
                            <div class="bar"></div>
                            <div class="percent">0%</div>
                          </div>
                          <div class=" profile-change" id="imgChange"><span>
                              <i class="material-icons time-editcreate" style="font-size: 30px; margin: 19px 0 0 56px;">photo_camera</i></span>
                            <input type="file" accept="image/*" name="image_upload_file" id="image_upload_file">
                          </div>
                  
                  </div>
        
        
                  </div>
                  
                  
                  
                  <div class="row-item clearfix">
                  
                    <label class="lbl" for="txt_name2">Profile URL:</label>
                    <div class="val">
                      
                      <input class="txt" type="text" id="slug"  name="slug" value="<?=$row_user->slug?>" placeholdertext="johndoe" onKeyPress="JavaScript: return keyRestrict(event,'abcdefghijklmnopqrstuvwxyz0123456789._-');">
                      <p class="rs display-val"  id="profile-link"><a href="#" class="be-fc-orange"><?=BASEPATH?>/profile/<?=$row_user->slug?></a></p>
                      <span id="slug_err" style="color:red;margin-left:19%"></span>
                      <p class="rs description-input" id="profile-link">You can set a vanity URL here. Once set, this vanity URL can not be changed.</p>
                    </div>
                  </div> <?php 
					if(strlen($row_user->cover_image_path)>0) 
					{
						
				       $coverimage = IMAGEPATH.$row_user->cover_image_path;
					   if (@file_get_contents($coverimage, 0, NULL, 0, 1)) 
					   {
					      $coverimage = $coverimage;
					   }
					   else
					   {
					     $coverimage ='';
					   }
					}
					 else
					   $coverimage = '';
					  ?>
                  <div class="row-item clearfix">
             
                    <label class="lbl" for="txt_web">Cover Photo:</label>
                   <div class="coverimage-impact" id="imgAreaCover"><img src="<?=$coverimage?>">
            
                  <div class="progressBar2">
                    <div class="bar2"></div>
                    <div class="percent2">0%</div>
                  </div>
                  <div class="change-coverimage" id="imgChange"><span><i class="material-icons time-editcreate" style="font-size: 30px;
    margin: 32px 0 0 44%;">photo_camera</i></span>
                    <input type="file" accept="image/*" name="cover_image_upload_file" id="cover_image_upload_file">
                  </div>
                  </div>
         
                      
                       
                    <!-- <div class="cover_image" style="background-image:url(<?=$coverimage?>); background-size:cover;"></div>
                      <input type="file" name="coverimage" accept="image/*" style="margin-left:38%; "/>-->
                      
                  
                    
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_time_zone" style="    margin: 0 0 0 0;">Earning Visibility:</label>
                    <div class="val"  id="user-earning">
                      <label  id="public-earning"> 
                      <input  type="radio" value="1" name="earning_visibility" <?=($row_user->earning_visibility==1)?'checked':'checked'?>  style="    margin: 0 0 0 0;">
                    <span>Public (recommended)</span><br>
                        <span style="    margin: 0 0 0 15px;">Anyone who visits your page will see how much you earn per month.</span></label>
                      <br>
                    <label id="public-earning"> 
                    <input  type="radio" value="0" name="earning_visibility" <?=($row_user->earning_visibility==0)?'checked':''?> style="    margin: 0 0 0 0;">
                     <span>Private</span><br>
                        <span style="    margin: 0 0 0 15px;">Only you can see how much you earn. Your earnings will be hidden from your page.</span></label>
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_time_zone" >Supporters Visibility:</label>
                    <div class="val" id="user-earning">
                     <label id="public-earning"> 
                     <input  type="radio" value="1" name="patronage_visibility" <?=($row_user->patronage_visibility==1)?'checked':'checked'?> style="margin:0 0 0 0;" >
                      <span>Public (recommended)</span><br>
                        <span style="    margin: 0 0 0 15px;">Anyone who visits your page will see how many supporters you have. We recommend this so that fans know there are others supporting you.</span></label>
                      <br>
                     <label id="public-earning"> 
                     <input  type="radio" value="0" name="patronage_visibility" <?=($row_user->patronage_visibility==0)?'checked':''?> style="margin:0 0 0 0;">
                      <span>Private</span><br>
                        <span style="    margin: 0 0 0 15px;">Only you can see how many supporters you have. The number of supporters you have will be hidden from your page.</span></label>
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_time_zone" >One-time Payments Visibility:</label>
                    <div class="val" id="user-earning">
                     <label id="public-earning"> 
                     <input  type="radio" value="1" name="onetime_visibility" <?=($row_user->onetime_visibility==1)?'checked':'checked'?> style="margin:0 0 0 0;" >
                      <span>Public (recommended)</span><br>
                        <span style="    margin: 0 0 0 15px;">Anyone who visits your page will see the total amount of one time payments you have received.</span></label>
                      <br>
                     <label id="public-earning"> 
                     <input  type="radio" value="0" name="onetime_visibility" <?=($row_user->onetime_visibility==0)?'checked':''?> style="margin:0 0 0 0;">
                      <span>Private</span><br>
                        <span style="    margin: 0 0 0 15px;">Only you can see the total amount of one time payments you have received. It will be hidden from your page.</span></label>
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" style="width:100%; text-align:left !important;" for="txt_location">About your ImpactMe page:</label>
                    
                    <p class="frist-potet">This is the first thing potential supporters will see when they land on your page, so make sure you paint a compelling picture of how they can join you on this journey.</p>
                    <div class="val" style="    margin: 28px 0 0 0;">
                     <textarea  class="form-control" name="about_page" id="about_page" parsley-trigger="change" style="height:200px;"><?=trim(stripslashes($row_user->about_page))?></textarea>
                              
                              <!--script>
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
</script-->
                    </div>
                    <p class="frist-potet">Many creators on ImpactMe have both a text and video description for their page. This combo is incredibly motivating for fans — it shows how real this is to you and how much you value their participation in your journey.</p>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl intro-video-label" for="txt_location" style="padding-top: 14px;text-align: left !important;
    margin: 0 0 0 17%;
    width: 130px;">Intro Video:</label>
                    <div class="val">
                   <?php if(!empty($dbUser[0]['intro_video'])){?>
                    <img src="<?=$db_query->getYoutubeImage($row_user->intro_video)?>" alt="">
                    <?php }?>
                      <input class="txt" type="text" id="introvideo" value="<?=$row_user->intro_video?>" name="intro_video" >
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_location"  id="user-social" style="font-size:17px;">Social Media :</label>
                    
                    <p style="margin-left:265px" class="display-social-links-p">Display your social links on your page</p>
                    
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
                    <span class="connect" style="left:284px;">
                      <a style="display:none;" href="<?=htmlspecialchars($facebookURL)?>" class="connecting"><?=$facebook_button_name?></a>
                      <input class="instragram-link" type="text" placeholder="facebook page link" name="facebook_link" id="facebook_link" value="<?=$row_user->facebook_link?>">
                    </span> 
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
                    <span class="facebook"><i class="fa fa-youtube" style="    margin: 0 12px 0 0;"></i>Youtube</span> 
                    <span class="connect youtube" style="left:283px;">
                      <a style="display:none;" href="<?=htmlspecialchars($googleURL)?>" class="connecting"><?=$google_button_name?></a>
                      <input class="instragram-link" type="text" placeholder="youtube channel link" name="youtube_link" id="youtube_link" value="<?=$row_user->youtube_link?>">
                    </span>
                    </div>
                    
                    <div class="social"> <span class="facebook" style="margin-top: 5px;"><i class="fa fa-instagram" style="    margin: 0 12px 0 0;"></i>Instagram ID</span> 
                       <span class="connect">
                           <input class="instragram-link" type="text" placeholder="instagram_username" name="instagram" id="instagram" value="<?=$row_user->instagram?>">
                       </span> 
                    </div>
                    
                  </div>
                  <div class="row-item clearfix">
                  
                    <button class="btn  btn-submit-all newtier"  id="user-save"style="padding: 10px 26px;" onClick="javascript:setText(this.value);">Save all </button>
                  </div>
                  <div class="row-item clearfix">&nbsp;</div>
                </form>
              </div>
              
              <div class="delete-page-section" style="margin: -70px 0 0 72px;    padding: 0 0 48px 0;">
              
              
               <h2>Delete Page</h2>
               <p>Careful! This will permanently delete your Creator Page. This action cannot be undone.</p>
<br>
               
                   <button class="btn  btn-submit-all newtier" id="del" style="margin:0 0 0 0;padding: 10px 26px;">Delete Creator Page</button>
            
           
              </div>
              
              <!--div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog  modal-dialog-centered">

    < Modal content>
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Please provide your password to delete your page.</h4>
      </div>
      <div class="modal-body">
      <span id="modalMsg" style="color:red"></span>
      <form class="form-horizontal" role="form" id="f2" method="post" action="" onSubmit="return false;">
                 <input type="hidden" name="user_id" id="UserID" value="<?=$row_user->user_id?>">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"
                          for="inputPassword3" >Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password"/>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-default" id="modal_check">Submit</button>
                    </div>
                  </div>
                </form>
                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div-->

              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modalDelPassLabel" aria-hidden="true">
                <div class="modal-dialog" role="document" style="width:400px;">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalDelPassLabel">Please provide your password to delete your page.</h5>
                    </div>
                    <div id="modalDelPassBody" class="modal-body">
                      <span id="modalMsg" style="color:red"></span>
                      <form class="form-horizontal" role="form" id="f2" method="post" action="" onSubmit="return false;">
                        <input type="hidden" name="user_id" id="UserID" value="<?=$row_user->user_id?>">
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="inputPassword3" >Password</label>
                          <div class="col-sm-10">
                              <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password"/>
                          </div>
                        </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-default" id="modal_check">Submit</button>
                    </div>
                  </div>
                </form>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
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
<?php if($_GET['msg'] == 1){?>
<div class="fixed-top d-flex justify-content-center">
<div class="alert alert-success fade in" style="width:fit-content; margin-top:67px;" role="alert" id="save-success-alert">
  All changes have been saved successfully.
</div>
</div>
<?php } ?>


</div>
<?php include('include/footer.php');
include('include/footer_js.php');?>


</div>
<!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  
  
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
	//document.getElementById('tagline1').value = document.getElementById('impact_name').value+' is creating '+document.getElementById('creating_for').value;
	//document.getElementById('tagline2').value = document.getElementById('impact_name').value+' are creating '+document.getElementById('creating_for').value;
}
</script>

<script>

 $(document).ready(function() {

  //dismiss alert if shown
  setTimeout(function () {
    $("#save-success-alert").alert('close');
  }, 4000);

$("#slug").keyup(function(){

    
      var slug = $("#slug").val();

      $('#profile-link > a').html('<?=BASEPATH?>/profile/'+slug);

	  
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
	
	

  $("#del").click(function(){
    $('#modalConfirmDel').modal('show');
  });

  $("#confirm-del-yes").click(function(){
    $('#modalConfirmDel').modal('hide');
    $('#myModal').modal('show');
  });

$("#modal_check").click(function(){
 
    var password = $("#inputPassword").val();
	if(password=="")
	{ 
	    $("#modalMsg").fadeIn().html("Password Required");
	    setTimeout(function(){ $("#modalMsg").fadeOut(); }, 3000);
	    $("#inputPassword").focus();
	    return false; 
	} 

	     var user_id = $("#UserID").val();
         if(user_id != "" || password != ""){

            $.ajax({
                url: '<?=BASEPATH?>/ajax/search_user.php',
                type: 'post',
                data: {UserId:user_id , Password:password },
                dataType: 'json',
                success:function(response){
				
                console.log(response); 
                 if(response == 0){ 
				 
				   $("#modalMsg").fadeIn().html(" Invalid Password ");
					setTimeout(function(){ $("#modalMsg").fadeOut(); }, 3000);
					$("#inputPassword").val("");
					$("#inputPassword").focus();
					return false; 
				 
				  }
                   else
				   {
				    window.location.href="<?=BASEPATH?>/edit_user.php?delete=1";
				   }
					
                 
					 

                }
            });
        }
   
	
 
});	
	
	
	
	});



</script>
<!--<script src="<?=BASEPATH?>/image_upload_js/jquery.min.js"></script>-->
<script src="<?=BASEPATH?>/image_upload_js/jquery.form.js"></script>
<link rel="stylesheet" href="https://www.impactme.in/croppie/croppie.css" />
<script src="https://www.impactme.in/croppie/croppie.js"></script>
<script>

/*<=========== Change Profile Pic ============>*/

var myProfileModal = $('#modalProfilePic');
var modalProfileBodyCroppie = $('#modalProfilePicBody');

var myProfileCroppie = modalProfileBodyCroppie.croppie({
    viewport: {
        width: 250,
        height: 250,
        type: 'circle'
    },
    boundary: {
        width: 300,
        height: 250
    }
});

$('#image_upload_file').on('change', function () {
  if($('#image_upload_file').val() != ''){
    myProfileModal.modal({backdrop: 'static', keyboard: false});
    myProfileModal.modal('show');
  }
});

myProfileModal.on('shown.bs.modal', function(){ 
    //myCroppie.croppie('bind', bindOpts);
    var reader = new FileReader();
    reader.onload = function (e) {
      myProfileCroppie.croppie('bind', {
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
      
    }
    reader.readAsDataURL($('#image_upload_file').get(0).files[0]);
});

$('#save-profile-pic').on('click', function(event){
  $(".loading-profile-spinner").show(0, function(){
    myProfileCroppie.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function (response) {
      $.ajax({
        url: '<?=BASEPATH?>/uploadFileCroppie.php',
        type: "POST",
        data:  {"type": "creator_profile" ,"image" : response},
        beforeSend: function(){
        },
        success: function(data){
          obj = $.parseJSON(data);
          if (obj.status){
            $("#imgArea>img").prop('src',obj.image_medium);
            $(".photo-nav").css("background-image", "url(" + obj.image_medium + ")");
          }else {
            alert('Error');
          }
          myProfileModal.modal('hide');
          $(".loading-profile-spinner").hide();
          $("#image_upload_file").val('');
        }
      });
    });
  });
});

$('#cancel-profile-pic').on('click', function(event){
  $("#image_upload_file").val('');
  myProfileModal.modal('hide');
});



/*<========== Change Cover Pic =============>*/

var myCoverModal = $('#modalCoverPic');
var modalCoverBodyCroppie = $('#modalCoverPicBody');

var window_h = $(window).height();
var window_w = $(window).width();

if (window_w < 550){
  croppie_w = window_w-50;
  croppie_h = (window_w-50)/5;
}else {
  croppie_w = 500;
  croppie_h = 100;
}

var myCoverCroppie = modalCoverBodyCroppie.croppie({
    viewport: {
        width: croppie_w,
        height: croppie_w/5,
        type: 'square'
    },
    boundary: {
        width: croppie_w,
        height: croppie_w*4/5
    },
    enforceBoundary: true,
});

$('#cover_image_upload_file').on('change', function () {
  if($('#cover_image_upload_file').val() != ''){
    myCoverModal.modal({backdrop: 'static', keyboard: false});
    myCoverModal.modal('show');
  }
});

myCoverModal.on('shown.bs.modal', function(){ 
    //myCroppie.croppie('bind', bindOpts);
    var reader = new FileReader();
    reader.onload = function (e) {
      myCoverCroppie.croppie('bind', {
        url: e.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
      
    }
    reader.readAsDataURL($('#cover_image_upload_file').get(0).files[0]);
});

$('#save-cover-pic').on('click', function(event){
  $(".loading-cover-spinner").show(0, function(){
    myCoverCroppie.croppie('result', {
      type: 'canvas',
      size: {width: 1440}
    }).then(function (response) {
      $.ajax({
        url: '<?=BASEPATH?>/uploadFileCroppie.php',
        type: "POST",
        data:  {"type": "creator_cover" ,"image" : response},
        beforeSend: function(){
        },
        success: function(data){
          obj = $.parseJSON(data);
          if (obj.status){
            $("#imgAreaCover>img").prop('src',obj.image_medium);
          }else {
            alert('Error');
          }
          myCoverModal.modal('hide');
          $(".loading-cover-spinner").hide();
          $("#cover_image_upload_file").val('');
        }
      });
    });
  });
});

$('#cancel-cover-pic').on('click', function(event){
  $("#cover_image_upload_file").val('');
  myCoverModal.modal('hide');
});


/*
$(document).on('change', '#image_upload_file', function () {
var progressBar = $('.progressBar'), bar = $('.progressBar .bar'), percent = $('.progressBar .percent');

$('#uploadForm').ajaxForm({
 url: '<?=BASEPATH?>/uploadFile.php',
    beforeSend: function() {
		progressBar.fadeIn();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    success: function(html, statusText, xhr, $form) {		
		obj = $.parseJSON(html);	
		if(obj.status){		
			var percentVal = '100%';
			bar.width(percentVal)
			percent.html(percentVal);
			$("#imgArea>img").prop('src',obj.image_medium);			
		}else{
			alert('err');
		}
    },
	complete: function(xhr) {
		progressBar.fadeOut();			
	}	
}).submit();		

});


$(document).on('change', '#cover_image_upload_file', function () {
var progressBar = $('.progressBar2'), bar = $('.progressBar2 .bar2'), percent = $('.progressBar2 .percent2');

$('#uploadForm').ajaxForm({
 url: '<?=BASEPATH?>/uploadFile.php',
    beforeSend: function() {
		progressBar.fadeIn();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    success: function(html, statusText, xhr, $form) {		
		obj = $.parseJSON(html);	
		if(obj.status_cover){		
			var percentVal = '100%';
			bar.width(percentVal)
			percent.html(percentVal);
			$("#imgAreaCover>img").prop('src',obj.image_cover);			
		}else{
			alert('err');
		}
    },
	complete: function(xhr) {
		progressBar.fadeOut();			
	}	
}).submit();		

});
*/

</script>

</body>
</html>
