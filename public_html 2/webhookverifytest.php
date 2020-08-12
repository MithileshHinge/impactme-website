<?php

$body ='{"entity":"event","account_id":"acc_E9U4g1uosallzq","event":"subscription.cancelled","contains":["subscription"],"payload":{"subscription":{"entity":{"id":"sub_FFeWjWPtv2ybtm","entity":"subscription","plan_id":"plan_F9Go9HSrkyITAv","customer_id":"cust_EdcTu6SaXmpi4s","status":"cancelled","current_start":null,"current_end":null,"ended_at":1595008542,"quantity":1,"notes":[],"charge_at":null,"start_at":1596477323,"end_at":1909247400,"auth_attempts":0,"total_count":120,"paid_count":0,"customer_notify":true,"created_at":1595008523,"expire_by":null,"short_url":null,"has_scheduled_changes":false,"change_scheduled_at":null,"source":"api","remaining_count":120}}},"created_at":1595008542}';
$sig = '9fa91aac9b3e08a409974278a39a9004168c50208b85710b11592b5dbcad75c7';

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;

$razorpay_id = "rzp_test_5ywxjtGTzegjUB";
$razorpay_secret = "JwBYcayJ12WR1sXekIB0VyK6";

$api = new Api($razorpay_id, $razorpay_secret);

//echo $api->utility->verifyWebhookSignature($body, $sig, 'hR!fkk7Kpu@JqPU');

$expected_signature = hash_hmac('sha256', $body, 'hR!fkk7Kpu@JqPU');
echo $expected_signature."\n";
echo $sig."\n";
echo ($expected_signature == $sig);
?>
