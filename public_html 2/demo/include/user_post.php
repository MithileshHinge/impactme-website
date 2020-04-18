 <?php $sql_post = $db_query->runQuery("select * from impact_post where user_id='$row_user->user_id'  order by create_date desc");
			  foreach($sql_post as $row_post) {?>
              
              
              <div class="box-marked-project project-short short" style="    margin-bottom: 33px;    padding: 0 0 23px 0;">
                  <div class="editor-content"> 
                 
                 <?php if($row_post['post_type']=="image"){ ?>
            <div > <img src="<?=IMAGEPATH?><?=$row_post['image_path']?>" class="impact-post"> </div>
                  
             <?php ?>
             <?php }else{ ?>
            <div > <iframe frameborder="0"  width="100%" height="351" src="<?= $db_query->getYoutubeEmbedUrl($row_post['video_link'])?>"></iframe> 
            
            </div>
                  
             <?php }?>
             </div>
            
               <p class="like"><?=$row_post['create_date']?><span class="user-like"><i class="fa fa-heart"></i></span> <span class="post-like">143 Likes / 43 Comments</span></p>
               
             <!--<p style="float: right;margin: 0 10px; 0 0"> Locked</p>-->
             <h4 class="like"><?=$row_post['post_title']?></h4>
             <span  class="like"><?=html_entity_decode(stripslashes($row_post['description']))?></span>
            <!--<p class="like">1 Like</p>-->
            
            
            
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
               
               
               
               
                </div>
              <?php } ?>