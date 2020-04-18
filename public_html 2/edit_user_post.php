<?php include('admin_path.php'); 
include('include/access.php');
?>
<?php
$image_save_folder = "post";
$table_name = "impact_post" ;
$table_id = "post_id";
$view_page = BASEPATH."/edit/post/";

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

if($_REQUEST['post_type']=="image") 
{  	
        if($_FILES['image']['tmp_name']!="")
        {
        
      	 $baseimg = $image_folder_name."/";	
           // unlink($baseimg.$row_user->image_path);
            $main_path = $image_folder_name."/".$image_save_folder."/";
            $thumb = $main_path."thumbs/";
            $upload_img = $db_query->cwUpload('image',$main_path,'',TRUE,$thumb,'100','75');
            $_REQUEST[image_path] =  $image_save_folder."/".$upload_img; 	
        }	    
        else
        {
           $_REQUEST[image_path] =  ''; 
        }
  }

 else if($_REQUEST['post_type']=="other") 
{ 

        if($_FILES['image1']['tmp_name']!="")
        {
        
         $baseimg = $image_folder_name."/"; 
           // unlink($baseimg.$row_user->image_path);
            $main_path = $image_folder_name."/".$image_save_folder."/";
            $thumb = $main_path."thumbs/";
            $file_name = time();
            $upload_img = $db_query->cwUpload('image1',$main_path,  $file_name);
            $_REQUEST[image_path] =  $image_save_folder."/".$upload_img;  
        }     
        else
        {
           $_REQUEST[image_path] =  ''; 
        }

}
   else
  {
     $_REQUEST[image_path] = ''; 
  }
  $_REQUEST[user_id] = $row_user->user_id;
  if($_REQUEST['price_type']=="free" || $_REQUEST['price_type']=="one_time")
  {
   $_REQUEST['tier_id'] = 0;
  }
 $_REQUEST['create_date'] = date('Y-m-d H:i:s');
  $_REQUEST['slug'] = $db_query->slug($_REQUEST['post_title']).time();
 //echo $db->insertDataArray($table_name,$_REQUEST);
 //exit;
  if( $postId= $db->insertDataArray($table_name,$_REQUEST))
  {
  
  $db_query->add_notification_post($row_user->user_id,  $postId , "post"  );
  
  header('location:'.$view_page."?msg=1");
  }
 //$db->updateArray("impact_user",$_REQUEST,"user_id=".$row_user->user_id);
// header('location:'.BASEPATH.'/edit/about/');
 
 
 }
 if($_GET[msg]==1)
{
$msg = "<span style='color:green;font-weight:bold; margin-bottom:10px;'>Added Successfully</span>";
$error_type = "success";
	$sign = "fa-check";
 }

