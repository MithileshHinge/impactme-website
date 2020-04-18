<?php include('admin_path.php'); 
//include('include/access.php');
?>
<?php
$image_save_folder = "user";

$s = $_GET['s'];
$page_title = "Search Result | ".PROJECT_TITLE;

if(strlen($row_user->cover_image_path)>0)
 $cover_image = IMAGEPATH.$row_user->cover_image_path;
else
 $cover_image = IMAGEPATH.'background.jpg'; 


if(strlen($row_user->image_path)>0)
 $user_image = IMAGEPATH.$row_user->image_path;
else
 $user_image = IMAGEPATH.'icon_man.png'; 

$sql = "select count(*) c from impact_user where status= 1 and review_status=1  and active_status=1 and user_type='ucreate' and (full_name like '%$s%' or impact_name  like '%$s%')";
$sql1 = "select * from impact_user where status= 1 and active_status=1 and review_status=1 and user_type='ucreate' and (full_name like '%$s%' or impact_name  like '%$s%')";
$sql_count = $db_query->fetch_object($sql);
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

<div class="layout-2cols">
        <div class="content grid_12">
            <div class="search-result-page">
                <div class="top-lbl-val" style="    margin-top: 53px;">
                    <h3 class="common-title"> <span class="fc-orange">Search</span></h3>
                    <div class="count-result">
                        <span class="fw-b fc-black"><?=$sql_count->c;?></span> creator found for “<span class="fw-b fc-black"><?=$s?></span>”
                    </div>
                    <!--<div class="confirm-search">Were you looking for projects in <a href="#" class="fw-b be-fc-orange">Crafts</a>?</div>-->
                </div>
                <div id="list-search-ajax" class="list-project-result">
                    <?php foreach($sql_rows as $row_post) {
					$image_post = IMAGEPATH.$row_post['image_path'];
					if(strlen($row_post['slug'])>0) 
					 $path = BASEPATH.'/profile/'.$row_post['slug']."/";
					else
					 $path = BASEPATH.'/profile/u/'.$row_post['user_id']."/";
					 
					 
					if(strlen($row_post['image_path'])>0)
				    {
					if (@file_get_contents($image_post, 0, NULL, 0, 1)) 
					 {
					 $image_post = IMAGEPATH.$row_post['image_path'];
					 }
					 else
					 {
					   $image_post = IMAGEPATH.'nouser.png'; 
					 }
					 }
					else
					 $image_post = IMAGEPATH.'nouser.png'; 
					 
					 
					 
					?> 
                     <div class="project-short larger">
                  
                        <div class="top-project-info">
                            <div class="content-info-short clearfix">
                                <a href="<?=$path?>" class="thumb-img" style="background-size:cover;">
                                    <img src="<?=$image_post?>"  alt="<?=$row_post['full_name']?>" style="width:100px">
                                </a>
                                <div class="wrap-short-detail">
                                    <h3 class="rs acticle-title"><a class="be-fc-orange" href="<?=$path?>"><?=$row_post['full_name']?></a></h3>
                                    <!--<p class="rs tiny-desc">by <a href="#" class="fw-b fc-gray be-fc-orange">Ray Sumser</a> in <span class="fw-b fc-gray">New York, NY</span></p>-->
                                    <p class="rs title-description"><?=$row_post['tag_line']?></p>

                                </div>
                                <p class="rs clearfix comment-view">
                                    <a href="<?=$path?>" class="fc-gray be-fc-orange">75 Patrons</a>
                                   <!-- <span class="sep">|</span>
                                    <a href="#" class="fc-gray be-fc-orange">378 views</a>-->
                                </p>
                            </div>
                        </div>
                  
                        
                    </div>
                        <?php } ?>
                </div>
                <!--<p class="rs ta-c">
                    <a id="showmoreresults" class="btn btn-black btn-load-more" href="#">Show more projects</a>
                </p>-->
            </div><!--end: .search-result-page -->
        </div><!--end: .content -->
     
    </div>


</div>
<?php include('include/footer.php');
include('include/footer_js.php');?>


</div>



</body>
</html>
