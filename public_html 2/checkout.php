<?php include('admin_path.php'); 
include('include/access.php');
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;

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
if(isset($_GET['tid']))
{
	$tier_id = $_GET['tid'];
	if($tier_id >0) {
		$row_tier = $db_query->fetch_object("select IFNULL(tier_price,0) price, tier_id, tier_name , description, plan_id from impact_tier where tier_id = '".$tier_id."'");

		$row_prev_payment_check = $db_query->fetch_object("select count(*) c from impact_payment where user_id='".$row_user->user_id."' and creator_id='".$rowUser->user_id."' and tier_id='".$tier_id."' and (status='authenticated' or status='active')");
		if ($row_prev_payment_check->c == 0){
			$api = new Api($razorpay_id, $razorpay_secret);

			$plan_id = $row_tier->plan_id;

			date_default_timezone_set('Asia/Calcutta');
			$start_at = strtotime('+2 days', strtotime('first day of next month'));

			//for ($i=0; $i < 10; $i++) { 
				$subscription = $api->subscription->create(array(
					'plan_id' => $plan_id,
					'total_count' => 6,
					'start_at' => $start_at,
					'customer_notify' => 1,
					'addons' => array(
						array(
							'item' => array(
								'name' => 'Payment for current month',
		      					'amount' => $row_tier->price * 100, //In paise
		      					'currency' => 'INR'
		      					)
							)
						)
					)
				);
			//}

			$db->insertDataArray("impact_payment", array(
				'user_id' => $row_user->user_id,
				'creator_id' => $rowUser->user_id,
				'tier_id' => $tier_id,
				'subscription_id' => $subscription->id,
				'paid_amount' => $row_tier->price,
				'status' => $subscription->status
				)
			);
		}
	}
	else
	{
		$row_tier = $db_query->fetch_object("select '50.00' price, '0' tier_id, 'Custom Pledge' tier_name  ");

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
	$page_title = $row_user->tag_line." | Checkout | ".PROJECT_TITLE;
}
else
{
	$page_title = "Checkout | ".PROJECT_TITLE;
}

/*
if($_REQUEST['mode']=="card")
{
	$pay_amount = $db_query->filter($_REQUEST['pay_amount']);
	if($pay_amount < 50 || $pay_amount=='') 
	{
		$msg = "<span style='color:red'>Minimum Amount Should Be 50</span>";	 
	}
	else
	{
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
		$transactionRequest->setReturnUrl($atom_payment_response_path);
		$transactionRequest->setClientCode(123);
		$transactionRequest->setTransactionId($transactionId);
		$transactionRequest->setTransactionDate($transactionDate);
		$transactionRequest->setCustomerName($row_user->impact_name);
		$transactionRequest->setCustomerEmailId($row_user->email_id);
		$transactionRequest->setCustomerMobile($sql_web->phone);
		$transactionRequest->setCustomerBillingAddress('Nagpur');
		$transactionRequest->setCustomerAccount($row_user->user_id);
		$transactionRequest->setReqHashKey($atom_payment_hash_request_key);
		
		//var_dump($transactionRequest);
        //  exit;
		$url = $transactionRequest->getPGUrl();
		
		
		$_REQUEST['transaction_id'] =  $transactionId;
		$_REQUEST['user_id'] =  $row_user->user_id;
		$_REQUEST['creator_id'] =  $rowUser->user_id;
		
		if($_REQUEST['custom']=='Y')
		{
			$_REQUEST['tier_id'] =  0; 
			$_REQUEST['tier_type'] =  'Custom'; 
			
		}
		else
		{
			$_REQUEST['tier_id'] =  $tier_id; 
			$_REQUEST['tier_type'] =  'Tier';  
		}
		$_REQUEST['paid_amount'] =  $pay_amount; 

		if( $db->insertDataArray("impact_payment",$_REQUEST))
		{
			header("Location: $url");	
		}
	}
}
*/

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

	
		<section style="background-color: white;">

			<div class="container">

				<h3 class="payment-monthly" style="margin-top:60px">Subscribe to <?= stripslashes($rowUser->impact_name)?></h3>
				<?php if(isset($msg)) { echo $msg ; } ?>

				<div class="col-md-12 paymet-box">

					<div class="col-md-6 choose-pay">

						<div class="col-md-4 payment-what">

							<p class="gio-payment">Monthly amount</p>

						</div>

						<div class="col-md-4 payment-what">

							<label class="label-dooler"><?=CURRENCY?></label>

                        <?php /*
                        <input type="text" name="pay_amount" id="pay_amount" class="rupees-payment" value="<?=$row_tier->price?>" <?php if($tier_id!=0){?>readonly<?php } ?>>
                        <input type="hidden" name="custom" id="custom" class="rupees-payment" <?php if($tier_id!=0){?>value="N"<?php } else { ?> value="Y" <?php } ?>>
                        */?>
                        <input type="text" name="pay_amount" id="pay_amount" class="rupees-payment" value="<?=$row_tier->price?>" readonly>

                    </div>

                    <div class="col-md-4 debit-payment">

                    	<p class="gio-payment">Your Tier</p>

                    </div>

                    <div class="col-md-4 credit-payment">
                    	<p style="font-size: 18px;color: #455058;" id="tier_name"><?=$row_tier->tier_name?></p>
                    	<!--p style="font-size: 16px;color: #455058;">Custom Pledge <a href="javascript:void(0)" style="margin: 0 0 0 6px;color: red; " id="custome_pledge">Edit</a></p-->

                    </div>

                    <div class="col-md-12"><p class="checkout-issue">ImpactMe does not issue refunds on behalf of creators. <a href="<?=$BASEPATH.'/terms-conditions/#terms_payments'?>" style="text-decoration: underline;">Learn more.</a></p></div>

                </div>

                <div class="col-md-5 card-payment">

                	<h2 style="color:#455058;    padding: 0 0 12px 18px;">Summary</h2>

                	<p style="font-size: 16px;color:#455058;    padding: 0 0 0 18px;"><?=date('F')?> payment<span class="price">₹<span id="price2" style="padding:0 26px 0 0;"> <?=$row_tier->price?></span></span></p>

                	<p class="pacifi-time">You will be charged  <?=CURRENCY?> <span id="price3"><?=$row_tier->price?></span></span> on <?=date('d M, Y')?> , Pacific Time and then the 3st of each month going forward.</p>

                	<p class="pacifi-time">You can cancel or edit your payment at any time. By making this payment, you agree to ImapctMe's <a href="<?=BASEPATH?>/terms-conditions" target="_blank">Terms of Use.</a></p>

                	<p class="pacifi-time" style="    font-size: 14px;">*Depending on your location your bank might charge an additional foreign transaction fee for your membership to this Creator. <?php echo $subscription->id?></p>

                	<div class="wrap-nav-pledge digital-payment">
                		<form action="<?=$BASEPATH.'/response'?>" method="post">
                		<?php
                		if ($row_prev_payment_check->c==0){ 
                		?>
	                		<script
	                		src="https://checkout.razorpay.com/v1/checkout.js"
	                		data-key="<?php echo $razorpay_id?>"
	                		data-amount="<?php echo $row_tier->price * 100?>"
	                		data-currency="INR"
	                		data-name="ImpactMe"
	                		data-description="Monthly payment to <?=$rowUser->full_name?>"
	                		data-prefill.name="<?php echo $row_user->impact_name?>"
	                		data-prefill.email="<?php echo $row_user->email_id?>"
	                		data-subscription_id="<?php echo $subscription->id?>"
	                		data-display_amount="<?php echo $row_tier->price?>"
	                		data-display_currency="INR"
	                		>
	                		</script>
                		<?php
                		}
                		?>

                		<input type="hidden" name="tier_id" value="<?=$tier_id?>">
                		<input type="hidden" name="creator_name" value="<?=$rowUser->full_name?>">
                		<!--button class="pay-card" id="pay_card">Pay  <span id="price3">₹<span id="price_4"><?=$row_tier->price?></span></span></button-->
                		</form>

                	</div>

                	<div class="col-md-12"><p class="question">Questions? 94.8% of people who visit our <a href="#" style="text-decoration: underline;">Help Center</a> find what they're looking for.</p></div>

                </div>

            </div>

        </div>

    </section>
    

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
		$('#price_4').html(pay_amount); 

		
	});


	$("#pay_card").click(function(){ 
		var pay_amount =  $('#pay_amount').val();
		if(pay_amount=='' || pay_amount<50 )
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