<?php
/*ob_start();// turn on output buffering
session_start();//start new or resume existing session
require_once('config.php');// inlclude config file 
require_once(MYSQL_CLASS_DIR.'DBConnection.php');// to make dtabase connection
require_once(PHP_FUNCTION_DIR.'function.database.php');// to use database function
require_once(PHP_FUNCTION_DIR.'phpmailer.php');// to send mail 
$dbObj = new DBConnection();// database connection object
$id = 2;*/
// for order detail
$dbObj->dbQuery = "select * from ".PREFIX."booking where id='".$id."'";
$dbOrder = $dbObj->SelectQuery('slider.php','slider_images()');

$mail = new PHPMailer();	
$mail->Priority = 3;
$mail->From = "contact@rushholidays.com";
$mail->FromName = "rushholidays.com";
$mail->Subject = "Thank you for purchase";
$mail->AddAddress($dbOrder[0]['email'],"rushholidays.com");
$mail->AddBCC('ksamayrananda@gmail.com',"developer");
$mail->Body = "";
$mail->AltBody = "";
$body = '';		
$body ='
<table width="100%" border="0" style=" border-collapse:collapse; margin:0; padding:0">
  <tr>
    <td scope="col" align="left"><table border="0" cellspacing="0" cellpadding="5" width="800" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;  border-collapse:collapse;">
  <tr>
      <td align="left" bgcolor="#FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">Dear '.$dbOrder[0]['fname'].' '.$dbOrder[0]['lname'].',</font></td>
  </tr>
<tr>
 <td align="left" bgcolor="#FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">We have received your Payment. Our representative will contact you soon. Below is your payment details.</font></td>
</tr>
<tr>
   <td align="left" bgcolor="#FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">Package Name: '.ucwords($dbOrder[0]['tour']).' - Days: '.$dbOrder[0]['tdays'].' and Nights: '.$dbOrder[0]['tnight'].'</font></td>
</tr>	
<tr>
   <td align="left" bgcolor="#FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">Adults: '.$dbOrder[0]['adult'].' - Price Per Persone: '.$dbOrder[0]['adultprice'].'</font></td>
</tr>
';

if(!empty($dbOrder[0]['kids'])){
   $body.='<tr><td align="left" bgcolor="#FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">Kids: '.$dbOrder[0]['kids'].' - Price Per Kid: '.$dbOrder[0]['kidsprice'].'</font></td>
</tr>		';
}
$body.='
<tr>
   <td align="left" bgcolor="#FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">Tour Date: '.date('d M Y',strtotime($dbOrder[0]['tsdate'])).' - to '.date('d M Y',strtotime($dbOrder[0]['tndate'])).'</font></td>
</tr>
<tr>
   <td align="left" bgcolor="#FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">Customer: '.$dbOrder[0]['fname'].' '.$dbOrder[0]['lname'].' | E-mail: '.$dbOrder[0]['email'].' | Mobile: '.$dbOrder[0]['mobile'].'</font></td>
</tr>
<tr>
   <td align="left" bgcolor="#FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">Address: '.$dbOrder[0]['addr'].' '.$dbOrder[0]['city'].' '.$dbOrder[0]['state'].' '.$dbOrder[0]['country'].' Pin-'.$dbOrder[0]['pincode'].'</font></td>
</tr>
<tr>
   <td align="left" bgcolor="#FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">Total Paid Amount: '.number_format($dbOrder[0]['ttotalprice']).'</font></td>
</tr>
<tr>
   <td align="left" bgcolor="#FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">Thanking You,<br><a href="http://www.rushholidays.com" style="color:#114F89;">www.rushholidays.com</a></font></td>
</tr>	  
  <tr>
    <td align="left"><img src="'.HTACCESS_URL.'images/logo.png" width="150"></td>
  </tr>
</table></td></tr></table>';

$mail->Body .= $body;
$mail->Send();
$mail->ClearAllRecipients(); 



//--------------------------------------------- mail send to admin ----------------------------------------

$dbObj->dbQuery="select * from ".PREFIX."adminuser where id=1"; 
$dbAdminEmail = $dbObj->SelectQuery('slider.php','slider_images()'); 
	
//echo $dbAdminEmail[0]['email'];
$mail = new PHPMailer();	
$mail->Priority = 3;
$mail->From = "contact@rushholidays.com";
$mail->FromName = "rushholidays.com";
$mail->Subject = "New Order Placed: #".$id;
$mail->AddAddress($dbAdminEmail[0]['email'],"Admin");
$mail->AddBCC('ksamayrananda@gmail.com',"developer");
$mail->Body = "";
$mail->AltBody = "";
$body = '';			
$body ='
<table width="100%" border="0" style=" border-collapse:collapse; margin:0; padding:0">
  <tr>
    <td scope="col" align="left"><table border="0" cellspacing="0" cellpadding="5" width="800" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;  border-collapse:collapse;">
  <tr>
      <td align="left" bgcolor="#FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">Dear '.$dbOrder[0]['fname'].' '.$dbOrder[0]['lname'].',</font></td>
  </tr>
<tr>
 <td align="left" bgcolor="#FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">We have received your Payment. Our representative will contact you soon. Below is your payment details.</font></td>
</tr>
<tr>
   <td align="left" bgcolor="#FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">Package Name: '.ucwords($dbOrder[0]['tour']).' - Days: '.$dbOrder[0]['tdays'].' and Nights: '.$dbOrder[0]['tnight'].'</font></td>
</tr>	
<tr>
   <td align="left" bgcolor="#FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">Adults: '.$dbOrder[0]['adult'].' - Price Per Persone: '.$dbOrder[0]['adultprice'].'</font></td>
</tr>
';

if(!empty($dbOrder[0]['kids'])){
   $body.='<tr><td align="left" bgcolor="#FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">Kids: '.$dbOrder[0]['kids'].' - Price Per Kid: '.$dbOrder[0]['kidsprice'].'</font></td>
</tr>		';
}
$body.='
<tr>
   <td align="left" bgcolor="#FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">Tour Date: '.date('d M Y',strtotime($dbOrder[0]['tsdate'])).' - to '.date('d M Y',strtotime($dbOrder[0]['tndate'])).'</font></td>
</tr>
<tr>
   <td align="left" bgcolor="#FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">Customer: '.$dbOrder[0]['fname'].' '.$dbOrder[0]['lname'].' | E-mail: '.$dbOrder[0]['email'].' | Mobile: '.$dbOrder[0]['mobile'].'</font></td>
</tr>
<tr>
   <td align="left" bgcolor="#FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">Address: '.$dbOrder[0]['addr'].' '.$dbOrder[0]['city'].' '.$dbOrder[0]['state'].' '.$dbOrder[0]['country'].' Pin-'.$dbOrder[0]['pincode'].'</font></td>
</tr>
<tr>
   <td align="left" bgcolor="#FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">Total Paid Amount: '.number_format($dbOrder[0]['ttotalprice']).'</font></td>
</tr>
<tr>
   <td align="left" bgcolor="#FFFFFF"><font style="font-family:Arial, Helvetica, sans-serif; font-size:13px">Thanking You,<br><a href="http://www.rushholidays.com" style="color:#114F89;">www.rushholidays.com</a></font></td>
</tr>	  
  <tr>
    <td align="left"><img src="'.HTACCESS_URL.'images/logo.png" width="150"></td>
  </tr>
</table></td></tr></table>';
$mail->Body .= $body;
$mail->Send();
$mail->ClearAllRecipients(); 

?>