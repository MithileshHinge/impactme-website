<?php include('admin_path.php'); 
include('include/access.php');
?>
<?php
$image_save_folder = "user";
$table_name = "impact_tier" ;
$table_id = "tier_id";
$view_page = BASEPATH."/edit/tiers/";

$edit_id1 = $_GET['edit_id'];
$row_edit = $db_query->fetch_object("select * from ".$table_name." where ".$table_id."='".$edit_id1."' and user_id='".$row_user->user_id."'");
$edit_id = $row_edit->tier_id;
$page_title = "Tier | ".PROJECT_TITLE;

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
 $tier_price = $_REQUEST['tier_price'];
  $sql_check_price = $db_query->fetch_object("select count(*) c from impact_tier where user_id='".$row_user->user_id."' and tier_price='".trim($tier_price)."' and tier_id !='".$id1."'");
  if($sql_check_price->c==0)
  {	
  
    	
  if($_FILES['image']['tmp_name']!="")
  {
  
	 $baseimg = $image_folder_name."/";	
      unlink($baseimg.$row_user->image_path);
      $main_path = $image_folder_name."/".$image_save_folder."/";
      $thumb = $main_path."thumbs/";
      $upload_img = $db_query->cwUpload('image',$main_path,'',TRUE,$thumb,'100','75');
      $_REQUEST[image_path] =  $image_save_folder."/".$upload_img; 	
  }	    
  else
  {
     $_REQUEST[image_path] =  $row_user->image_path; 
  }
  $_REQUEST[user_id] = $row_user->user_id;
   
   $db->updateArray($table_name,$_REQUEST,$table_id."=".$id1);
  
  
 //$db->updateArray("impact_user",$_REQUEST,"user_id=".$row_user->user_id);
// header('location:'.BASEPATH.'/edit/about/');
 header('location:'.$view_page."?msg=update");
  }
  else
  {
	 $msg = "<span style='color:red;font-weight:bold; margin-bottom:10px;'>You can not add same price waves. Please change your wave price.</span>";
     $error_type = "success";
	 $sign = "fa-check";   
  }
  
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
	if($res)
	{
		$msg='Record Deleted Sucessfully';
		header("location:".$view_page);
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
<div id="wrapper" style="background-image:url(<?=BASEPATH?>/images/setting-back.jpg); ">
<?php include('include/header.php'); ?>

<div class="layout-2cols">
  <div class="content grid_12" >
   
    <div class="project-detail">
      <div class="project-tab-detail tabbable accordion edit-about">
    
       <?php include('include/user_menu.php');?>
        
        
        
        <div class="tab-content">
          <div>
         
            <h3 class="rs alternate-tab accordion-label">Waves</h3>
            <div class="tab-pane accordion-content active">
             <?php if(isset($msg)){?> <div  id="err_msg"><?=$msg?></div> <?php } ?>
              <div class="form form-profile">
                <form action="<?=BASEPATH?>/edit/tiers/<?=$edit_id?>/" name="myForm"  method="post" enctype="multipart/form-data" id="edit-createrform">
               
                <input type="hidden" name="mode" value="profile" />
                     <div class="row-item clearfix">
                    <label class="lbl" for="txt_name1">Wave Title:</label>
                    <div class="val">
                      <input class="txt" type="text" name="tier_name" id="tier_name" value="<?=$row_edit->tier_name?>"  >
                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_location">Price:</label>
                    <div class="val">
                      <input class="txt" type="text" name="tier_price" id="tier_price" value="<?=$row_edit->tier_price?>" onKeyPress="JavaScript: return keyRestrict(event,'0123456789.');">
                    </div>
                  </div>
                  
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_time_zone">Description:</label>
                    <div class="val">
                     <textarea name="description" id="summary"  onKeyDown="textCounter(document.myForm.summary,document.myForm.text_count,300)"
onKeyUp="textCounter(document.myForm.summary,document.myForm.text_count,300)" class="txt"><?=$row_edit->description?></textarea>

<br>

<span style="color:#F00; margin-left:120px"><input type="text" readonly id="text_count" value="300" style="width:30px; border:none; background-color:#fff; color:#F00 "> Characters max</span>

                    </div>
                  </div>
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_time_zone">Impact limit:</label>
                    <div class="val">
                      <input class="txt" type="text" id="impact_limit" name="impact_limit"  value="<?=$row_edit->impact_limit?>" onKeyPress="JavaScript: return keyRestrict(event,'0123456789');">
                      <label style="font-size: 11px;    margin: -18px 0 41px 120px;">Limit number of impact.</label>
                      <br>
                    </div>
                  </div>
                  
                  
                  
                  
                  
                  
                  <div class="row-item clearfix">
                   <input type="hidden" name="<?=$table_id?>" value="<?=$edit_id?>"> 
                  <input type="hidden" name="mode" value="add">  
                    <button class="btn btn-red btn-submit-all newtier" id="tier-submit">Update</button>
                  </div>
                  <div class="row-item clearfix">&nbsp;</div>
                </form>
              </div>
            </div>
            <!--end: .tab-pane --> 
          </div>
         
        </div>
        
        
        <div class="col-md-12 " style="padding:0; background-color:#fff;">
            <h3 style="text-align:center;font-weight: 700;">Manage Your Tier</h3>
              <?php $sql_tier = $db_query->runQuery("select * from impact_tier where user_id='$row_user->user_id' order by tier_price asc");
			  foreach($sql_tier as $row_tier)
			  {?>
            <div class="col-md-4 become-telegram_new" id="tier-manage">
            <p class="faccio-become" style="text-align:center;"> <?php if(!empty($row_tier['image_path'])){ ?>
                  <img src="<?=IMAGEPATH?><?=$row_tier['image_path']?>" width="200px">
                  <?php } ?></p>
              <h3 class="livello-1-become"><?=$row_tier['tier_name']?></h3>
              <h2 class="doller-become">₹  <?=$row_tier['tier_price']?> </h2>
              <p class="doller-permonth">PER MONTH</p>
              
              <p class="faccio-become"><?=stripslashes(nl2br($row_tier['description']))?></p>
             <div align="center"><a href="<?=$view_page?><?=$row_tier['tier_id']?>/" class="btn btn-blue btn-submit-all" ><i class="fa fa-pencil"></i></a>
             <a href="javascript:void(0);" onClick="javascript:deldata(<?=$row_tier['tier_id']?>)" class="btn btn-blue btn-submit-all" style="margin-left:10px;" ><i class="fa fa-times"></i></a></div>
              
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



</body>
</html>