<?php include('admin_path.php'); 
include('include/access.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
?>
<?php
$image_save_folder = "user";

$page_title = "My Subscriptions | ".PROJECT_TITLE;

if(strlen($row_user->cover_image_path)>0)
 $cover_image = IMAGEPATH.$row_user->cover_image_path;
else
 $cover_image = IMAGEPATH.'background.jpg'; 


if(strlen($row_user->image_path)>0)
 $user_image = IMAGEPATH.$row_user->image_path;
else
 $user_image = IMAGEPATH.'icon_man.png'; 


if (isset($_REQUEST['id'])) {
  $tier_id = $_REQUEST['id'];
  $row_payment = $db_query->fetch_object("select subscription_id sub_id from impact_payment where tier_id='".$tier_id."' and user_id='".$row_user->user_id."' and (status='authenticated' or status='active')");
  if (!empty($row_payment) and !empty($row_payment->sub_id) and $row_payment->sub_id){
    $api = new Api($razorpay_id, $razorpay_secret);
    $subscription = $api->subscription->fetch($row_payment->sub_id);
    $subscription->cancel();
    $db_query->runQuery("delete from impact_join where user_id='".$row_user->user_id."' and tier_id='".$tier_id."'");
    $db->updateArray("impact_payment", array('status' => 'cancelled'), "tier_id='".$tier_id."' and user_id='".$row_user->user_id."' and (status='authenticated' or status='active')");
  }

}

$sql1 = "select * from impact_join where user_id='".$row_user->user_id."' order by join_date";

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
  <div class="container" style="padding-bottom: 50px;">
        <div class="col-md-12">
            <div class="layout-12cols">
        <div class="content grid_12">
            <div class="project-detail">
  <h2 style="color: #455058; margin: 72px 0 0 28px">My Subscriptions</h2>
  <table style="width: 100%; margin: 38px 0 0 28px; position:relative; background: white; border: 1px solid #ddd; border-radius: 5px; border-collapse: separate; table-layout: fixed;">
    <style type="text/css">
      th, td {
        padding: 18px;
      }

      td{
        border-top: 1px solid #ddd;
      }
    </style>
    <tr>
      <th><h3>Creator</h3></th>
      <th><h3>Pact</h3></th>
      <th><h3>Amount</h3></th>
      <th><h3>Date</h3></th>
      <th style="text-align: center;"><h3>Cancel</h3></th>
    </tr>
    <?php foreach ($sql_rows as $row_subscription) {
      $creator = $db_query->fetch_object("select full_name name, slug from impact_user where user_id='".$row_subscription['creator_id']."'");
      $pact_title = $db_query->fetch_object("select tier_name title from impact_tier where tier_id='".$row_subscription['tier_id']."'");

      if (strlen($creator->slug)<=0){
        $user1_path = BASEPATH.'/profile/u/'.$row_subscription['creator_id'].'/';
      }else{
        $user1_path = BASEPATH.'/profile/'.$creator->slug.'/';
      }
    ?>
      <tr>
        <td style="curson:pointer;" onclick="location.href='<?=$user1_path?>';"><?=$creator->name?></td>
        <td><?=$pact_title->title?></td>
        <td><?=$row_subscription['tier_price']?></td>
        <td><?=$row_subscription['join_date']?></td>
        <td style="text-align: center;"><a href="<?=BASEPATH.'/my-subscriptions?id='.$row_subscription['tier_id']?>" class="join_btn">Cancel</a></td>
      </tr>
    <?php } ?>
  </table>
</div><!--end: .project-tab-detail -->
            </div>
        </div><!--end: .content -->
        </div>
    </div>

<!--div class="col-md-12 user-photo" style="background-image:url(<?=IMAGEPATH?>header-bg-1.png)" >
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
</section-->


<?php include('include/footer.php');
include('include/footer_js.php');?>


</div>

</body>
</html>
