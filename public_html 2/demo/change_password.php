<?php include('admin_path.php'); 
include('include/access.php');
?>
<?php
$image_save_folder = "user";

$page_title = "Profile Settings | ".PROJECT_TITLE;

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
 header('location:'.BASEPATH.'/change-password/?msg=1');
 
 
 }
 if($_GET['msg']==1)
 {
  $msg = "<span style='color:green'>Password Changed Successfully</span>";
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
        
        
        
        
        <div class="tab-content">
          <div>
            <h3 class="rs alternate-tab accordion-label">About</h3>
            <div class="tab-pane accordion-content active">
           
              <div class="form form-profile">
                <form action="<?=$_SERVER['PHP_SELF']?>" name="profile" method="post" enctype="multipart/form-data">
               <?php if(isset($msg)){?> <div  id="err_msg"><?=$msg?></div> <?php } ?> 
               <h2>Change Password</h2><br />

                <input type="hidden" name="mode" value="profile" />
                
                <div class="row-item clearfix">
                    <label class="lbl" for="txt_name1">Password:</label>
                    <div class="val">
                      <input class="txt" type="password" id="password" value="" name="password" >
                     
                    </div> <span id="password_err" style="color:red"></span>
                  </div>
                  
                
             <div class="row-item clearfix">
                    <label class="lbl" for="txt_name1">Confirm Password:</label>
                    <div class="val">
                      <input class="txt" type="password" id="cpassword" value="" name="cpassword" >
                  
                    </div>   <span id="cpassword_err"  style="color:red"></span>
                  </div>
            
                  
                  <div class="row-item clearfix">
                  
                    <button class="btn btn-red btn-submit-all newtier" id="log">Change Password </button>
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
setTimeout(function(){ $("#err_msg").fadeOut(); }, 3000);
  $("#log").click(function(){

	var password = $("#password").val();
	var cpassword = $("#cpassword").val();
	
	if(password=="")
	{ 
	    $("#password_err").fadeIn().html("Password Required");
	    setTimeout(function(){ $("#password_err").fadeOut(); }, 5000);
	    $("#password").focus();
	    return false; 
	} 
	if(cpassword=="")
	{ 
	    $("#cpassword_err").fadeIn().html("Confirm Password Required");
	    setTimeout(function(){ $("#cpassword_err").fadeOut(); }, 5000);
	    $("#cpassword").focus();
	    return false; 
	} 
	if(password!==cpassword)
	{ 
	    $("#cpassword_err").fadeIn().html("Password Not Matched");
	    setTimeout(function(){ $("#cpassword_err").fadeOut(); }, 5000);
	    $("#cpassword").focus();
	    return false; 
	} 
});

});




</script>

</body>
</html>
