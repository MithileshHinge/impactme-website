<?php 
include('access.php');
 $row = $_POST['row'];
$rowperpage = PAGINATION;


 $sql_c22_count = $db_query->fetch_object("select count(*) c from impact_post where user_id in (select u.user_id id from impact_payment p, impact_user u where u.user_id=p.creator_id and p.user_id='$row_user->user_id' and p.paid_status='Success' group by p.creator_id) order by create_date desc"); 
 
 
$sql_c22 = "select * from impact_post where user_id in (select u.user_id id from impact_payment p, impact_user u where u.user_id=p.creator_id and p.user_id='$row_user->user_id' and p.paid_status='Success' group by p.creator_id) order by create_date desc limit $row,$rowperpage";


  

$sql_user =  $db_query->runQuery($sql_c22 );
foreach($sql_user as $row_post)
{
			  
		 $sql_like_count = $db_query->fetch_object("select count(*) c from tbl_post_like where post_id='$row_post[post_id]'");
         $row_userPost = $db_query->fetch_object("select * from impact_user where user_id='$row_post[user_id]'");
         $userImagN = IMAGEPATH.$row_userPost->image_path;
		 $row_comment = $db_query->fetch_object("select count(*) c from tbl_comment where post_id='".$row_post['post_id']."'");
			  ?>
              
              
              <div class="box-marked-project project-short short post" id="post_<?=$row_post['post_id']?>" style="    margin-bottom: 33px;    padding: 0 0 23px 0;">
                  
              <div class="post-creater-postname">
                  <ul style="padding: 0 0 0 8px;">
                      <li style="list-style:none;"> 
                            <a href="<?=$path2?>" class="suppt-list">
                                <div class="small-creater-support" style="background-image:url(<?=$userImagN?>);  background-size:cover;"></div>
                                <div class="small_support">
                                    <span class="creater-post-title"><?=stripslashes(ucwords(strtolower($row_userPost->full_name)))?></span>
                               
                                </div>
                            </a>
                        </li>
                  </ul>
              </div>
              
			      <?=$db_query->getImageUnlockDiv($row_post['post_id'], $row_post[user_id], '', $row_user->user_id )?>
                  <?php list($show, $tier_link) =  $db_query->getImageUnlockDivStatus($row_post['post_id'], $row_post[user_id], '', $row_user->user_id ); ?>  
                <p class="like" style="margin-left:20px;font-weight:bold;"><?=date('M d, Y', strtotime($row_post['create_date']))?> at <?=date('h:i a', strtotime($row_post['create_date']))?>
                <span class="user-like"></span> 
                <span class="post-like">
                <a href="javascript:void(0)" id="post_like" onclick="javascript:post_like(<?=$row_post['post_id']?>,<?=$row_user->user_id?>)">
                <i class="fa fa-star fa-lg" aria-hidden="true"></i>
                    <!--<img src="<?=BASEPATH?>/images/starfish-empty-20px.png" style="padding: 2px 0 7px 0;">-->
                  </a>
                <span id="postLikeText<?=$row_post['post_id']?>"> <?=$sql_like_count->c?></span> Likes </span></p>
               <br />
               <?php echo $db_query->getPostNameDescription($row_post['post_id'],0, $show,$tier_link);?>
               <?php $tier_link1 = $db_query->getPostNameDescriptionLink($row_post['post_id'],0, $show,$tier_link); ?>
               <p class="post-comments"><a href="<?=$tier_link1?>"><?=$row_comment->c?> comments</a></p>
           
                </div>
              <?php } ?>
              
             
            
            
			  
       