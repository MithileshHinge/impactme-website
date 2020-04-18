<?php include('admin_path.php'); 
include('include/access.php');
?>
<?php
$image_save_folder = "user";
$page_title = "Payment | ".PROJECT_TITLE;
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
 header('location:'.BASEPATH.'/edit/thanks/');
 
 
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
          <li ><a href="<?=BASEPATH?>/edit/about/">About</a></li>
          <li><a href="<?=BASEPATH?>/edit/tiers/" class="be-fc-orange">Tiers</a></li>
          <li><a href="<?=BASEPATH?>/edit/goals/" class="be-fc-orange">Goals</a></li>
          <li ><a href="<?=BASEPATH?>/edit/thanks/" class="be-fc-orange">Thanks</a></li>
          <li class="activet" ><a href="<?=BASEPATH?>/edit/payment/" class="be-fc-orange">Payment</a></li>
         <?php if($row_user->review_status==1) {?>
          <li ><a href="<?=BASEPATH?>/edit/post/" class="be-fc-orange">Manage Your Post</a></li>
          <?php } ?>
           <?php if($row_user->review_status==0) {?>
          <li ><a href="<?=BASEPATH?>/edit/review/" class="submit_review"><?php if($row_user->review_submit_status==0) {?>Submit for review<?php }else { ?> Review Status <?php } ?></a></li>
          <?php } ?>
        </ul>
        
        
        
        <div class="tab-content">
          <div>
            <h3 class="rs alternate-tab accordion-label">Payment</h3>
            <div class="tab-pane accordion-content active">
             
              <div class="form form-profile">
                <form action="<?=$_SERVER['PHP_SELF']?>" name="profile" method="post" enctype="multipart/form-data">
               <?php if(isset($msg)){?> <div  id="err_msg"><?=$msg?></div> <?php } ?>
                <input type="hidden" name="mode" value="profile" />
                 
                  <div class="row-item clearfix">
                    <label class="lbl" style="width:100%; text-align:left" for="txt_location">Payment Schedule:</label>
                  
                  <br>
<br>

                    <!--<div class="val" style="    margin: 28px 0 0 0;">
                     <textarea  class="form-control" name="thanks_message" id="thanks_message" parsley-trigger="change"  > <?=trim(stripslashes($row_user->thanks_message))?>
                              </textarea>
                              
                              <script>
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
</script>
                    </div>-->
                   
                  </div>
                 
                  <div class="row-item clearfix">
                  
                   <!-- <button class="btn btn-red btn-submit-all newtier">Save  </button>-->
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
  $(document).ready(function() {
   setTimeout(function(){ $("#err_msg").fadeOut(); }, 3000);
  });
 
</script>




</body>
</html>
