<?php
class query{

function redirect($page)
{
 header("location:".$page);	
}
function currency_code($val)
{
 if($val=="EUR")
  $code = "&euro;";
 if($val=="USD" || $val=="AUD")
 $code = "$";
 if($val=="GBP")
 $code = "&pound;";
 if($val=="DKK" || $val=="SEK" || $val=="NOK")
 $code = "kr";
  if($val=="RUB")
 $code = "RUB";
 /* if($val=="RUB")
 $code = "&#8381;";*/
 
 return $code;

}


function currencyConverter($currency_from,$currency_to,$currency_input){
    $yql_base_url = "http://query.yahooapis.com/v1/public/yql";
    $yql_query = 'select * from yahoo.finance.xchange where pair in ("'.$currency_from.$currency_to.'")';
    $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
    $yql_query_url .= "&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
    $yql_session = file_get_contents($yql_query_url);
    $yql_json =  json_decode($yql_session,true);
    $currency_output = (float) $currency_input*$yql_json['query']['results']['rate']['Rate'];

    return $currency_output;
}
function convertCurrency($amount, $from, $to){
if($from==$to)
{
$main_amount = number_format(round($amount, 3),2);
}
else
{
	$data = file_get_contents("https://finance.google.com/finance/converter?a=$amount&from=$from&to=$to");
	preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
	$converted = preg_replace("/[^0-9.]/", "", $converted[1]);
	$main_amount =  number_format(round($converted, 3),2);
}
return $main_amount;
}
function filter($data)
{
   // normalize $data because of get_magic_quotes_gpc
   $dataNeedsStripSlashes = get_magic_quotes_gpc();
   if ($dataNeedsStripSlashes) {
       $data = stripslashes($data);
   }
   // normalize $data because of whitespace on beginning and end
   $data = trim($data);
   // strip tags
   $data = strip_tags($data);
   // replace characters with their HTML entitites
   $data = htmlentities($data);
   // mysql escape string    
   $data = mysql_real_escape_string($data);
   return $data;
}
function isemail($user)
{
	
if(filter_var($user, FILTER_VALIDATE_EMAIL)) {
		return true;
	} else {
		return false;
	}
}

function valid_email($email) {
    return !!filter_var($email, FILTER_VALIDATE_EMAIL);
}
function customer_log_in($user_name, $password)
{
 $valid_check = $this->valid_email($user_name);
 if($valid_check)
 {
  $sql_log = "select count(*) c,hash_active, customer_id, '1' type from customer where BINARY email_id='$user_name' and BINARY password='$password'  and status=1";
  }
  else
  {
  $sql_log = "select count(*) c,hash_active, customer_id , '2' type from customer where phone='$user_name' and password='$password' and status=1";
  }
  $row_log = $this->fetch_object($sql_log);
  if($row_log->c==1)
  {
                $_SESSION[session_customer]=$row_log->customer_id;
			    $_SESSION['session_idc']=session_id();
				$_SESSION['password']=$row_log->password;
				session_regenerate_id();
				session_write_close();
				$user_cookie = $row_log->email_id;
				$pwd_cookie =$row_log->password;
				setcookie('user_cookie',$user_cookie,time() + (86400 * 7)); // 86400 = 1 day    
				setcookie('pwd_cookie',$pwd_cookie,time() + (86400 * 7)); // 86400 = 1 day   
		        $LogMsg = 1;
 
  }
  else
  {
    if($row_log->type==1)
     $LogMsg="Invalid Email ID or Password";
   else
     $LogMsg="Invalid Mobile Number or Password";
  }
return $LogMsg;

}



function login_check($user_name,$password,$lang)
{
 $sql = "select count(*) c, p.* from admin_user p where binary p.username =  '".$user_name."' AND";
 $sql.=" BINARY p.password = '".$password."' ";
 $row_object = $this->fetch_object($sql);
 if($row_object->c==1)
 {
   if($row_object->status==1)
   {
      $session_name = $_SESSION[SESSION_USER]=$row_object->username;
	  $session_id = $_SESSION[SESSION_ID]=session_id();
	  $_SESSION[PASSWORD]=$row_object->password;
	  $_SESSION[language_id]=$lang;
	  session_regenerate_id();
	  session_write_close();
	  $user_cookie = $username; 
	  $pwd_cookie = $password; 
	  setcookie('user_cookie',$user_cookie,time() + (86400 * 7)); // 86400 = 1 day   
	  setcookie('pwd_cookie',$pwd_cookie,time() + (86400 * 7)); // 86400 = 1 day   
      $msg = 1;
	  $update = mysql_query("update admin_user set last_login_date=NOW() where username='$user_name'");
   }
   else
   {
    $msg = "You are Currently blocked by administrator.Please contact with administrator.";
   }
 
 }
 else
 {
  $msg = "Invalid User Name or Password";
 }
return $msg;

}
function customer_register_email($name,$email_id,$confirm_link)
{
$sql_web1 = $this->fetch_object("select email_id,site_url,site_name,image_path from web_settings where web_id=1");
$logo_path = "https://www.carellocart.com/admin/".$sql_web1->image_path;


$to = $email_id;

$subject = "Email Verification From   ".PROJECT_TITLE;
$headers = 'From: noreply@carellocart.com'. "\r\n"; 	   
	   //$headers = 'From: '.$email. "\r\n";
$headers.= 'MIME-Version: 1.0' . "\r\n";
$headers.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head> </head> <body>
<table width="465"  class="table" cellpadding="0" cellspacing="0" align="center">
<tr>
<td width="465" height="50" valign="middle"><div align="center"><a href="'.$sql_web1->site_url.'"><img src="'.$logo_path.'" width="250"/></div></td>
</tr>
<tr>
<td width="465" height="50" valign="middle"><div align="left"><strong>Hi, '.$name.'</strong></div></td>
</tr>
<tr>
<td width="465" height="50" valign="middle"><div align="left"><strong> Welcome to '.$sql_web1->site_name.'</strong></div></td>
</tr>

</table><br /><br /><div align="center">
We greatly appreciate you and delighted that you decided to create an account on The '.$sql_web1->site_name.'. We wish you enjoy our products and services.
<br />
<br />

Before you start using our service you need to activate your account. In order to do that, please follow the link : <br />
<br />
<a href="'.$confirm_link.'" target="_blank">'.$confirm_link.'</a><br />
<br />
If you run into any problems or have any questions , do not hesitate to contact us at '.$sql_web1->email_id.'
<br />
<br />

Have fun, and please share your feedback with us.
<br />
</div>
<div align="left"><br />
<br />

Thank You.<br />'
.PROJECT_TITLE.'
</div>'
;
//echo $subject;	   
	   if(mail($to, $subject, $message,$headers))
	   {
		mail("bhaskar2359@gmail.com", $subject, $message,$headers)	;
			$msg1= "Your request has been submitted. We will return as soon as possible to you ...";
	   }
	   else 
	   {
			$msg1= "Try Again.......";
	   }
	   return true;
}


function send_forget_mail($email_id)
{
  $sql = "select count(*) c, au.* from ".LOG_TABLE." au where binary au.email_id='$email_id'";
  $row_check = $this->fetch_object($sql);
  if($row_check->c==1)
  {
    $to = $email_id;
    $subject = "Password Request From ".PROJECT_TITLE;
    $headers = 'From: '.CONTACT_LINK. "\r\n"; 
	   
	   //$headers = 'From: '.$email. "\r\n";
    $headers.= 'MIME-Version: 1.0' . "\r\n";
    $headers.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $message = '<table width="465"  class="table" cellpadding="0" cellspacing="0" align="center">

  <tr>
    <td width="465" height="50" valign="middle"><div align="center"><h1><a href="'.PROJECT_LINK.'">'.PROJECT_TITLE.'</h1></a></div></td>
  </tr>
</table>
<fieldset><h1>Dear '.$row_check->name.', your Login details are: </h1><table>
					
					<tr><td>user Name</td><td>:</td><td>'.$row_check->username.'</td></tr>
					<tr><td><br /></td></tr>
					<tr><td>Password</td><td>:</td><td>'.$row_check->password.'</td></tr>
					
					
				  </table></fieldset>'
;	   
	   if(mail($to, $subject, $message,$headers))
	   {
			$msg= "Your Log In Details Has Been Sent To Your Email ID. Please Check Your Mail";
	   }
	   else 
	   {
			$msg= "Try Again.......";
	   }

  
  }
  else
  {
   $msg = "Invalid Email ID. Please check your email id";
  }

return $msg;
}



function fetch_object($sql)
 {
		$query = mysql_query($sql);
		$object = mysql_fetch_object($query);
		return $object;
 }	
function fetch_array($sql)
 {
		$query = mysql_query($sql);
		$object = mysql_fetch_array($query);
		return $object;
 }	
 	
