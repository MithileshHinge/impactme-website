 <?php $sql_goal_check = $db_query->fetch_object("select count(*) c from impact_goal where user_id='$row_user->user_id'");
                        if($sql_goal_check->c==0) {?>


                 <div class="project-author">
                    <div class="box-gray">
                      <h3 class="tier add-tiers">+ Add Goals</h3>
                    </div>
                  </div>
                  <?php } else {?>
                  
                  <?php $sql_goal = $db_query->runQuery("select * from impact_goal where user_id='$row_user->user_id'");
				foreach($sql_goal as $row_goal) { ?>	
                  <div class="project-author" >
                    <div class="box-gray" style="margin-bottom:20px; padding:10px;">
                      <h3 class="tier add-tiers" style="margin:0 auto;">
                      <?=($row_goal['goal_type']=='earning')?'Earnings-based goals':'Community-based goals'?>
                    </h3>
                    <h2 class="doller-become">
                      <?=$row_goal['goal_price']?>
                      INR</h2>
                    <p class="faccio-become">
                      <?=stripslashes(nl2br($row_goal['description']))?>
                    </p>
                    </div>
                  </div>
                  
                  <?php } ?>
                  
                  <?php } ?>
                                    <!--end: .project-author --> 
                  
               