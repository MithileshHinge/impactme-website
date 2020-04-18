<?php include('admin_path.php'); 
include('include/access.php');
?>
<?php
$image_save_folder = "user";
$table_name = "impact_post" ;
$table_id = "post_id";
$view_page = BASEPATH."/edit/post/";

$edit_id = $_GET['edit_id'];
$row_edit = $db_query->fetch_object("select * from ".$table_name." where ".$table_id."='".$edit_id."'");
$page_title = "Post | ".PROJECT_TITLE;

if(strlen($row_user->cover_image_path)>0)
 $cover_image = IMAGEPATH.$row_user->cover_image_path;
else
 $cover_image = IMAGEPATH.'background.jpg'; 


if(strlen($row_user->image_path)>0)
 $user_image = IMAGEPATH.$row_user->image_path;
else
 $user_image = IMAGEPATH.'icon_man.png'; 
 
 if($_REQUEST['mode']=="add")
 {
  $id1=$_REQUEST[$table_id];
  $row_post_check = $db_query->fetch_object("select * from ".$table_name." where ".$table_id."=".$id1);	
  if($_FILES['image']['tmp_name']!="")
  {
  
	 $baseimg = $image_folder_name."/";	
      unlink($baseimg.$row_post_check->image_path);
      $main_path = $image_folder_name."/".$image_save_folder."/";
      $thumb = $main_path."thumbs/";
      $upload_img = $db_query->cwUpload('image',$main_path,'',TRUE,$thumb,'100','75');
      $_REQUEST[image_path] =  $image_save_folder."/".$upload_img; 	
  }	    
  else
  {
     $_REQUEST[image_path] =  $row_post_check->image_path; 
  }
  $_REQUEST[user_id] = $row_user->user_id;
   
   $db->updateArray($table_name,$_REQUEST,$table_id."=".$id1);
  
  
 //$db->updateArray("impact_user",$_REQUEST,"user_id=".$row_user->user_id);
// header('location:'.BASEPATH.'/edit/about/');
 header('location:'.$view_page."?msg=update");
 
 }
 if($_GET[msg]==1)
{
$msg = "<span style='color:green;font-weight:bold; margin-bottom:10px;'>Added Successfully</span>";
$error_type = "success";
	$sign = "fa-check";
 }

 
 if($_GET['id'])
{
	$id=$_GET['id'];
	
	$sql="DELETE FROM ".$table_name." WHERE ".$table_id."='$id'";
	$res=$db_query->runQuery($sql);
	
		header("location:".$view_page);

}
if($_GET[$table_id] && $_GET['status'])
{
  $id=base64_decode($_GET[$table_id]);
  $status=base64_decode($_GET['status']);
  if($status=='0')
  {
     $sql_status="UPDATE ".$table_name." SET `status`='1' WHERE ".$table_id."='$id'";
     $res_status=$db_query->runQuery($sql_status);
	  header('location:'.$view_page);
   }
  if($status=='1')
  {
    $sql_status="UPDATE ".$table_name." SET `status`='0' WHERE ".$table_id."='$id'";
    $res_status=$db_query->runQuery($sql_status);
	  header('location:'.$view_page);
  }
}



?>

<!DOCTYPE html>
<html>
<head>
 <title><?=$page_title?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=$sql_web->meta_description?>" /> 
    <meta name="title" content="<?=$sql_web->meta_title?>" />
    
    
    
    <meta name="keywords" content="<?=$sql_web->meta_keyword?>" />

<meta name="author" content="<?=PROJECT_TITLE?>" />
<meta name="copyright" content="<?=PROJECT_TITLE?>" />
<meta name="application-name" content="<?=PROJECT_TITLE?>" />

<!-- For Facebook -->
<meta property="og:title" content="<?=$sql_web->meta_title?>" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?=IMAGEPATH.$row_user->image_path?>" />
<meta property="og:url" content="<?=$_SERVER['REQUEST_URI']?>" />
<meta property="og:description" content="<?=$sql_web->meta_description?>" />

<!-- For Twitter -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?=$sql_web->meta_title?>" />
<meta name="twitter:description" content="<?=$sql_web->meta_description?>" />
<meta name="twitter:image" content="<?=IMAGEPATH.$row_user->image_path?>" />


    <?php include('include/titlebar.php'); ?>
    <style>
	.active {
    border: 0px solid;
    margin: 6px 0 10% 0px;
}
	
	</style>
</head>

<body>
<div id="wrapper" style="background-image:url(<?=BASEPATH?>/images/blog-banner.jpg); background-size:cover;">
<?php include('include/header.php'); ?>

