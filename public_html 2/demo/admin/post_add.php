<?php include('configure.php');
include('include/access.php');
$page_title = "Add Post";
$table_name = "post";

$table_id=  $table_name."_id";

$add_page = ADMINPATH."/".$table_name."_add.php";
$view_page = ADMINPATH."/".$table_name."_view.php";

$image_save_folder = "post";

if($_REQUEST[mode] == "add")
{
 $page_id = $_REQUEST[page_id];
$sql_page = $db_query->fetch_object("select count(*) c from post where page_id='$page_id'");
if($sql_page->c==0)
 {

  if($_FILES['f1']['tmp_name']!="")
  {
   if($db_query->image_type('f1')==1) 
    {
        $main_path = "../".$image_folder_name."/".$image_save_folder."/";
      $thumb = $main_path."thumbs/";
	  $file_without_ext = substr($file, 0, strrpos(".", $file));
	  $file = str_replace(' ', '_', $file_without_ext);
	  $file_save_name = md5($file);
      $upload_img = $db_query->cwUpload('f1',$main_path,'',TRUE,$thumb,'270','187',$file_save_name);
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
     $_REQUEST[image_path] =  $_REQUEST[thumb_image] =''; 
  }
  
   if($_FILES['f2']['tmp_name']!="")
  {
   if($db_query->image_type('f2')==1) 
    {
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
     $_REQUEST[breadcumb_image] =  ''; 
  }
  
 $_REQUEST[slug] = $db_query->slug($_REQUEST[post_name]);
 $_REQUEST[language_id] = $_SESSION[language_id]; 
  $_REQUEST[status]=1;
  if( $db->insertDataArray($table_name,$_REQUEST))
  {
  header('location:'.$add_page."?msg=1");
  }
}

else
{
 $msg = "Post Already Added";
 $error_type = "danger";
	$sign = "fa-wrong";

}
}


if($_GET[msg]==1)
{
$msg = "Added Successfully";
$error_type = "success";
	$sign = "fa-check";
 }

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php include('titlebar.php');?>
 <link rel="stylesheet" type="text/css" href="<?=ADMINPATH?>/assets/lib/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css">
 <link rel="stylesheet" type="text/css" href="<?=ADMINPATH?>/assets/lib/jquery.icheck/skins/square/blue.css">
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
                              <label  class="col-sm-2">Page Name</label>
                             <div class="col-sm-4">  
                             
                              <select name="page_id" id="page_id" parsley-trigger="change" required=""  class="form-control " >
                                          <option value="">--Select--</option>
                                          <?php $sql_page = $db_query->runQuery("select * from page where status=1 order by page_name");
										  foreach($sql_page as $row_page) { ?>
                                          <option value="<?=$row_page[page_id]?>" <?php if($_REQUEST[page_id]==$row_page[page_id]) {?> selected="selected"<?php } ?> ><?=$row_page[page_name]?></option>
                                          <?php } ?>
                                         
                                          </select>
                                          
                             </div>
                            </div>
                              
                            
                            
                            <div class="form-group ">
                              <label  class="col-sm-2">Post Name</label>
                             <div class="col-sm-7">  
                             <input type="text" name="post_name" parsley-trigger="change" required="" class="form-control " value="<?=$_REQUEST[post_name]?>">
                             </div>
                             
                            </div>
                            
                            <!--<div class="form-group ">
                              <label  class="col-sm-2">Short Description</label>
                             <div class="col-sm-10">  
                             <textarea  class="form-control" name="short_description" id="short_description"  parsley-trigger="change" > <?=trim(stripslashes($_REQUEST[short_description]))?>
                              </textarea>
                             </div>
                            </div>-->
                            <script>
	CKEDITOR.replace('short_description',{
                       
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
                              <label  class="col-sm-2">Description</label>
                             <div class="col-sm-10">  
                             <textarea  class="form-control" name="description" id="description" parsley-trigger="change"  > <?=trim(stripslashes($_REQUEST[description]))?>
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
                              <label  class="col-sm-2">Featured Image  </label>
                             <div class="col-sm-4">  
                              <input class="form-control col-sm-6" type="file" name="f1" id="f1"  value=""  />
                             </div>
                            </div>
                             
                              <div class="form-group ">
                              <label  class="col-sm-2">Breadcumb Image  </label>
                             <div class="col-sm-4">  
                              <input class="form-control col-sm-6" type="file" name="f2" id="f2"  value=""  />
                             </div>
                            </div>
                             
                             <div class="form-group ">
                              <label  class="col-sm-2">Page Title</label>
                             <div class="col-sm-7">  
                             <input type="text" name="page_title" parsley-trigger="change"  class="form-control " value="<?=$_REQUEST[page_title]?>">
                             </div>
                             
                            </div>
                             
                             <div class="form-group ">
                              <label  class="col-sm-2">Meta Title</label>
                             <div class="col-sm-7">  
                             <input type="text" name="meta_title" parsley-trigger="change"  class="form-control " value="<?=$_REQUEST[meta_title]?>">
                             </div>
                             
                            </div>
                             
                             <div class="form-group ">
                              <label  class="col-sm-2">Meta Keyword</label>
                             <div class="col-sm-7">  
                             <input type="text" name="meta_keyword" parsley-trigger="change"  class="form-control " value="<?=$_REQUEST[meta_keyword]?>">
                             </div>
                             
                            </div>
                             
                             <div class="form-group ">
                              <label  class="col-sm-2">Meta Description</label>
                             <div class="col-sm-7">  
                             <input type="text" name="meta_description" parsley-trigger="change"  class="form-control " value="<?=$_REQUEST[meta_description]?>">
                             </div>
                              
                            </div>
                            
                            
                              <input type="hidden" name="mode" value="add" />
                              <button type="submit" class="btn btn-primary">Submit</button>
                     <!--    <button type="reset" class="btn btn-default">Reset</button>-->
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
		  
         $('form').parsley();
		 
         });
		 App.formElements();
      </script>
</body>
</html>
