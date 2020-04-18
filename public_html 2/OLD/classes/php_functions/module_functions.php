<?php
function redirect($msg,$location_with_parameter)
	{
		//echo "Location:index.php?mo=$location_with_parameter&msg=".$msg;exit;
		$msg =base64_encode($msg);
		header("Location:index.php?mo=$location_with_parameter&msg=".$msg);
		exit();
	}


/* unlink_image($original_path,$thumb_path,$image_name)- To delete image from their path by their given image name
	Parameters
	1.$original_path - original image path
	2.$thumb_path - thumb image path
	3.$image_name - value or name of image
	
	Return Value-no return value
*/
function unlink_image($original_path,$thumb_path,$image_name)
{
	if(file_exists($original_path.$image_name) && !empty($image_name)){
		unlink($thumb_path.$image_name);
		unlink($original_path.$image_name);
	}
}

/* unlink_image($original_path,$thumb_path,$image_name)- To delete image from their path by their given image name
	Parameters
	1.$original_path - original image path
	2.$thumb_path - thumb image path
	3.$image_name - value or name of image
	
	Return Value-no return value
*/
function unlink_image_multiple($paths,$image_name)
{
	$paths2 = explode(',',$paths);
	
	if(file_exists($paths2[0].$image_name) && !empty($image_name)){
		foreach($paths2 as $p)
		{
			unlink($p.$image_name);
		}
	}
}

function uploadImage($image_name,$new_image_name,$exts,$table_name,$where,$image_field_name,$paths,$resize_value,$page_url)
{
		$temp = explode('.',$_FILES[$image_name]['name']); // explode to get image extension
		$ext = $temp[count($temp)-1];
		$image_name2 = $new_image_name.".".$ext; // to remane image
		validateImage($image_name,$exts,"Please Upload $exts images.",$page_url);
		// to remove image
		$imgRes = get_data($dbObj,$table_name,$where,"*");
		unlink_image_multiple($paths,$imgRes[0][$image_field_name]);
		$paths2=explode(',',$paths);
		resize_img($_FILES[$image_name]['tmp_name'],$resize_value,$paths[1].$image_name); // to resize image and upload it in thumbs folder
		move_uploaded_file($_FILES[$image_name]['tmp_name'],$paths[0].$image_name); // upload original image in original folder
		return  $image_name2;
		
}

/* change_status($set,$where,$table)- To change the status of a table under ceratin condition
	Parameters
	1.$table_name - the name of the table.
	2.$set - it specify the conditional expression ,if multiple seperated by ,(comma)
	3.$where - it spcify the conditional under which the status of table will set
	4.$echo_on_success- echo this value on success
	
	Return Value-no return value
*/
function change_status($dbObj,$table_name,$set,$where,$echo_on_success)
{
	// to update event status
	$dbObj->dbQuery = "update ".PREFIX."$table_name set $set where $where";
	$dbObj->ExecuteQuery();
	echo $echo_on_success;
}




/* update($table_name,$set,$where)- To update table under ceratin condition
	Parameters
	1.$table_name- the name of the table.
	2.$set - it specify the conditional expression ,if multiple seperated by ,(comma)
	3.$where - it spcify the conditional under which the status of table will set
	Return Value-no return value
*/
function update($dbObj,$table_name,$set,$where)
{
	// to update event status
	$dbObj->dbQuery = "update ".PREFIX."$table_name set $set";
	if(!empty($where))
	{
		$dbObj->dbQuery.=" WHERE $where";
	}
	$dbObj->ExecuteQuery();
}




/* logout($sessions,$msg,$location_with_parameter)- To unset the session and make logout from a panel
	Parameters
	1.$sessions - it specify the list of sessions (seperated by ,(comma))  that we want to unset
	2.$msg - it contain the message that we want to send
	3.$location_with_parameter - location with parameter to where we want to redirect
	Return Value-no return value
*/
//function logout($sessions,$msg,$location_with_parameter)
//{
//	$session_array=explode(",",$sessions);
//	foreach($session_array as $session)
//	{
//		unset($session);
//	}
//	 redirect($msg,$location_with_parameter);
//
//}



/* get_data($table_name,$where,$columns)- To get the data from the table
	Parameters
	1.$table_name - the name of the table
	2.$where - it specify the condition under which the query execute.
	3.$columns - it specify the list of columns(seperated by ,(comma)) that we want to fetch, * can be set to get all the columns
	Return Value-it will
*/
function get_data($dbObj,$table_name,$where,$field_name)
{
	$dbObj->dbQuery = "SELECT $field_name FROM ".PREFIX."$table_name"; // to check username is correct
	if(!empty($where))
	{
		
		$dbObj->dbQuery.=" WHERE $where";
	}
	$dbExistsData = $dbObj->SelectQuery('logincheck.php','loginaccess()');
	return $dbExistsData;
}


