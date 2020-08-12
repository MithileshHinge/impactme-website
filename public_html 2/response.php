<?php include('admin_path.php'); 
include('include/access.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

if($_SESSION['is_user_login']==0)
 
{
header('location:'.BASEPATH.'/sign-up/');
}
?>
<?php
$image_save_folder = "user";

$page_title = "Payment Verification| ".PROJECT_TITLE;

if(strlen($row_user->cover_image_path)>0)
 $cover_image = IMAGEPATH.$row_user->cover_image_path;
else
 $cover_image = IMAGEPATH.'background.jpg'; 


if(strlen($row_user->image_path)>0)
 $user_image = IMAGEPATH.$row_user->image_path;
else
 $user_image = IMAGEPATH.'icon_man.png'; 


$success = false;

$error = "Payment Failed";

$ids = $db_query->get_ids_sql($row_user->user_id);

if (empty($_POST['razorpay_payment_id']) == false and empty($_REQUEST['tier_id']) == false)
{
  $tier_id = $_REQUEST['tier_id'];
  $row_payment = end($db_query->runQuery("select * from impact_payment where user_id in $ids and tier_id=".$tier_id." and subscription_id='".$_POST['razorpay_subscription_id']."' and status='created' limit 1"));

  if (!empty($row_payment) && !empty($row_payment["subscription_id"])){
        $subscription_id = $row_payment["subscription_id"];

    
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        /*$attributes = array(
            'razorpay_subscription_id' => $subscription_id,
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
        $success = true;
        */
        $expectedSignature = hash_hmac('sha256', $_POST['razorpay_payment_id'] . '|' . $subscription_id, $razorpay_secret);
        
        if ($expectedSignature === $_POST['razorpay_signature']){
            $success = true;

            $db->updateArray("impact_payment", array('transaction_id' => $_POST['razorpay_payment_id'],  'status' => 'authenticated'), "user_id in $ids and tier_id=".$tier_id." and subscription_id='".$subscription_id."' and status='created'");
            //$db_query->Query("update impact_payment set status='authenticated', paid_timestamp = ".strtotime("now").", transaction_id='".$_POST['razorpay_payment_id']."' where ");
            $response_message = "Payment successful";

            // TODO: Add row to Notifications table (see commented code)
            $row_pay_user = $db_query->fetch_object("select * from impact_user where user_id='". $row_payment["creator_id"]."'");
            $insert_array = $insert_array2 = array();
            
            $insert_array['user_id'] =  $creator->user_id;
            $insert_array2['user_id'] = $fan->user_id;
            $insert_array2['creator_id'] = $insert_array['creator_id'] = $row_payment["creator_id"];
            $insert_array2['tier_id'] = $insert_array['tier_id'] = $row_payment["tier_id"];
            $insert_array2['tier_type'] = $insert_array['tier_type'] = "Tier";
            $insert_array2['tier_price'] = $insert_array['tier_price'] = $row_payment["paid_amount"];
            $db->insertDataArray("impact_join",$insert_array);
            $db->insertDataArray("impact_join",$insert_array2);
            $db_query->add_notification_payment($row_user->user_id,  $row_payment["tier_id"] , "payment");
        }else{
            $success = false;
            $error = "Invalid signature";
            $response_message = "Payment failed";
            $db->updateArray("impact_payment", array('transaction_id' => $_POST['razorpay_payment_id'], 'status' => 'authentication fail'), "user_id in $ids and subscription_id='".$subscription_id."' tier_id=".$tier_id." and status='created'");   
        }
      }
}else if (isset($_POST['upgrade']) and $_POST['upgrade'] == "1" and isset($_POST['tier_id']) and isset($_POST['tier_id_old'])) {
    $tier_id = $_REQUEST['tier_id'];
    $api = new Api($razorpay_id, $razorpay_secret);
    $row_tier = $db_query->fetch_object("select * from impact_tier where tier_id = '".$tier_id."'");
    $row_pay_user = $db_query->fetch_object("select * from impact_user where user_id='$row_tier->user_id'");
    $row_subscription_old = $db_query->fetch_object("select * from impact_payment where user_id in $ids and creator_id='".$row_tier->user_id."' and tier_id='".$_POST['tier_id_old']."' and (status='authenticated' or status='active')");
    $subscription_old = $api->subscription->fetch($row_subscription_old->subscription_id);
    if ($row_subscription_old->paid_amount < $row_tier->tier_price){
        // Upgrade subscription
        $subscription_new = $subscription_old->update(array('plan_id' => $row_tier->plan_id, 'schedule_change_at' => 'now'));
        $success = true;
        $response_message = "Upgrade request sent: You will be notified shortly";
      }else {
        $success = false;
        $response_message = "Pact upgrade failed";
        $error = "Cannot upgrade to lower price pact.";
      }
}else {
    $success = false;
    $error = "Invalid signature 0x07";
    $response_message = "Payment failed";
    $db->updateArray("impact_payment", array('status' => 'authentication fail'), "user_id in $ids and tier_id=".$tier_id." and subscription_id='".$_POST['razorpay_subscription_id']."' and status='created'");   
}

/*
require_once 'payment/TransactionResponse.php';
$transactionResponse = new TransactionResponse();
$transactionResponse->setRespHashKey($atom_payment_hash_response_key);

if($transactionResponse->validateResponse($_POST)){
    $msg =  "Transaction Processed <br/>";
   
} else {
     $msg =  "Invalid Signature";
}

$url ="https://paynetzuat.atomtech.in/paynetz/vfts?merchantid=".$_POST['merchant_id']."&merchanttxnid=".$_POST['mer_txn']."&amt=".$_POST['amt']."&tdate=".date('Y-m-d',strtotime($_POST['date']));

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents

$data = curl_exec($ch); // execute curl request
curl_close($ch);

$xml = simplexml_load_string($data);

// UPDATE TABLE

$desc = $_POST['desc'];
$transaction_id = $_POST['mer_txn'];
$mmp_txn = $_POST['mmp_txn'];
$response_new = $_POST;
 

//echo "<pre>";
  //  var_dump($_POST);
$sql_check = $db_query->fetch_object("select count(*) c from impact_payment where transaction_id='$transaction_id' and status=0");
if($sql_check->c>0)
{
  if($desc=="Cancel by User") {
        $db_query->Query("update impact_payment set paid_status='Cancel', status=1 , response = '$response_new' where transaction_id='$transaction_id'"); 
  }
  
  if($desc=="Transction Success" || $desc=="APPROVED OR COMPLETED SUCCESSFULLY" || $desc=="Transaction Success" || $desc=="Success" ||  $_POST['f_code']=="OK" ||  $_POST['f_code']=="Ok"   ) {
    
    
    $response_message = "Payment Successfull";
     $db_query->Query("update impact_payment set paid_status='Success', mmp_txn = '$mmp_txn', status=1 where transaction_id='$transaction_id'");  
    $row_pay = $db_query->fetch_object("select * from impact_payment where mmp_txn='".$mmp_txn."'");
      $row_pay_user = $db_query->fetch_object("select * from impact_user where user_id='". $row_pay->creator_id."'");
     $insert_array = $insert_array2 = array();
     $creator = $db_query->creator_check($row_user->email_id);
     $fan = $db_query->fan_check($row_user->email_id);
     $insert_array['user_id'] =  $creator->user_id;
     $insert_array2['user_id'] = $fan->user_id;
     $insert_array2['creator_id'] = $insert_array['creator_id'] = $row_pay->creator_id;
     $insert_array2['tier_id'] = $insert_array['tier_id'] = $row_pay->tier_id;
     $insert_array2['tier_type'] = $insert_array['tier_type'] = $row_pay->tier_type;
     $insert_array2['tier_price'] = $insert_array['tier_price'] = $row_pay->paid_amount;
     $db->insertDataArray("impact_join",$insert_array);
     $db->insertDataArray("impact_join",$insert_array2);
    $db_query->add_notification_payment($row_user->user_id,  $row_pay->tier_id , "payment"  );
  }
  if( $_POST['f_code']=="F"   ) { $response_message = "Payment Failed";}
}
*/

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

<?php if (!empty($row_pay_user)){
    if (!empty($row_pay_user->slug)){
      $creator_profile_link = "/profile/".$row_pay_user->slug;
    }else{
      $creator_profile_link = "/profile/u/".$row_pay_user->user_id;
    }
?>
<meta http-equiv="refresh" content="10;url=<?=BASEPATH.$creator_profile_link?>"/>
<?php } ?>

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
            <div class="tab-pane accordion-content active">
              <div class="form form-profile">
           
                <h3><?=$response_message?><? //=$xml['VERIFIED']?></h3>
               <? //=print_r($_POST);?>
               <?php if($success === false) {?>
               <h4><?=$error?></h4><br>
               <?php } ?>
               <!--h4>Subscription Id: <?=$subscription_id?></h4>
               <h4>Tier Id: <?=$_REQUEST['tier_id']?>, <?=var_dump($row_payment)?></h4-->
                <h4>Transaction Id: <?=$_POST['razorpay_payment_id'] /*.",  ".$_POST['razorpay_signature']*/?></h4>
                 <h4>Date: <?=date('Y-m-d') /*.",  ".$expectedSignature*/?></h4>
                  <h4>Creator : <?=$_POST["creator_name"]?></h4>
                   <h4>Amount: <?=$row_payment["paid_amount"]?></h4>
                <br>
                <h4 id="timeLeft">You will automatically be redirected to the creator's profile in 10 seconds...</h4>
                <script type="text/javascript">
                  var timeleft = 10;
                  var countdownTimer = setInterval(function(){
                    if(timeleft < 0){
                      clearInterval(downloadTimer);
                    } else {
                      document.getElementById("timeLeft").innerHTML = "You will automatically be redirected to the creator's profile in "+timeleft+" seconds...";
                    }
                    timeleft -= 1;
                  }, 1000);
                </script>
   <? //=print_r($xml);?>
            
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
