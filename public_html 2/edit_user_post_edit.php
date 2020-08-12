<?php include('admin_path.php'); 
include('include/access.php');
?>
<?php
$image_save_folder = "user";
$table_name = "impact_post" ;
$table_id = "post_id";
$view_page = BASEPATH."/edit/post/";

$edit_id1 = $_GET['edit_id'];
$row_edit = $db_query->fetch_object("select * from ".$table_name." where ".$table_id."='".$edit_id1."' and user_id='".$row_user->user_id."'");

$edit_id = $row_edit->post_id;

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
  if($_REQUEST['post_type']=="image") 
{
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
}
else if($_REQUEST['post_type']=="other") 
{ 

        if($_FILES['image1']['tmp_name']!="")
        {
        
         $baseimg = $image_folder_name."/"; 
            unlink($baseimg.$row_post_check->image_path);
            $main_path = $image_folder_name."/".$image_save_folder."/";
            $thumb = $main_path."thumbs/";
            $file_name = time();
            $upload_img = $db_query->cwUpload('image1',$main_path,  $file_name);
            $_REQUEST[image_path] =  $image_save_folder."/".$upload_img;  
        }     
        else
        {
           $_REQUEST[image_path] =  $row_post_check->image_path; 
        }

}
   else
  {
     $_REQUEST[image_path] = $row_post_check->image_path; 
  }

  $_REQUEST[user_id] = $row_user->user_id;
  
   if($_REQUEST['price_type']=="free" || $_REQUEST['price_type']=="one_time")
  {
   $_REQUEST['tier_id'] = 0;
  }
   
   $db->updateArray($table_name,$_REQUEST,$table_id."=".$id1);
  
  
 //$db->updateArray("impact_user",$_REQUEST,"user_id=".$row_user->user_id);
// header('location:'.BASEPATH.'/edit/about/');
 header('location:'.$view_page."?msg=update");
 
 }

 if($_GET[msg]==1)
{
$msg = "Post added successfully.";
$error_type = "success";
 }

if($_GET[msg]=="update")
{
$msg = "Post updated successfully.";
$error_type = "success";
} 
if($_GET[msg]=="deleted")
{
  $msg = "Post deleted successfully.";
  $error_type = "success";
}
if($_GET[msg]=="archived")
{
  $msg = "Post has been archived.";
  $error_type = "success";
}
if($_GET[msg]=="unarchived")
{
  $msg = "Post has been unarchived.";
  $error_type = "success";
}

 
 if($_GET['id'])
{
	$id=$_GET['id'];
	
	$sql="DELETE FROM ".$table_name." WHERE ".$table_id."='$id' and user_id='$row_user->user_id'";
	$res=$db_query->runQuery($sql);
	
		header("location:".$view_page."?msg=deleted");

}
if($_GET[$table_id] && $_GET['status'])
{
  $id=base64_decode($_GET[$table_id]);
  $status=base64_decode($_GET['status']);
  if($status=='0')
  {
     $sql_status="UPDATE ".$table_name." SET `status`='1' WHERE ".$table_id."='$id' and user_id='$row_user->user_id'";
     $res_status=$db_query->runQuery($sql_status);
    header('location:'.$view_page."?msg=unarchived");
   }
  if($status=='1')
  {
    $sql_status="UPDATE ".$table_name." SET `status`='0' WHERE ".$table_id."='$id' and user_id='$row_user->user_id'";
    $res_status=$db_query->runQuery($sql_status);
    header('location:'.$view_page."?msg=archived");
  }
}



?>

<!DOCTYPE html>
<html>
<head>
 <title><?=$page_title?></title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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

<body class="body-bg">
<div id="wrapper" style="background-image:url(<?=BASEPATH?>/images/setting-back.jpg); ">
<?php include('include/header.php'); ?>