 function id_number_generate($table_name,$id_number,$number_format)
 {
  $sql_check="select ". $id_number ." id from ".$table_name." ORDER BY ".$id_number." DESC limit 0,1";
  $row_check=$this->fetch_object($sql_check);
  if($row_check->id)
  {
	$i=$row_check->id;
  }
  else
  {
	$i=$number_format;
  }
  $i++;
  return $i;
}
 function zero_pad($str, $len)
 {
	return sprintf('%0'.$len.'s', $str);
 }	
 
 
 function record_exist($table_name,$sql_clause)
 {
	$sql = "select count(*) c from ".$table_name." where ".$sql_clause." ";
	$row_object = $this->queryObject($sql);
	$count = $row_object->c;
	return $count; 
	 
	 
	 
 }
 
 function ErrorMsg($value,$msg_part)
{
	switch($value)
	{
		
		case 1:
		$msg= $msg_part." Deleted Successfully";
		break;
		case 2 :
		$msg= $msg_part." Is Successfully Activated";
		break;
		case 3:
		$msg= $msg_part." Is Successfully Blocked";
		break;
		case 4:
		$msg= $msg_part." Is Successfully Updated";
		break;
		case 5:
		$msg= $msg_part." Added Successfully";
		break;
		default : 
		$msg = "";
	}
	return ucfirst($msg);
}

function ViewRelationship()
	{
		$arrayRelationship = array('Father','Mother','Husband','Wife','Brother','Sister','Son','Daughter','Grandparent','Grandfather','Grandmother','Grandson','Granddaughter','Uncle','Aunt','Cousin','Nephew','Niece','Father-in-law','Mother-in-law','Brother-in-law','Sister-in-law','Friends' ,'Others');		
		return $arrayRelationship;
	}
	
