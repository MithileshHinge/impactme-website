<?php include('configure.php');
include('include/access.php');
$page_title = "User Queries";
$table_name = "user_queries";

$table_id= "query_id";

//$add_page = ADMINPATH."/".$table_name."_add.php";
$view_page = ADMINPATH."/queries.php";
//$edit_page = ADMINPATH."/".$table_name."_edit.php";


define("TABLE_ID",$table_id);
$query_item  = array('Sl No','UserID', 'Username' , 'User type', 'Email', 'Query Type', 'File', 'Device Type', 'Description', 'Token', 'Submit time', 'Status', 'Remarks');
$count = count($query_item);

$action =1;
$edit_action = 0;
$delete_action=1;
$status_action = 1;

$sql_query = "SELECT q.query_id, q.user_id, u.full_name, (case when q.user_type='ucreate' then 'Creator' else 'Supporter' end) user_type, q.email_id, (case when q.query_type=0 then 'Bug or Error' when q.query_type=1 then 'Question about ImpactMe' when q.query_type=2 then 'Report user or post' when q.query_type=3 then 'Trust and safety related' else 'Other' end) query_type, q.filepath, (case when q.device_type=0 then 'Desktop' when q.device_type=1 then 'Mobile (Android)' else 'Mobile (Apple)' end) device_type, q.description, q.token, q.submit_time, q.status, q.remarks FROM $table_name q, impact_user u where u.user_id=q.user_id";
$sql_query.=" order by q.submit_time desc";
$row_query = $db_query->runQuery($sql_query);

?>
<?php
if($_GET[TABLE_ID] && $_GET['status'])
{
  $id=base64_decode($_GET[TABLE_ID]);
  $status=base64_decode($_GET['status']);
  if($status=='0')
  {
     $sql_status="UPDATE ".$table_name." SET `status`='1' WHERE ".TABLE_ID."='$id'";
     $res_status=mysql_query($sql_status);
     if($res_status)
     { 
    $msg='Status Updated Successfully';
    header('location:'.$view_page);
     }
   }
  if($status=='1')
  {
    $sql_status="UPDATE ".$table_name." SET `status`='0' WHERE ".TABLE_ID."='$id'";
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
  $sql_del = mysql_query("delete from  ".$table_name." WHERE sub_menu_id=".$id);
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
                                       <?php foreach($query_item as $menu_name) { ?>
                                       <th><?=$menu_name?></th>
                                       <?php } ?>
                                    </tr>
                                 </thead>
                                 <tbody>
              <?php 
        $i=1;
        foreach($row_query as $item) {
        if($i%2==0) $class=  "odd "; else $class=  "even ";
      
        
         ?>
                <tr class="<?=$class?>">
                  <td><?=$i++?></td>
                  <td><?=$item['user_id']?></td>
                  <td><?=$item['full_name']?></td>
                  <td><?=$item['user_type']?></td>
                  <td><?=$item['email_id']?></td>
                  <td><?=$item['query_type']?></td>
                  <td><?=$item['filepath']?></td>
                  <td><?=$item['device_type']?></td>
                  <td><?=$item['description']?></td>
                  <td><?=$item['token']?></td>
                  <td><?=$item['submit_time']?></td>
                
                 
                  
                  <?php if($action==1) { ?>
                  <td>
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
                  <td><?=$item['remarks']?></td>
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