<div class="layout-2cols">
  <div class="content grid_12" >
   
    <div class="project-detail">
      <div class="project-tab-detail tabbable accordion edit-about">
        <?php include('include/user_menu.php');?>
        
        
        
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
                      <select disabled="true" class="txt" id="post_type" required>
                      <option value="">--Select Post Type--</option>
                              <option value="image" <?=($row_edit->post_type=="image")?'selected':''?>>Image</option>
                              <option value="video" <?=($row_edit->post_type=="video")?'selected':''?>>Video</option>
                               <option value="other" <?=($row_edit->post_type=="other")?'selected':''?>>Other</option>
                            </select>
                      <input type="hidden" name="post_type" value="<?=$row_edit->post_type?>"/>
                    </div>
                  </div>
                  <div class="row-item clearfix" id="goal" <?php if($row_edit->post_type=="video" || $row_edit->post_type=="other") {?>style="display:none"<?php } ?>>
                    <label class="lbl" for="txt_location">Image :</label>
                    <div class="val">
                      <input disabled class="txt" type="file" id="image" value="<?=$row_edit->image_path?>"  accept="image/*"/>
                      <input type="hidden" name="image" value="<?=$row_edit->image_path?>"/>
                      <img src="<?=IMAGEPATH.$row_edit->image_path?>" style="    width: 250px;
    margin-left: 20%;
    margin-top: 13px;"> 
                    </div>
                  </div>

                   <div class="row-item clearfix" id="goal_other" <?php if($row_edit->post_type=="video" || $row_edit->post_type=="image") {?>style="display:none"<?php } ?>>
                    <label class="lbl" for="txt_location">Upload File :</label>
                    <div class="val">
                      <input disabled class="txt" type="file" id="image1" value="<?=$row_edit->image_path?>"  />
                      <input type="hidden" name="image1" value="<?=$row_edit->image_path?>"/>
                      <a href="<?=IMAGEPATH.$row_edit->image_path?>" target="_blank">View File</a> 
                    </div>
                  </div>
                  
                  
                         <div class="row-item clearfix" id="patron"  <?php if($row_edit->post_type=="image") {?>style="display:none"<?php } ?>>
                    <label class="lbl" for="txt_location">You Tube Video Link:</label>
                    <div class="val">
                      <input readonly class="txt" type="text" name="video_link" id="video_link" value="<?=$row_edit->video_link?>"  >
                    </div>
                  </div>
                  
                  
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_name1">Pricing:</label>
                    <div class="val">
                      <select class="txt" name="price_type" id="price_type" >
                      <option value="">--Select Post Price--</option>
                              <option value="free" <?=($row_edit->price_type=="free")?'selected':''?>>Free</option>
                              <option value="tier" <?=($row_edit->price_type=="tier")?'selected':''?>>Pact</option>
                               <option value="one_time" <?=($row_edit->price_type=="one_time")?'selected':''?>>One Time Payment</option>
                            </select>
                    </div>
                  </div>
                  
                  <div class="row-item clearfix" id="price" <?php if($row_edit->price_type=="free" || $row_edit->price_type=="one_time"){?> style="display:none"<?php } ?>>
                    <label class="lbl" for="txt_name1">Pact:</label>
                    <div class="val">
                      <select  class="txt" name="tier_id" id="tier_id">
                      <option value="">--Select Pact--</option>
                             <?php
							 $sql_tier = $db_query->runQuery("select * from impact_tier where user_id='$row_user->user_id' and status=1 order by tier_price");
							 foreach($sql_tier as $row_tier){
							 
							 ?>
                             <option value="<?=$row_tier['tier_id']?>"<?php if($row_edit->tier_id==$row_tier['tier_id']){?> selected<?php } ?>><?=$row_tier['tier_name']?>(<?=$row_tier['tier_price']?><?=CURRENCY?>)</option>
                             <?php } ?>
                            </select>
                    </div>
                  </div>
                  
                  
                  <div class="row-item clearfix" id="onetime" <?php if($row_edit->price_type=="free" || $row_edit->price_type=="tier"){?> style="display:none"<?php } ?>>
                    <label class="lbl" for="txt_name1">One Time Price:</label>
                    <div class="val">
                       <input class="txt" type="text" name="one_time_amount" id="one_time_amount" value="<?=$row_edit->one_time_amount?>"  >
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_location" style="font-size:18px;margin:0 0px 23px 0">Description:</label>
                    <div class="val"> 
                     <textarea  class="form-control" name="description" id="description" parsley-trigger="change"  style="height:200px;width:403px;" ><?=$row_edit->description?></textarea>
                              
                              <!--script>
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
</script-->
                    </div>
                  </div>
                  
      
                  
                  
                  
                  
                  
                  <div class="row-item clearfix" style="text-align:center;">
                   <input type="hidden" name="<?=$table_id?>" value="<?=$edit_id?>"> 
                  <input type="hidden" name="mode" value="add">  
                    <button class="btn btn-submit-all newtier" style="display:inline-block;">Update Post</button>
                  </div>
                  <div class="row-item clearfix">&nbsp;</div>
                </form>
              </div>
            </div>
            <!--end: .tab-pane --> 
          </div>
         
        </div>

        <section class="col-md-12" style="background-color:#FFF; ">
       <h3 style="text-align:center;font-weight: 700;">Manage Your Posts</h3>
            <div class="col-md-12" style="    margin: 10px 0 0 0;padding:0 0 0 0;">
              <?php $sql_post = $db_query->runQuery("select * from ".$table_name." where user_id='$row_user->user_id' order by post_id desc");
			  foreach($sql_post as $row_post)
			  {
				  $post_path = BASEPATH.'#';
				  $image_div = $db_query->getPostImage($row_post['post_id'], 250);
			
			  
			  ?>
              
                <div class="col-sm-12  col-md-5  post-image">
                    <div class="col-md-12  post-createrimage">
                       <?=$image_div?>
                    </div>
                    <div class="col-md-12 post-edit">
                        <p style="float:left"><?=date('d M, Y H:i:s A',strtotime($row_post['create_date']))?><p>
                   <span style="margin: 0 0 0 41px;">     <a href="<?=$view_page?>?<?=$table_id?>=<?=base64_encode($row_post[$table_id])?>&status=<?=base64_encode($row_post[status])?>" title="Active/Inactive">
        <?php if($row_post[status]==1){?><i class="fa fa-unlock"></i><?php }else{?><i class="fa fa-lock"></i><?php }?></a> &nbsp;&nbsp;
   
                  
                  
                   
                  
                  <a href="<?=$view_page?><?=$row_post['post_id']?>/" title="Edit" ><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                 <a href="javascript:void(0);" onClick="javascript:deldata(<?=$row_post['post_id']?>)" title="Delete" ><i class="fa fa-times"></i></a>
                 </span>
             
                        <p style="font-size: 23px;font-weight: 600; margin: 21px 0 0 0; word-break: break-word;"><?=$row_post['post_title']?><p>
                        <?php if($row_post['price_type']=="free"){?><h4 class="">Free</h4><?php } else if($row_post['price_type']=="tier") {
				  $row_tier_check = $db_query->fetch_object("select tier_name, tier_price from impact_tier where tier_id='$row_post[tier_id]'");
				  ?>
                  <h4 class="" style="word-break: break-word;"><?=$row_tier_check->tier_name?> (<?=$row_tier_check->tier_price.CURRENCY?>)</h4>
                  
                  <?php } else {  ?><h4 class="">One Time (<?=$row_post[one_time_amount].CURRENCY?>)</h4><?php } ?>
                  <p class="like" style="word-break: break-word;"><?=mb_strimwidth(stripslashes($row_post['description']),0,100)?></p>
                    </div>
                </div>
                
                <?php } ?>
               
            </div>
       
    </section>
                
         
          
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


