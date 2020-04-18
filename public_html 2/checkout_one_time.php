<?php include('admin_path.php'); 
include('include/access.php');
if($_SESSION['is_user_login']==0)
 
{
header('location:'.BASEPATH.'/sign-up/');
}
?>
<?php
if(isset($_GET['u']))
{
 $userID = $_GET['u'];	
 $rowUser = $db_query->fetch_object("select * from impact_user where user_id='$userID'");
}
if(isset($_GET['pid']))
{
	$post_id = $_GET['pid'];
	if($post_id >0) {
		$sql = "select IFNULL(one_time_amount,0) price, post_id tier_id,post_title  tier_name , 'One Time Payment' description from impact_post where post_id = '".$post_id."'";
		//echo $sql;
$row_tier = $db_query->fetch_object($sql);
	}
	

}
else
{
	$tier_id = 0;
	$row_tier = $db_query->fetch_object("select '50.00' price, '0' tier_id, 'Custom Pledge' tier_name  ");
}

	


if(strlen($row_user->cover_image_path)>0)
 $cover_image = IMAGEPATH.$row_user->cover_image_path;
else
 $cover_image = IMAGEPATH.'background.jpg'; 


if(strlen($row_user->image_path)>0)
 $user_image = IMAGEPATH.$row_user->image_path;
else
 $user_image = IMAGEPATH.'icon_man.png'; 
if(strlen($row_user->tag_line)>0) { 
 $page_title = $row_user->tag_line." | One Time Checkout | ".PROJECT_TITLE;
 }
 else
 {
  $page_title = "One Time Checkout | ".PROJECT_TITLE;
 }
 
 if($_REQUEST['mode']=="card")
 {
   $pay_amount = $_REQUEST['pay_amount'];
  
	    date_default_timezone_set('Asia/Calcutta');
		$datenow = date("d/m/Y h:m:s");
		$transactionDate = str_replace(" ", "%20", $datenow);
		
		$transactionId = rand(1,1000000);
		
		require_once 'payment/TransactionRequest.php';
		
		$transactionRequest = new TransactionRequest();
		
		//Setting all values here
		$transactionRequest->setMode($atom_payment_mode);
		$transactionRequest->setLogin($atom_payment_login);
		$transactionRequest->setPassword($atom_payment_password);
		$transactionRequest->setProductId($atom_payment_product_id);
		$transactionRequest->setAmount($pay_amount);
		$transactionRequest->setTransactionCurrency("INR");
		$transactionRequest->setTransactionAmount($pay_amount);
		$transactionRequest->setReturnUrl($atom_payment_response_path_one_time);
		$transactionRequest->setClientCode(123);
		$transactionRequest->setTransactionId($transactionId);
		$transactionRequest->setTransactionDate($transactionDate);
		$transactionRequest->setCustomerName($row_user->impact_name);
		$transactionRequest->setCustomerEmailId($row_user->email_id);
		$transactionRequest->setCustomerMobile($sql_web->phone);
		$transactionRequest->setCustomerBillingAddress('Nagpur');
		$transactionRequest->setCustomerAccount($row_user->user_id);
		$transactionRequest->setReqHashKey($atom_payment_hash_request_key);
		//echo "<pre><br>";
	//	var_dump($transactionRequest);
         // exit;
		$url = $transactionRequest->getPGUrl();
		
		
		$_REQUEST['transaction_id'] =  $transactionId;
		$_REQUEST['user_id'] =  $row_user->user_id;
		$_REQUEST['creator_id'] =  $rowUser->user_id;
		
		
			$_REQUEST['tier_id'] =  0; 
			$_REQUEST['tier_type'] =  'One Time';  
		
		 $_REQUEST['paid_amount'] =  $pay_amount; 
		  $_REQUEST['post_id'] = $post_id; 
		 if( $db->insertDataArray("impact_payment",$_REQUEST))
  {
		header("Location: $url");	
  }
  
}
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
</head>

<body>
<div id="wrapper">
<?php include('include/header.php'); ?>


</div>

<form action="" method="post">
<section style="background-color: white;">

        <div class="container">

            <h3 class="payment-monthly" style="margin-top:60px">Complete Your One Time Payment to <?= stripslashes($rowUser->impact_name)?></h3>
            <?php if(isset($msg)) { echo $msg ; } ?>

            <div class="col-md-12 paymet-box">

                <div class="col-md-6 choose-pay">

                    <div class="col-md-4 payment-what">

                        <p class="gio-payment">Amount</p>

                    </div>

                    <div class="col-md-4 payment-what">

                        <label class="label-dooler"><?=CURRENCY?> </label>

                        <input type="text" name="pay_amount" id="pay_amount" class="rupees-payment" value="<?=$row_tier->price?>" readonly>
                        <input type="hidden" name="custom" id="custom" class="rupees-payment" value="N">

                    </div>

                   
                    <div class="col-md-4 credit-payment">
                        <p style="font-size: 18px;color: black;" id="tier_name"><?=$row_tier->tier_name?></p>
                      

                    </div>

                    <div class="col-md-12"><p class="checkout-issue">Patreon does not issue refunds on behalf of creators. <a href="#" style="text-decoration: underline;">Learn more.</a></p></div>

                </div>

                <div class="col-md-5 card-payment">

                    <h2 style="color: black;    padding: 0 0 12px 0;">Summary</h2>

                    <p style="font-size: 16px;color:black;">One Time Payment<span class="price"><?=CURRENCY?><span id="price2"> <?=$row_tier->price?></span></span></p>

                   

                    <div class="wrap-nav-pledge digital-payment">
                    
                     <input type="hidden" name="mode" value="card">
                     <button class="pay-card" id="pay_card">Pay with Card</button>
                      

                    </div>

                    <div class="col-md-12"><p class="question">Questions? 94.8% of people who visit our <a href="#" style="text-decoration: underline;">Help Center</a> find what they're looking for.</p></div>

                </div>

            </div>

        </div>

    </section>
    
    </form>
<?php //include('include/footer.php');
include('include/footer_js.php');?>

<script type="text/javascript">
  $(document).ready(function() {
  	  $("#custome_pledge").click(function(){ 
			 $('#pay_amount').val('');
			 $('#custom').val('Y');
			 $('#pay_amount').attr('readonly', false); 
			 $('#pay_amount').focus();
	   });
	   
	    $("#pay_amount").keyup(function(){ 
			var pay_amount =  $('#pay_amount').val();
			$('#tier_name').hide();
			  $('#price2').html(pay_amount); 
			  $('#price3').html(pay_amount); 
		
	   });
	   
	   
	    $("#pay_card").click(function(){ 
			var pay_amount =  $('#pay_amount').val();
			if(pay_amount=='' )
			{
			 alert("Minimum Amount Should Be 50");
			 $('#pay_amount').val('');
			 $('#pay_amount').focus();
			 return false;	
			}
	   });
	  
  });

</script>

</div>
</body>
</html>