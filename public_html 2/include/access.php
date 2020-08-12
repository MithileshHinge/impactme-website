<?php
include('../admin_path.php');
if(isset($_SESSION['is_user_login'])==1)
{

 $user_log = 1;
 $user_id = base64_decode($_SESSION['user_id']);
 $row_user = $db_query->fetch_object("select i.*, count(*) c from impact_user i where i.user_id='".$user_id ."'");
 if($row_user->c==0) {
 session_destroy();
 header('location:'.BASEPATH.'');
 exit();
 }
 else
 {
   if (strlen($row_user->account_number) > 4){
    $row_user->account_number = str_repeat('X', strlen($row_user->account_number) - 4) . substr($row_user->account_number, -4);
   }
   $basefile = basename($_SERVER['PHP_SELF']);
   $Cretor_Check = $db_query->creator_check($row_user->email_id);
   if($Cretor_Check->c>0)
   {
     $_SESSION['is_user_login'] = 1;
	 $_SESSION['user_id'] = base64_encode( $Cretor_Check->user_id );
	 $_SESSION['user_type'] = 1;
   }
 
 if($row_user->user_type=="create")
  $impact_type = "fan";
 else
  $impact_type = "creator"; 
  }
}
else
{
 $user_log = 0;
 session_destroy();

 header('location:'.BASEPATH.'');
 exit();
}


?>