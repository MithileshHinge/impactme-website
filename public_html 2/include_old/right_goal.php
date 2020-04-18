<?php /*?> <?php $sql_goal_check = $db_query->fetch_object("select count(*) c from impact_goal where user_id='$row_user->user_id'");
                        if($sql_goal_check->c==0) {?>


                 <div class="project-author">
                    <div class="box-gray">
                      <h3 class="tier add-tiers"><a href="<?=BASEPATH?>/edit/goals/">+ Add Goals</a></h3>
                    </div>
                  </div>
                  <?php } else {?>
                  
                  <?php $sql_goal = $db_query->runQuery("select * from impact_goal where user_id='$row_user->user_id'");
				foreach($sql_goal as $row_goal) { ?>	
                  <div class="project-author" >
                    <div class="box-gray" style="margin-bottom:20px; padding:10px;">
                      <h4 class="tier add-tiers" style="margin:0 auto;">
                      <?=($row_goal['goal_type']=='earning')?'Earnings Based Goals':'Community Based Goals'?>
                    </h4>
                    <h2 class="doller-become">
                      
                      <?php if($row_goal['goal_type']=='earning'){?> <?=CURRENCY?><?=$row_goal['goal_price']?> <?php } else { ?>
                      <?=$row_goal['patron_number']?> 
                      <?php } ?></h2>
                    <span class="faccio-become">
                      <?=stripslashes(nl2br($row_goal['description']))?>
                    </span>
                    </div>
                  </div>
                  
                  <?php } ?>
                  
                  <?php } ?>
                                    <!--end: .project-author --> 
                  
               <?php */?>
			   
               
               
                  <?php $sql_goal_check = $db_query->fetch_object("select count(*) c from impact_goal where user_id='$row_user->user_id'");
                        if($sql_goal_check->c>0) {?>                         
                                    
                                    
                                      <div class="project-author">
                                                    <div class="box-gray">
                                                         <h3 class="tier">Goals&nbsp;&nbsp;&nbsp;<span style="
    margin-left: 9%;
   "><a  href="javascript:return false;" id="view_all" style="font-size: 12px;

    color: #3ea1ec;
    text-align: center;
    text-decoration: none;">View All</a></span></h3>
                                                        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">

<section class="testimonial_section">
            <div class="" id="goal_grid">
                <div class="row">
                    
                    <div class="col-lg-12">
                    
                      	
                        <div class="testimonial_box">
                            <div class="testimonial_container">
                                
                                <div class="layer_content">
                                    <div class="testimonial_owlCarousel owl-carousel" id="myCarousel">
                                    
                                    <?php 
									  $g=1;
				  $sql_goal_count = $db_query->fetch_object("select count(*) c from impact_goal where user_id='$row_user->user_id'");
									$sql_goal = $db_query->runQuery("select * from impact_goal where user_id='$row_user->user_id'");
				foreach($sql_goal as $row_goal) { ?>
                                        <div class="testimonials" id="goal<?=$row_goal['goal_id']?>"> 
                                            <div class="testimonial_content">
                                                <div class="testimonial_caption">
                                                    <h6>10% completed</h6>
                                                    
                                                </div>
                                                <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:10%">
                                                  <span class="sr-only">70% Complete</span>
                                                </div>
                                              </div>
<h4 class="tier add-tiers" style="margin:0 auto;">
                      <?=($row_goal['goal_type']=='earning')?'Earnings Based Goals':'Community Based Goals'?>
                    </h4>
                   <h2>  <?php if($row_goal['goal_type']=='earning'){?> <?=CURRENCY?><?=$row_goal['goal_price']?> <?php } else { ?>
                      <?=$row_goal['patron_number']?> Impact <?php } ?></h2>
                                                <p><?=stripslashes(nl2br($row_goal['description']))?></p>
                                            </div>
                                            <div>
                                              <ul>
                                                <li class="test-page"><a  href="#"><?=$g++?> of <?=$sql_goal_count->c?></a></li>
                                                <li class="test-view"></li>
                                              </ul>
                                            </div>
                                        </div>
                                        <?php } ?>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="col-md-12" style="display:none;" id="goal_list">
            <?php 
			$jm=0;
			foreach($sql_goal as $row_goal) { ?>
                <div class="col-md-12" style="border-bottom: 1px solid #00000040;padding: 12px 0 9px 18px;">
                  <a href="javascript:return false;" onclick="return goal(<?=$jm++?>);">  <p class="goal-completed"><?php if($row_goal['goal_type']=='earning'){?> <?=CURRENCY?> <?=$row_goal['goal_price']?> <?php } else { ?>
                      <?=$row_goal['patron_number']?> Impact <?php } ?></p>
                    <p class="goal-text"><?=stripslashes(nl2br(mb_strimwidth($row_goal['description'],0,50)))?> </p>
                    </a>
                </div>
                <?php } ?>
                
            </div>
            
            
        </section>
        <!-- carousel -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>

        <script type="text/javascript">
          $('.testimonial_owlCarousel').owlCarousel({
    loop:true,
    margin:10,
    dots:false,
    nav:true,
    autoplay:false,   
    smartSpeed: 200, 
    autoplayTimeout:4000,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})


$("#view_all").click(function()
{
  $("#goal_list").css("display","block");
  $("#goal_grid").css("display","none");
   $('.owl-item').removeClass('active');
});
 
 function goal(goal_id)
 {

  $("#goal_grid").css("display","block");
  $("#goal_list").css("display","none");
//  $("#goal"+goal_id).css("display","block");
//$("#goal"+goal_id).addClass('active');
   // $('#myCarousel').trigger('to.owl.carousel', goal_id);
	$('#myCarousel').trigger('to.owl.carousel', [goal_id,0,true])
 }
 
        </script>
                                                    </div>
                                                </div><!--end: .project-author -->
                  
                  <?php } ?>