<?php
$base_path_new = basename($_SERVER['PHP_SELF']);

?>


         <ul class="tbs clearfix">
          <li <?php if($base_path_new=="edit_user.php") {?>class="activet"<?php } ?>  ><a href="<?=BASEPATH?>/edit/about/" class="be-fc-orange">Page Settings</a></li>
          <li <?php if($base_path_new=="edit_user_tier.php" || $base_path_new=="edit_user_tier_edit.php") {?>class="activet"<?php } ?>><a href="<?=BASEPATH?>/edit/tiers/" class="be-fc-orange">Pacts</a></li>
          
          <li  <?php if($base_path_new=="edit_user_goal.php" || $base_path_new=="edit_user_goal_edit.php") {?>class="activet"<?php } ?>><a href="<?=BASEPATH?>/edit/goals/" class="be-fc-orange">Goals</a></li>
          
          <li  <?php if($base_path_new=="edit_user_thanks.php" ) {?>class="activet"<?php } ?>><a href="<?=BASEPATH?>/edit/thanks/" class="be-fc-orange">Thanks</a></li>
          <li  <?php if($base_path_new=="edit_user_payment.php") {?>class="activet"<?php } ?>><a href="<?=BASEPATH?>/edit/payment/" class="be-fc-orange">Income</a></li>
           <?php if($row_user->review_status==1) {?>
          <li  <?php if($base_path_new=="edit_user_post.php" || $base_path_new=="edit_user_post_edit.php") {?>class="activet"<?php } ?>><a href="<?=BASEPATH?>/edit/post/" class="be-fc-orange">Manage Posts</a></li>
          <?php } ?>
          <?php if($row_user->review_status==0) {?>
          <li  <?php if($base_path_new=="profile_submit.php" ) {?>class="activet"<?php } ?>><a href="<?=BASEPATH?>/edit/review/" class="submit_review"><?php if($row_user->review_submit_status==0) {?>Submit for review<?php }else { ?> Review Status <?php } ?></a></li>
          <?php } ?>
          
          
           <?php if($row_user->review_status==1) {?>
          <li  <?php if($base_path_new=="edit_user_graph.php" ) {?>class="activet"<?php } ?>><a href="<?=BASEPATH?>/edit/statistics/" class="be-fc-orange">Page Insights</a></li>
          <?php } ?>
          
          
          
        </ul>
        
