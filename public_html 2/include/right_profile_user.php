<?php 
//echo "select count(*) c, ifnull(sum(a.b),0) p from (select p.user_id, sum(paid_amount) b from impact_payment p, impact_user u where u.user_id=p.creator_id and p.creator_id='$row_user1->user_id' and p.paid_status='Success' group by p.creator_id) a";
$sql_1223=  "select count(*) c, ifnull(sum(a.b),0) p from (select p.user_id, paid_amount b from impact_payment p where p.creator_id='$row_user1->user_id' and (p.status='authenticated' or p.status='active') group by p.subscription_id) a " ;
$total_impact = $db_query->fetch_object($sql_1223);

$total_onetime = $db_query->fetch_object("select ifnull(sum(a.b),0) p from (select p.user_id, paid_amount b from impact_pay_onetime p where p.creator_id='$row_user1->user_id' and p.status='success' group by p.transaction_id) a");
 ?>


<div class="project-runtime" style="margin: 0 0 18px 0;" >
                  <div class="project-date clearfix" style="border:1px solid #ccc; border-radius:4px;">
                  <div class="photo" style="background-image:url(<?=$user_image?>);background-size:cover; cursor:pointer;" onclick="location.href='<?=$user1_path?>';"></div> 
                   <hr class="line-image">
              <p class="creater-name" style="text-align:center;    padding: 0 0 0 0; "><span class="creater-125" style="cursor:pointer;" onclick="location.href='<?=$user1_path?>';"><?=stripslashes($row_user1->impact_name)?></span></p>
              <!--<p class="creater-count" style="text-align:center; left:0;"><?=stripslashes($row_user1->tag_line)?></p>-->
              <div >
                <span style="text-align:center;margin:auto;display:block;">
                  <?php if(strlen($row_user1->youtube_link)>0) { ?>
                  <a href="<?=$row_user1->youtube_link?>" target="_blank"  >
                    <span style="margin: 0 0px 0 0;">
                      <i class="fab fa-youtube" style="font-size: 27px;margin:13px 3px 0 0"></i>
                    </span>
                  </a> 
                  <?php }
                  
                  if(strlen($row_user1->facebook_link)>0) { ?>
                  <a href="<?=$row_user1->facebook_link?>"  target="_blank" >
                      <span style="">
                        <i class="fab fa-facebook-square" style="font-size: 22px;    margin: 10px 4px 0 4px;position:relative;bottom:2px;"></i>
                      </span>
                   </a>
                 <?php }

                 if(strlen($row_user1->instagram)>0) { ?>
                 <a href="https://www.instagram.com/<?=$row_user1->instagram?>"  target="_blank" >
                    <span style="margin: 0 0px 0 0;">
                      <i class="fab fa-instagram" style="font-size: 22px;position:relative;margin:10px 0 0 3px;bottom:2px;"></i>
                    </span>
                 </a>
                 <?php } ?>
                </span>
              </div>
              <div style="text-align:center;">
              <?php
			
			   if($row_user1->patronage_visibility==1) { ?>
                  <p class="creater-count" style="text-align:center; left:0;display:block;margin:0 auto;    margin: 11px 0 0 0;"><span class="creater-125"style="font-size:20px"><?php if (empty($total_impact->c)){
                       echo "0";
                     }else {
                      echo $total_impact->c;
                    } ?></span><br>
                        Supporters</p>
                        <?php } ?>
                        <?php if($row_user1->earning_visibility==1) { ?>
                      <p class="creater-count" style="text-align:center; left:0;display:block;margin:0 auto    "><span class="creater-125" style="font-size:20px">₹<?php if (empty($total_impact->p)){
                       echo "0";
                     }else {
                      echo $total_impact->p;
                    } ?></span><br>
                        Per month</p>
                        <?php } ?> 
                      <?php if ($row_user1->onetime_visibility==1){ ?>
                      <p class="creater-count" style="text-align:center; left:0; display:block; margin:0 auto;">
                    <span class="creater-125" style="font-size:20px">₹<?php if (empty($total_onetime->p)){
                       echo "0";
                     }else {
                      echo $total_onetime->p;
                    } ?></span><br>
                        One time payments
                  </p>
                  <?php }?>
                        
              </div>
                        
                      <div class="clr"></div>
            </div>
                    
                  </div>