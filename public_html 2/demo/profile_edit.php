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
 header('location:'.BASEPATH.'/settings/?update=1');
 
 
 }
 
 
 if($_REQUEST['mode']=="change_password")
 {
 
 $db->updateArray("impact_user",$_REQUEST,"user_id=".$row_user->user_id);
 header('location:'.BASEPATH.'/settings/?pwd=1');
 
 
 }
 if($_GET['delete']==1)
 {
 $sqlUserCheck = $db_query->fetch_object("select email_id from impact_user where user_id='$row_user->user_id'");
  $sql_delete = $db_query->Query("delete from impact_user where email_id='$sqlUserCheck->email_id'");
  header('location:'.BASEPATH);
 }
 if($_GET['activate']==1)
 {
  $sql_delete = $db_query->Query("update impact_user set active_status=1 where user_id='$row_user->user_id'");
  header('location:'.BASEPATH."/settings/?update=1");
 }
 
 if($_GET['deactivate']==1)
 {
  $sql_delete = $db_query->Query("update impact_user set active_status=0 where user_id='$row_user->user_id'");
  header('location:'.BASEPATH."/settings/?update=1");
 }
 
 
 if($_GET['pwd']==1)
 {
  $msg = "<span style='color:green'>Password Changed Successfully</span>";
 }
  if($_GET['update']==1)
 {
  $msg = "<span style='color:green'>Profile Updated Successfully</span>";
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
        
       
         <?php if(isset($msg)){?> <div  id="err_msg"><?=$msg?></div> <?php } ?>
        
        <div class="tab-content">
          <div>
            <h3 class="rs alternate-tab accordion-label">About</h3>
            <div class="tab-pane accordion-content active">
            
              <div class="form form-profile">
                <form action="<?=$_SERVER['PHP_SELF']?>" name="profile" method="post" enctype="multipart/form-data" id="uploadForm">
              
               <h2>Profile Settings</h2>
<br>

                <input type="hidden" name="mode" value="profile" />
                
                   
                   
                    <div class="val"> <label class="lbl" for="txt_name1" style="margin-right:75px;">Name:</label>
                      <input class="txt" type="text" id="full_name" value="<?=$row_user->full_name?>" name="full_name" >
                     
                    </div>
                    <span id="name_err" style="color:red"></span><br>

         
         
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
                      
                      
                  <div class="val">
              
                  
                 
                    <label class="lbl" for="txt_bio">Profile Photo:</label>
                   
                  <div id="imgArea" style="    margin-left: 28px;"><img src="<?=$profile_image?>">
                    
                          <div class="progressBar">
                            <div class="bar"></div>
                            <div class="percent">0%</div>
                          </div>
                          <div id="imgChange"><span>Change Profile Photo</span>
                            <input type="file" accept="image/*" name="image_upload_file" id="image_upload_file">
                          </div>
                  
                  </div>
        
        
                  </div>
                  <br>

                  
                    <div class="val"> <label class="lbl" for="txt_name1">About You:</label>
                      <textarea  class="form-control" name="about_you" id="about_you" parsley-trigger="change"  > <?=trim(stripslashes($row_user->about_you))?>
                              </textarea>
                              
                              <script>
	CKEDITOR.replace('about_you',{
                       
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
                  
                  
                  
                  
                  
                  <br />

                 
                   <button class="btn btn-red btn-submit-all " id="update" type="submit">Update</button>
            
                </form>
              </div>
              
              
              <div class="form form-profile">
                <form action="<?=$_SERVER['PHP_SELF']?>" name="profile" method="post" enctype="multipart/form-data">
              
               <h2>Change Password</h2>
<br>

                <input type="hidden" name="mode" value="change_password" />
                
                   
                   
                    <div class="val"> <label class="lbl" for="txt_name1" style="margin-right:129px;">Password:</label>
                      <input class="txt" type="password" id="password" value="" name="password" >
                     
                    </div> <span id="password_err" style="color:red"></span>
                    <br>

                       <div class="val"> <label class="lbl" for="txt_name1" style="margin-right:75px;">Confirm Password:</label>
                   <input class="txt" type="password" id="cpassword" value="" name="cpassword" >
                     
                    </div>
          <span id="cpassword_err" style="color:red"></span>
                    
                  <br />

                 
                   <button class="btn btn-red btn-submit-all " id="log">Change Password </button>
            
                </form>
              </div>
              
              
              <div class="form form-profile">
              
              
               <h2>Delete Account</h2>
               <p>Careful! This will permanently disable your account. You won't be able to log in again after you do this.</p>
<br>
               
                   <button class="btn btn-red btn-submit-all " id="del" >Delete Account </button>
            
           
              </div>
              
              <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog  modal-dialog-centered">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
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
</div>
              
              <?php if($row_user->active_status==1) {?>
              
             <div class="form form-profile">
              
              
               <h2>Deactivate Account</h2>
               <p> This will deactivate your account temporarily. You will not appear on search any more. You can activate your account at anytime.</p>
<br>
               
                   <button class="btn btn-red btn-submit-all " id="deactivate" >Deactivate Account </button>
            
           
              </div> 
              <?php } else {?>
              
              <div class="form form-profile">
              
              
               <h2>Activate Account</h2>
               <p> This will activate your account. You will be appear on search.</p>
<br>
               
                   <button class="btn btn-red btn-submit-all " id="activate" >Activate Account </button>
            
           
              </div> 
              <?php } ?>
              
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
	    setTimeout(function(){ $("#password_err").fadeOut(); }, 3000);
	    $("#password").focus();
	    return false; 
	} 
	if(cpassword=="")
	{ 
	    $("#cpassword_err").fadeIn().html("Confirm Password Required");
	    setTimeout(function(){ $("#cpassword_err").fadeOut(); }, 3000);
	    $("#cpassword").focus();
	    return false; 
	} 
	if(password!==cpassword)
	{ 
	    $("#cpassword_err").fadeIn().html("Password Not Matched");
	    setTimeout(function(){ $("#cpassword_err").fadeOut(); }, 3000);
	    $("#cpassword").focus();
	    return false; 
	} 
});

  $("#update").click(function(){

	var full_name = $("#full_name").val();
	
	if(full_name=="")
	{ 
	    $("#name_err").fadeIn().html("Name Required");
	    setTimeout(function(){ $("#name_err").fadeOut(); }, 3000);
	    $("#full_name").focus();
	    return false; 
	} 

});

  $("#del").click(function(){
  $('#myModal').modal();
  var result = confirm("Want to delete?");
if (result) {
    //window.location.href="<?=BASEPATH?>/profile_edit.php?delete=1";
	//$('#myModal').modal('show'); 
	$('#myModal').modal();
}
else {
    return false;
}
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
				    window.location.href="<?=BASEPATH?>/profile_edit.php?delete=1";
				   }
					
                 
					 

                }
            });
        }
   
	
 
});


  $("#activate").click(function(){
 
    window.location.href="<?=BASEPATH?>/profile_edit.php?activate=1";

});

  $("#deactivate").click(function(){
  var result = confirm("Want to deactivate?");
if (result) {
    window.location.href="<?=BASEPATH?>/profile_edit.php?deactivate=1";
}
else {
    window.location.href="<?=BASEPATH?>/settings/";
}
});



});




</script>

<script src="<?=BASEPATH?>/image_upload_js/jquery.form.js"></script>
<script>
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


</script>


</body>
</html>
