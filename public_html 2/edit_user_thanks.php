<?php include('admin_path.php'); 
include('include/access.php');
?>
<?php
$image_save_folder = "user";
$page_title = "Thanks | ".PROJECT_TITLE;

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
  	

 $db->updateArray("impact_user",$_REQUEST,"user_id=".$row_user->user_id);
 header('location:'.BASEPATH.'/edit/thanks?msg=1');
 }

 if($_GET[msg]==1)
{
  $msg = "Thanks message updated successfully.";
  $error_type = "success";
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

<body class="body-bg">
<div id="wrapper" style="background-image:url(<?=BASEPATH?>/images/setting-back.jpg); ">
<?php include('include/header.php'); ?>

<div class="layout-2cols">
  <div class="content grid_12">
    <div class="project-detail">
      <div class="project-tab-detail tabbable accordion edit-about">
       <?php include('include/user_menu.php');?>
        
        
        
        <div class="tab-content">
          <div>
            <h3 class="rs alternate-tab accordion-label">Thanks</h3>
            <div class="tab-pane accordion-content active">
             <h2 class="excited">How do you want to thank your supporters?</h2>
                <p class="goal">How amazing would it be if your supporters got a personal, secret thank you from you when they make a Pact with you? Don't worry, this text isn't required in order to launch. You can come back to this at any time.</p>
              <div class="form form-profile"  id="thank-data">
                <form action="<?=$_SERVER['PHP_SELF']?>" name="profile" method="post" enctype="multipart/form-data">
                <input type="hidden" name="mode" value="profile" />
                 
                  <div class="row-item clearfix">
                    <label class="lbl" style="width:100%; text-align:left !important;" for="txt_location">Your Thanks Message:</label>
                  
                  <br>
<br>

                    <div class="val" style="    margin: 28px 0 0 0;">
                     <textarea  class="form-control" name="thanks_message" id="thanks_message" parsley-trigger="change"  style="height: 200px;"><?=trim(stripslashes($row_user->thanks_message))?></textarea>
                              
                              <!--script>
	CKEDITOR.replace('thanks_message',{
                       
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
                   
                  </div>
                 
                  <div class="row-item clearfix">
                  
                    <button class="btn btn-submit-all newtier">Save all </button>
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

<?php if(isset($msg)){?>
    <div class="fixed-top d-flex justify-content-center">
    <div class="alert alert-<?=$error_type?> fade in" style="width:fit-content; margin-top:67px;" role="alert" id="save-success-alert">
      <?=$msg?>
    </div>
    </div>
    <?php } ?>


<?php include('include/footer.php');
include('include/footer_js.php');?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


</div>
<script type="text/javascript">
  $(document).ready(function() {
   setTimeout(function () {
      $("#save-success-alert").alert('close');
    }, 4000);
  });
 
</script>




</body>
</html>
