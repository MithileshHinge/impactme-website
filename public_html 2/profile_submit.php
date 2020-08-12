<?php include('admin_path.php'); 
include('include/access.php');
?>
<?php
$image_save_folder = "user";

if($row_user->review_submit_status==0)
 $page_title = "Submit For Review | ".PROJECT_TITLE;
 else
  $page_title = "Review Status | ".PROJECT_TITLE;

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
  	$_REQUEST['review_submit_status'] = 1;
	
$_REQUEST['review_submit_date'] = date('Y-m-d H:i:s');
 $db->updateArray("impact_user",$_REQUEST,"user_id=".$row_user->user_id);
 header('location:'.BASEPATH.'/edit/review/');
 
 
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
           <?php if($row_user->review_submit_status==0) {?>
             <h2 class="excited" style="text-align:center">Are you ready to submit for review?</h2>
              <p class="goal">Reviews usually take minutes, although some content takes up to 3 days to review. Once approved, your page will be launched automatically.</p>
                 <div class="form form-profile">
                  <h2>Required to submit for review:</h2>
                  <form action="<?=$_SERVER['PHP_SELF']?>" name="profile" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="mode" value="profile" />
               <?php if(isset($msg)){?> <div  id="err_msg"><?=$msg?></div> <?php } ?>
                
                 <?php 
				 if(strlen($row_user->image_path)>0) 
				  { 
					   $profile_image = 1;
					   $profile_color = "green";
					   $profile_icon = "check"; 
				  } 
				  else 
				  {
				       $profile_image = 0;
				       $profile_color = "red";
				       $profile_icon = "ban";
			      }
				   if(strlen($row_user->cover_image_path)>0) 
				   {
				       $cover_image = 1;
					   $cover_color = "green";
					   $cover_icon = "check"; 
				   }
				    else 
				  {
				       $cover_image = 0;
				       $cover_color = "red";
				       $cover_icon = "ban";
			      }
				   
				   if(strlen($row_user->about_page)>0) 
				   {
				       $about_image = 1;
					   $about_color = "green";
					   $about_icon = "check"; 
				   }
				    else 
				  {
				       $about_image = 0;
				       $about_color = "red";
				       $about_icon = "ban";
			      }
           
				   
				   
				   ?>
				   
                  <div class="row-item clearfix">
                    <label class="lbl" style="width:100%; text-align:left !important; color:<?=$profile_color?>" for="txt_location"><i class="fa fa-<?=$profile_icon?>"></i> Upload Profile Picture</label>
                    </div>
                    
                      <div class="row-item clearfix">
                     <label class="lbl" style="width:100%; text-align:left !important; color:<?=$cover_color?>" for="txt_location"><i class="fa fa-<?=$cover_icon?>"></i> Upload Cover Image</label>
                    </div>
                    
                      <div class="row-item clearfix">
                     <label class="lbl" style="width:100%; text-align:left !important; color:<?=$about_color?>" for="txt_location"><i class="fa fa-<?=$about_icon?>"></i> Create About Section</label>
                    </div>
                    
                     <button class="btn join_btn btn-submit-all newtier" style="float:left" <?php if($profile_image==0 || $cover_image==0 || $about_image==0 ) {?> disabled="disabled"<?php } ?>>Submit For Review </button>
                     <a href="<?=BASEPATH?>/edit/" class="btn join_btn btn-submit-all newtier" style="float:left; margin-left:15px;">Edit My Page</a>
                   <br />
<br />
   </form>
                  </div>
             <?php } else {?> 
             
             <h2 class="excited" style="text-align:center; color:green">Your page is under review</h2>
              <p class="goal">As we do with all new creator pages, we're reviewing your page to make sure it meets our guidelines. We're working as fast as we can and will send you an email when your page has been approved.</p>
             <br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />

               <?php } ?>   
                  <div class="row-item clearfix">
                  
                   
                  </div>
                  <div class="row-item clearfix">&nbsp;</div>
             
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
