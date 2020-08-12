<?php include('configure.php');
include('include/access.php');
$page_title = "Edit Tier";
$table_name = "impact_tier";


$table_id=  "tier_id";
$view_page = ADMINPATH."/tier_view.php/";
define("TABLE_ID",$table_id);

$image_save_folder = "post";

$id = base64_decode($_REQUEST['id']);
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
      $upload_img = $db_query->cwUpload('f1',$main_path,'',TRUE,$thumb,'100','75');
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
   if($_FILES['f2']['tmp_name']!="")
  {
   if($db_query->image_type('f2')==1) 
    {
	 $baseimg = "../".$image_folder_name."/";	
      unlink($baseimg.$row_web_settings->breadcumb_image);
    
  
      $main_path = "../".$image_folder_name."/".$image_save_folder."/";
      $thumb = $main_path."thumbs/";
      $upload_img = $db_query->cwUpload('f2',$main_path,'',FALSE,$thumb,'100','75');
      $_REQUEST[breadcumb_image] =  $image_save_folder."/".$upload_img; 
     
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
     $_REQUEST[breadcumb_image] =  $row_web_settings->breadcumb_image; 
	
  }
 
   $_REQUEST[language_id] = $_SESSION[language_id]; 
   $db->updateArray($table_name,$_REQUEST,TABLE_ID."=".$id1);
   
    $ImageBaseUrl = "";
  if(count($_FILES['file']['name']) > 0)
	{
        for($i=0; $i<count($_FILES['file']['name']); $i++) 
		{
            $tmpFilePath = $_FILES['file']['tmp_name'][$i];
            if($tmpFilePath != "")
			{
                $shortname = $_FILES['file']['name'][$i];
                $filePath = "images/post/" .rand(1,100000).time().'-'.$_FILES['file']['name'][$i];
                if(move_uploaded_file($tmpFilePath, "../".$filePath)) 
				{
                    $Galleryfiles[] = $ImageBaseUrl.$filePath;
					$gal_image = $ImageBaseUrl.$filePath;
					mysql_query("insert into page_gallery values('', '$gal_image','about','$id1')");
                }
              }
         }
	}
	
	
   header("location:".$view_page);
}






 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php include('titlebar.php');?>
 <link rel="stylesheet" type="text/css" href="<?=ADMINPATH?>/assets/lib/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css">
 <link rel="stylesheet" type="text/css" href="<?=ADMINPATH?>/assets/lib/jquery.icheck/skins/square/blue.css">
 <link rel="stylesheet" href="<?=ADMINPATH?>/multifile/style.css">
 <script src="<?=ADMINPATH?>/multifile/jquery.js"></script>
<script src="<?=ADMINPATH?>/multifile/script.js"></script>

 <script language="JavaScript" >
function deldata(id)
{
	if(confirm("Do you want to delete?"))
	{
		window.location.href="<?=$main_page?>&delid="+id;
	}
}

function deldata_customer(id)
{
	if(confirm("Do you want to delete?"))
	{
		window.location.href="<?=$main_page?>&delid_customer="+id;
	}
}
</script>
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
                           
                           <input type="hidden" name="page_id" value="<?=$row->page_id?>" />
                           
                        
                            
                           <div class="form-group ">
                              <label  class="col-sm-2">Tier Name</label>
                             <div class="col-sm-7">  
                             <input type="text" name="tier_name" parsley-trigger="change" required="" class="form-control " value="<?=stripslashes($row->tier_name)?>">
                             </div>
                            
                            </div>
                            
                            <div class="form-group ">
                              <label  class="col-sm-2">Tier Price</label>
                             <div class="col-sm-7">  
                             <input type="text" name="tier_price" parsley-trigger="change" required="" class="form-control " value="<?=stripslashes($row->tier_price)?>">
                             </div>
                            
                            </div>
                      
                        <div class="form-group ">
                              <label  class="col-sm-2">Impact Limit</label>
                             <div class="col-sm-7">  
                             <input type="text" name="impact_limit" parsley-trigger="change" required="" class="form-control " value="<?=stripslashes($row->impact_limit)?>">
                             </div>
                            
                            </div>
                            
                             <div class="form-group ">
                              <label  class="col-sm-2">Description</label>
                             <div class="col-sm-10">  
                             <textarea  class="form-control" name="description" id="description" parsley-trigger="change"  > <?=trim(stripslashes($row->description))?>
                              </textarea>
                             </div>
                            
                            </div>
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
 
                          
                              
                        
                              
                              <input type="hidden" name="mode" value="edit" />
                               <input type="hidden" name="<?=$table_id?>" value="<?=$id?>" id="<?=$table_id?>"/>
                              <button type="submit" class="btn btn-primary">Submit</button>
                              <input type="button" name="back" value="Back" onclick="history.go(-1)" class="btn btn-success"/>
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
<!--<script src="<?=ADMINPATH?>/assets/lib/jquery.parsley/src/extra/dateiso.js" type="text/javascript"></script>-->
 <script src="<?=ADMINPATH?>/assets/lib/bootstrap.switch/js/bootstrap-switch.js" type="text/javascript"></script>
	<script src="<?=ADMINPATH?>/assets/lib/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>  
  
	  <script type="text/javascript">$(document).ready(function(){
         //initialize the javascript
         App.init();
		 
		  App.formElements();
         $('form').parsley();
		 
         });
      </script>
</body>
</html>
