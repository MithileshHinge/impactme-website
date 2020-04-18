<?php
include('configure.php');
include('include/access.php');
$page_title = "Manage Sent Payment";
$table_name = "impact_payment";

$table_id=  "payment_id";

$add_page = ADMINPATH."/creator_add.php";
$view_page = ADMINPATH."/payment_received.php";
$view_details_page = ADMINPATH."/payment_received_details.php";
$edit_page = ADMINPATH."/creator_edit.php";


define("TABLE_ID",$table_id);
$menu_item  = array('Sl No','Merchant Id','Transaction Id','Date', 'Amount', 'Impact Name','Commission Amount', 'Send Amount','Send Date','Sent Status','Action');
$count = count($menu_item);

$action = 1;
$edit_action = 0;
$delete_action=0;
$status_action = 0;

$sql_menu = "SELECT * FROM ".$table_name." where send_status=1 order by ".$table_id." desc";
$row_menu = $db_query->runQuery($sql_menu);

?>
<?php
if($_GET[TABLE_ID] && $_GET['status'])
{
  $id=base64_decode($_GET[TABLE_ID]);
  $status=base64_decode($_GET['status']);
  if($status=='0')
  {
     $sql_status="UPDATE ".$table_name." SET `status`='1' WHERE ".TABLE_ID."='$id'";
     $res_status=$db_query->runQuery($sql_status);
	  header('location:'.$view_page);
   }
  if($status=='1')
  {
    $sql_status="UPDATE ".$table_name." SET `status`='0' WHERE ".TABLE_ID."='$id'";
    $res_status=$db_query->runQuery($sql_status);
	  header('location:'.$view_page);
  }
}

if($_GET['id'])
{
	$id=$_GET['id'];
	
	$sql="DELETE FROM ".$table_name." WHERE ".TABLE_ID."='$id'";
	$res=$db_query->runQuery($sql);
		header("location:".$view_page);
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
			
			  $menu_item  = array('Sl No','Merchant Id','Transaction Id','Date', 'Amount', 'Impact Name','Tier Name', 'For User', 'Status', 'Action');
			  
			  $row_user = $db_query->fetch_object("select impact_name, full_name from impact_user where user_id='$item[user_id]'");
			  $row_tier = $db_query->fetch_object("select * from impact_tier where tier_id='$item[tier_id]'");
			  $row_user1 = $db_query->fetch_object("select impact_name, full_name from impact_user where user_id='$item[creator_id]'");
			   ?>
                <tr class="<?=$class?>">
                  <td><?=$i++?></td>
              
                  <td><?=$item[transaction_id]?></td>
                   <td><?=$item[mmp_txn]?></td>
                   <td><?=$item[paid_date]?></td>
                   <td><?=$item[paid_amount]?></td>
                   <td><?=$row_user->impact_name?></td>
                    <td><?=$item[commission_amount]?></td>
                    <td><?=$item[send_amount]?></td>
                     <td><?=$item[send_date]?></td>
                      <td><?php if($item[send_status]==1) echo "Paid"; else echo "Not Paid";?></td>
                 <!-- <td><img src="<?=IMAGEPATH?><?=$item[image_path]?>"  class="col-sm-4" style="width:20%"/></td>-->
               
                
                 
                  
                  <?php if($action==1) { ?>
                  <td>
                   <a href="<?=$view_details_page?>?id=<?=base64_encode($item[TABLE_ID])?>" title="Edit"><i class="fa fa-list"></i></a>
                    <?php if($status_action==1) { ?>         
        <a href="<?=$view_page?>?<?=TABLE_ID?>=<?=base64_encode($item[TABLE_ID])?>&status=<?=base64_encode($item[status])?>" title="Active/Inactive">
        <?php if($item[status]==1){?><i class="fa fa-unlock"></i><?php }else{?><i class="fa fa-lock"></i><?php }?></a> &nbsp;&nbsp;
        <?php } ?>
         <?php if($delete_action==1) { ?>   
         <a href="#"  onclick="javascript:deldata(<?=$item[TABLE_ID]?>)" title="Delete"><i class="fa fa-times"></i></a>&nbsp;&nbsp;
        <?php } ?>
        <?php if($edit_action==1) { ?> 
         <a href="<?=$edit_page?>?id=<?=base64_encode($item[TABLE_ID])?>" title="Edit"><i class="fa fa-pencil"></i></a>
        <?php } ?>
                  
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