<?php
 include('access.php');
 $row = $_POST['row'];
 $u = $_POST['u'];
 $rowperpage = PAGINATION;
 
 $sql_post = $db_query->runQuery("select * from impact_post where user_id='$u'  order by create_date desc limit $row,$rowperpage");
			  foreach($sql_post as $row_post) {
			   $sql_like_count = $db_query->fetch_object("select count(*) c from tbl_post_like where post_id='$row_post[post_id]'");
			   $row_comment = $db_query->fetch_object("select count(*) c from tbl_comment where post_id='".$row_post['post_id']."'");
			  ?>
              
              
              <div class="box-marked-project project-short short post" style="    margin-bottom: 33px;    padding: 0 0 23px 0;">
              
			   <?=$db_query->getImageUnlockDiv($row_post['post_id'], $row_user1->user_id, '', $row_user->user_id )?>
                 <?php list($show, $tier_link) =  $db_query->getImageUnlockDivStatus($row_post['post_id'], $row_user1->user_id, '', $row_user->user_id ); ?>
                 
                <?php //if($show == 1) { ?> 
                <p class="like" style="margin-left:20px;font-weight:bold;"><?=date('M d, Y', strtotime($row_post['create_date']))?> at <?=date('h:i a', strtotime($row_post['create_date']))?><span class="user-like"></span> <span class="post-like"><a href="javascript:void(0)" id="post_like" onclick="javascript:post_like(<?=$row_post['post_id']?>,<?=$row_user->user_id?>)"> 
                
                  <i class="fa fa-star fa-lg" aria-hidden="true"></i>
               <!--  <img src="<?=BASEPATH?>/images/starfish-empty-20px.png" style="padding: 2px 0 7px 0;">-->
                </a><span id="postLikeText<?=$row_post['post_id']?>"> <?=$sql_like_count->c?></span> Likes </span></p>
                <?php //} ?>
             <!--<p style="float: right;margin: 0 10px; 0 0"> Locked</p>-->
             <?php echo $db_query->getPostNameDescription($row_post['post_id'],0, $show,$tier_link);?>
             <?php $tier_link1 = $db_query->getPostNameDescriptionLink($row_post['post_id'],0, $show,$tier_link); ?>
          <p class="post-comments"><a href="<?=$tier_link1?>"><?=$row_comment->c?> comments</a></p>
            <!--<p class="like">1 Like</p>-->
            
            <?php 
			//$show == 1
			if($show == 5) { ?> 
              <?php if(isset($_SESSION['is_user_login'])==1) { ?> 
			
                <div id="output<?=$row_post['post_id']?>" >
			 
			  </div>
             
                  <div class="box_comment_section">
                      <form  id="frm-comment<?=$row_post['post_id']?>"  method="post" action="">
                       <div class="media comment-item">
                        <a href="#" class="thumb-left1">
                          <img src="<?=$user_image1?>" alt="" class="comment-image">
                       </a>
                           <div class="media-body">
                         <div class="input-row">
                      <textarea class="comment input-field com<?=$row_post['post_id']?>" type="text" name="comment" id="comment[<?=$row_post['post_id']?>]" placeholder="Add a Comment">  </textarea> 
                 </div>
                       </div>
                                <input  type="hidden" name="name" id="name<?=$row_post['post_id']?>" value="<?=$row_user->full_name?>" />
                           <input  type="hidden" name="user_id" id="user_id<?=$row_post['post_id']?>" value="<?=$row_user->user_id?>" />
                           <input  type="hidden" name="post_id" id="post_id<?=$row_post['post_id']?>" value="<?=$row_post['post_id']?>" class="post_id" /> 
                           <input type="hidden" name="comment_id" id="commentId<?=$row_post['post_id']?>" placeholder="Name" value="0" /> 
                           <div id="comment-message<?=$row_post['post_id']?>" class="comment-message">Comments Added Successfully!</div>
                       </div>
                       </form>
                    </div>
                    
                   
                    
               
   
               
               <?php } else { ?>
               
               <div class="box_comment">
                       <div class="media comment-item">
                        <a href="#" class="thumb-left">
                          <img src="<?=BASEPATH?>/images/nouser.png" alt="" >
                       </a>
                       <div class="media-body">
                         <p class="rs log-comment-content"><a href="<?=BASEPATH?>/login/">Log In</a> to Comment</p>
                       </div>
                       </div>
                    </div>
               <?php } ?>
               
               <?php } ?>
               
               
               
                
                </div>
              <?php } ?>
			  
              
               