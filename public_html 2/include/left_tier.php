
                                             
                                              

<?php $sql_tier_check = $db_query->fetch_object("select count(*) c from impact_tier where user_id='$row_user->user_id'");
if($sql_tier_check->c==0) {?>

                  <div class="project-author">
                    <div class="box-gray">
                      <h3 class="tier add-tiers"><a href="<?=BASEPATH?>/edit/tiers/">+ Add Tiers</a></h3>
                   </div>
                 </div>
                 <?php } else { ?>
				  <div class="wrap-lst-category" style="box-shadow: 0 1px 4px rgba(0,0,0,.1);">
                   <h3 class="tier">
                       Waves  
                   <a href="#" class="become" onClick="alert('You cannot join your own tiers')">See all</a>
                   </h3>
                <?php $sql_tier = $db_query->runQuery("select * from impact_tier where user_id='$row_user->user_id' order by tier_price");
				foreach($sql_tier as $row_tier) { 
				$tier_link = BASEPATH.'/join/'.$row_user1->user_id.'/checkout/'.$row_tier['tier_id'].'/';
				
				?>	
                
                <div class="tier1">
 <h4 class="livello"><?=$row_tier['tier_name']?> (₹ <?=$row_tier['tier_price']?>)</h4>
<div style="padding-left: 20px;padding-right: 20px;">
    <span class="more" style="text-align: justify;color: #455058;font-weight: 300;"> <?=stripslashes(nl2br( $row_tier['description']))?></span></div>
                                                  <br /><br>
      <?php if($row_user->user_id==base64_decode($_SESSION['user_id'])) {?>

       <div>
           <a href="#" class="join_btn">Join ₹ <?=$row_tier['tier_price'].' '?> Wave</a>
           </div>
       <?php } else { ?>
        <a href="<?=$tier_link?>" class="join_btn">Join <?=$row_tier['tier_price'].' '.CURRENCY?> Tier</a>
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
   							 
                                 