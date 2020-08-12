<?php include('admin_path.php'); 
if(isset($_SESSION['is_user_login'])==1){
include('include/access.php'); }
?>
<?php
$image_save_folder = "user";

$page_title = "Email Verification | ".PROJECT_TITLE;

if(strlen($row_user->cover_image_path)>0)
 $cover_image = IMAGEPATH.$row_user->cover_image_path;
else
 $cover_image = IMAGEPATH.'background.jpg'; 


if(strlen($row_user->image_path)>0)
 $user_image = IMAGEPATH.$row_user->image_path;
else
 $user_image = IMAGEPATH.'icon_man.png'; 

$utype = $_GET['utype'];
$hash = $_GET['slug']; 
$reg_type = $_GET['reg_type'];

$sql_check_slug = $db_query->fetch_object("select count(*) c, i.* from impact_user i where i.hash='$hash' and i.user_type='$utype' and i.hash_active='N'");
if($sql_check_slug->c>0)
{
  $update = $db_query->runQuery("update impact_user set hash_active='Y', status=1 where hash='$hash' and user_type='$utype' and hash_active='N'");
  if($reg_type=="creator")
  {
     $_SESSION['is_user_login'] = 1;
	 $_SESSION['user_id'] = base64_encode( $sql_check_slug->user_id );
	 $_SESSION['user_type'] = 1;
    header('location:'.BASEPATH.'/edit/about/');
  }
  else
  {
    header('location:'.BASEPATH.'/login/?ut='.$utype);
  }
}
else
{
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

<body>
<div id="wrapper">
<?php include('include/header.php'); ?>

<div class="layout-2cols">
  <div class="content grid_12">
    <div class="project-detail">
      <div class="project-tab-detail tabbable accordion edit-about">
        
        
        
        
        <div class="tab-content">
          <div>
            <h3 class="rs alternate-tab accordion-label">Become a Creator</h3>
            <div class="tab-pane accordion-content active">
              <div class="form form-profile">
             
                <h4>Email Verification</h4>
                
              
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



</body>
</html>
