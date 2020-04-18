<?php include('admin_path.php'); 
include('include/access.php');
?>
<?php
$image_save_folder = "user";
$table_name = "impact_goal" ;
$table_id = "goal_id";
$view_page = BASEPATH."/edit/goals/";

$page_title = "Goal | ".PROJECT_TITLE;

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
  
  if( $db->insertDataArray($table_name,$_REQUEST))
  {
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
<div id="wrapper">
<?php include('include/header.php'); ?>

<div class="layout-2cols">
  <div class="content grid_12" >
   
    <div class="project-detail">
      <div class="project-tab-detail tabbable accordion edit-about">
      <?php if(isset($msg)){?> <div  id="err_msg"><?=$msg?></div> <?php } ?>
        <ul class="tbs clearfix">
          <li ><a href="<?=BASEPATH?>/edit/about/">About</a></li>
          <li ><a href="<?=BASEPATH?>/edit/tiers/" class="be-fc-orange">Tiers</a></li>
          <li class="activet"><a href="<?=BASEPATH?>/edit/goals/" class="be-fc-orange">Goals</a></li>
          <li><a href="<?=BASEPATH?>/edit/thanks/" class="be-fc-orange">Thanks</a></li>
          <li ><a href="<?=BASEPATH?>/edit/payment/" class="be-fc-orange">Payment</a></li>
          <?php if($row_user->review_status==1) {?>
          <li ><a href="<?=BASEPATH?>/edit/post/" class="be-fc-orange">Manage Your Post</a></li>
          <?php } ?>
           <?php if($row_user->review_status==0) {?>
          <li ><a href="<?=BASEPATH?>/edit/review/" class="submit_review"><?php if($row_user->review_submit_status==0) {?>Submit for review<?php }else { ?> Review Status <?php } ?></a></li>
          <?php } ?>
        </ul>
        
        
        
        <div class="tab-content">
          <div>
         
            <h3 class="rs alternate-tab accordion-label">Tiers</h3>
            <div class="tab-pane accordion-content active">
            
             <h2 class="excited">What would you like to work toward with your patrons?</h2>
                <p class="goal">Goals are the best way to get patrons excited about the next big step of your creative journey. Paint a picture of what you'll work towards together.</p>
                <p class="goal" style="color: black;font-weight: 900;">What type of goal are you working towards?</p>
                <p class="goal">You can change your mind at any time. You'll keep your Patreon earnings regardless of hitting your goals.</p>
                <div class="row-item clearfix" style="position: relative;top: 50px;">
                  <div class="val">
                   
                    <label style="font-size: 16px;    margin: -18px 0 41px 25px;">
                    <p style="color:green">Earnings-based goals</p>
                    <br>
                    <p>Your goals are based on how much you earn on Patreon"</p>
                    <p>"When I reach $500 per month, I'll start a special podcast series where I interview 1 patron every month.</p>
                    </label>
                    <br>
                   
                    <label style="font-size: 16px;    margin: -18px 0 41px 25px;">
                    <p style="color:green">Community-based goals</p>
                    <br>
                    <p>Your goals are based on how many patrons you have on Patreon. </p>
                    <p>"When I reach 500 patrons, I'll hire an editor to help me release 2 videos per week instead of 1."</p>
                    </label>
                    
                    
                    
              <div class="form form-profile">
                <form action="<?=$_SERVER['PHP_SELF']?>" name="myForm"  method="post" enctype="multipart/form-data">
               
                <input type="hidden" name="mode" value="profile" />
                     <div class="row-item clearfix">
                    <label class="lbl" for="txt_name1">Goal Type:</label>
                    <div class="val">
                      <select  class="txt" name="goal_type" id="goal_type" required>
                      <option value="">--Select Goal Type--</option>
                              <option value="earning" <?=($_REQUEST['goal_type']=="earning")?'selected':''?>>Earnings Based Goals</option>
                              <option value="community" <?=($_REQUEST['goal_type']=="community")?'selected':''?>>Community Based Goals</option>
                            </select>
                    </div>
                  </div>
                  <div class="row-item clearfix" id="goal" style="display:none">
                    <label class="lbl" for="txt_location">Goal Earning Amount:</label>
                    <div class="val">
                      <input class="txt" type="text" name="goal_price" id="goal_price" value="<?=$_REQUEST['goal_price']?>" onKeyPress="JavaScript: return keyRestrict(event,'0123456789.');" >
                    </div>
                  </div>
                  
                  
                   <div class="row-item clearfix" id="patron" style="display:none">
                    <label class="lbl" for="txt_location">Number Of Patrons:</label>
                    <div class="val">
                      <input class="txt" type="text" name="patron_number" id="patron_number" value="<?=$_REQUEST['patron_number']?>" onKeyPress="JavaScript: return keyRestrict(event,'0123456789.');" >
                    </div>
                  </div>
                  
                  
                  
                  <div class="row-item clearfix">
                    <label class="lbl" for="txt_time_zone">Description:</label>
                    <div class="val">
                     <textarea name="description" id="summary"  onKeyDown="textCounter(document.myForm.summary,document.myForm.text_count,300)"
onKeyUp="textCounter(document.myForm.summary,document.myForm.text_count,300)" class="txt" required><?=$_REQUEST['description']?></textarea>

<br>

<span style="color:#F00; margin-left:120px"><input type="text" readonly id="text_count" value="300" style="width:30px; border:none; background-color:#fff; color:#F00 "> Characters max</span>

                    </div>
                  </div>
                  
                  
                  
                  
                  
                  
                  
                  <div class="row-item clearfix">
                  <input type="hidden" name="mode" value="add">  
                    <button class="btn btn-red btn-submit-all newtier">Submit</button>
                  </div>
                  <div class="row-item clearfix">&nbsp;</div>
                </form>
              </div>
            </div>
            <!--end: .tab-pane --> 
          </div>
         
        </div>
        
        
        <div class="col-md-12 " style="padding:0; background-color:#fff;">
              <?php $sql_tier = $db_query->runQuery("select * from ".$table_name." where user_id='$row_user->user_id'");
			  foreach($sql_tier as $row_tier)
			  {?>
            <div class="col-md-4 become-telegram_new">
             <h3 class="livello-1-become">
                      <?=($row_tier['goal_type']=='earning')?'Earnings Based Goals':'Community Based Goals'?>
                    </h3>
                <?php if($row_tier['goal_type']=='earning') { ?>
              <h2 class="doller-become"><?=$row_tier['goal_price']?> INR</h2>
              <?php } else { ?>
              
              <h2 class="doller-become"><?=$row_tier['patron_number']?></h2>
              <?php } ?>
              
              <p class="faccio-become"><?=stripslashes(nl2br($row_tier['description']))?></p>
             <div align="center"><a href="<?=$view_page?><?=$row_tier['goal_id']?>/" class="btn btn-red btn-submit-all" ><i class="fa fa-pencil"></i></a>
             <a href="javascript:void(0);" onClick="javascript:deldata(<?=$row_tier['goal_id']?>)" class="btn btn-red btn-submit-all" style="margin-left:10px;" ><i class="fa fa-times"></i></a></div>
              
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
   
    $("#goal_type").change(function(){

        var goal_type = $(this).val();
	

if(goal_type=="earning")
{
  $("#goal").css("display","block");
  $("#patron").css("display","none");
  }
else if(goal_type=="community" )  
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


  });
 
</script>



</body>
</html>
