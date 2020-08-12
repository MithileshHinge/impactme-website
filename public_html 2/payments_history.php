<?php include('admin_path.php'); 
include('include/access.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
?>
<?php
$image_save_folder = "user";

$page_title = "Payments History | ".PROJECT_TITLE;

if(strlen($row_user->cover_image_path)>0)
 $cover_image = IMAGEPATH.$row_user->cover_image_path;
else
 $cover_image = IMAGEPATH.'background.jpg'; 


if(strlen($row_user->image_path)>0)
 $user_image = IMAGEPATH.$row_user->image_path;
else
 $user_image = IMAGEPATH.'icon_man.png'; 
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

  <div class="container" style="padding-bottom: 50px;">
        <div class="col-md-12">
            <div class="layout-12cols">
        <div class="content grid_12">
            <div class="project-detail">
  <h2 style="color: #455058; margin: 72px 0 0 28px">My Payment History</h2>

              <br><br>

              <h4 style="margin: 0 28px;">Monthly Payments</h4>
              
              <br>

              <?php
              $ids = $db_query->get_ids_sql($row_user->user_id);
              //$all_payments = $db_query->fetch_object("SELECT a.*, 'monthly' AS table_type FROM impact_payment a UNION ALL SELECT b.*, 'onetime' AS table_type FROM impact_pay_onetime b WHERE (a.creator_id IN '$ids' AND (a.status='authenticated' OR a.status='active')) OR (b.creator_id IN '$ids' AND b.status='success')");
              $monthly_payments = $db_query->runQuery("SELECT * FROM impact_payment WHERE user_id IN $ids AND (status='authenticated' OR status='active' OR status='completed') GROUP BY transaction_id ORDER BY paid_timestamp DESC");
              $onetime_payments = $db_query->runQuery("SELECT * FROM impact_pay_onetime WHERE user_id IN $ids AND status='success' GROUP BY transaction_id ORDER BY paid_timestamp DESC");
              ?>
              <table style="width: 100%; margin: 38px 0 0 28px; position:relative; background: white; border: 1px solid #ddd; border-radius: 5px; border-collapse: separate; table-layout: fixed;">
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
                <th><h4>Creator</h4></th>
                <th><h4>Pact</h4></th>
                <th><h4>Amount (₹)</h4></th>
                <th><h4>Date</h4></th>
                <th><h4>Transaction ID</h4></th>
                <!--th style="text-align: center;"><h3>Cancel</h3></th-->
              </tr>
              <?php foreach ($monthly_payments as $row_payment) {
                $creator = $db_query->fetch_object("select impact_name name from impact_user where user_id='".$row_payment['creator_id']."'");
                $pact_title = $db_query->fetch_object("select tier_name title from impact_tier where tier_id='".$row_payment['tier_id']."'");

                if (empty($creator->name)) $creator->name="Deleted User";
                if (empty($pact_title->title)) $pact_title->title="Deleted Pact";
              ?>
                <tr>
                  <td><?=$creator->name?></td>
                  <td><?=$pact_title->title?></td>
                  <td><?=$row_payment['paid_amount']?></td>
                  <td><?=$row_payment['paid_timestamp']?></td>
                  <td><?=$row_payment['transaction_id']?></td>
                  <!--td style="text-align: center;"><a class="join_btn cancel" id="<?=$row_subscription['tier_id']?>" style="cursor:pointer">Cancel</a></td-->
                </tr>
              <?php } ?>
              </table>

              <br><br><br>

              <h4 style="margin: 0 28px;">One-time Payments</h4>

              <br>
              
              <table style="width: 100%; margin: 38px 0 0 28px; position:relative; background: white; border: 1px solid #ddd; border-radius: 5px; border-collapse: separate; table-layout: fixed;">
              <tr>
                <th><h4>Creator</h4></th>
                <th><h4>Post Title</h4></th>
                <th><h4>Amount (₹)</h4></th>
                <th><h4>Date</h4></th>
                <th><h4>Transaction ID</h4></th>
                <!--th style="text-align: center;"><h3>Cancel</h3></th-->
              </tr>
              <?php foreach ($onetime_payments as $row_payment) {
                $creator = $db_query->fetch_object("select impact_name name from impact_user where user_id='".$row_payment['creator_id']."'");
                $post_title = $db_query->fetch_object("select post_title title from impact_post where post_id='".$row_payment['post_id']."'");

                if (empty($creator->name)) $creator->name="Deleted User";
                if (empty($post_title->title)) $post_title->title="Deleted Post";
              ?>
                <tr>
                  <td><?=$creator->name?></td>
                  <td><?=$post_title->title?></td>
                  <td><?=$row_payment['paid_amount']?></td>
                  <td><?=$row_payment['paid_timestamp']?></td>
                  <td><?=$row_payment['transaction_id']?></td>
                  <!--td style="text-align: center;"><a class="join_btn cancel" id="<?=$row_subscription['tier_id']?>" style="cursor:pointer">Cancel</a></td-->
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

<!--script type="text/javascript">

$(".cancel").on('click', function(event){
  var tier_id = event.target.id;
  var myModal = $("#modalConfirmCancel");

  myModal.modal('show');

  $("#yes-cancel").on('click', function(event){
    window.location.replace("https://www.impactme.in/my-subscriptions?id="+tier_id+"");
  });
});
</script-->

</div>

</body>
</html>
