<?php

if (empty($row_post->post_id))
	$post_id = $row_post['post_id'];
else
	$post_id = $row_post->post_id;

$ids = $db_query->get_ids_sql($row_user->user_id);
?>

<a href="javascript:void(0)" id="post_like" onclick="javascript:post_like(this, <?=$post_id?>,<?=$row_user->user_id?>)" style="outline: 0; text-decoration:none;"> 
<?php $sql_check = $db_query->fetch_object("select count(*) c from tbl_post_like where post_id='$post_id'  and user_id in $ids");
if($sql_check->c==0) {?>
<i class="material-icons" style="position:relative; top:6px;">favorite_border</i>
<?php }else { ?>
<i class="material-icons" style="position:relative; top:6px; color: #da5454;">favorite</i>
<?php } ?>
</a>
<!--i class="fa fa-star fa-lg" aria-hidden="true"></i-->
<!--i class="fa fa-star" style="font-size: 18px;"></i-->
<!--i class="fa fa-heart"></i-->