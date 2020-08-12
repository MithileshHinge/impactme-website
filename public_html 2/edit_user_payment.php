<?php include('admin_path.php'); 
include('include/access.php');
?>
<?php
$image_save_folder = "user";
$page_title = "Income | ".PROJECT_TITLE;
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
 header('location:'.BASEPATH.'/edit/payment?msg=1');
 
 }

 if($_GET[msg]==1)
{
  $msg = "Payment details updated.";
  $error_type = "success";
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
    margin: 6px 0 20% 0px;
}

  .arrow-toggle[data-toggle="collapse"]:after{
    font-family: 'FontAwesome';
    content: "\f107";
    /* "play" icon */
    float: right;
    color: #b0c5d8;
    font-size: 18px;
    line-height: 22px;
    /* rotate "play" icon from > (right arrow) to down arrow */
    -webkit-transform: rotate(180deg);
    -moz-transform: rotate(180deg);
    -ms-transform: rotate(180deg);
    -o-transform: rotate(180deg);
    transform: rotate(180deg);
  }

  .arrow-toggle[data-toggle="collapse"].collapsed:after{
    /* rotate "play" icon from > (right arrow) to ^ (up arrow) */
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
	
	</style>
</head>

<body class="body-bg">
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

              <div style="width:80%; margin:auto; padding: 50px 0;">


                <h3>Payout Details</h3>
                <br>

              <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

                <!-- Accordion card -->
                <div class="card shadow-sm bg-white rounded">

                  <!-- Card header -->
                  <div class="shadow-sm bg-white rounded" role="tab" id="headingOne1">
                    <a class="collapsed text-decoration-none arrow-toggle p-3" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="false"
                      aria-controls="collapseOne1" style="width:100%; height:100%; display:block;">
                        Direct Transfer Account <?php if (!empty($row_user->account_number)) echo "(".$row_user->account_number.")";?><!--i class="fas fa-angle-down rotate-icon"></i-->
                    </a>
                  </div>

                  <!-- Card body -->
                  <div id="collapseOne1" class="collapse" role="tabpanel" aria-labelledby="headingOne1" data-parent="#accordionEx">
                    <div class="card-body">

                      <!-- Bank Details Form -->
                      <div class="form form-profile payment-form" style="left: 0px; padding: 16px 0;">
                        <form action="<?=$_SERVER['PHP_SELF']?>" name="profile" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="mode" value="profile" />
                         
                          <div class="row-item clearfix">
                            <label class="lbl" for="txt_name1">Bank Name :</label>
                              <div class="val">
                                <input class="txt" type="text" name="bank_name" value="<?=$row_user->bank_name?>"  required>
                              </div>
                          </div>
                          
                          <div class="row-item clearfix">
                            <label class="lbl" for="txt_name1">Bank Holder Name :</label>
                              <div class="val">
                                <input class="txt" type="text" name="bank_holder_name"  value="<?=$row_user->bank_holder_name?>" required>
                              </div>
                          </div>
                          
                          <div class="row-item clearfix">
                              <label class="lbl" for="txt_name1">Account Number :</label>
                              <div class="val">
                                <input class="txt" type="text" name="account_number" value="" required onKeyPress="JavaScript: return keyRestrict(event,'0123456789');">
                              </div>
                          </div>
                          
                           <div class="row-item clearfix">
                              <label class="lbl" for="txt_name1">IFSC Code :</label>
                              <div class="val">
                                <input class="txt" type="text" name="ifsc_code" value="<?=$row_user->ifsc_code?>" required>
                              </div>
                          </div>
                          <br>
                          <button class="btn  btn-submit-all newtier" id="tier-submit">Update</button>
                          <br>

                        </form>
                      </div>
                      <!-- Bank Details Form -->

                    </div>
                  </div>

                </div>
                <!-- Accordion card -->

                <br>

                <!-- Accordion card -->
                <div class="card shadow-sm bg-white rounded">

                  <!-- Card header -->
                  <div class="shadow-sm bg-white rounded" role="tab" id="headingTwo2">
                    <a class="collapsed text-decoration-none arrow-toggle p-3" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2"
                      aria-expanded="false" aria-controls="collapseTwo2" style="width:100%; height:100%; display:block;">
                        UPI Payment ID <?php if (!empty($row_user->upi_id)) echo "(".$row_user->upi_id.")";?><!--i class="fas fa-angle-down rotate-icon"></i-->
                    </a>
                  </div>

                  <!-- Card body -->
                  <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2" data-parent="#accordionEx">
                    <div class="card-body">
                      


                      <!-- UPI ID Form -->
                      <div class="form form-profile payment-form" style="left: 0px; padding: 16px 0;">
                        <form action="<?=$_SERVER['PHP_SELF']?>" name="profile" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="mode" value="profile" />

                           <div class="row-item clearfix">
                              <label class="lbl" for="txt_name1">UPI ID :</label>
                              <div class="val">
                                <input class="txt" type="text" name="upi_id"  value="<?=$row_user->upi_id?>" required>
                              </div>
                          </div>
                          <br>
                          <br>
                          <button class="btn  btn-submit-all newtier" id="tier-submit">Update</button>
                          <br>
                        </form>
                      </div>
                      <!-- UPI ID Form -->


                    </div>
                  </div>

                </div>
                <!-- Accordion card -->
              </div>
              <!-- Accordion wrapper -->

              <br><br><br><br>

              <h3>Payments from my supporters</h3>

              <br><br>
              <!-- Received payments table -->

              <h4>Monthly Payments</h4>
              
              <br>

              <?php
              $ids = $db_query->get_ids_sql($row_user->user_id);
              //$all_payments = $db_query->fetch_object("SELECT a.*, 'monthly' AS table_type FROM impact_payment a UNION ALL SELECT b.*, 'onetime' AS table_type FROM impact_pay_onetime b WHERE (a.creator_id IN '$ids' AND (a.status='authenticated' OR a.status='active')) OR (b.creator_id IN '$ids' AND b.status='success')");
              $monthly_payments = $db_query->runQuery("SELECT * FROM impact_payment WHERE creator_id IN $ids AND (status='authenticated' OR status='active' OR status='completed') GROUP BY transaction_id ORDER BY paid_timestamp DESC");
              $onetime_payments = $db_query->runQuery("SELECT * FROM impact_pay_onetime WHERE creator_id IN $ids AND status='success' GROUP BY transaction_id ORDER BY paid_timestamp DESC");
              ?>
              <table>
                <style type="text/css">
                td {
                  border: 1px solid #ddd;
                  padding: 18px;
                  word-break: break-word;
                }

                th{
                  border: 1px solid #ddd;
                  padding: 10px;
                }
              </style>
              <tr>
                <th><h5>Supporter Name</h5></th>
                <th><h5>Pact</h5></th>
                <th><h5>Amount (₹)</h5></th>
                <th><h5>Date</h5></th>
                <th><h5>Transaction ID</h5></th>
                <!--th style="text-align: center;"><h3>Cancel</h3></th-->
              </tr>
              <?php foreach ($monthly_payments as $row_payment) {
                $supporter = $db_query->fetch_object("select full_name name from impact_user where user_id='".$row_payment['user_id']."'");
                $pact_title = $db_query->fetch_object("select tier_name title from impact_tier where tier_id='".$row_payment['tier_id']."'");

                if (empty($supporter->name)) $supporter->name="Deleted User";
                if (empty($pact_title->title)) $pact_title->title="Deleted Pact";
              ?>
                <tr>
                  <td><?=$supporter->name?></td>
                  <td><?=$pact_title->title?></td>
                  <td><?=$row_payment['paid_amount']?></td>
                  <td><?=$row_payment['paid_timestamp']?></td>
                  <td><?=$row_payment['transaction_id']?></td>
                  <!--td style="text-align: center;"><a class="join_btn cancel" id="<?=$row_subscription['tier_id']?>" style="cursor:pointer">Cancel</a></td-->
                </tr>
              <?php } ?>
              </table>

              <br><br><br>

              <h4>One-time Payments</h4>

              <br>
              
              <table>
              <tr>
                <th><h5>Supporter Name</h5></th>
                <th><h5>Post Title</h5></th>
                <th><h5>Amount (₹)</h5></th>
                <th><h5>Date</h5></th>
                <th><h5>Transaction ID</h5></th>
                <!--th style="text-align: center;"><h3>Cancel</h3></th-->
              </tr>
              <?php foreach ($onetime_payments as $row_payment) {
                $supporter = $db_query->fetch_object("select full_name name from impact_user where user_id='".$row_payment['user_id']."'");
                $post_title = $db_query->fetch_object("select post_title title from impact_post where post_id='".$row_payment['post_id']."'");

                if (empty($supporter->name)) $supporter->name="Deleted User";
                if (empty($post_title->title)) $post_title->title="Deleted Post";
              ?>
                <tr>
                  <td><?=$supporter->name?></td>
                  <td><?=$post_title->title?></td>
                  <td><?=$row_payment['paid_amount']?></td>
                  <td><?=$row_payment['paid_timestamp']?></td>
                  <td><?=$row_payment['transaction_id']?></td>
                  <!--td style="text-align: center;"><a class="join_btn cancel" id="<?=$row_subscription['tier_id']?>" style="cursor:pointer">Cancel</a></td-->
                </tr>
              <?php } ?>
              </table>




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

<?php if(isset($msg)){?>
    <div class="fixed-top d-flex justify-content-center">
    <div class="alert alert-<?=$error_type?> fade in" style="width:fit-content; margin-top:67px;" role="alert" id="save-success-alert">
      <?=$msg?>
    </div>
    </div>
    <?php } ?>


<?php include('include/footer.php');
include('include/footer_js.php');?>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</div>
<script type="text/javascript">
  $(document).ready(function() {
   //dismiss alert if shown
    setTimeout(function () {
      $("#save-success-alert").alert('close');
    }, 4000);
  });
 
</script>




</body>
</html>
