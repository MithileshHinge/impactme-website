<?php include('configure.php');
include('include/access.php');
$page_title = "Payment Details";
$table_name = "impact_payment";


$table_id=  "payment_id";
$view_page = ADMINPATH."/payment_received_details.php";
define("TABLE_ID",$table_id);


$id = base64_decode($_REQUEST['id']);
 $sql = "select * from ".$table_name." where ".$table_id."=".$id;
$row = $db_query->fetch_object($sql);
$row_customer = $db_query->fetch_object("select * from impact_user where user_id='".$row->user_id."'");
$row_customer1 = $db_query->fetch_object("select * from impact_user where user_id='".$row->creator_id."'");
$row_tier = $db_query->fetch_object("select * from impact_tier where tier_id='".$row->tier_id."'");
if($_REQUEST[mode] == "edit")
{
   $_REQUEST[send_date]=date('Y-m-d');
 $_REQUEST[send_status]=1;
   $id1=$_REQUEST[TABLE_ID];
   
   $db->updateArray($table_name,$_REQUEST,TABLE_ID."=".$id1);
   header("location:".$view_page."?id=".base64_encode($id1)."&msg=1");
}




if($_GET['msg']==1)
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

           <?php if($msg) { ?>
                       <div class="alert alert-<?=$error_type?>"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button><i class="fa <?=$sign?> sign"></i><?=$msg?></div><?php } ?>

    <div class="row">

                  <div class="col-sm-6 col-md-6">

   <div class="block-flat">

      <div class="header">

         <h3>Payment Details </h3>

      </div>

      <div class="content">

      <p class=""><strong>Merchant ID:</strong> <?=$row->transaction_id?></p> 

      <p class=""><strong>Transaction ID:</strong> <?=$row->mmp_txn?></p> 
      
      <p class=""><strong>Transaction Date:</strong> <?=$row->paid_date?></p> 
        
      <p class=""><strong>Transaction Amount:</strong> <?=$row->paid_amount?></p> 
      <p class=""><strong>Transaction Status:</strong> <?=$row->paid_status?></p> 
      
      

      </div>

   </div>

   

</div>



<div class="col-sm-6 col-md-6">

   <div class="block-flat">

      <div class="header">

         <h3>User Details </h3>

      </div>

      <div class="content">

     

         <p class=""><strong> Name:</strong> <?=$row_customer->full_name?></p> 
         <p class=""><strong>Impact Name:</strong> <?=$row_customer->impact_name?></p> 
         <p class=""><strong>Email ID:</strong> <?=$row_customer->email_id?></p>
         <p class=""><strong>Payment For:</strong> <?=$row_customer1->full_name?> (<?=$row_customer1->email_id?>)</p>
         <p class=""><strong>Tier Name:</strong> <?=$row_tier->tier_name?></p>

      



      </div>

   </div>

   

</div>


<div class="col-sm-6 col-md-6">

   <div class="block-flat">

      <div class="header">

         <h3>User Bank Details </h3>

      </div>

      <div class="content">

     

         <p class=""><strong> Bank Name:</strong> <?=$row_customer->bank_name?></p> 
         <p class=""><strong>Bank Holder Name:</strong> <?=$row_customer->bank_holder_name?></p> 
         <p class=""><strong>Account Number:</strong> <?=$row_customer->account_number?></p>
         <p class=""><strong>IFSC Code:</strong> <?=$row_customer->ifsc_code?> </p>
         <p class=""><strong>UPI ID:</strong> <?=$row_customer->upi_id?></p>

      



      </div>

   </div>

   

</div>


     
<div class="col-sm-6 col-md-6">

   <div class="block-flat">

      <div class="header">

         <h3>Sent Amount Details </h3>

      </div>

      <div class="content">

     

         <p class=""><strong> Commission Amount:</strong> <?=$row->commission_amount?></p> 
         <p class=""><strong>Send Amount:</strong> <?=$row->send_amount?></p> 
         <p class=""><strong>Send Date:</strong> <?=$row->send_date?></p>
         
      



      </div>

   </div>

   

</div>
               
<div class="col-sm-12 col-md-12">

   <div class="block-flat">

      <div class="header">

         <h3>Sent Amount </h3>

      </div>

      <div class="content">

       <form  action="<?=$_SERVER['REQUEST_URI']?>"  method="post" enctype="multipart/form-data" class="form-horizontal">
                           
                            
                            <div class="form-group ">
                              <label  class="col-sm-2">Commission Amount</label>
                             <div class="col-sm-7">  
                             <input type="text" name="commission_amount" parsley-trigger="change" required="" class="form-control " value="<?php if(strlen($row->commission_amount)>0) echo $row->commission_amount; else echo '0.00';?>">
                             </div>
                            </div>
                            
                             <div class="form-group ">
                              <label  class="col-sm-2">Total Amount</label>
                             <div class="col-sm-7">  
                             <input type="text" name="send_amount" parsley-trigger="change" required=""  class="form-control "   value="<?php if(strlen($row->send_amount)>0) echo $row->send_amount; else echo $row->paid_amount;?>">
                             </div>
                            </div>
                             
                             
                              
                               <input type="hidden" name="mode" value="edit" />
                               <input type="hidden" name="<?=$table_id?>" value="<?=$id?>" id="<?=$table_id?>"/>
                              <button type="submit" class="btn btn-primary">Update</button>
                              <input type="button" name="back" value="Back" onclick="history.go(-1)" class="btn btn-success"/>
                     <!--    <button type="reset" class="btn btn-default">Reset</button>-->
                           </form>

         
      



      </div>

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