<div class="layout-2cols">
  <div class="content grid_12" >
   
    <div class="project-detail">
      <div class="project-tab-detail tabbable accordion edit-about">
      <?php if(isset($msg)){?> <div  id="err_msg"><?=$msg?></div> <?php } ?>
        <ul class="tbs clearfix">
          <li ><a href="<?=BASEPATH?>/edit/about/">About</a></li>
          <li><a href="<?=BASEPATH?>/edit/tiers/" class="be-fc-orange">Tiers</a></li>
          <li><a href="<?=BASEPATH?>/edit/goals/" class="be-fc-orange">Goals</a></li>
          <li><a href="<?=BASEPATH?>/edit/thanks/" class="be-fc-orange">Thanks</a></li>
          <li ><a href="<?=BASEPATH?>/edit/payment/" class="be-fc-orange">Payment</a></li>
         <?php if($row_user->review_status==1) {?>
          <li  class="activet"><a href="<?=BASEPATH?>/edit/post/" class="be-fc-orange">Manage Your Post</a></li>
          <?php } ?>
          <?php if($row_user->review_status==0) {?>
          <li ><a href="<?=BASEPATH?>/edit/review/" class="submit_review"><?php if($row_user->review_submit_status==0) {?>Submit for review<?php }else { ?> Review Status <?php } ?></a></li>
          <?php } ?>
        </ul>
        
        
        
        <div class="tab-content">
          <div>
         
            <h3 class="rs alternate-tab accordion-label">Tiers</h3>
            <div class="tab-pane accordion-content active">
              <div class="form form-profile">
                <form action="<?=$_SERVER['PHP_SELF']?>" name="myForm"  method="post" enctype="multipart/form-data" id="post-formcreater">
               
                <input type="hidden" name="mode" value="profile" />
                   <div class="row-item clearfix" >
                    <label class="lbl" for="txt_location">Post Title:</label>
                    <div class="val">
                      <input class="txt" type="text" name="post_title" id="post_title" value="<?=$row_edit->post_title?>" required  >
                    </div>
                  </div>
                  
                  
                     <div class="row-item clearfix">
                    <label class="lbl" for="txt_name1">Post Type:</label>
                    <div class="val">
                      <select  class="txt" name="post_type" id="post_type" required>
                      <option value="">--Select Post Type--</option>
                              <option value="image" <?=($row_edit->post_type=="image")?'selected':''?>>Image</option>
                              <option value="video" <?=($row_edit->post_type=="video")?'selected':''?>>Video</option>
                            </select>
                    </div>
                  </div>
                  <div class="row-item clearfix" id="goal" <?php if($row_edit->post_type=="video") {?>style="display:none"<?php } ?>>
                    <label class="lbl" for="txt_location">Image :</label>
                    <div class="val">
                      <input class="txt" type="file" name="image" id="image" value="<?=$row_edit->image_path?>"  accept="image/*">
                      <img src="<?=IMAGEPATH.$row_edit->image_path?>" style="    width: 250px;
    margin-left: 20%;
    margin-top: 13px;"> 
                    </div>
                  </div>
                  
                  
                         <div class="row-item clearfix" id="patron"  <?php if($row_edit->post_type=="image") {?>style="display:none"<?php } ?>>
                    <label class="lbl" for="txt_location">You Tube Video Link:</label>
                    <div class="val">
                      <input class="txt" type="text" name="video_link" id="video_link" value="<?=$row_edit->video_link?>"  >
                    </div>
                  </div>
                  
                  
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_name1">Price:</label>
                    <div class="val">
                      <select  class="txt" name="price_type" id="price_type" required>
                      <option value="">--Select Post Price--</option>
                              <option value="free" <?=($row_edit->price_type=="free")?'selected':''?>>Free</option>
                              <option value="tier" <?=($row_edit->price_type=="tier")?'selected':''?>>Tier</option>
                            </select>
                    </div>
                  </div>
                  
                  <div class="row-item clearfix" id="price" <?php if($row_edit->price_type=="free"){?> style="display:none"<?php } ?>>
                    <label class="lbl" for="txt_name1">Price:</label>
                    <div class="val">
                      <select  class="txt" name="tier_id" id="tier_id" required>
                      <option value="">--Select Tier--</option>
                             <?php
							 $sql_tier = $db_query->runQuery("select * from impact_tier where user_id='$row_user->user_id' and status=1 order by tier_name");
							 foreach($sql_tier as $row_tier){
							 
							 ?>
                             <option value="<?=$row_tier['tier_id']?>"<?php if($row_edit->tier_id==$row_tier['tier_id']){?> selected<?php } ?>><?=$row_tier['tier_name']?>(<?=$row_tier['tier_price']?><?=CURRENCY?>)</option>
                             <?php } ?>
                            </select>
                    </div>
                  </div>
                  
                  
                  
              
                    <div class="val"  style="margin: 28px 27px 0 71px;"> 
                        <label class="lbl" for="txt_location" style="font-size:18px;margin:0 0px 23px 0">Description:</label>
                     <textarea  class="form-control" name="description" id="description" parsley-trigger="change"  ><?=$row_edit->description?></textarea>
                              
                              <script>
	CKEDITOR.replace('description',{
                       
                       filebrowserWindowWidth: '900',
					   filebrowserWindowHeight: '400',
					   filebrowserBrowseUrl : '<?=ADMINPATH?>/ckfinder/ckfinder.html',
					   filebrowserImageBrowseUrl : '<?=ADMINPATH?>/ckfinder/ckfinder.html?type=Images',
					   filebrowserFlashBrowseUrl : '<?=ADMINPATH?>/ckfinder/ckfinder.html?type=Flash',
					   filebrowserUploadUrl : '<?=ADMINPATH?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
					   filebrowserImageUploadUrl : '<?=ADMINPATH?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
					   filebrowserFlashUploadUrl : '<?=ADMINPATH?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
	} );