	function ViewFathersType()
	{
		$arrayRelationship = array('Father','Husband');	
		return $arrayRelationship;
	}
	function ViewSex()
	{
		$arrayRelationship = array('Male','Female');
		return $arrayRelationship;
	}
	function ViewMaritalStatus()
	{
		$arrayRelationship = array('Single','Married','Widowed','Separated','Divorced');
		return $arrayRelationship;
	}
	function ViewIDProof()
	{
		$arrayRelationship = array('Voter Card','Pan Card','Ration Card','Driving License','Aadhar Card','Passport','Others');
		return $arrayRelationship;
	}
	
	

function ViewSleeveMen()
	{
		$arrayRelationship = array('Sleeveless','Full Sleeve','Short Sleeve','Cap Sleeve','Half Sleeve','3/4 Sleeve','Roll-up Sleeve','Puff Sleeve');		
		return $arrayRelationship;
	}
function ViewSuitableMen()
	{
		$arrayRelationship = array('Maternity Wear','Fusion Wear','Western Wear','Ethnic Wear');		
		return $arrayRelationship;
	}	
	function ViewIdealMen()
	{
		$arrayRelationship = array("Boy's","Girl's","Baby Boy's","Baby Girl's","Women's");		
		return $arrayRelationship;
	}
	function ViewPattern()
	{
		$arrayRelationship = array("Solid","Military Camouflage","Applique","Chevron","Paisley" ,"Houndstooth" ,"Embroidered" ,"Harringbone" ,"Woven" ,"Polka Print" ,"Striped" ,"Printed" ,"Checkered" ,"Floral Print" ,"Embellished" ,"Geometric Print" ,"Self Design" ,"Graphic Print" ,"Animal Print" ,"Argyle");		
		return $arrayRelationship;
	}
	function ViewNeck()
	{
		$arrayRelationship = array("Scoop Neck","Hooded","Mandarin Collar","Round Neck","Draped Neck" ,"Polo Neck" ,"Turtle Neck" ,"V-neck" ,"Polo" ,"Fashion Neck" ,"Mock Neck" ,"Halter Neck" ,"Peter Pan Collar" ,"Flap Collar Neck" ,"Henley" ,"Sweetheart Neck" ,"Off-shoulder" ,"Boat Neck" ,"Noodle Strap" ,"Square Neck");		
		return $arrayRelationship;
	}
	function ViewFit()
	{
		$arrayRelationship = array("Regular","Slim");		
		return $arrayRelationship;
	}
	function ViewOccassion()
	{
		$arrayRelationship = array("Wedding","Casual","Party","Formal","Beach Wear" ,"Sports" ,"Lounge Wear" ,"Festive" );		
		return $arrayRelationship;
	}
		function ViewSize()
	{
		$arrayRelationship = array("8 - 9 Years","15 - 16 Years","36","6 - 7 Years","33" ,"34" ,"39" ,"Free" ,"38" ,"42" ,"40" ,"4 - 5 Years" ,"10 - 11 Years" ,"XXL" ,"3 - 6 Months" ,"22" ,"12 - 18 Months" ,"24" ,"26" ,"28" ,"29" ,"2" ,"0" ,"7 - 8 Years" ,"30" ,"14 - 15 Years" ,"6" ,"32" ,"4" ,"6 - 9 Months" ,"XS" ,"1 - 2 Years" ,"2 - 3 Years" ,"7XL" ,"L" ,"8XL" ,"18" ,"M" ,"16" ,"9 - 10 Years" ,"14" ,"XL" ,"12" ,"3XS" ,"18 - 24 Months" ,"20" ,"12 - 13 Years" ,"13 - 14 Years" ,"6XL" ,"S" ,"3 - 4 Years" ,"5XL" ,"3XL" ,"4XL" ,"5 - 6 Years" ,"48" ,"44" ,"46" ,"0 - 3 Months" ,"9 - 12 Months" ,"10" ,"0 - 6 Months" ,"52" ,"54" ,"6 - 12 Months" ,"50" );		
		return $arrayRelationship;
	}
	function ViewSubCat()
	{
		$arrayRelationship = array("Wedding","Casual","Party","Formal","Beach Wear" ,"Sports" ,"Lounge Wear" ,"Festive" );		
		return $arrayRelationship;
	}
	function Trfalse()
	{
		$arrayRelationship = array("Yes","No");		
		return $arrayRelationship;
	}
	function ViewSub()
	{
		$arrayRelationship = array("Toys - Party Supplies","Pens &amp; Stationery - Office Supplies","Sports &amp; Fitness - Team Sports","Household - Dinnerware &amp; Crockery" );		
		return $arrayRelationship;
	}
	
function str_rand($length = 6, $seeds = 'numeric')
{
    // Possible seeds
    $seedings['alpha'] = 'abcdefghijklmnopqrstuvwqyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $seedings['numeric'] = '0123456789';
    $seedings['alphanum'] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $seedings['hexidec'] = '0123456789abcdef';
$seedings['alphacaps'] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    // Choose seed
    if (isset($seedings[$seeds]))
    {
        $seeds = $seedings[$seeds];
    }
    
    // Seed generator
    list($usec, $sec) = explode(' ', microtime());
    $seed = (float) $sec + ((float) $usec * 100000);
    mt_srand($seed);
    
    // Generate
    $str = '';
    $seeds_count = strlen($seeds);
    
    for ($i = 0; $length > $i; $i++)
    {
        $str .= $seeds{mt_rand(0, $seeds_count - 1)};
    }
    
    return $str;
}
	
function course($val)
{
if($val==1)
$ms = "1st";
if($val==2)
$ms = "2nd";
if($val==3)
$ms = "3rd";
return $ms;	
}
function runQuery($query) {
		$result = mysql_query($query);
		while($row=mysql_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

function geoCheckIP($ip)
{
    $response=@file_get_contents('http://www.netip.de/search?query='.$ip);
    $patterns=array();
    $patterns["country"] = '#Country: (.*?)&nbsp;#i';
    $ipInfo=array();
    foreach ($patterns as $key => $pattern)
    {
        $ipInfo[$key] = preg_match($pattern,$response,$value) && !empty($value[1]) ? $value[1] : 'not found';
    }
        return $ipInfo;
}

function ip_details($ip) {
    $json = file_get_contents("http://ipinfo.io/{$ip}");
    $details = json_decode($json);
    return $details;
}

function noimage($admin_path,$image_name)
{
$image_path =$admin_path.'/'.$image_name;
 if(getimagesize($image_path)>0)
  $image = $image_path;
 else
 $image = $admin_path.'/images/noimage/noimage.jpg';
 return $image; 

}

function randStrGen($len){
    $result = "";
    $chars = "abcdefghijklmnopqrstuvwxyz$_?!-0123456789";
    $charArray = str_split($chars);
    for($i = 0; $i < $len; $i++){
	    $randItem = array_rand($charArray);
	    $result .= "".$charArray[$randItem];
    }
    return $result;
}



function validateEmailSmtp($email, $probe_address="", $debug=false) {
    # --------------------------------
    # function to validate email address
    # through a smtp connection with the
    # mail server.
    # by Giulio Pons
    # http://www.barattalo.it
    # --------------------------------
    $output = "";
    # --------------------------------
    # Check syntax with regular expression
    # --------------------------------
    if (!$probe_address) $probe_address = $_SERVER["SERVER_ADMIN"];
    if (preg_match('/^([a-zA-Z0-9\._\+-]+)\@((\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,7}|[0-9]{1,3})(\]?))$/', $email, $matches)) {
        $user = $matches[1];
        $domain = $matches[2];
        # --------------------------------
        # Check availability of DNS MX records
        # --------------------------------
        if (function_exists('checkdnsrr')) {
            # --------------------------------
            # Construct array of available mailservers
            # --------------------------------
            if(getmxrr($domain, $mxhosts, $mxweight)) {
                for($i=0;$i<count($mxhosts);$i++){
                    $mxs[$mxhosts[$i]] = $mxweight[$i];
                }
                asort($mxs);
                $mailers = array_keys($mxs);
            } elseif(checkdnsrr($domain, 'A')) {
                $mailers[0] = gethostbyname($domain);
            } else {
                $mailers=array();
            }
            $total = count($mailers);
            # --------------------------------
            # Query each mailserver
            # --------------------------------
            if($total > 0) {
                # --------------------------------
                # Check if mailers accept mail
                # --------------------------------
                for($n=0; $n < $total; $n++) {
                    # --------------------------------
                    # Check if socket can be opened
                    # --------------------------------
                    if($debug) { $output .= "Checking server $mailers[$n]...\n";}
                    $connect_timeout = 2;
                    $errno = 0;
                    $errstr = 0;
                    # --------------------------------
                    # controllo probe address
                    # --------------------------------
                    if (preg_match('/^([a-zA-Z0-9\._\+-]+)\@((\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,7}|[0-9]{1,3})(\]?))$/', $probe_address,$fakematches)) {
                        $probe_domain = str_replace("@","",strstr($probe_address, '@'));
 
                        # --------------------------------
                        # Try to open up socket
                        # --------------------------------
                        if($sock = @fsockopen($mailers[$n], 25, $errno , $errstr, $connect_timeout)) {
                            $response = fgets($sock);
                            if($debug) {$output .= "Opening up socket to $mailers[$n]... Success!\n";}
                            stream_set_timeout($sock, 5);
                            $meta = stream_get_meta_data($sock);
                            if($debug) { $output .= "$mailers[$n] replied: $response\n";}
                            # --------------------------------
                            # Be sure to set this correctly!
                            # --------------------------------
                            $cmds = array(
                                "HELO $probe_domain",
                                "MAIL FROM: <$probe_address>",
                                "RCPT TO: <$email>",
                                "QUIT",
                            );
                            # --------------------------------
                            # Hard error on connect -> break out
                            # --------------------------------
                            if(!$meta['timed_out'] && !preg_match('/^2\d\d[ -]/', $response)) {
                                $codice = trim(substr(trim($response),0,3));
                                if ($codice=="421") {
                                    //421 #4.4.5 Too many connections to this host.
                                    $error = $response;
                                    break;
                                } else {
                                    if($response=="" || $codice=="") {
                                        //c'è stato un errore ma la situazione è poco chiara
                                        $codice = "0";
                                    }
                                    $error = "Error: $mailers[$n] said: $response\n";
                                    break;
                                }
                                break;
                            }
                            foreach($cmds as $cmd) {
                                $before = microtime(true);
                                fputs($sock, "$cmd\r\n");
                                $response = fgets($sock, 4096);
                                $t = 1000*(microtime(true)-$before);
                                if($debug) {$output .= "$cmd\n$response" . "(" . sprintf('%.2f', $t) . " ms)\n";}
                                if(!$meta['timed_out'] && preg_match('/^5\d\d[ -]/', $response)) {
                                    $codice = trim(substr(trim($response),0,3));
                                    if ($codice<>"552") {
                                        $error = "Unverified address: $mailers[$n] said: $response";
                                        break 2;
                                    } else {
                                        $error = $response;
                                        break 2;
                                    }
                                    # --------------------------------
                                    // il 554 e il 552 sono quota
                                    // 554 Recipient address rejected: mailbox overquota
                                    // 552 RCPT TO: Mailbox disk quota exceeded
                                    # --------------------------------
                                }
                            }
                            fclose($sock);
                            if($debug) { $output .= "Succesful communication with $mailers[$n], no hard errors, assuming OK\n";}
                            break;
                        } elseif($n == $total-1) {
                            $error = "None of the mailservers listed for $domain could be contacted";
                            $codice = "0";
                        }
                    } else {
                        $error = "Invalid Email Address";
                    }
                }
            } elseif($total <= 0) {
                $error = "Invalid Email Address";
            }
        }
    } else {
        $error = 'Address syntax not correct';
    }
    if($debug) {
        print nl2br(htmlentities($output));
    }
    if(!isset($codice)) {$codice="n.a.";}
    if(isset($error)) return array($error,$codice); else return true;
}

function verifyEmail($toemail, $fromemail, $getdetails = false){
	$email_arr = explode("@", $toemail);
	$domain = array_slice($email_arr, -1);
	$domain = $domain[0];

	// Trim [ and ] from beginning and end of domain string, respectively
	$domain = ltrim($domain, "[");
	$domain = rtrim($domain, "]");

	if( "IPv6:" == substr($domain, 0, strlen("IPv6:")) ) {
		$domain = substr($domain, strlen("IPv6") + 1);
	}

	$mxhosts = array();
	if( filter_var($domain, FILTER_VALIDATE_IP) )
		$mx_ip = $domain;
	else
		getmxrr($domain, $mxhosts, $mxweight);

	if(!empty($mxhosts) )
		$mx_ip = $mxhosts[array_search(min($mxweight), $mxhosts)];
	else {
		if( filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) ) {
			$record_a = dns_get_record($domain, DNS_A);
		}
		elseif( filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) ) {
			$record_a = dns_get_record($domain, DNS_AAAA);
		}

		if( !empty($record_a) )
			$mx_ip = $record_a[0]['ip'];
		else {

			$result   = "<span style='color:red;'>Invalid Email ID</span>";
			$details .= "No suitable MX records found.";

			return ( (true == $getdetails) ? array($result, $details) : $result );
		}
	}
	
	$connect = @fsockopen($mx_ip, 25); 
	if($connect){ 
		if(preg_match("/^220/i", $out = fgets($connect, 1024))){
			fputs ($connect , "HELO $mx_ip\r\n"); 
			$out = fgets ($connect, 1024);
			$details .= $out."\n";
 
			fputs ($connect , "MAIL FROM: <$fromemail>\r\n"); 
			$from = fgets ($connect, 1024); 
			$details .= $from."\n";

			fputs ($connect , "RCPT TO: <$toemail>\r\n"); 
			$to = fgets ($connect, 1024);
			$details .= $to."\n";

			fputs ($connect , "QUIT"); 
			fclose($connect);

			if(!preg_match("/^250/i", $from) || !preg_match("/^250/i", $to)){
				$result = "<span style='color:red;'>Invalid Email ID</span>"; 
			}
			else{
				$result = "<span style='color:green;'>Valid Email ID</span>";
			}
		} 
	}
	else{
		$result = "<span style='color:red;'>Invalid Email ID</span>";
		$details .= "Could not connect to server";
	}
	if($getdetails){
		return array($result, $details);
	}
	else{
		return $result;
	}
}

function slug($string, $spaceRepl = "-") {
// Replace "&" char with "and"
$string = str_replace("&", "and", $string);
// Delete any chars but letters, numbers, spaces and _, -
$string = preg_replace("/[^a-zA-Z0-9 _-]/", "", $string);
// Optional: Make the string lowercase
$string = strtolower($string);
// Optional: Delete double spaces
$string = preg_replace("/[ ]+/", " ", $string);
// Replace spaces with replacement
$string = str_replace(" ", $spaceRepl, $string);
return $string;
}

function comma_separated_to_array($string, $separator = ',')
{
  $vals = explode($separator, $string);
  foreach($vals as $key => $val) {
    $vals[$key] = trim($val);
  }
  return array_diff($vals, array(""));
}

function post($post_id)
{
 $sql_query = $this->fetch_object("select count(*) c, p.* from post p where p.page_id='$post_id' limit 1");
 return $sql_query;

}
function post_lang($post_id,$lang)
{
 $sql_query = $this->fetch_object("select count(*) c, p.* from post p where p.page_id='$post_id' and p.language_id='$lang' limit 1");
 return $sql_query;

}
function info_lang($post_id)
{
 $sql_query = $this->fetch_array("select count(*) c, p.* from info p where p.slug='$post_id' limit 1");
 return $sql_query;

}
function post_array($post_id)
{
 $sql_query = mysql_fetch_array(mysql_query("select  p.* from post p where p.page_id='$post_id' limit 1"));
 return $sql_query;

}

function unlink_image($image)
{
	$imagename = IMAGEPATH.$image;
 unlink($imagename)	;
 return true;
}

function image_type($field_name)
{
 $filename = stripslashes($_FILES[$field_name]['name']);
 $extension = $this->getExtension($filename);
 $extension = strtolower($extension);
 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
 {
 	$errors=0;
 }
 else $errors = 1;
 return $errors;	
	
}
function cwUpload($field_name = '', $target_folder = '', $file_name = '', $thumb = FALSE, $thumb_folder = '', $thumb_width = '', $thumb_height = '',$file_save_name){
	//folder path setup
	$target_path = $target_folder;
	$thumb_path = $thumb_folder;
	
	//file name setup
	$filename_err = explode(".",$_FILES[$field_name]['name']);
	$filename_err_count = count($filename_err);
	$file_ext = $filename_err[$filename_err_count-1];
	if($file_name != '')
	{
		$fileName = $file_name.'.'.$file_ext;
	}
	else
	{
		$fileName = $_FILES[$field_name]['name'];
	}
	str_replace(" ", "_", $_FILES['userfile']['name']);
	//$fileName = rand().time().basename($fileName);
	if($file_save_name=='') {
	$fileName = rand().time().str_replace(" ", "_",basename($fileName));
	}
	else
	{
	$fileName = $file_save_name.'.'.$file_ext;
	}
	
	
		//upload image path
	$upload_image_name = $fileName;
	$upload_image = $target_path.$upload_image_name;
	
	//upload image
	if(move_uploaded_file($_FILES[$field_name]['tmp_name'],$upload_image))
	{
		//thumbnail creation
		if($thumb == TRUE)
		{
			$thumbnail = $thumb_path.$fileName;
			list($width,$height) = getimagesize($upload_image);
			$thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
			switch($file_ext){
				case 'jpg':
					$source = imagecreatefromjpeg($upload_image);
					break;
				case 'jpeg':
					$source = imagecreatefromjpeg($upload_image);
					break;
				case 'png':
					$source = imagecreatefrompng($upload_image);
					break;
				case 'gif':
					$source = imagecreatefromgif($upload_image);
					break;
				default:
					$source = imagecreatefromjpeg($upload_image);
			}
			imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
			switch($file_ext){
				case 'jpg' || 'jpeg':
					imagejpeg($thumb_create,$thumbnail,100);
					break;
				case 'png':
					imagepng($thumb_create,$thumbnail,100);
					break;
				case 'gif':
					imagegif($thumb_create,$thumbnail,100);
					break;
				default:
					imagejpeg($thumb_create,$thumbnail,100);
			}
		}

		return $upload_image_name;
	}
	else
	{
		return false;
	}
}	
function language($lang)
{
$sql = $this->fetch_object("select language_name from language where language_id='$lang'");
return $sql->language_name;
}




function url_origin( $s, $use_forwarded_host = false )

{

    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );

