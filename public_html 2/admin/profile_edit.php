<?php include('configure.php');
include('include/access.php');
$page_title = "Company Profile";
$table_name = "web_settings";
$table_id=  "web_id";
$page_name = ADMINPATH."/company-profile/";
$image_save_folder = "logo";


define("TABLE_ID",$table_id);

$id = 1;
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
      $main_path = "../".$image_folder_name."/".$image_save_folder."/";
     // $thumb = $main_path."thumbs/";
      $upload_img = $db_query->cwUpload('f1',$main_path,'',FALSE,$thumb,'30','30');
      $_REQUEST[image_path] =  $image_save_folder."/".$upload_img; 
     
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
	// $_REQUEST[thumb_image] = $row_web_settings->thumb_image; 
  }
  
  
  
  if($_FILES['f2']['tmp_name']!="")
  {
   if($db_query->image_type('f2')==1) 
    {
	 $baseimg = "../".$image_folder_name."/";	
      unlink($baseimg.$row_web_settings->fav_icon);
      $main_path = "../".$image_folder_name."/".$image_save_folder."/";
      //$thumb = $main_path."thumbs/";
      $upload_img = $db_query->cwUpload('f2',$main_path,'',FALSE,$thumb,'30','30');
      $_REQUEST[fav_icon] =  $image_save_folder."/".$upload_img; 
     // $_REQUEST[thumb_image] = $image_save_folder."/thumbs/".$upload_img; 
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
     $_REQUEST[fav_icon] =  $row_web_settings->fav_icon;  
  }
  
    if($_FILES['f3']['tmp_name']!="")
  {
   if($db_query->image_type('f3')==1) 
    {
	 $baseimg = "../".$image_folder_name."/";	
      unlink($baseimg.$row_web_settings->profile_logo);
      $main_path = "../".$image_folder_name."/".$image_save_folder."/";
      //$thumb = $main_path."thumbs/";
      $upload_img = $db_query->cwUpload('f3',$main_path,'',FALSE,$thumb,'30','30');
      $_REQUEST[header_gif] =  $image_save_folder."/".$upload_img; 
     // $_REQUEST[thumb_image] = $image_save_folder."/thumbs/".$upload_img; 
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
     $_REQUEST[header_gif] =  $row_web_settings->header_gif;  
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
                              <label  class="col-sm-2">Website Name</label>
                             <div class="col-sm-7">  
                             <input type="text" name="site_name" parsley-trigger="change" required=""  class="form-control "   value="<?=$row->site_name?>">
                             </div>
                            </div>
                             <div class="form-group ">
                              <label  class="col-sm-2">Page Title</label>
                             <div class="col-sm-7">  
                             <input type="text" name="page_title" parsley-trigger="change" required=""  class="form-control "   value="<?=$row->page_title?>">
                             </div>
                            </div>
                            
                            <div class="form-group ">
                              <label  class="col-sm-2">Email ID</label>
                             <div class="col-sm-7">  
                             <input type="email" name="email_id" parsley-trigger="change" required=""  class="form-control "   value="<?=$row->email_id?>">
                             </div>
                            </div>
                             <div class="form-group ">
                              <label  class="col-sm-2">Phone</label>
                             <div class="col-sm-7">  
                             <input type="text" name="phone" parsley-trigger="change" required=""  class="form-control "   value="<?=$row->phone?>">
                             </div>
                            </div>
                            
                          <!-- <div class="form-group ">
                              <label  class="col-sm-2">Mobile</label>
                             <div class="col-sm-7">  
                             <input type="text" name="phone1" parsley-trigger="change"  class="form-control "   value="<?=$row->phone1?>">
                             </div>
                            </div>-->
                            
                             <div class="form-group ">
                              <label  class="col-sm-2">Address</label>
                             <div class="col-sm-9">  
                             <input type="text" name="address" parsley-trigger="change"   class="form-control "   value="<?=$row->address?>">
                             <input type="text" name="address1" parsley-trigger="change"   class="form-control "   value="<?=$row->address1?>">
                             </div>
                            </div>
                             <!--script>
	CKEDITOR.replace('address0',{
                       
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


<!--<div class="form-group ">
                              <label  class="col-sm-2">Footer About Us</label>
                             <div class="col-sm-9">  
                             <textarea required="" class="form-control" name="footer_about" id="footer_about" > <?=trim(stripslashes($row->footer_about))?>
                              </textarea>
                             </div>
                            </div>
                             <script>
	CKEDITOR.replace('footer_about',{
                       
                       filebrowserWindowWidth: '900',
					   filebrowserWindowHeight: '400',
					   filebrowserBrowseUrl : '<?=ADMINPATH?>/ckfinder/ckfinder.html',
					   filebrowserImageBrowseUrl : '<?=ADMINPATH?>/ckfinder/ckfinder.html?type=Images',
					   filebrowserFlashBrowseUrl : '<?=ADMINPATH?>/ckfinder/ckfinder.html?type=Flash',
					   filebrowserUploadUrl : '<?=ADMINPATH?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
					   filebrowserImageUploadUrl : '<?=ADMINPATH?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
					   filebrowserFlashUploadUrl : '<?=ADMINPATH?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
	} );
</script>-->

<div class="form-group ">
                              <label  class="col-sm-2">Footer Copyright</label>
                             <div class="col-sm-9">  
                             <textarea required="" class="form-control" name="copyright" id="copyright" > <?=trim(stripslashes($row->copyright))?>
                              </textarea>
                             </div>
                            </div>
                             <!--script>
	CKEDITOR.replace('copyright',{
                       
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


<!--<div class="form-group ">
                              <label  class="col-sm-2">Footer Contact Description</label>
                             <div class="col-sm-9">  
                             <textarea  class="form-control" name="footer_contact" id="footer_contact" > <?=trim(stripslashes($row->footer_contact))?>
                              </textarea>
                             </div>
                            </div>-->
                             <!--script>
	CKEDITOR.replace('footer_contact',{
                       
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


                        <!--   <div class="form-group ">
                              <label  class="col-sm-2">Footer Goggle Map</label>
                             <div class="col-sm-9">  
                             <textarea  class="form-control" name="footer_map" id="footer_map" > <?=trim(stripslashes($row->footer_map))?>
                              </textarea>
                             </div>
                            </div>
                            
                   <div class="form-group ">
                              <label  class="col-sm-2">Contact Us Page Goggle Map</label>
                             <div class="col-sm-9">  
                             <textarea  class="form-control" name="contact_map" id="contact_map" > <?=trim(stripslashes($row->contact_map))?>
                              </textarea>
                             </div>
                            </div>-->
                        


                            
                            
  <div class="form-group ">
                              <label  class="col-sm-2">Company Logo ( 200 * 65 px )</label>
                             <div class="col-sm-7">  
                            <input class="form-control col-sm-4" type="file" name="f1" id="f1"  value="<?=$row->image_path?>" />
<?php if(getimagesize(IMAGEPATH.$row->image_path)>0) { ?>
 <img src="<?=IMAGEPATH?><?=$row->image_path?>"  class="col-sm-3" style="margin-top:5%; width:20%"/> <?php } ?>
                             </div>
                            </div>
                            
                            
                           <!-- <div class="form-group ">
                              <label  class="col-sm-2">Profile Logo</label>
                             <div class="col-sm-7">  
                            <input class="form-control col-sm-4" type="file" name="f3" id="f3"  value="<?=$row->profile_logo?>" />
<?php if(getimagesize(IMAGEPATH.$row->profile_logo)>0) { ?>
 <img src="<?=IMAGEPATH?><?=$row->profile_logo?>"  class="col-sm-3" style="margin-top:5%; width:20%"/> <?php } ?>
                             </div>
                            </div>-->
                            
                            
<div class="form-group ">
                              <label  class="col-sm-2">Fav Icon ( 18*18 px )</label>
                             <div class="col-sm-7">  
                            <input class="form-control col-sm-4" type="file" name="f2" id="f2"  value="<?=$row->fav_icon?>" />
<?php if(getimagesize(IMAGEPATH.$row->fav_icon)>0) { ?>
 <img src="<?=IMAGEPATH?><?=$row->fav_icon?>"  class="col-sm-3" style="margin-top:5%; width:20%"/> <?php } ?>
                             </div>
                            </div>


<!-- <div class="form-group ">
                              <label  class="col-sm-2">Header Gif</label>
                             <div class="col-sm-7">  
                            <input class="form-control col-sm-4" type="file" name="f3" id="f3"  value="<?=$row->header_gif?>" />
<?php if(getimagesize(IMAGEPATH.$row->header_gif)>0) { ?>
 <img src="<?=IMAGEPATH?><?=$row->header_gif?>"  class="col-sm-3" style="margin-top:5%; width:20%"/> <?php } ?>
                             </div>
                            </div>-->
                            
                            
                       <!-- <div class="header">
                           <h3>Social Link</h3>
                        </div>
                             <div class="form-group ">
                              <label  class="col-sm-2">Facebook</label>
                             <div class="col-sm-7">  
                             <input type="text" name="facebook"  value="<?=$row->facebook?>" parsley-trigger="change"  class="form-control "  >
                             </div>
                            </div>
                              <div class="form-group ">
                              <label  class="col-sm-2">Linkedin</label>
                             <div class="col-sm-7">  
                             <input type="text" name="linkedin"  value="<?=$row->linkedin?>" parsley-trigger="change"  class="form-control">
                             </div>
                            </div>
                            
                             <div class="form-group ">
                              <label  class="col-sm-2">Twitter</label>
                             <div class="col-sm-7">  
                             <input type="text" name="twitter"  value="<?=$row->twitter?>" parsley-trigger="change"  class="form-control">
                             </div>
                            </div>
                             <div class="form-group ">
                              <label  class="col-sm-2">Google Plus</label>
                             <div class="col-sm-7">  
                             <input type="text" name="google_plus"  value="<?=$row->google_plus?>" parsley-trigger="change"  class="form-control">
                             </div>
                            </div>
                             <div class="form-group ">
                              <label  class="col-sm-2">Instagram</label>
                             <div class="col-sm-7">  
                             <input type="text" name="instagram"  value="<?=$row->instagram?>" parsley-trigger="change"  
                             class="form-control">
                             </div>
                            </div>-->
                            
                           <!-- <div class="form-group ">
                              <label  class="col-sm-2">Pininterest</label>
                             <div class="col-sm-7">  
                             <input type="text" name="pininterest"  value="<?=$row->pininterest?>" parsley-trigger="change"  class="form-control">
                             </div>
                            </div>
                          
                              <div class="form-group ">
                              <label  class="col-sm-2">Telegram</label>
                             <div class="col-sm-7">  
                             <input type="text" name="telegram"  value="<?=$row->telegram?>" parsley-trigger="change"  class="form-control">
                             </div>
                            </div>-->
                          <!--   <div class="form-group ">
                              <label  class="col-sm-2">You Tube</label>
                             <div class="col-sm-7">  
                             <input type="text" name="you_tube_code"  value="<?=$row->you_tube_code?>" parsley-trigger="change"  class="form-control">
                             </div>
                            </div>-->
                            <!--   <div class="form-group ">
                              <label  class="col-sm-2">Instagram</label>
                             <div class="col-sm-7">  
                             <input type="text" name="instagram"  value="<?=$row->instagram?>" parsley-trigger="change"  class="form-control">
                             </div>
                            </div>-->
                            
                         <div class="header">
                           <h3>Meta Tag</h3>
                        </div>
                            
                             <div class="form-group ">
                              <label  class="col-sm-2">Meta Title</label>
                             <div class="col-sm-7">  
                             <input type="text" name="meta_title"  value="<?=$row->meta_title?>" parsley-trigger="change"  class="form-control "  >
                             </div>
                            </div>
                            
                             <div class="form-group ">
                              <label  class="col-sm-2">Meta Keyword</label>
                             <div class="col-sm-7">  
                             <input type="text" name="meta_keyword"  value="<?=$row->meta_keyword?>" parsley-trigger="change"  class="form-control">
                             </div>
                            </div>
                             <div class="form-group ">
                              <label  class="col-sm-2">Meta Description</label>
                             <div class="col-sm-7">  
                             <input type="text" name="meta_description"  value="<?=$row->meta_description?>" parsley-trigger="change"  
                             class="form-control">
                             </div>
                            </div>
                          
                          
                          
                         <!--   <div class="header">
                           <h3>Home Page Counter</h3>
                        </div>
                            
                             <div class="form-group ">
                              <label  class="col-sm-2">Counter 1 Title</label>
                             <div class="col-sm-7">  
                             <input type="text" name="counter1_title"  value="<?=$row->counter1_title?>" parsley-trigger="change"  class="form-control "  >
                             </div>
                            </div>
                            
                             <div class="form-group ">
                              <label  class="col-sm-2">Counter 1 Number</label>
                             <div class="col-sm-7">  
                             <input type="text" name="counter1_no"  value="<?=$row->counter1_no?>" parsley-trigger="change"  class="form-control">
                             </div>
                            </div>
                              <div class="form-group ">
                              <label  class="col-sm-2">Counter 2 Title</label>
                             <div class="col-sm-7">  
                             <input type="text" name="counter2_title"  value="<?=$row->counter2_title?>" parsley-trigger="change"  class="form-control "  >
                             </div>
                            </div>
                            
                             <div class="form-group ">
                              <label  class="col-sm-2">Counter 2 Number</label>
                             <div class="col-sm-7">  
                             <input type="text" name="counter2_no"  value="<?=$row->counter2_no?>" parsley-trigger="change"  class="form-control">
                             </div>
                            </div>
                            
                              <div class="form-group ">
                              <label  class="col-sm-2">Counter 3 Title</label>
                             <div class="col-sm-7">  
                             <input type="text" name="counter3_title"  value="<?=$row->counter3_title?>" parsley-trigger="change"  class="form-control "  >
                             </div>
                            </div>
                            
                             <div class="form-group ">
                              <label  class="col-sm-2">Counter 3 Number</label>
                             <div class="col-sm-7">  
                             <input type="text" name="counter3_no"  value="<?=$row->counter3_no?>" parsley-trigger="change"  class="form-control">
                             </div>
                            </div>
                          
                          
                            <div class="form-group ">
                              <label  class="col-sm-2">Counter 4 Title</label>
                             <div class="col-sm-7">  
                             <input type="text" name="counter4_title"  value="<?=$row->counter4_title?>" parsley-trigger="change"  class="form-control "  >
                             </div>
                            </div>
                            
                             <div class="form-group ">
                              <label  class="col-sm-2">Counter 4 Number</label>
                             <div class="col-sm-7">  
                             <input type="text" name="counter4_no"  value="<?=$row->counter4_no?>" parsley-trigger="change"  class="form-control">
                             </div>
                            </div>-->
                              
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
