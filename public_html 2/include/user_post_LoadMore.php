 <?php 
 include('access.php');
 $row = $_POST['row'];
 $rowperpage = PAGINATION;
 
  $sql_c22_count = $db_query->fetch_object("select count(*) c from impact_post where status=1 and user_id='$row_user->user_id'  order by create_date desc"); 
 
$allcount =  $sql_c22_count->c;

 $sql_post = $db_query->runQuery("select * from impact_post where status=1 and user_id='$row_user->user_id'  order by create_date desc limit $row,$rowperpage");
 
 
 
 
			  foreach($sql_post as $row_post) {
			  $sql_like_count = $db_query->fetch_object("select count(*) c from tbl_post_like where post_id='$row_post[post_id]'");
			   $row_comment = $db_query->fetch_object("select count(*) c from tbl_comment where post_id='".$row_post['post_id']."'");
			  ?>
              
              
              <div class="box-marked-project project-short short post" style="    margin-bottom: 18px;    padding: 0 0 0px 0;">
                
                  <div class="editor-content"> 
                   <?=$db_query->getPostImageDiv($row_post['post_id'], 350)?>
                   
                 </div>
            
               <p class="like" style="margin-left:20px;"><?=date('M d, Y', strtotime($row_post['create_date']))?> at <?=date('h:i a', strtotime($row_post['create_date']))?><span class="user-like"></span> <span class="post-like">
               <!--<i class="fa fa-star" style="font-size: 18px;"></i> -->
               <?php include('include/like_button.php');?>
               <!--  <img src="<?=BASEPATH?>/images/starfish-empty-20px.png" style="padding: 2px 0 7px 0;">-->
               <span id="postLikeText<?=$row_post['post_id']?>"><?=$sql_like_count->c?></span> Likes </span></p>
               
             <!--<p style="float: right;margin: 0 10px; 0 0"> Locked</p>-->
             <?php $post_path_link = BASEPATH.'/post/'.$row_post['post_id'].'/'; ?>  
             <?php echo $db_query->getPostNameDescription($row_post['post_id'],0, 1,"#");?>
             <?php $tier_link1 = $db_query->getPostNameDescriptionLink($row_post['post_id'],0, 1,"#"); ?>
             <!--a href="<?=$post_path_link?>"> <h4 class="like"><?=$row_post['post_title']?></h4></a>
    
            <span  class="like"><?=mb_strimwidth(html_entity_decode(stripslashes($row_post['description'])),0,500)?></span-->
     
            <br />  
   
   
   
        
               
              <?php // echo $db_query->getPostNameDescription($row_post['post_id'], $row_user->user_id,1);?>
                <?php //$tier_link1 = $db_query->getPostNameDescriptionLink($row_post['post_id'], $row_user->user_id,1); ?>
                
            <p class="post-comments"><a href="<?=$post_path_link?>"><?=$row_comment->c?> comments</a></p>
            
             <?php 
			//$show == 1
		    	if($show == 5) { ?> 
            
             <?php if(isset($_SESSION['is_user_login'])==1) { ?> 
			
               <div id="output<?=$row_post['post_id']?>" >
			 
			  </div>
             
                  <div class="box_comment_section">
                      <form  id="frm-comment<?=$row_post['post_id']?>"  method="post" action="" >
                       <div class="media comment-item">
                        <a href="#" class="thumb-left1">
                          <img src="<?=$user_image?>" alt="" class="comment-image">
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
                          <img src="<?=BASEPATH?>/images/nouser.png" alt="">
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
			  
              