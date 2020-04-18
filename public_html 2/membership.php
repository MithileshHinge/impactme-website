<?php include('admin_path.php'); 
include('include/access.php');
?>
<?php
$image_save_folder = "user";

$page_title = "Explore Creator | ".PROJECT_TITLE;

if(strlen($row_user->cover_image_path)>0)
 $cover_image = IMAGEPATH.$row_user->cover_image_path;
else
 $cover_image = IMAGEPATH.'background.jpg'; 


if(strlen($row_user->image_path)>0)
 $user_image = IMAGEPATH.$row_user->image_path;
else
 $user_image = IMAGEPATH.'icon_man.png'; 
 $sql1 = "select * from impact_user where status= 1 and review_status=1 and user_type='ucreate' ";

$sql_rows = $db_query->runQuery($sql1);

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

<div class="col-md-12 user-photo" style="background-image:url(<?=IMAGEPATH?>header-bg-1.png)" >
  <p class="gio" style="top:50%; left:25%; color:rgb(36, 30, 18)"> There are a million ways to use impactMe</p>
</div>
<div class="clr"></div>
<div class="clr"></div>
<section style="background-color: white;">
  <div class="container become-conter">
    <div class="col-md-12 ">
    <?php foreach($sql_rows as $row_post){?>
      <div class="col-md-4 "  >
        <div class="colcss">
          <div display="flex" class="sc-cSHVUG bmaBYi">
            <div display="block" ><img src="<?=IMAGEPATH.$row_post['image_path']?>" style="width:100px;" /></div>
            <div class="sc-cSHVUG jojKnz"><span color="dark" class="sc-htpNat fucUEQ"><?=$row_post['full_name']?></span></div>
          </div>
          <p class="faccio-become"><?=$row_post['about_page']?></p>
          <a href="#" class="select-become-tier" >See All Tiers</a></div>
      </div>
      <?php }?>
    </div>
  </div>
</section>


<?php include('include/footer.php');
include('include/footer_js.php');?>


</div>

</body>
</html>
