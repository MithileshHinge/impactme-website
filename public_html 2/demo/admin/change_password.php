<?php include('configure.php');
include('include/access.php');
$page_title = "Change Password";
 ?>
 <?php
 if($_REQUEST[mode] == "reset")
{
 $id1 = $row_access->emp_id;
 $username = $db_query->filter($_REQUEST[username]);
 $old_password = $db_query->filter($_REQUEST[old_password]);
 $new_password = $db_query->filter($_REQUEST[password]);
 $confirm_password = $db_query->filter($_REQUEST[cpassword]);
 $sql = "select count(*) c from ".LOG_TABLE." where binary password='$old_password' and binary username='$username'";
 $row_object = $db_query->fetch_object($sql);
  if($row_object->c==1)
  {
   if($new_password==$confirm_password)
   {
     $db->updateArray(LOG_TABLE,$_REQUEST,emp_id."=".$id1);
    $msg = "Passwortd Changed Successfully";
	$error_type = "success";
	$sign = "fa-check";
	
	//unset($_SESSION[SESSION_USER]);
	unset($_SESSION[PASSWORD]);
	$_SESSION[PASSWORD] = $confirm_password;
	//header('location:index.php');
   }
   else
   {
    $msg = "Both password are not same.";
    $error_type = "danger";
    $sign = "fa-times-circle";
   }
  
  
  }
  else
  {
   $msg = "Old Password Is not Correct.";
   $error_type = "danger";
   $sign = "fa-times-circle";
  }


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
                  <li><a href="<?=ADMINPATH?>home/">Home</a></li>
                  <li class="active"><a href="#"><?=$page_title?></a></li>
                 
               </ol>
            </div>

<div class="cl-mcont">
          
    <div class="row">
                  <div class="col-sm-12 col-md-12">
                     <div class="block-flat">
                     <?php if($msg) { ?>
                       <div class="alert alert-<?=$error_type?>"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button><i class="fa <?=$sign?> sign"></i><?=$msg?></div><?php } ?>
                        <div class="content">
                           <form action="<?=$_SERVER['REQUEST_URI']?>" data-parsley-validate="" novalidate="" method="post">
                              <div class="form-group col-sm-6"><label>User Name</label><input type="text" name="username" parsley-trigger="change" required="" placeholder="Enter user name" class="form-control "  readonly="readonly" value="<?=$row_access->username?>"></div>
                               <div class="form-group col-sm-6"><label>Old Password</label><input id="pass2" type="password" placeholder="Old Password" required="" class="form-control" name="old_password"></div>
                              <div class="form-group col-sm-6"><label>Password</label><input id="pass1" type="password" placeholder="Password" required="" class="form-control" name="password"></div>
                              <div class="form-group col-sm-6"><label>Repeat Password</label><input data-parsley-equalto="#pass1" type="password" required="" placeholder="Password" class="form-control" name="cpassword"></div>
                              <input type="hidden" name="mode" value="reset" />
                              <button type="submit" class="btn btn-primary">Submit</button><!--<button class="btn btn-default">Cancel</button>-->
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

<script src="<?=ADMINPATH?>assets/lib/jquery.parsley/dist/parsley.min.js" type="text/javascript"></script>
<script src="<?=ADMINPATH?>assets/lib/jquery.parsley/src/extra/dateiso.js" type="text/javascript"></script>
	  
	  <script type="text/javascript">$(document).ready(function(){
         //initialize the javascript
         App.init();
         $('form').parsley();
         });
      </script>
</body>
</html>