if($_GET[msg]=="update")
{
$msg = "<span style='color:green;font-weight:bold; margin-bottom:10px;'>Updated Successfully</span>";
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


 $sql_post_check1  = $db_query->fetch_object("select count(*) c from impact_post where user_id='$row_user->user_id' and status=1");
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
<div id="wrapper" style="background-image:url(<?=BASEPATH?>/images/setting-back.jpg); ">
<?php include('include/header.php'); ?>

<div class="layout-2cols">
  <div class="content grid_12" >
   
    <div class="project-detail">
      <div class="project-tab-detail tabbable accordion edit-about">
      <?php if(isset($msg)){?> <div  id="err_msg"><?=$msg?></div> <?php } ?>
       <?php include('include/user_menu.php');?>
        
        
        
        <div class="tab-content">
          <div>
         
            <h3 class="rs alternate-tab accordion-label">Post</h3>
            <div class="tab-pane accordion-content active">
            
          
                    
                    
                    
              <div class="form form-profile">
                <form action="<?=$_SERVER['PHP_SELF']?>" name="myForm"  method="post" enctype="multipart/form-data" id="post_form">
               
                <input type="hidden" name="mode" value="profile" />
                
                  <div class="row-item clearfix" >
                    <label class="lbl" for="txt_location">Post Title:</label>
                    <div class="val">
                      <input class="txt" type="text" name="post_title" id="post_title" value="<?=$_REQUEST['post_title']?>" required  >
                    </div>
                  </div>
                  
                  
                     <div class="row-item clearfix">
                    <label class="lbl" for="txt_name1">Post Type:</label>
                    <div class="val">
                      <select  class="txt" name="post_type" id="post_type" required>
                      <option value="">--Select Post Type--</option>
                              <option value="image" <?=($_REQUEST['post_type']=="image")?'selected':''?>>Image</option>
                              <option value="video" <?=($_REQUEST['post_type']=="video")?'selected':''?>>Video</option>
                              <option value="other" <?=($_REQUEST['post_type']=="other")?'selected':''?>>Other</option>
                            </select>
                    </div>
                  </div>
                  <div class="row-item clearfix" id="goal" style="display:none">
                    <label class="lbl" for="txt_location">Image :</label>
                    <div class="val">
                      <input class="txt" type="file" name="image" id="image" value="" accept="image/*" >
                    </div>
                  </div>

                   <div class="row-item clearfix" id="goal_other" style="display:none">
                    <label class="lbl" for="txt_location">Upload File :</label>
                    <div class="val">
                      <input class="txt" type="file" name="image1" id="image1" value="" >
                    </div>
                  </div>
                  
                  <div id="patron" style="display:none">
                  
                 <div class="row-item clearfix"  >
                    <label class="lbl" for="txt_location">Video Type:</label>
                    <div class="val">
                      <select  class="txt" name="video_type" id="video_type" >
                      <option value="">--Select Video Type--</option>
                              <option value="file" <?=($_REQUEST['video_type']=="file")?'selected':''?>>Add File</option>
                              <option value="video" <?=($_REQUEST['video_type']=="video")?'selected':''?>>Add Link</option>
                            </select>
                    </div>
                  </div>
                  
                  <div class="row-item clearfix"  style="display:none" id="you_tube">
                    <label class="lbl" for="txt_location"> Video Link:</label>
                    <div class="val">
                      <input class="txt" type="text" name="video_link" id="video_link" value="<?=$_REQUEST['video_link']?>"  >
                      <p style="margin-left: 20%;
    font-size: 11px;"> Supports You Tube Link Only</p>
                    </div>
                  </div>
                  
                  <div class="row-item clearfix"  style="display:block" id="file_video">
                    <label class="lbl" for="txt_location">Add File</label>
                    <div class="val">
                               
                   
                            <input type="file" accept="video/*" name="video_upload_file" id="video_upload_file" style="margin-top:11px">
                          <div id="video_status"> </div><div class="progressBar" style="top:30%; margin-left:36%; width:54%; padding:5px;">
                            <div class="bar" style="background-color:#3dc934"></div>
                            <div class="percent">0%</div>
                           
                          </div>
                      
        
                    </div>
                    <div class="val" id="video_display" style="display:none">
                    
                    <video controls  style="width: 75%;height: 240px;margin-top: 4%;">
    <source src="" />
  </video>
  
  </div>
                    <input type="hidden" name="video_path" id="video_path" value="">
                  </div>
                  
                  </div>
                  
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_name1">Price Type:</label>
                    <div class="val">
                    <?php $sql_post_check = $db_query->fetch_object("select count(*) c from impact_post where user_id='$row_user->user_id'"); ?>
                      <select  class="txt" name="price_type" id="price_type" required>
                      
                      <?php //if($sql_post_check->c==0) {?>
                      <!-- <option value="free" selected>Free</option>-->
                      <?php //} else { ?>
                      <option value="">--Select Post Price--</option>
                      
                              <option value="free" <?=($_REQUEST['price_type']=="free")?'selected':''?>>Free</option>
                              <option value="tier" <?=($_REQUEST['price_type']=="tier")?'selected':''?>>Tier</option>
                              <option value="one_time" <?=($_REQUEST['price_type']=="one_time")?'selected':''?>>One Time Payment</option>
                              <?php //} ?>
                            </select>
                    </div>
                  </div>
                  
                  <div class="row-item clearfix" id="price" style="display:none">
                    <label class="lbl" for="txt_name1">Tier:</label>
                    <div class="val">
                      <select  class="txt" name="tier_id" id="tier_id">
                      <option value="">--Select Tier--</option>
                             <?php
							 $sql_tier = $db_query->runQuery("select * from impact_tier where user_id='$row_user->user_id' and status=1 order by tier_price");
							 foreach($sql_tier as $row_tier){
							 
							 ?>
                             <option value="<?=$row_tier['tier_id']?>"><?=$row_tier['tier_name']?>(<?=$row_tier['tier_price']?><?=CURRENCY?>)</option>
                             <?php } ?>
                            </select>
                    </div>
                  </div>
                  
                 <div class="row-item clearfix" id="onetime" style="display:none">
                    <label class="lbl" for="txt_name1">One Time Price:</label>
                    <div class="val">
                       <input class="txt" type="text" name="one_time_amount" id="one_time_amount" value="<?=$_REQUEST['one_time_amount']?>"  >
                    </div>
                  </div>
              
                    <div class="val"   id="post-data"> 
                        <label class="lbl" for="txt_location" style="font-size:18px;margin:0 0px 23px 0">Description:</label>
                     <textarea  class="form-control" name="description" id="description" parsley-trigger="change"  ></textarea>
                              
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
                  
      
                  
                  
                  
               
                <?php if($row_user->review_status==0 && $sql_post_check1->c==0 )
				 $lock = 1; else $lock=0;
				  if($row_user->review_status==1 )
				  $lock = 1;
				  if($lock==1) { ?>
                  <div class="row-item clearfix">
                  <input type="hidden" name="mode" value="add">  
                    <button class="btn  btn-submit-all newtier" style="    margin-left: 93px;" onClick="javascript:
                                                var x = document.getElementsByName('myForm');
x[0].submit();" type="button">Submit</button>
                  </div>
                  <?php } ?>
                  <div class="row-item clearfix">&nbsp;</div>
                </form>
              </div>
            </div>
            <!--end: .tab-pane --> 
          </div>
         
        </div>
        
        
                <?php if($lock==1) {?>
                    <section class="col-md-12" style="background-color:#FFF; ">
       <h3 style="text-align:center;font-weight: 700;">Manage Your Post</h3>
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
             
                        <p style="font-size: 23px;font-weight: 600; margin: 21px 0 0 0;"><?=$row_post['post_title']?><p>
                        <?php if($row_post['price_type']=="free"){?><h4 class="">Free</h4><?php } else if($row_post['price_type']=="tier") {
				  $row_tier_check = $db_query->fetch_object("select tier_name, tier_price from impact_tier where tier_id='$row_post[tier_id]'");
				  ?>
                  <h4 class=""><?=$row_tier_check->tier_name?> (<?=$row_tier_check->tier_price.CURRENCY?>)</h4>
                  
                  <?php } else {  ?><h4 class="">One Time (<?=$row_post[one_time_amount].CURRENCY?>)</h4><?php } ?>
                  <p class="like"><?=mb_strimwidth(html_entity_decode(stripslashes($row_post['description'])),0,100)?></p>
                    </div>
                </div>
                
                <?php } ?>
               
            </div>
       
    </section> 
                <?php } ?>
        
          
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
    $("#video_type").change(function(){

        var video_type = $(this).val();
	

if(video_type=="file")
{
  $("#file_video").css("display","block");
  $("#you_tube").css("display","none");
  }
else if(video_type=="video" )  
{
$("#file_video").css("display","none");
  $("#you_tube").css("display","block");
  
  }
  else
  {
  $("#file_video").css("display","none");
  $("#you_tube").css("display","none");
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


<script src="<?=BASEPATH?>/image_upload_js/jquery.form.js"></script>
<script>
$(document).on('change', '#video_upload_file', function () {
var progressBar = $('.progressBar'), bar = $('.progressBar .bar'), percent = $('.progressBar .percent');
    var fileSize = this.files[0];
    var sizeInMb = fileSize.size/1024;
    var sizeLimit= 1024*200;
    if (sizeInMb > sizeLimit) {
	 $("#video_status").html("<span style='color:red'>File Can not Be Uploaded. Maximum File Size 200MB</span>");	
	 return false;
	}
	
	
$('#post_form').ajaxForm({
 url: '<?=BASEPATH?>/uploadPostFile.php',
    beforeSend: function() {
		progressBar.fadeIn();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
		if(percentComplete=="100")
		{
         percent.html(percentVal+" Please Wait");
		 }
		 else
		 {
		 percent.html(percentVal);
		 }
    },
    success: function(html, statusText, xhr, $form) {		
		obj = $.parseJSON(html);	
		if(obj.status){		
			var percentVal = '100%';
			bar.width(percentVal)
			percent.html(percentVal);
			//$("#imgArea>img").prop('src',obj.video_medium);		
			$("#video_status").html("<span style='color:green'>File Uploaded</span>");	
			$("#video_path").val(obj.video_medium);	
		    $("#video_display").css("display","block");
			$("#video_display>video>source").prop('src',"<?=IMAGEPATH?>"+obj.video_medium);	
			$("#video_display video")[0].load();
			setTimeout(function(){ $("#video_status").fadeOut(); }, 3000);
		}else{
			$("#video_status").html("<span style='color:red'>Error In File Uploading. Please Try Again</span>");	
		}
    },
	complete: function(xhr) {
		progressBar.fadeOut();			
	}	
}).submit();	


});




</script>

</body>
</html>
