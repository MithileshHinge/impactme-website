<?php
include('configure.php');
include('include/access.php');
$page_title = "Manage All Submission";
$table_name = "impact_user";

$table_id=  "user_id";

$add_page = ADMINPATH."/".$table_name."_add.php";
$view_page = ADMINPATH."/creator_submission_view.php";
$edit_page = ADMINPATH."/".$table_name."_edit.php";


define("TABLE_ID",$table_id);
$menu_item  = array('Sl No','Date', 'Name','Email ID', 'Link', 'Action');
$count = count($menu_item);

$action = 1;
$edit_action = 0;
$delete_action=0;
$status_action = 1;

$sql_menu = "SELECT * FROM ".$table_name." where user_type='ucreate' and review_submit_status=1 order by review_submit_date desc";
$row_menu = $db_query->runQuery($sql_menu);

?>
<?php
if($_GET[TABLE_ID] && $_GET['review_status'])
{
  $id=base64_decode($_GET[TABLE_ID]);
  $status=base64_decode($_GET['review_status']);
  if($status=='0')
  {
     $sql_status="UPDATE ".$table_name." SET `review_status`='1' WHERE ".TABLE_ID."='$id'";
     $res_status=mysql_query($sql_status);
     if($res_status)
     { 
	  $msg='Status Updated Successfully';
	  header('location:'.$view_page);
     }
   }
  if($status=='1')
  {
    $sql_status="UPDATE ".$table_name." SET `review_status`='0' WHERE ".TABLE_ID."='$id'";
    $res_status=mysql_query($sql_status);
    if($res_status)
    {
     $msg='Status Updated Successfully';
	  header('location:'.$view_page);
    }
  }
}

if($_GET['id'])
{
	$id=$_GET['id'];
	$sql_image = $db_query->fetch_object("select image_path from ".$table_name." where ".TABLE_ID."='$id'");
	  $baseimg = "../".$image_folder_name."/";	
      unlink($baseimg.$sql_image->image_path);
	  
	$sql="DELETE FROM ".$table_name." WHERE ".TABLE_ID."='$id'";
	$res=mysql_query($sql);
	if($res)
	{
		$msg='Record Deleted Sucessfully';
		header("location:".$view_page);
	}
}
?>
<?php


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
 <link rel="stylesheet" type="text/css" href="<?=ADMINPATH?>/assets/lib/jquery.datatables/plugins/bootstrap/3/dataTables.bootstrap.css"/>
  <script language="JavaScript" >
function deldata(id)
{
	if(confirm("Do you want to delete?"))
	{
		window.location.href="<?=$view_page?>?id="+id;
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
                       
                       
                       <!-- <div class="header">
                           <h3>Horizontal Icons</h3>
                        </div>-->
                        <div class="content">
                           <div>
                              <table id="datatable2" class="table table-bordered">
                                 <thead>
                                    <tr>
                                       <?php foreach($menu_item as $menu_name) { ?>
                                       <th><?=$menu_name?></th>
                                       <?php } ?>
                                    </tr>
                                 </thead>
                                 <tbody>
              <?php 
			  $i=1;
			  foreach($row_menu as $item) {
			  if($i%2==0) $class=  "odd "; else $class=  "even ";
		            	if(strlen($item['slug'])>0) 
					 $path = BASEPATH.'/profile/'.$item['slug']."/";
					else
					 $path = BASEPATH.'/profile/u/'.$item['user_id']."/";
			  
			   ?>
                <tr class="<?=$class?>">
                  <td><?=$i++?></td>
                  <td><?=$item[review_submit_date]?></td>
                   <td><?=$item[full_name]?></td>
                  <td><?=$item[email_id]?></td>
                 
                <td><a href="<?=$path?>" target="_blank">View</a></td>
                
                 
                  
                  <?php if($action==1) { ?>
                  <td>
                    <?php if($status_action==1) { ?>         
        <a href="<?=$view_page?>?<?=TABLE_ID?>=<?=base64_encode($item[TABLE_ID])?>&review_status=<?=base64_encode($item[review_status])?>" title="Active/Inactive">
        <?php if($item[review_status]==0){?><i class="fa fa-lock"></i><?php }else{?><i class="fa fa-unlock"></i><?php }?></a> &nbsp;&nbsp;
        <?php } ?>
         <?php if($delete_action==1) { ?>   
         <a href="#"  onclick="javascript:deldata(<?=$item[TABLE_ID]?>)" title="Delete"><i class="fa fa-times"></i></a>&nbsp;&nbsp;
        <?php } ?>
        <?php if($edit_action==1) { ?> 
         <a href="<?=$edit_page?>?id=<?=base64_encode($item[TABLE_ID])?>" title="Edit"><i class="fa fa-pencil"></i></a>
        <?php } ?>
              <a href="creator_details.php?id=<?=base64_encode($item[TABLE_ID])?>" title="Details"><i class="fa fa-list"></i></a>    
                  </td>
                  <?php } ?>
                </tr>
                <?php } ?>
                                   
                                 </tbody>
                              </table>
                           </div>
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


      
  <script src="<?=ADMINPATH?>/assets/lib/jquery.datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="<?=ADMINPATH?>/assets/lib/jquery.datatables/plugins/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>
  <script type="text/javascript">$(document).ready(function(){
         //initialize the javascript
         App.init();
         App.dataTables();
         });
      </script>
 
 
 
</body>
</html>
