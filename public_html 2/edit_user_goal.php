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
/* if($_REQUEST['mode']=="goal_set")
 {
  $goal_type = $_REQUEST['goal_type'];
  $db_query->runQuery("update impact_user set goal_type='$goal_type' where user_id='$row_user->user_id'");
   header('location:'.$view_page);
 }*/
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
// $_REQUEST['goal_type'] = $row_user->goal_type;
 
 
   $goal_type = $_REQUEST['goal_type'];
   $setGoal = $_REQUEST['setGoal'];
  
   if($setGoal!=="")
   {
    echo $setGoal;
        if($goal_type!==$row_user->goal_type)
	  {
	     $db_query->Query("delete from impact_goal where user_id='$row_user->user_id'"); 
	  }
   
   }
   
  $db_query->Query("update impact_user set goal_type='$goal_type' where user_id='$row_user->user_id'");
 $db->insertDataArray($table_name,$_REQUEST);
 header('location:'.$view_page."?msg=1");

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
 $sql_goal_check = $db_query->fetch_object("select count(*) c from impact_goal where user_id='$row_user->user_id'");   

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
         
            <h3 class="rs alternate-tab accordion-label">Goal</h3>
            <div class="tab-pane accordion-content active">
            
             <h2 class="excited">What would you like to work toward with your supporters?</h2>
                <p class="goal">Goals are the best way to get supporters excited about the next big step of your creative journey. Paint a picture of what you'll work towards together.</p>
                <p class="goal" style="color: black;font-weight: 900;">What type of goal are you working towards?</p>
                <p class="goal">You can change your mind at any time. You'll keep your supporter earnings regardless of hitting your goals.</p>
                <div class="row-item clearfix" style="position: relative;top: 50px;">
                  <div class="val">
                    <form action="<?=$_SERVER['PHP_SELF']?>" name="myForm"  method="post" enctype="multipart/form-data" id="myForm">
                    <label style="font-size: 16px;    margin: -18px 0 41px 25px;">
                    <p style="color:#3a9cb5">Earnings-based goals</p>
                    <br>
                    <p><input type="radio" value="earning" name="goal_type"<?php if($row_user->goal_type=="earning"){?> checked<?php } ?> id="goal_type">&nbsp;Your goals are based on how much you earn on supporter"</p>
                    <p>"When I reach ₹ 500 per month, I'll start a special podcast series where I interview 1 supporter every month.</p>
                    </label>
                    <br>
                   
                   
                    <label style="font-size: 16px;    margin: -18px 0 0px 25px;">
                    <p style="color:#3a9cb5">Community-based goals</p>
                    <br>
                    <p><input type="radio" value="community" name="goal_type"<?php if($row_user->goal_type=="community"){?> checked<?php } ?> id="goal_type">&nbsp; Your goals are based on how many supporters you have on Impact. </p>
                    <p>"When I reach 500 supporter, I'll hire an editor to help me release 2 videos per week instead of 1."</p>
                    </label>
                  
                
              <div class="form form-profile" id="goal-editcreater">
             
               
                <input type="hidden" name="mode" value="profile" />
                     
                
                  <div class="row-item clearfix" id="goal" <?php if($row_user->goal_type=="community" || $row_user->goal_type==""){?> style="display:none"<?php } ?>>
                    <label class="lbl" for="txt_location">Goal Earning Amount:</label>
                    <div class="val">
                      <input class="txt" type="text" name="goal_price" id="goal_price" value="<?=(isset($_REQUEST['goal_price'])) ? $_REQUEST['goal_price']:'0';?>" onKeyPress="JavaScript: return keyRestrict(event,'0123456789.');"  >
                    </div>
                  </div>
                 
                   <div class="row-item clearfix" id="patron" <?php if($row_user->goal_type=="earning" || $row_user->goal_type==""){?> style="display:none"<?php } ?>>
                    <label class="lbl" for="txt_location">Number Of Patrons:</label>
                    <div class="val">
                      <input class="txt" type="text" name="patron_number" id="patron_number" value="<?=(isset($_REQUEST['patron_number'])) ? $_REQUEST['patron_number']:'0';?>" onKeyPress="JavaScript: return keyRestrict(event,'0123456789.');"  >
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
                  
                 <input type="hidden" name="setGoal" id="setGoal" value="<?=$row_user->goal_type?>">  
                     <input type="hidden" name="mode" value="add">  
                    <button class="btn  btn-submit-all newtier" id="goal-submit">Submit</button>
                  
                  

                  
                  
                  
                  
                  
                  
                    
                  <div class="row-item clearfix">&nbsp;</div>
                 
               
              </div>
             
               </form>
              
              
              
              
              </div>
              
            </div>
            <!--end: .tab-pane --> 
          </div>
         </div>
        
        </div>
        
        
        <div class="col-md-12 " style="padding:0; background-color:#fff;">
            
            <h3 style="text-align:center;font-weight: 700;">Manage Your Goal</h3>
              <?php $sql_tier = $db_query->runQuery("select * from ".$table_name." where user_id='$row_user->user_id'");
			  foreach($sql_tier as $row_tier)
			  {?>
            <div class="col-md-4 become-telegram_new" id="tier-manage">
             <h3 class="livello-1-become">
                      <?=($row_tier['goal_type']=='earning')?'Earnings Based Goals':'Community Based Goals'?>
                    </h3>
                <?php if($row_tier['goal_type']=='earning') { ?>
              <h2 class="doller-become"><?=$row_tier['goal_price']?> INR</h2>
              <?php } else { ?>
              
              <h2 class="doller-become"><?=$row_tier['patron_number']?></h2>
              <?php } ?>
              
              <p class="faccio-become"><?=stripslashes(nl2br($row_tier['description']))?></p>
             <div align="center"><a href="<?=$view_page?><?=$row_tier['goal_id']?>/" class="btn btn-blue btn-submit-all" ><i class="fa fa-pencil"></i></a>
             <a href="javascript:void(0);" onClick="javascript:deldata(<?=$row_tier['goal_id']?>)" class="btn btn-blue btn-submit-all" style="margin-left:10px;" ><i class="fa fa-times"></i></a></div>
              
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
   
   
	
	$('#myForm input[type="radio"]').click(function(){

        var goal_type = $(this).val();
	    var setGoal = $("#setGoal").val();
        if(setGoal!="")
		{
		
			if(setGoal!==goal_type)
			{
			
			  confirm("Do you want to change Goal Type? \nAll existing goal will be deleted.");
			}
		}
		
		
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