    $sp       = strtolower( $s['SERVER_PROTOCOL'] );

    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );

    $port     = $s['SERVER_PORT'];

    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;

    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );

    $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;

    return $protocol . '://' . $host;

}



function full_url( $s, $use_forwarded_host = false )

{

    return $this->url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];

}

function send_buy_sms($ph_no,$message)
{
$curl = curl_init();
$numberList = json_encode(array($ph_no));
$message = json_encode($message);
$senderId = json_encode("CBTIPS");
$apikey = json_encode("cjs2u9vx600043pqu6vthfj55");


curl_setopt_array($curl, array(
  CURLOPT_URL => "https://smsapi.epadhai.in/api/v1/sendsms",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\n\"apikey\":$apikey ,\n\"number\":$numberList,\n\"message\":$message,\n\"senderId\": $senderId\n}",
  CURLOPT_HTTPHEADER => array(
    "content-type: application/json",
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "CURL Error #:" . $err;
} else {
  echo $response;
}



}
function getYoutubeImage($e){
        //GET THE URL
        $url = $e;

        $queryString = parse_url($url, PHP_URL_QUERY);

        parse_str($queryString, $params);

        $v = $params['v'];  
        //DISPLAY THE IMAGE
		//$thumb1 = file_get_contents("http://img.youtube.com/vi/$vidID/0.jpg");
//$thumb2 = file_get_contents("http://img.youtube.com/vi/$vidID/1.jpg");
//$thumb3 = file_get_contents("http://img.youtube.com/vi/$vidID/2.jpg");
//$thumb4 = file_get_contents("http://img.youtube.com/vi/$vidID/3.jpg");
//http://img.youtube.com/vi/VideoID/default.jpg
//http://img.youtube.com/vi/VideoID/hqdefault.jpg
//http://img.youtube.com/vi/VideoID/mqdefault.jpg
//http://img.youtube.com/vi/VideoID/sddefault.jpg
        if(strlen($v)>0){
            echo "http://img.youtube.com/vi/$v/mqdefault.jpg";
        }
    }
	
function getYoutubeEmbedUrl($url)
{
     $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
$longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

    if (preg_match($longUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }

    if (preg_match($shortUrlRegex, $url, $matches)) {
        $youtube_id = $matches[count($matches) - 1];
    }
	

		
    return 'https://www.youtube.com/embed/' . $youtube_id  ;
}


}


?>
