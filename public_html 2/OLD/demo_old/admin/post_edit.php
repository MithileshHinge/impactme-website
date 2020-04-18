<?php include('configure.php');
include('include/access.php');
$page_title = "Edit Post";
$table_name = "post";


$table_id=  $table_name."_id";
$view_page = ADMINPATH."/".$table_name."_view.php/";
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
                           
                            <div class="form-group " style="display:none">
                              <label  class="col-sm-2">Page Name</label>
                             <div class="col-sm-4">  
                             
                              <select name="page_id" id="page_id" parsley-trigger="change" required=""  class="form-control " >
                                          <option value="">--Select--</option>
                                          <?php $sql_page = $db_query->runQuery("select * from page where status=1  order by page_name");
										  foreach($sql_page as $row_page) { ?>
                                          <option value="<?=$row_page[page_id]?>" <?php if($row->page_id==$row_page[page_id]) {?> selected="selected"<?php } ?> ><?=$row_page[page_name]?></option>
                                          <?php } ?>
                                         
                                          </select>
                                          
                             </div>
                            </div>
                            
                            
                           <div class="form-group ">
                              <label  class="col-sm-2">Post Name</label>
                             <div class="col-sm-7">  
                             <input type="text" name="post_name" parsley-trigger="change" required="" class="form-control " value="<?=stripslashes($row->post_name)?>">
                             </div>
                            
                            </div>
                      
                            
                             <div class="form-group ">
                              <label  class="col-sm-2">Description</label>
                             <div class="col-sm-10">  
                             <textarea  class="form-control" name="description" id="description" parsley-trigger="change"  > <?=trim(stripslashes($row->description))?>
                              </textarea>
                             </div>
                            
                            </div>
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
 
                          
                              
                             <div class="form-group ">
                              <label  class="col-sm-2">Featured Image  ( 550 * 350 px ) </label>
                             <div class="col-sm-7">  
                              <input class="form-control col-sm-6" type="file" name="f1" id="f1"  value=""  />
                              <?php if(getimagesize(IMAGEPATH.$row->image_path)>0) { ?><br />
 <img src="<?=IMAGEPATH?><?=$row->image_path?>"  class="col-sm-4" style="margin-top:5%; width:20%"/> <?php }?>
                             </div>
                            </div>
                            <div class="form-group ">
                              <label  class="col-sm-2">Breadcumb Image ( 1350 * 500 px ) </label>
                             <div class="col-sm-7">  
                              <input class="form-control col-sm-6" type="file" name="f2" id="f2"  value=""  />
                              <?php if(getimagesize(IMAGEPATH.$row->breadcumb_image)>0) { ?><br />
 <img src="<?=IMAGEPATH?><?=$row->breadcumb_image?>"  class="col-sm-4" style="margin-top:5%; width:20%"/> <?php }?>
                             </div>
                            </div>
                            
                               <!--  <div class="col-md-12">
                     <div class="block-flat">
                   
                         <div class="gallery-cont">
                        <?php 
						$sql_gallery = $db_query->runQuery("select * from page_gallery where page_id='".$id."' and image_type='about'");
						foreach($sql_gallery as $row_gallery )
			{ 
			 $gallery_path = BASEPATH."/".$row_gallery[image_path];
			 
			 ?>
                           <div class="item">
                     <div class="photo">
                        
                        <div class="img">
                           <img src="<?=$gallery_path?>">
                           <div class="over">
                              <div class="func"><a href="<?=$gallery_path?>" class="image-zoom"><i class="fa fa-search"></i></a>
                              
                               <a href="#"  onclick="javascript:deldata_customer(<?=$row_gallery[image_id]?>)" title="Delete"><i class="fa fa-times"></i></a>&nbsp;&nbsp;
                               
                               
                               </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <?php } ?>
                        </div>
                     </div>
                  </div>
                  <div class="form-group ">
                              <label  class="col-sm-2">Gallery Image </label>
                             <div class="col-sm-7">  
                          
                            <div id="filediv"><input name="file[]" type="file" id="file" /></div><br />
            <input type="button" id="add_more" class="upload" value="Add More Files"/>
                             </div>
                            
                              
                            </div>-->
                  
                             
                                <div class="form-group ">
                              <label  class="col-sm-2">Page Title</label>
                             <div class="col-sm-7">  
                             <input type="text" name="page_title" parsley-trigger="change" required="" class="form-control " value="<?=$row->page_title?>">
                             </div>
                            
                            </div>
                             
                             <div class="form-group ">
                              <label  class="col-sm-2">Meta Title</label>
                             <div class="col-sm-7">  
                             <input type="text" name="meta_title" parsley-trigger="change"  class="form-control " value="<?=$row->meta_title?>">
                             </div>
                            
                            </div>
                             
                             <div class="form-group ">
                              <label  class="col-sm-2">Meta Keyword</label>
                             <div class="col-sm-7">  
                             <input type="text" name="meta_keyword" parsley-trigger="change"  class="form-control " value="<?=$row->meta_keyword?>">
                             </div>
                             
                            </div>
                             
                             <div class="form-group ">
                              <label  class="col-sm-2">Meta Description</label>
                             <div class="col-sm-7">  
                             <input type="text" name="meta_description" parsley-trigger="change" class="form-control " value="<?=$row->meta_description?>">
                             </div>
                             
                            </div>
                              
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
