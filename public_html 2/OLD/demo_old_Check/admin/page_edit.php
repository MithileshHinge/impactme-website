<?php include('configure.php');
include('include/access.php');
$page_title = "Edit Page";
$table_name = "page";


$table_id=  $table_name."_id";
$view_page = ADMINPATH."/".$table_name."_view.php/";
define("TABLE_ID",$table_id);

$image_save_folder = "page";

$id = base64_decode($_REQUEST['id']);
$sql = "select * from ".$table_name." where ".$table_id."=".$id;
$row = $db_query->fetch_object($sql);

if($_REQUEST[mode] == "edit")
{
  $_REQUEST[page_name] = stripslashes($_REQUEST[page_name]);
   $id1=$_REQUEST[TABLE_ID];
    $_REQUEST[slug] = $db_query->slug($_REQUEST[page_name]);
   $_REQUEST[language_id] = $_SESSION[language_id]; 
   $db->updateArray($table_name,$_REQUEST,TABLE_ID."=".$id1);
   header("location:".$view_page);
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
                              <label  class="col-sm-2">Category Name</label>
                             <div class="col-sm-7">  
                             <input type="text" name="page_name" parsley-trigger="change" required="" class="form-control " value="<?=$row->page_name?>">
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
<script src="<?=ADMINPATH?>/assets/lib/jquery.parsley/src/extra/dateiso.js" type="text/javascript"></script>
	  
	  <script type="text/javascript">$(document).ready(function(){
         //initialize the javascript
         App.init();
         $('form').parsley();
         });
      </script>
</body>
</html>
