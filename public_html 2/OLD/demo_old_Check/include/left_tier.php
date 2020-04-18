

<?php $sql_tier_check = $db_query->fetch_object("select count(*) c from impact_tier where user_id='$row_user->user_id'");
if($sql_tier_check->c==0) {?>

                  <div class="project-author">
                    <div class="box-gray">
                      <h3 class="tier add-tiers">+ Add Tiers</h3>
                   </div>
                 </div>
                 <?php } else { ?>
				
                <?php $sql_tier = $db_query->runQuery("select * from impact_tier where user_id='$row_user->user_id'");
				foreach($sql_tier as $row_tier) { ?>				 
                 <div class="wrap-lst-category" style="margin-bottom:20px; padding:10px;">
                    <h3 class="tier add-tiers" style=" margin: 0 4% 0 0;
    text-align: center;">
                      <?=$row_tier['tier_name']?>
                    </h3>
                   <!-- <p class="faccio-become" style="text-align:center;">
                     
                      <img src="cms_images/user/original/" width="200px">
                     
                    </p>-->
                    <h2 class="doller-become" style="font-size:22px">
                       <?=$row_tier['tier_price']?>
                      INR</h2>
                    <p class="doller-permonth">PER MONTH</p>
                    <p class="faccio-become">
                      <?=stripslashes(nl2br( $row_tier['description']))?>
                    </p>
                  </div> 
              <?php }} ?>
   							 
                                 