</script>
                    </div>
                  
      
                  
                  
                  
                  
                  
                  <div class="row-item clearfix">
                   <input type="hidden" name="<?=$table_id?>" value="<?=$edit_id?>"> 
                  <input type="hidden" name="mode" value="add">  
                    <button class="btn btn-red btn-submit-all newtier" style="    margin-left: 68px;">Update</button>
                  </div>
                  <div class="row-item clearfix">&nbsp;</div>
                </form>
              </div>
            </div>
            <!--end: .tab-pane --> 
          </div>
         
        </div>

        <div class="container_12 clearfix" style="background-color:#FFF; width:100%;">
          <?php $sql_post = $db_query->runQuery("select * from ".$table_name." where user_id='$row_user->user_id'");
			  foreach($sql_post as $row_post)
			  {?>
            <div class="box-marked-project short" style="padding:0 20px 20px 20px;">
            <?php if($row_post['post_type']=="image"){ ?>
            <div > <img src="<?=IMAGEPATH.$row_post['image_path']?>" > </div>
                  
             <?php }else {?>
            
            <div > <img src="<?= $db_query->getYoutubeImage($row_post['video_link'])?>" > </div>
                  
             <?php }?>
                  
                  <p class="like"><?=date('d M, Y H:i:s A',strtotime($row_post['create_date']))?></p>
                  <p style="float: right;margin: 0 10px; 0 0">
                  
                  <a href="<?=$view_page?>?<?=$table_id?>=<?=base64_encode($row_post[$table_id])?>&status=<?=base64_encode($row_post[status])?>" title="Active/Inactive">
        <?php if($row_post[status]==1){?><i class="fa fa-unlock"></i><?php }else{?><i class="fa fa-lock"></i><?php }?></a> &nbsp;&nbsp;
   
                  
                  
                   
                  
                  <a href="<?=$view_page?><?=$row_post['post_id']?>/" title="Edit" ><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                 <a href="javascript:void(0);" onClick="javascript:deldata(<?=$row_post['post_id']?>)" title="Delete" ><i class="fa fa-times"></i></a>
             
             
                  </p>
                  <h4 class="like"><?=$row_post['post_title']?></h4>
                  <?php if($row_post['price_type']=="free"){?><h4 class="like">Free</h4><?php } else {
				  $row_tier_check = $db_query->fetch_object("select tier_name, tier_price from impact_tier where tier_id='$row_post[tier_id]'");
				  ?>
                  <h4 class="like"><?=$row_tier_check->tier_name?> (<?=$row_tier_check->tier_price.CURRENCY?>)</h4>
                  
                  <?php } ?>
                  <p class="like"><?=html_entity_decode(stripslashes($row_post['description']))?></p>
                 <!-- <p class="like">1 Like</p>-->
                </div>
                <?php }?>
                </div>
                
         
          
               <div class="col-md-12 " style="padding:0;height:100px; margin-bottom:10px;">&nbsp;
          </div>
      </div>
      <!--end: .project-tab-detail --> 
    </div>
  </div>
  <!--end: .content -->
  
  <div class="clear"></div>
</div>


</div>
<?php include('include/footer.php');
include('include/footer_js.php');?>

 <script language="JavaScript" >
function deldata(id)
{
	if(confirm("Do you want to delete?"))
	{
		window.location.href="<?=$view_page?>?id="+id;
	}
}
</script>
</div>

<script type="text/javascript">
  $(document).ready(function() {
   setTimeout(function(){ $("#err_msg").fadeOut(); }, 3000);
  });
 
</script>

<script type="text/javascript">
  $(document).ready(function() {
   setTimeout(function(){ $("#err_msg").fadeOut(); }, 3000);
   
    $("#post_type").change(function(){

        var post_type = $(this).val();
	

if(post_type=="image")
{
  $("#goal").css("display","block");
  $("#patron").css("display","none");
  }
else if(post_type=="video" )  
{
$("#goal").css("display","none");
  $("#patron").css("display","block");
  
  }
  else
  {
  $("#goal").css("display","none");
  $("#patron").css("display","none");
  }
});

    $("#price_type").change(function(){

        var price_type = $(this).val();
	

if(price_type=="free")
{

  $("#price").css("display","none");
  }
else if(price_type=="tier" )  
{
  $("#price").css("display","block");
  
  }
  else
  {
  $("#price").css("display","none");
  }
});

  });
 
</script>



</body>
</html>
