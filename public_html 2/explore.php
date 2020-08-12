<?php include('admin_path.php'); 
//include('include/access.php');

//code from access.php but without stopping non-logged in users
if(isset($_SESSION['is_user_login'])==1)
{

 $user_log = 1;
 $user_id = base64_decode($_SESSION['user_id']);
 $row_user = $db_query->fetch_object("select i.*, count(*) c from impact_user i where i.user_id='".$user_id ."'");
 if($row_user->c!=0)
 {
   $basefile = basename($_SERVER['PHP_SELF']);
   $Cretor_Check = $db_query->creator_check($row_user->email_id);
   if($Cretor_Check->c>0)
   {
     $_SESSION['is_user_login'] = 1;
   $_SESSION['user_id'] = base64_encode( $Cretor_Check->user_id );
   $_SESSION['user_type'] = 1;
   }
 
 if($row_user->user_type=="create")
  $impact_type = "fan";
 else
  $impact_type = "creator"; 
  }
}

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
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<!--meta name="viewport" content="width=device-width, initial-scale=1.0"-->
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

<!--div class="col-md-12 user-photo" style="background-image:url(<?=IMAGEPATH?>header-bg-1.png)" -->
<div class="col-md-12 user-photo body-bg" style="text-align:center;">
  <p class="gio"  id="million-explore">ImpactMe can be used in many ways</p>
</div>
<div class="clr"></div>
<div class="clr"></div>
<section style="background-color: white;padding: 0 0 133px 0;">
    
  <div class="container become-conter">
       <h3 class="creater-title">Creators with exclusive Pacts</h3>
    <div class="col-md-12 " id="exploer-creater">
       
    <?php foreach($sql_rows as $row_post){
		if(strlen($row_post['slug'])>0) 
			$path = BASEPATH.'/profile/'.$row_post['slug']."/";
		else
			$path = BASEPATH.'/profile/u/'.$row_post['user_id']."/";
					 
				 
		
		?>
      <div class="col-md-4 "  id="exploer-creater">
        <div class="colcss">
        <a href="<?=$path?>">
          <div display="flex" class="sc-cSHVUG bmaBYi">
            <div display="block" ><img src="<?=IMAGEPATH.$row_post['image_path']?>" class="exploer-images"></div>
            <div class="sc-cSHVUG jojKnz"><span color="dark" class="sc-htpNat fucUEQ" style="margin: 0 0 0 10px;"><?=$row_post['impact_name']?></span></div>
          </div>
          
          </a>
          <p class="faccio-become">
            <div class="explore-discript" style="height:85px;">  <?=$db_query->truncate($row_post['about_page'], $length=50, $ending="...", $exact=false, $considerHtml = true)?></div>
         <!--     <p class="explore-discript"><?php echo html_entity_decode($db_query->truncate($row_post['about_page'], $length=50, $ending="...", $exact=false, $considerHtml = true))?></p>-->
              </p>
          <a href="<?=$path?>" class="select-become-tier" >see all Pacts</a></div>
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
