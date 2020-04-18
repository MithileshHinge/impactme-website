<?php
/* validateEmail($email)- To Validate Email
	Parameter
	1.$email- email id
	2.$msg - a message in case of find email invalid
	3.$location_with_parameter - location with parameter to where we want to redirect in case of invalid email
	Return Value-return TRUE if email is valid otherwise return false
*/
function validateEmail($email,$msg,$location_with_parameter){
	if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i",$email))
	{
    	redirect($msg,$location_with_parameter);
	}
}


/* confirmPassword($pass,$rpass)- To compare password
	Parameter
	1.$pass- new password
	2.$rpass-reenter new password
	3.$msg - a message in case of no password match
	4.$location_with_parameter - location with parameter to where we want to redirect in case of no password match
	Return Value-return TRUE if password match otherwise return false
*/
function confirmPassword($pass,$rpass,$msg,$location_with_parameter)
{
	if(trim($pass)==trim($rpass))
	{
		return true;
	}else{
		redirect($msg,$location_with_parameter);
	}
}



/* validateImage($image_name,$exts,$msg,$location_with_parameter)- To check image extension and if find invalid ,will redirect to location
	Parameters
	1.$image_name - image name (input field name of type file)
	2.$exts - number of extensions seperated by ,(comma)
	3.$msg - a message in case of find image invalid
	4.$location_with_parameter - location with parameter to where we want to redirect in case of invalid image
	
	Return Value-no return value
*/
function validateImage($image_name,$exts,$new_image_name,$msg,$location_with_parameter)
{
	$temp = explode('.',$_FILES[$image_name]['name']); // explode to get image extension
	$ext = $temp[count($temp)-1];
	$ext=strtolower($ext);
	$ext_array=explode(",",strtolower($exts));
	if(!in_array($ext,$ext_array)){
		redirect($msg,$location_with_parameter);	
	}
	$newname=$new_image_name.".".$ext;
	return $newname;
}

/*/ validateImage($image_name,$exts,$msg,$location_with_parameter)- To check image extension and if find invalid ,will redirect to location
	Parameters
	1.$image_name - image name (input field name of type file)
	2.$exts - number of extensions seperated by ,(comma)
	3.$msg - a message in case of find image invalid
	4.$location_with_parameter - location with parameter to where we want to redirect in case of invalid image
	
	Return Value-no return value
*/
function validateUploadMultipleImage($image_name,$exts,$original_path,$thumb_path,$resize)
{
$a=0;
$info=array();
//print_r($_FILES[$image_name]['name'][3]);exit;
	$ext_array=explode(",",strtolower($exts));
		$cou=count($_FILES[$image_name]);
	for($m=0;$m<$cou;$m++)
	{
		$temp = explode('.',$_FILES[$image_name]['name'][$m]); // explode to get image extension
		 $ext = $temp[count($temp)-1];
		 $ext=strtolower($ext);
		if(in_array($ext,$ext_array)){
			$image_name2 = time().'_product_preview'.$m.'.'.$ext; // to remane image
			$info[] = $image_name2;
		// to remove image
		/*$imgRes = get_data($dbObj,"product","id='$id'","*");
		unlink_image(PRODUCT_IMAGE_PATH,PRODUCT_THUMBS_IMAGE_PATH,$imgRes[0]['image']);*/
			resize_img($_FILES[$image_name]['tmp_name'][$m],100,$thumb_path.$image_name2); // to resize image and upload it in thumbs folder
			move_uploaded_file($_FILES[$image_name]['tmp_name'][$m],$original_path.$image_name2); // upload original image in original folder
		}
	}
	//print_r($info);
	//exit;
	return $info;
}


/* isEmpty($field_value,$msg,$location_with_parameter)- To check empty values and if find empty ,will redirect to location with msg
	Parameters
	1.$field_value - value of field
	2.$msg - a message in case of find empty value
	3.$location_with_parameter - location with parameter to where we want to redirect in case of empty value 
	Return Value-no return value
*/
function isEmpty($field_value,$msg,$location_with_parameter)
{
	if(empty($field_value))
	{
		redirect($msg,$location_with_parameter);
	}

}



