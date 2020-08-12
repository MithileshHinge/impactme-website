<?php
function loglog($str='')
{
	$fpmailerr = fopen("webhooklog.txt", 'a');
   	fwrite($fpmailerr, date('Y-m-d H:i:s').": ".$str."\n");
   	fclose($fpmailerr);
}

if (!function_exists('getallheaders')) {
    function getallheaders() {
    $headers = [];
    foreach ($_SERVER as $name => $value) {
        if (substr($name, 0, 5) == 'HTTP_') {
            $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
        }
    }
    return $headers;
    }
}

function verifyWebhookSignature($body, $sig, $secret)
{
	$expected_signature = hash_hmac('sha256', $body, 'hR!fkk7Kpu@JqPU');
	return ($expected_signature == $sig);
}

loglog("init");

include('admin_path.php');

$request_headers = apache_request_headers();

loglog($request_headers["X-Razorpay-Event-Id"]);

$idempotency_check = $db_query->fetch_object("SELECT COUNT(*) c FROM razorpay_webhook_ids WHERE event_id='".$request_headers["X-Razorpay-Event-Id"]."'");
$body = file_get_contents("php://input");
loglog("111111  idem: ".$idempotency_check->c);
loglog($body);

$_POST = json_decode($body, true);

loglog(print_r($_POST, true));


