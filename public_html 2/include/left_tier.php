
                                             
                                              

<?php 
function show_impact_limit($row_tier, $pact_members)
{
  if (!empty($row_tier['impact_limit']) and $row_tier['impact_limit']>0) {
    if ($pact_members->c <=0) $pact_members->c = '0';
        ?>
        <div style="padding: 0px 20px 0px 20px;">
          <p style="display: inline-block; vertical-align: super;">Pact members: <?=$pact_members->c."/".$row_tier['impact_limit']?></p>
          <?php if ($pact_members->c >= $row_tier['impact_limit']) { ?>
            <span class="material-icons info-hover" data-toggle="tooltip" data-placement="right" title="This is a limited entry pact. It has reached its max limit of <?=$row_tier['impact_limit']?> members.">info</span>
          <?php } else { ?>
            <span class="material-icons info-hover" data-toggle="tooltip" data-placement="right" title="This is a limited entry pact. It will get closed once it reaches its max limit of <?=$row_tier['impact_limit']?> members.">info</span>
          <?php } ?>
        </div>
      <?php }
}


$sql_tier_check = $db_query->fetch_object("select count(*) c from impact_tier where user_id='$row_user->user_id'");
if($sql_tier_check->c==0) {?>

                  <div class="project-author">
                    <div class="box-gray">
                      <h3 class="tier add-tiers"><a href="<?=BASEPATH?>/edit/tiers/">+ Add Pacts</a></h3>
                   </div>
                 </div>
                 <?php } else { ?>
				  <div class="wrap-lst-category" style="box-shadow: 0 1px 4px rgba(0,0,0,.1);">
                   <h3 class="tier">
                       Pacts
                   </h3>
                <?php $sql_tier = $db_query->runQuery("select * from impact_tier where user_id='$row_user->user_id' order by tier_price");
				foreach($sql_tier as $row_tier) { 
				$tier_link = BASEPATH.'/join/'.$row_user1->user_id.'/checkout/'.$row_tier['tier_id'].'/';
				$pact_members = $db_query->fetch_object("SELECT count(*) c from impact_payment where tier_id='$row_tier->tier_id' and creator_id='$row_user->user_id' and (status='active' or status='authenticated') group by subscription_id");
        if (!empty($row_tier['impact_limit']) and $row_tier['impact_limit']>0 and $pact_members->c>=$row_tier['impact_limit']) {
          $tier_link = "#";
          $join_btn_class = "join_btn_disabled";
        }else {
          $join_btn_class = "join_btn";
        }
				?>	
                
                <div class="tier1">
 <h4 class="livello"><?=$row_tier['tier_name']?></h4>
<div style="padding-left: 20px;padding-right: 20px;">
    <span class="more" style="text-align: justify;color: #455058;font-weight: 300;"> <?=stripslashes($row_tier['description'])?></span></div>
                                                  <br /><br>
      <?php if($row_user->user_id==base64_decode($_SESSION['user_id'])) {?>

       <div>
           <a href="#" class="<?=$join_btn_class?>">Make ₹<?=$row_tier['tier_price'].' '?> Pact</a>
           <?php show_impact_limit($row_tier, $pact_members); ?>
           </div>
       <?php } ?>
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
   							 
                                 