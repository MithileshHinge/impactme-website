<?php 
//echo "select count(*) c, ifnull(sum(a.b),0) p from (select p.user_id, sum(paid_amount) b from impact_payment p, impact_user u where u.user_id=p.creator_id and p.creator_id='$row_user->user_id' and p.paid_status='Success' group by p.creator_id) a";
$total_impact = $db_query->fetch_object("select count(*) c, ifnull(sum(a.b),0) p from (select p.user_id, sum(paid_amount) b from impact_payment p where p.creator_id='$row_user->user_id' and p.paid_status='Success' group by p.user_id ) a");

 ?>
<div class="project-runtime" style="margin: 0 0 18px 0;box-shadow: 0 1px 4px rgba(0,0,0,.1);">
                  <div class="project-date clearfix" style="border:1px solid #ccc; border-radius:4px;">
                  <div class="photo" style="background-image:url(<?=$user_image?>);background-size:cover; "></div>     
                  <hr class="line-image">
              <p class="creater-name" style="text-align:center;    padding: 0 0 0 0; "><span class="creater-125"><?=stripslashes($row_user->impact_name)?> </span></p>
              <!--<p class="creater-count" style="text-align:center; left:0;"><?=stripslashes($row_user->tag_line)?></p>-->
                <div >
                    <span style="text-align:center;margin:auto;display:block;">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$profile_link?>" target="_blank"  >
                  <span style="margin: 0 0px 0 0;">
                    <i class="fab fa-youtube" style="font-size: 27px;margin-top:13px"></i>
                  </span>
                </a> 
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$profile_link?>"  target="_blank" >
                    <span style="">
                      <i class="fab fa-facebook-square" style="font-size: 22px;    margin: 0 7px 0 7px;position:relative;bottom:2px;"></i>
                    </span>
                 </a>
                 <?php if(strlen($row_user->instagram)>0) { ?>
                 <a href="https://www.instagram.com/<?=$row_user->instagram?>"  target="_blank" >
                    <span style="margin: 0 0px 0 0;">
                      <i class="fab fa-instagram" style="font-size: 22px;position:relative;bottom:2px;"></i>
                    </span>
                 </a>
                 <?php } ?>
                 </span>
                </div>
             <div style="text-align:center;">
                  <p class="creater-count" style="text-align:center; left:0;display:inline-block;margin:0 auto;    margin: 11px 14px 0 0;"><span class="creater-125"style="font-size:20px"><?=$total_impact->c ?></span><br>
                        Supporters</p>
                     <p class="creater-count" style="text-align:center; left:0;display:inline-block;margin:0 auto    "><span class="creater-125" style="font-size:20px">₹ <?=$total_impact->p ?></span><br>
                        Per month</p>
             </div>
                        <!--<a href="https://www.facebook.com/sharer/sharer.php?u=<?=$profile_link?>" target="_blank" class="share" style="color: white;background-color:rgb(66, 103, 178); "><span style="margin: 0 4px 0 0;"><i class="fa fa-facebook-square"></i></span>facebook</a> <a href="https://twitter.com/share?url=<?=$profile_link?>&amp;text=<?=PROJECT_TITLE?>&amp;hashtags=<?=PROJECT_TITLE?>"  target="_blank" class="share" style="color: white;background-color:rgb(62, 161, 236); "><span style="margin: 0 4px 0 0;"><i class="fa fa-twitter"></i></span>Tweet</a>-->
                      <div class="clr"></div>
            </div>
                    
                  </div>