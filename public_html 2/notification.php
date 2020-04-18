<?php include('admin_path.php'); 
include('include/access.php');
?>
<?php
$image_save_folder = "user";

$s = $_GET['s'];
$page_title = "All Notification| ".PROJECT_TITLE;

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
                    <h3 class="common-title"> <span class="fc-orange">All Notification</span></h3>
                   
                   
                </div>
                <div id="list-search-ajax" class="list-project-result">
                     <?php $sql_notification_d1 = $db_query->runQuery("select * from impact_notification where user_id='$row_user->user_id' and from_user_id!='$row_user->user_id'  order by notification_id desc ");
			  foreach($sql_notification_d1 as $row_notification_d) {
			  
			  $notify_link = $db_query->get_notification_link($row_notification_d['notification_id']);
			  ?>
                     <div class="project-short larger" >
                  
                        <div class="top-project-info">
                            <div class="content-info-short clearfix">
                               
                                <div class="wrap-short-detail" style="width:100%">
                                    <h3 class="rs acticle-title"><a class="be-fc-orange" href="<?=$notify_link?>"  onclick="javascript:  $.ajax({
                url: '<?=BASEPATH?>/ajax/search_notification.php',
                type: 'post',
                data: {notify_id:<?=$row_notification_d['notification_id']?>},
                dataType: 'json',
                success:function(response){
				 $(this).addClass('inactive_notify').removeClass('active_notify');
               
                }
            });"><?=$row_notification_d['description']?></a></h3>
                                  
                                   

                                </div>
                                <p class="rs clearfix comment-view">
                                    <a href="javascript:void(0)" class="fc-gray be-fc-orange"><?=$db_query->facebook_time_ago($row_notification_d['notify_date'])
									?></a>
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
