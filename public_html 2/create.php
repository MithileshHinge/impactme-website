<?php include('admin_path.php'); 
include('include/access.php');
if($_SESSION['user_type'] == 1)
 header('location:'.BASEPATH.'/edit/about/');
?>
<?php
$image_save_folder = "user";

$page_title = "Become a Creator | ".PROJECT_TITLE;

if(strlen($row_user->cover_image_path)>0)
 $cover_image = IMAGEPATH.$row_user->cover_image_path;
else
 $cover_image = IMAGEPATH.'background.jpg'; 


if(strlen($row_user->image_path)>0)
 $user_image = IMAGEPATH.$row_user->image_path;
else
 $user_image = IMAGEPATH.'icon_man.png'; 
 
 $sql_check_impact = $db_query->creator_check($row_user->email_id);
 if($sql_check_impact->hash_active=="Y" && $sql_check_impact->status==1)
 {
   header('location:'.BASEPATH.'/edit/about/');
 }
 
 
 if($_REQUEST['mode']=="profile")
 {
     $_REQUEST['first_name'] =  $row_user->first_name; 
	 $_REQUEST['last_name'] =  $row_user->last_name; 
	 $_REQUEST['full_name'] =  $row_user->full_name; 
	 $_REQUEST['email_id'] =  $row_user->email_id;
     $_REQUEST['image_path'] =  $row_user->image_path;  
     $_REQUEST['cover_image_path'] =  $row_user->cover_image_path; 
     $_REQUEST['id_number'] = $db_query->id_number_generate("impact_user","id_number",ID_NUMBER);
	 $_REQUEST['password']= $row_user->password;
	 $_REQUEST['registration_date']=date('Y-m-d H:i:s');
	 $_REQUEST['hash']=md5($row_user->email_id);
	 $_REQUEST['hash_active']='Y';
	 $_REQUEST['status']=1;
	 $_REQUEST['user_type']="ucreate";
	 $_REQUEST['reg_type']="user";
	 $_REQUEST['register_ip']=$_SERVER['REMOTE_ADDR'];
	 $verify_link = BASEPATH.'/verify/creator/ucreate/'.$_REQUEST['hash'].'/';
	
	
	 if($db->insertDataArray("impact_user",$_REQUEST))
	 {
	   //$send_mail = $db_query->verification_email($row_user->email_id, EMAIL_FROM , $mail,  $verify_link);
	
	
		  $last_id = mysql_insert_id();
		 $_SESSION['is_user_login'] = 1;
		  $_SESSION['username'] = $row_user->email_id;
		 $_SESSION['user_id'] = base64_encode( $last_id );
		$_SESSION['user_type'] = 1;
         header('location:'.BASEPATH.'/edit/');
		 
		  
     }
 
 }
 
 
 
 if(isset($_GET['resend'])==true)
 {
   $hash = md5($row_user->email_id);
   $verify_link = BASEPATH.'/verify/creator/ucreate/'.$hash.'/';
   if($send_mail = $db_query->verification_email($row_user->email_id, EMAIL_FROM , $mail,  $verify_link))
   {
    header('location:'.BASEPATH.'/create/?send=1');
   }
 }
 if(isset($_GET['send'])==1)
 {
  $msg = "Email Has Been Sent.";
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
  <div class="content grid_12" style="    padding: 0 0 80px 0;">
    <div class="project-detail">
      <div class="project-tab-detail tabbable accordion edit-about">
        
        
        
        
        <div class="tab-content">
          <div>
            <h3 class="rs alternate-tab accordion-label">Become a Creator</h3>
            <div class="tab-pane accordion-content active">
              <div class="form form-profile" style="left:0px;margin:auto;">
              <?php if($sql_check_impact->c==0) {?>
                <form action="<?=$_SERVER['PHP_SELF']?>" name="profile" method="post" enctype="multipart/form-data">
               <?php if(isset($msg)){?> <div  id="err_msg"><?=$msg?></div> <?php } ?>
                <input type="hidden" name="mode" value="profile" />
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_name1" style="text-align: right;padding: 13px 24px 0 0;    width: 265px;">Name of your page:</label>
                    <div class="val">
                      <input class="txt" type="text" id="impact_name" value="" onBlur="setText(this.value)" onKeyUp="setText(this.value)" name="impact_name"  required>
                     
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_location" style="text-align: right;padding: 13px 24px 0 0;    width: 265px;">What are you creating? :</label>
                    <div class="val">
                      <input class="txt" type="text" id="creating_for" value="" onBlur="setWord(this.value)" onKeyUp="setWord(this.value)" name="creating_for" placeholder="e.g. educational videos" required>
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_time_zone" style="text-align: right;padding: 13px 24px 0 0;width:265px">Which sounds correct? :</label>
                    <div class="val">
                   
                      <label style="font-size: 16px;    margin: 9px 0 0 0px;font-weight:500"> <input  type="radio" name="tag_line"  id="tagline1" value="" required>
                     <span id="txt1"></span> <span style="vertical-align: middle;">is creating </span><span id="wrd1"></span></label>
                      <br>
                       <label style="font-size: 16px;    margin: 9px 0 0 0px;font-weight:500;"><input  type="radio" name="tag_line" id="tagline2" value="" >
                     <span id="txt2"></span> <span style="vertical-align: middle;">are creating </span><span id="wrd2"></span></label>
                    </div>
                  </div>
                
               
                  <div class="row-item clearfix">
                  
                    <button class="btn  btn-submit-all newtier" id="creater-submit-new">Submit</button>
                  </div>
                 
                </form>
                
                <?php } else {  ?>
                <?php if(isset($msg)) { ?><span style="color:green" id="emailMsg"><?=$msg?></span><?php } ?>
                <h4>Almost there! We sent a verification email to <?=$row_user->email_id?>.</h4>
                <p>Not seeing your verification email? Double-check your spam folder and review your email filters.</p>
                <p><a href="<?=BASEPATH?>/create/?resend=true" style="color:#0066CC">Resend Verification Link</a></p>
                <?php } ?>
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
