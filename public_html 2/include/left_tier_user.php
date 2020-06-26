<?php
$sql_tier_check = $db_query->fetch_object("select count(*) c from impact_tier where user_id='$row_user1->user_id'");
if($sql_tier_check->c>0) {?>


<div class="wrap-lst-category">
	<h3 class="tier">
		Waves
		<a href="#" class="become" onClick="alert('You cannot join your own tiers')">See all</a>
	</h3>
	<?php $sql_tier = $db_query->runQuery("select * from impact_tier where user_id='$row_user1->user_id' and plan_id is not null and not plan_id='' order by tier_price");
	$check_subscription = $db_query->fetch_object("select IFNULL(tier_id, 0) tier_id from impact_payment where user_id='".$row_user->user_id."' and creator_id='".$row_user1->user_id."' and (status='authenticated' or status='active')");
	if ($check_subscription->tier_id > 0)
		$joined_tier_price = $db_query->fetch_object("select tier_price p from impact_tier where user_id='".$row_user1->user_id."' and tier_id='".$check_subscription->tier_id."' and plan_id is not null and not plan_id=''");
	foreach($sql_tier as $row_tier) { 
		$tier_link = BASEPATH.'/join/'.$row_user1->user_id.'/checkout/'.$row_tier['tier_id'].'/';
		?>	

		<div class="tier1">
			<h4 class="livello"><?=$row_tier['tier_name']?> (<?=CURRENCY.$row_tier['tier_price']?>)</h4>
			<div style="padding-left:10px;padding-right:10px;margin: 0 0 0 13px;"><span class="more" style="padding: 10px 21px 15px 0px;text-align: justify;color: black"> <?=stripslashes(nl2br( $row_tier['description']))?></span></div>
			<br />
			<?php if($row_user1->user_id==base64_decode($_SESSION['user_id'])) {?>

			<div style="text-align: center;">
				<a href="#" class="join_btn">Make <?=CURRENCY.$row_tier['tier_price']?> Pact</a>
			</div>
			<?php } else { ?>
			<?php if ($check_subscription->tier_id == 0) { ?>
			<a href="<?=$tier_link?>" class="join_btn"  style="color:white;">Make <?=CURRENCY.$row_tier['tier_price']?> Pact</a>
			<?php }else {
				if ($joined_tier_price->p >= $row_tier['tier_price']) {?>
				<a class="join_btn_disabled"  style="color:white;">Joined <?=CURRENCY.$row_tier['tier_price']?> Pact</a>
			<?php }else if ($joined_tier_price->p < $row_tier['tier_price']) {?>
			<a href="<?=$tier_link?>" class="join_btn"  style="color:white;">Upgrade to <?=CURRENCY.$row_tier['tier_price']?> Pact</a>
		
		<?php }}} ?>
	</div>


<!--<div class="wrap-lst-category" style="margin-bottom:20px; padding:10px;">
<h3 class="tier add-tiers" style=" margin: 0 4% 0 0;
text-align: center;">
<?=$row_tier['tier_name']?>
</h3>
<p class="faccio-become" style="text-align:center;">

<img src="cms_images/user/original/" width="200px">

</p>
<h2 class="doller-become" style="font-size:22px">
<?=$row_tier['tier_price']?>
INR</h2>
<p class="doller-permonth">PER MONTH</p>
<span class="more faccio-become" style="padding:0px;">
<?=stripslashes(nl2br( $row_tier['description']))?>
</span>
<a href="#" class="join_btn">Join</a>
</div>--> 
<?php } ?>

</div><?php } ?>