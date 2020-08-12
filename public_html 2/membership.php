<?php include('admin_path.php'); 
include('include/access.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
?>
<?php
$image_save_folder = "user";

$page_title = "My Pacts | ".PROJECT_TITLE;

if(strlen($row_user->cover_image_path)>0)
 $cover_image = IMAGEPATH.$row_user->cover_image_path;
else
 $cover_image = IMAGEPATH.'background.jpg'; 


if(strlen($row_user->image_path)>0)
 $user_image = IMAGEPATH.$row_user->image_path;
else
 $user_image = IMAGEPATH.'icon_man.png'; 

$ids = $db_query->get_ids_sql($row_user->user_id);

if (isset($_REQUEST['id'])) {
  $tier_id = $_REQUEST['id'];

  $row_payment = $db_query->fetch_object("select subscription_id sub_id from impact_payment where tier_id='".$tier_id."' and user_id in $ids and (status='authenticated' or status='active')");
  if (!empty($row_payment) and !empty($row_payment->sub_id) and $row_payment->sub_id){
    $api = new Api($razorpay_id, $razorpay_secret);
    $subscription = $api->subscription->fetch($row_payment->sub_id);
    if (!empty($subscription) and !empty($subscription->status) and $subscription->status != 'cancelled'){
      $subscription->cancel();
      $db_query->runQuery("delete from impact_join where user_id in $ids and tier_id='".$tier_id."'");
      //$db->updateArray("impact_payment", array('status' => 'cancelled'), "tier_id='".$tier_id."' and user_id in $ids and (status='authenticated' or status='active')");
    }
  }

}

$sql1 = "SELECT * FROM impact_payment WHERE user_id IN $ids AND (status='authenticated' OR status='active') GROUP BY transaction_id ORDER BY paid_timestamp DESC";
$sql_rows = $db_query->runQuery($sql1);

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

  <div class="modal fade" id="modalConfirmCancel" tabindex="-1" role="dialog" aria-labelledby="modalConfirmCancelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:400px; margin: 100px auto;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalConfirmCancelLabel">Break my Pact</h5>
        </div>
        <div id="modalConfirmCancelBody" class="modal-body">
          <p>You will no longer have access to any of this creator's Pact-only posts. It might take a couple of minutes for the changes to reflect on the list. Are you sure you want to break this Pact?</p>
        </div>
        <div class="modal-footer">
          <button id="yes-cancel" type="button" class="btn btn-secondary">Yes</button>
          <button id="dont-cancel" type="button" class="btn btn-primary" style="color:#fff;" data-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>

  <div class="container" style="padding-bottom: 50px;">
        <div class="col-md-12">
            <div class="layout-12cols">
        <div class="content grid_12">
            <div class="project-detail">
  <h2 style="color: #455058; margin: 72px 0 0 28px">My Pacts</h2>
  <table class="my-pacts-table" style="width: 100%; margin: 38px 0 0 28px; position:relative; background: white; border: 1px solid #ddd; border-radius: 5px; border-collapse: separate; table-layout: fixed;">
    <style type="text/css">
      th, td {
        padding: 18px;
      }

      td{
        border-top: 1px solid #ddd;
        word-break: break-word;
      }
    </style>
    <tr>
      <th><h3>Creator</h3></th>
      <th><h3>Pact</h3></th>
      <th><h3>Amount</h3></th>
      <th><h3>Join Date</h3></th>
      <th style="text-align: center;"><h3>Cancel</h3></th>
    </tr>
    <?php foreach ($sql_rows as $row_subscription) {
      $creator = $db_query->fetch_object("select impact_name name, slug from impact_user where user_id='".$row_subscription['creator_id']."'");
      $pact_title = $db_query->fetch_object("select tier_name title from impact_tier where tier_id='".$row_subscription['tier_id']."'");
      $join_date = $db_query->fetch_object("select min(paid_timestamp) t from impact_payment where creator_id='".$row_subscription['creator_id']."' and user_id in $ids and (status='authenticated' OR status='active' OR status='completed')");

      if (empty($creator->name)) $creator->name="Deleted User";
      if (empty($pact_title->title)) $pact_title->title="Deleted Pact";

      if (strlen($creator->slug)<=0){
        $user1_path = BASEPATH.'/profile/u/'.$row_subscription['creator_id'].'/';
      }else{
        $user1_path = BASEPATH.'/profile/'.$creator->slug.'/';
      }
    ?>
      <tr>
        <td style="curson:pointer;" onclick="location.href='<?=$user1_path?>';"><?=$creator->name?></td>
        <td><?=$pact_title->title?></td>
        <td><?=$row_subscription['paid_amount']?></td>
        <td><?=$join_date->t?></td>
        <td style="text-align: center;"><a class="join_btn cancel" id="<?=$row_subscription['tier_id']?>" style="cursor:pointer">Cancel</a></td>
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="<?=BASEPATH?>/image_upload_js/jquery.form.js"></script>

<script type="text/javascript">

$(".cancel").on('click', function(event){
  var tier_id = event.target.id;
  var myModal = $("#modalConfirmCancel");

  myModal.modal('show');

  $("#yes-cancel").on('click', function(event){
    window.location.replace("https://www.impactme.in/my-pacts?id="+tier_id+"");
  });
});
</script>

</div>

</body>
</html>