<div class="modal fade" id="modalConfirmDel" tabindex="-1" role="dialog" aria-labelledby="modalConfirmDelLabel" aria-hidden="true">
      <div class="modal-dialog" role="document" style="width:400px;">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalConfirmDelLabel">Confirm delete post?</h5>
          </div>
          <div id="modalConfirmDelBody" class="modal-body">This operation cannot be undone. Do you wish to continue?
            <input type="hidden" name="modal_post_id" id="modal_post_id" value="0"/>
          </div>
          <div class="modal-footer">
            <button id="confirm-del-no" type="button" class="btn btn-primary" style="color:#fff;" data-dismiss="modal">No</button>
            <button id="confirm-del-yes" type="button" class="btn btn-secondary" style="color:#fff;">Yes</button>
          </div>
        </div>
      </div>
    </div>


<?php include('include/footer.php');
include('include/footer_js.php');?>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

 <script language="JavaScript" >
function deldata(id)
{
	$("#modalConfirmDel").modal('show');
  $("#modal_post_id").val(id);
}

$('#confirm-del-yes').click(function () {
  window.location.href="<?=$view_page?>?id="+$("#modal_post_id").val();
});
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
  $("#goal_other").css("display","none");
  }
else if(post_type=="video" )  
{
$("#goal").css("display","none");
 $("#goal_other").css("display","none");
  $("#patron").css("display","block");
  
  }
  else if(post_type=="other" )  
{
  $("#goal").css("display","none");
  $("#patron").css("display","none");
  $("#goal_other").css("display","block");
  
}
  else
  {
  $("#goal").css("display","none");
  $("#patron").css("display","none");
  $("#goal_other").css("display","none");
  }
});

    $("#price_type").change(function(){

        var price_type = $(this).val();
	

 if(price_type=="free")
  {

  $("#price").css("display","none");
  $("#onetime").css("display","none");
  }
  else if(price_type=="tier" )  
  {
  $("#price").css("display","block");
   $("#onetime").css("display","none");
  
  }
  else if(price_type=="one_time" )  
  {
  $("#onetime").css("display","block");
  $("#price").css("display","none");
  }
  else
  {
  $("#price").css("display","none");
   $("#onetime").css("display","none");
  }
});

  });
 
</script>



</body>
</html>
