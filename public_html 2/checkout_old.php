<?php include('admin_path.php'); 
include('include/access.php');
if($_SESSION['is_user_login']==0)
 
{
header('location:'.BASEPATH.'/sign-up/');
}
?>
<?php
if(strlen($row_user->cover_image_path)>0)
 $cover_image = IMAGEPATH.$row_user->cover_image_path;
else
 $cover_image = IMAGEPATH.'background.jpg'; 


if(strlen($row_user->image_path)>0)
 $user_image = IMAGEPATH.$row_user->image_path;
else
 $user_image = IMAGEPATH.'icon_man.png'; 
if(strlen($row_user->tag_line)>0) { 
 $page_title = $row_user->tag_line." | ".PROJECT_TITLE;
 }
 else
 {
  $page_title = "My Profile | ".PROJECT_TITLE;
 }
 
 if($_REQUEST['mode']=="card")
 {
 
    $datenow = date("d/m/Y h:m:s");
$transactionDate = str_replace(" ", "%20", $datenow);

$transactionId = rand(1,1000000);

require_once 'payment/TransactionRequest.php';

$transactionRequest = new TransactionRequest();

//Setting all values here
$transactionRequest->setMode("test");
$transactionRequest->setLogin(197);
$transactionRequest->setPassword("Test@123");
$transactionRequest->setReturnUrl(BASEPATH."/response.php");
$transactionRequest->setTransactionCurrency("INR");
$transactionRequest->setTransactionId($transactionId);
$transactionRequest->setTransactionDate($transactionDate);
$transactionRequest->setReqHashKey("KEY123657234");

$transactionRequest->setProductId("NSE");

$transactionRequest->setAmount($_REQUEST['pay_amount']);
$transactionRequest->setTransactionAmount($_REQUEST['pay_amount']);

$transactionRequest->setClientCode(123);

$transactionRequest->setCustomerName($row_user->full_name);
$transactionRequest->setCustomerEmailId($row_user->email_id);
$transactionRequest->setCustomerMobile("1234567890");
$transactionRequest->setCustomerBillingAddress($row_user->full_name);
$transactionRequest->setCustomerAccount($row_user->user_id);



$url = $transactionRequest->getPGUrl();

header("Location: $url");
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

            <h3 class="payment-monthly">Complete your monthly payment to GioPizzi</h3>

            <div class="col-md-12 paymet-box">

                <div class="col-md-6 choose-pay">

                    <div class="col-md-4 payment-what">

                        <p class="gio-payment">Choose What You Pay</p>

                    </div>

                    <div class="col-md-4 payment-what">

                        <label class="label-dooler">$</label>

                        <input type="text" name="pay_amount" class="rupees-payment" value="1">

                    </div>

                    <div class="col-md-4 debit-payment">

                        <p class="gio-payment">Your Tier</p>

                    </div>

                    <div class="col-md-4 credit-payment">

                        <p style="font-size: 18px;color: black;">Custom pledge<a href="#" style="margin: 0 0 0 6px;color: red;">Edit</a></p>

                    </div>

                    <div class="col-md-12"><p class="checkout-issue">Patreon does not issue refunds on behalf of creators. <a href="#" style="text-decoration: underline;">Learn more.</a></p></div>

                </div>

                <div class="col-md-5 card-payment">

                    <h2 style="color: black;    padding: 0 0 12px 0;">Summery</h2>

                    <p style="font-size: 16px;color:black;">June payment<span class="price"><?=CURRENCY?> $5.00*</span></p>

                    <p class="pacifi-time">You will be charged $5.00 on July 1st, Pacific Time and then the 1st of each month going forward.</p>

                    <p class="pacifi-time">You can cancel or edit your payment at any time. By making this payment, you agree to ImapctMe Terms of Use.</p>

                    <p class="pacifi-time" style="    font-size: 14px;">*Depending on your location your bank might charge an additional foreign transaction fee for your membership to this Creator. </p>

                    <div class="wrap-nav-pledge digital-payment">
                    
                     <input type="hidden" name="mode" value="card">
 <button class="pay-card">Pay with Card</button>
                        <!--<ul class="rs nav nav-pledge accordion">



                            <li>

                                <div class="active pledge-label accordion-label clearfix">

                                    <i class="icon iPlugGray"></i>

                                    <span class="pledge-amount" style="font-weight: bold;">Card</span>

                                </div>

                                <div class="active pledge-content accordion-content">

                                    <div class="pledge-detail">

                         

                                           <div class="row">

                                              <input type="" name="" class="card-number" placeholder=" Credit Card Number"> 

                                           </div>

                                           <div class="card-exp">

                                            <label>Expiration</label><br>

                                              <input type="" name=""  class=" Credit-exp" placeholder="09/24"> 

                                           </div>

                                           <div class="card-cvv">

                                            <label>CVV</label><br>

                                              <input type="" name=""  class=" Credit-cvv" placeholder="123"> 

                                           </div>

                                           <div class="card-postal">

                                            <label>Postal</label><br>

                                              <input type="" name=""  class=" Credit-postal" placeholder="1234"> 

                                           </div>

                        
                                             
                                        <button class="pay-card">Pay with Card</button>

                                    </div>

                                </div>

                            </li>

                            <li>

                                <div class=" pledge-label accordion-label clearfix">

                                    <i class="icon iPlugGray"></i>

                                    <span class="pledge-amount" style="color: #009CDE"><span style="color: red;">Pay</span>Pal</span>

                                </div>

                                <div class=" pledge-content accordion-content">

                                    <div class="pledge-detail" style="padding: 49px 0 61px 0;">

                                        <a href="#" class="pay-pal">Pay With <span style="color: #002F86;">pay</span> <span style="color:#009CDE;">Pal</span></a>

                                    </div>

                                </div>

                            </li>

                        </ul>-->

                    </div>

                    <div class="col-md-12"><p class="question">Questions? 94.8% of people who visit our <a href="#" style="text-decoration: underline;">Help Center</a> find what they're looking for.</p></div>

                </div>

            </div>

        </div>

    </section>
    
    </form>
<?php //include('include/footer.php');
include('include/footer_js.php');?>


</div>
</body>
</html>