if (verifyWebhookSignature($body, $request_headers['X-Razorpay-Signature'], 'hR!fkk7Kpu@JqPU') && $idempotency_check->c <= 0){

	$subscription = $_POST["payload"]["subscription"]["entity"];
	$row_last_payment = $db_query->fetch_object("SELECT * FROM impact_payment WHERE subscription_id='".$subscription['id']."' ORDER BY paid_timestamp DESC LIMIT 1");
	$row_tier = $db_query->fetch_object("SELECT * FROM impact_tier WHERE plan_id='".$subscription['plan_id']."'");

	$email_id = $db_query->fetch_object("SELECT email_id FROM impact_user WHERE user_id='$row_last_payment->user_id'");
	loglog("2222222");
	loglog(print_r($email_id, true));
	$creator_prof = $db_query->creator($email_id->email_id);
	$fan_prof = $db_query->impact($email_id->email_id);

	loglog(print_r($subscription, true));

	if ($_POST["event"] == 'subscription.charged'){

		$payment = $_POST['payment']['entity'];

		$db->updateArray("impact_payment", array('status' => 'completed'), "subscription_id='".$subscription["id"]."'");


		if (!empty($creator_prof)){
			$db->insertDataArray("impact_payment", array(
				'transaction_id' => $payment['id'],
				'user_id' =>  $creator_prof->user_id,
				'creator_id' => $row_last_payment->creator_id,
				'tier_id' => $row_tier->tier_id,
				'subscription_id' => $subscription['id'],
				'paid_amount' => $payment['amount']/100,
				'status' => $subscription['status']
			));
		}

		if (!empty($fan_prof)){
			$db->insertDataArray("impact_payment", array(
				'transaction_id' => $payment['id'],
				'user_id' =>  $row_last_payment->user_id,
				'creator_id' => $row_last_payment->creator_id,
				'tier_id' => $row_tier->tier_id,
				'subscription_id' => $subscription['id'],
				'paid_amount' => $payment['amount']/100,
				'status' => $subscription['status']
			));
		}
	}

	if ($_POST["event"] == 'subscription.completed'){
		$db->updateArray("impact_payment", array('status' => 'completed'), "subscription_id='".$subscription["id"]."'");
	}

	if ($_POST["event"] == 'subscription.halted'){
		$creator = $db_query->fetch_object("SELECT impact_name FROM impact_user WHERE user_id = '".$row_last_payment->creator_id."'");

		$db->updateArray("impact_payment", array('status' => 'completed'), " subscription_id='".$subscription["id"]."'");

		if (!empty($creator_prof)){
			$db->insertDataArray("impact_notification", array(
				'user_id' => $creator_prof->user_id,
				'from_user_id' => $row_last_payment->creator_id,
				'description' => 'Monthly payment attempts on you card for $creator->impact_name\'s Pact have failed repeatedly. Your Pact has been broken, please follow the link in your mail to add a new card and continue enjoying exclusive benefits.',
				'notify_date' => date('Y-m-d H:i:s'),
				'notification_type' => 'subscription_halted'
			));
		}

		if (!empty($fan_prof)){
			$db->insertDataArray("impact_notification", array(
				'user_id' => $fan_prof->user_id,
				'from_user_id' => $row_last_payment->creator_id,
				'description' => 'Monthly payment attempts on you card for $creator->impact_name\'s Pact have failed repeatedly. Your Pact has been broken, please follow the link in your mail to add a new card and continue enjoying exclusive benefits.',
				'notify_date' => date('Y-m-d H:i:s'),
				'notification_type' => 'subscription_halted'
			));
		}
	}

	if ($_POST["event"] == 'subscription.cancelled'){
		loglog("cancel");

		if (!empty($creator_prof) && !empty($creator_prof->user_id)){
			$sql = "UPDATE impact_payment SET status='cancelled' WHERE subscription_id='".$subscription["id"]."' AND user_id='".$creator_prof->user_id."' ORDER BY paid_timestamp DESC LIMIT 1";
			$res = $db_query->Query($sql);
			loglog($res);
			loglog($db_query->error);
		}

		if (!empty($fan_prof) && !empty($fan_prof->user_id)){
			$sql = "UPDATE impact_payment SET status='cancelled' WHERE subscription_id='".$subscription["id"]."' AND user_id='".$fan_prof->user_id."' ORDER BY paid_timestamp DESC LIMIT 1";
			$res = $db_query->Query($sql);
			loglog($res);
			loglog($db_query->error);
		}
		loglog("cancelled");
	}

	if ($_POST["event"] == 'subscription.updated'){
		$db->updateArray("impact_payment", array('status' => 'completed'), " subscription_id='".$subscription["id"]."'");
		$payment = $_POST['payment']['entity'];

		$creator = $db_query->fetch_object("SELECT impact_name FROM impact_user WHERE user_id = '".$row_last_payment->creator_id."'");

		if (!empty($creator_prof)){
			$db->insertDataArray("impact_payment", array(
				'transaction_id' => $payment['id'],
				'user_id' =>  $creator_prof->user_id,
				'creator_id' => $row_last_payment->creator_id,
				'tier_id' => $row_tier->tier_id,
				'subscription_id' => $subscription['id'],
				'paid_amount' => $payment['amount']/100,
				'status' => $subscription['status']
			));
		}
		if (!empty($fan_prof)){
			$db->insertDataArray("impact_payment", array(
				'transaction_id' => $payment['id'],
				'user_id' =>  $fan_prof->user_id,
				'creator_id' => $row_last_payment->creator_id,
				'tier_id' => $row_tier->tier_id,
				'subscription_id' => $subscription['id'],
				'paid_amount' => $payment['amount']/100,
				'status' => $subscription['status']
			));
		}

		if (!empty($creator_prof)){
			$db->insertDataArray("impact_notification", array(
				'user_id' => $creator_prof->user_id,
				'from_user_id' => $row_last_payment->creator_id,
				'description' => 'Congrats! Pact for creator $creator->impact_name has been upgraded. Thank you for the support, and enjoy your exclusive benefits.',
				'notify_date' => date('Y-m-d H:i:s'),
				'notification_type' => 'subscription_updated'
			));
		}

		if (!empty($fan_prof)){
			$db->insertDataArray("impact_notification", array(
				'user_id' => $fan_prof->user_id,
				'from_user_id' => $row_last_payment->creator_id,
				'description' => 'Congrats! Pact for creator $creator->impact_name has been upgraded. Thank you for the support, and enjoy your exclusive benefits.',
				'notify_date' => date('Y-m-d H:i:s'),
				'notification_type' => 'subscription_updated'
			));
		}
	}

	$db->insertDataArray("razorpay_webhook_ids", array('event_id' => $request_headers["X-Razorpay-Event-Id"]));
}
?>