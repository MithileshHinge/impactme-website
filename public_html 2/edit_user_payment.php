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
 header('location:'.BASEPATH.'/edit/payment/');
 
 
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
    margin: 6px 0 20% 0px;
}
	
	</style>
</head>

<body>
<div id="wrapper" style="background-image:url(<?=BASEPATH?>/images/setting-back.jpg); ">
<?php include('include/header.php'); ?>

<div class="layout-2cols">
  <div class="content grid_12">
    <div class="project-detail">
      <div class="project-tab-detail tabbable accordion edit-about">
       <?php include('include/user_menu.php');?>
        
        
        <div class="tab-content">
          <div>
            <h3 class="rs alternate-tab accordion-label">Payment</h3>
            <div class="tab-pane accordion-content active">
             
              <div class="form form-profile" style="left:48px;">
                <form action="<?=$_SERVER['PHP_SELF']?>" name="profile" method="post" enctype="multipart/form-data">
                 <?php if(isset($msg)){?> <div  id="err_msg"><?=$msg?></div> <?php } ?>
                  <input type="hidden" name="mode" value="profile" />
                 
                    <div class="row-item clearfix">
                      <label class="lbl" for="txt_name1">Bank Name :</label>
                        <div class="val">
                          <input class="txt" type="text" name="bank_name" value="<?=$row_user->bank_name?>"  >
                        </div>
                    </div>
                    
                    <div class="row-item clearfix">
                      <label class="lbl" for="txt_name1">Bank Holder Name :</label>
                        <div class="val">
                          <input class="txt" type="text" name="bank_holder_name"  value="<?=$row_user->bank_holder_name?>" >
                        </div>
                    </div>
                    
                    <div class="row-item clearfix">
                        <label class="lbl" for="txt_name1">Account Number :</label>
                        <div class="val">
                          <input class="txt" type="number" name="account_number" value="<?=$row_user->account_number?>" >
                        </div>
                    </div>
                    
                     <div class="row-item clearfix">
                        <label class="lbl" for="txt_name1">IFSC Code :</label>
                        <div class="val">
                          <input class="txt" type="text" name="ifsc_code" value="<?=$row_user->ifsc_code?>" >
                        </div>
                    </div>
                    
                     <div class="row-item clearfix">
                        <label class="lbl" for="txt_name1">UPI Id :</label>
                        <div class="val">
                          <input class="txt" type="text" name="upi_id"  value="<?=$row_user->upi_id?>">
                        </div>
                    </div>
           
                  
                  <br>

                  </div>
                 
                  <div class="row-item clearfix">
                  
                    <button class="btn  btn-submit-all newtier" id="tier-submit" style="background-color:#3a9cb5" >Submit</button>
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