/* exists_data($table_name,$where,$columns)- To get the data from the table
	Parameters
	1.$table_name - the name of the table
	2.$where - it specify the condition under which the query execute.
	3.$columns - it specify the list of columns(seperated by ,(comma)) that we want to fetch, * can be set to get all the columns
	Return Value-it will
*/
function exists_data($dbObj,$table_name,$where,$field_name,$msg,$location_with_parameter)
{
	$dbObj->dbQuery = "SELECT $field_name FROM ".PREFIX."$table_name"; // to check username is correct
	if(!empty($where))
	{
		$dbObj->dbQuery.=" WHERE $where";
	}
	$dbExistsData = $dbObj->SelectQuery('logincheck.php','loginaccess()');
	//return $dbExistsData;
	if(count($dbExistsData)>0)
	{
		redirect($msg,$location_with_parameter);
	}
}




/* not_exists_data($table_name,$where,$columns)- To get the data from the table
	Parameters
	1.$table_name - the name of the table
	2.$where - it specify the condition under which the query execute.
	3.$columns - it specify the list of columns(seperated by ,(comma)) that we want to fetch, * can be set to get all the columns
	Return Value-it will
*/
function not_exists_data($dbObj,$table_name,$where,$field_name,$msg,$location_with_parameter)
{
	$dbObj->dbQuery = "SELECT $field_name FROM ".PREFIX."$table_name"; // to check username is correct
	if(!empty($where))
	{
		$dbObj->dbQuery.=" WHERE $where";
	}
	$dbExistsData = $dbObj->SelectQuery('logincheck.php','loginaccess()');
	//return $dbExistsData;
	if(count($dbExistsData)==0)
	{
		redirect($msg,$location_with_parameter);
	}
}



/* toDate($date,$current_format,$current_delimeter,$format)- To convert the date format
	Parameters
	1.$date - the date of which format to be converted
	2.$current_format - the current format of date.
	3.$current_delimeter - the delimeter of current date format
	4.$format- the format to which the given date shuld be converted
	Return Value-it will return the new format date
*/
function toDate($date,$current_format,$current_delimeter,$format)
{
	
		if($current_format=='dmy')
			{
				list($day, $month, $year) = explode($current_delimeter, $date);
    		}
		if($current_format=='mdy')
			{
				list($month, $day, $year) = explode($current_delimeter, $date);
    		}
			
		if($current_format=='ymd')
			{
				list($year,$month, $day) = explode($current_delimeter, $date);
    		}		
	
	$strtotime_date = mktime(0, 0, 0, $month, $day, $year);
	return date($format,$strtotime_date);
}




/* toDate($date,$current_format,$current_delimeter,$format)- To convert the date format
	Parameters
	1.$date - the date of which format to be converted
	2.$current_format - the current format of date.
	3.$current_delimeter - the delimeter of current date format
	4.$format- the format to which the given date shuld be converted
	Return Value-it will return the new format date
*/
// Function to convert time 24 hour mode and convert it to integer.
function conv_time($time){
// get am pm
$ampm=explode(" ",$time);
// get H:M:S
$hms=explode(":",$ampm[0]);

// figure out noon vs midnight, convert to 24 hour time.
if($hms[0]==12 && $ampm[1]=="AM"){
$hms[0]="00";
}
else{
   if($ampm[1]=="PM"){
      if($hms[0]<12){
      $hms[0]=$hms[0]+12;
      }
   }
}
// build the integer
$build=$hms[0].$hms[1].$hms[2];
return $build;
}

function conv_time24($time)
{
	// get am pm
	$ampm=explode(" ",$time);
	// get H:M:S
	$hms=explode(":",$ampm[0]);
	
	// figure out noon vs midnight, convert to 24 hour time.
	if($hms[0]==12 && $ampm[1]=="AM"){
	$hms[0]="00";
	}
	else{
	   if($ampm[1]=="PM"){
		  if($hms[0]<12){
		  $hms[0]=$hms[0]+12;
		  }
	   }
	}
	// build the integer
	$new_time=$hms[0].":".$hms[1].":".$hms[2];
	return $new_time;
}


/* get_data_join($dbObj,$table_name1,$table_name2,$on,$where,$field_name)
	Parameters
	1.$table_name1 - the name of the first table
	2.$table_name2 - the name of the second table
	3.$where - it specify the condition under which the query execute.
	4.$columns - it specify the list of columns(seperated by ,(comma)) that we want to fetch, * can be set to get all the columns
	Return Value-it will
*/
function get_data_join($dbObj,$table_name1,$table_name2,$on,$where,$field_name)
{
	
	$dbObj->dbQuery = "SELECT $field_name FROM ".PREFIX."$table_name1 join ".PREFIX."$table_name2 on $on"; // to check username is correct
	if(!empty($where))
	{
		$dbObj->dbQuery.=" WHERE $where";
	}
	$dbExistsData = $dbObj->SelectQuery('logincheck.php','loginaccess()');
	return $dbExistsData;
}




function set_display_order($page,$updateRecordsArray,$table_name)
{
	$listingCounter = ($page>1)?(10*($page-1)+1):1;
	foreach ($updateRecordsArray as $recordIDValue) {
		$query = "UPDATE portfolio SET display_order = " . $listingCounter . " WHERE id = " . $recordIDValue;
		mysql_query($query) or die('Error, insert query failed');
		$listingCounter = $listingCounter + 1;	
	}
}


?>