/* isEmptyImage($image_name,$msg,$location_with_parameter)- To check empty image and if find empty ,will redirect to location with msg
	Parameters
	1.$image_name - image name  (input field name of type file)
	2.$msg - a message in case of find empty value
	3.$location_with_parameter - location with parameter to where we want to redirect in case of empty value 
	Return Value-no return value
*/
function isEmptyImage($image_name,$msg,$location_with_parameter)
{
	if($_FILES[$image_name]['size']==0)
	{
		redirect($msg,$location_with_parameter);
	}

}






/* validateUrl($url,$msg,$location_with_parameter)- To check whether the url is valid or not
	Parameters
	1.$url - the url that we want to validate
	2.$msg - a message in case of find empty value
	3.$location_with_parameter - location with parameter to where we want to redirect in case of invalid url
	Return Value-no return value
*/
function validateUrl($url,$msg,$location_with_parameter)
{
	if(!preg_match("/((((?:http|https|ftp):\/\/)|(www\.))(?:[A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?[^\s\"\']+)/i",$url)){
		redirect($msg,$location_with_parameter);
	}
}




/* validateDate($date,$date_format)- To check whether the date is valid with given date format
	Parameters
	1.$date - date
	2.$date_format - the format of the date
	Return Value-return TRUE if found valid otherwise FALSE
*/
/**
    *
    * Validate a date
    *
    * @param    string    $date
    * @param    string    format
    * @return    bool
    *
    */
    function validateDate( $date, $format='YYYY-MM-DD')
    {
        switch( $format )
        {
            case 'YYYY/MM/DD':
            case 'YYYY-MM-DD':
            list( $y, $m, $d ) = preg_split( '/[-\.\/ ]/', $date );
            break;

            case 'YYYY/DD/MM':
            case 'YYYY-DD-MM':
            list( $y, $d, $m ) = preg_split( '/[-\.\/ ]/', $date );
            break;

            case 'DD-MM-YYYY':
            case 'DD/MM/YYYY':
            list( $d, $m, $y ) = preg_split( '/[-\.\/ ]/', $date );
            break;

            case 'MM-DD-YYYY':
            case 'MM/DD/YYYY':
            list( $m, $d, $y ) = preg_split( '/[-\.\/ ]/', $date );
            break;

            case 'YYYYMMDD':
            $y = substr( $date, 0, 4 );
            $m = substr( $date, 4, 2 );
            $d = substr( $date, 6, 2 );
            break;

            case 'YYYYDDMM':
            $y = substr( $date, 0, 4 );
            $d = substr( $date, 4, 2 );
            $m = substr( $date, 6, 2 );
            break;

            default:
            throw new Exception( "Invalid Date Format" );
        }
        return checkdate( $m, $d, $y );
    }






/* validatePhoneNo($phone,$msg,$location_with_parameter)- To check whether the phone no is valid or not
	Parameters
	1.$phone - the phone no that we want to validate
	2.$msg - a message in case of find invalid phone no
	3.$location_with_parameter - location with parameter to where we want to redirect in case of invalid url
	Return Value-no return value
*/
function validatePhoneNo($phone,$msg,$location_with_parameter)
{
	$reg_phone = "/^((([0-9]{1})*[- .(]*([0-9]{3})[- .)]*[0-9]{3}[- .]*[0-9]{4})+)*$/"; 
	if (!preg_match($reg_phone, $phone)) {
		redirect($msg,$location_with_parameter);
	}
}






///* redirect($msg,$location_with_parameter)- To redirect to a location with its parameter and msg
//	Parameters
//	1.$msg - message that we want to send
//	2.$location_with_parameter - location with parameter to where we want to redirect
//	Return Value-no return value
//*/
//function redirect($msg,$location_with_parameter)
//{
//	$msg =base64_encode($msg);
//	header("location:$location_with_parameter&msg=".$msg);
//	exit;
//}


?>