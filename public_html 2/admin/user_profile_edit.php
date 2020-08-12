<?php include('configure.php');
include('include/access.php');
$page_title = "My Profile";
$table_name = "admin_user";
$table_id=  "emp_id";
$page_name = ADMINPATH."/admin-profile/";
$image_save_folder = "profile";


define("TABLE_ID",$table_id);

$id = $row_access->emp_id;
$sql = "select * from ".$table_name." where ".$table_id."=".$id;
$row = $db_query->fetch_object($sql);

if($_REQUEST[mode] == "edit")
{
  $id1=$_REQUEST[TABLE_ID];
  
  $sql1="select * from ".$table_name." where ".$table_id."='".$id1."'";
  $row_web_settings=$db_query->fetch_object($sql1);
	
  if($_FILES['f1']['tmp_name']!="")
  {
   if($db_query->image_type('f1')==1) 
    {
	 $baseimg = "../".$image_folder_name."/";	
      unlink($baseimg.$row_web_settings->image_path);
      unlink($baseimg.$row_web_settings->thumb_image);
  
      $main_path = "../".$image_folder_name."/".$image_save_folder."/";
      $thumb = $main_path."thumbs/";
      $upload_img = $db_query->cwUpload('f1',$main_path,'',TRUE,$thumb,'30','30');
      $_REQUEST[image_path] =  $image_save_folder."/".$upload_img; 
      $_REQUEST[thumb_image] = $image_save_folder."/thumbs/".$upload_img; 
	}
	else
	{
		$msg = "Unknown Image extension";
		$error_type = "danger";
	    $sign = "fa-times-circle";
		//exit;
	}
  }	 
   
  else
  {
     $_REQUEST[image_path] =  $row_web_settings->image_path; 
	 $_REQUEST[thumb_image] = $row_web_settings->thumb_image; 
  }
	$_REQUEST[edit_date] = date('Y-m-d H:i:s');  
	$_REQUEST[edit_by] = $row_access->username;
	  
   $db->updateArray($table_name,$_REQUEST,TABLE_ID."=".$id1);
   header("location:".$page_name."?msg=1");
}







if($_GET[msg]==1)
{
$msg = "Updated Successfully";
$error_type = "success";
	$sign = "fa-check";
 }
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php include('titlebar.php');?>
</head>

<body>
<?php
include('include/header.php');
?>
<div id="cl-wrapper" class="fixed-menu">
<?php
include('include/menubar.php');
?>
<div id="pcont" class="container-fluid">
<div class="page-head">
               <h2><?=$page_title?></h2>
               <ol class="breadcrumb">
                  <li><a href="<?=ADMINPATH?>/dashboard/">Home</a></li>
                  <li class="active"><a href="#"><?=$page_title?></a></li>
                 
               </ol>
            </div>

<div class="cl-mcont">
          
    <div class="row">
                  <div class="col-md-12">
                     <div class="block-flat">
                     <?php if($msg) { ?>
                       <div class="alert alert-<?=$error_type?>"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button><i class="fa <?=$sign?> sign"></i><?=$msg?></div><?php } ?>
                        <div class="content">
                           <form  action="<?=$_SERVER['REQUEST_URI']?>"  method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group ">
                              <label  class="col-sm-2">Name</label>
                             <div class="col-sm-7">  
                             <input type="text" name="name" parsley-trigger="change" required=""  class="form-control "   value="<?=$row_access->name?>">
                             </div>
                            </div>
                            
                           <!-- <div class="form-group ">
                              <label  class="col-sm-2">Last Name</label>
                             <div class="col-sm-7">  
                             <input type="text" name="last_name" parsley-trigger="change" required=""  class="form-control "   value="<?=$row_access->last_name?>">
                             </div>
                            </div>-->
                            
                             <div class="form-group ">
                              <label  class="col-sm-2">Email ID</label>
                             <div class="col-sm-7">  
                             <input type="email" name="email_id" parsley-trigger="change" required=""  class="form-control "   value="<?=$row_access->email_id?>">
                             </div>
                            </div>
                             <div class="form-group ">
                              <label  class="col-sm-2">Phone</label>
                             <div class="col-sm-7">  
                             <input type="text" name="phone_no" parsley-trigger="change" required=""  class="form-control "   value="<?=$row_access->phone_no?>">
                             </div>
                            </div>
                             <div class="form-group ">
                              <label  class="col-sm-2">Address</label>
                             <div class="col-sm-9">  
                             <textarea required="" class="form-control" name="address" id="address" > <?=trim(stripslashes($row_access->address))?>
                              </textarea>
                             </div>
                            </div>
                             <!--script>
	CKEDITOR.replace('address',{
                       
                       filebrowserWindowWidth: '900',
					   filebrowserWindowHeight: '400',
					   filebrowserBrowseUrl : '<?=ADMINPATH?>ckfinder/ckfinder.html',
					   filebrowserImageBrowseUrl : '<?=ADMINPATH?>ckfinder/ckfinder.html?type=Images',
					   filebrowserFlashBrowseUrl : '<?=ADMINPATH?>ckfinder/ckfinder.html?type=Flash',
					   filebrowserUploadUrl : '<?=ADMINPATH?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
					   filebrowserImageUploadUrl : '<?=ADMINPATH?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
					   filebrowserFlashUploadUrl : '<?=ADMINPATH?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
	} );
</script-->
                            
                            
                          <!--   <div class="form-group ">
                              <label  class="col-sm-2">Profile Photo</label>
                             <div class="col-sm-7">  
                            <input class="form-control col-sm-6" type="file" name="f1" id="f1"  value="<?=$row_access->image_path?>" /><br />

 <img src="<?=IMAGEPATH?><?=$row->image_path?>"  class="col-sm-4" style="margin-top:5%; width:20%"/> 
                             </div>
                            </div>
                              
                             -->
                              
                              <input type="hidden" name="mode" value="edit" />
                               <input type="hidden" name="<?=$table_id?>" value="<?=$id?>" id="<?=$table_id?>"/>
                              <button type="submit" class="btn btn-primary">Submit</button>
                         <!--<button class="btn btn-default">Cancel</button>-->
                           </form>
                        </div>
                     </div>
                  </div>     
               
         </div>     
 </div>
</div>

</div>

<?php
include('footer_js.php');


?>

<script src="<?=ADMINPATH?>/assets/lib/jquery.parsley/dist/parsley.min.js" type="text/javascript"></script>
<script src="<?=ADMINPATH?>/assets/lib/jquery.parsley/src/extra/dateiso.js" type="text/javascript"></script>
	  
	  <script type="text/javascript">$(document).ready(function(){
         //initialize the javascript
         App.init();
         $('form').parsley();
         });
      </script>
</body>
</html>
