<?php
include('../admin_path.php'); 
//include('./access.php');
    $uploadfile = $_FILES["uploadImage"]["tmp_name"];
    $folderPath = "../images/user/";
	$folderPath1 = "/images/user/";
    
    if (! is_writable($folderPath) || ! is_dir($folderPath)) {
        echo "error";
        exit();
    }
    if (move_uploaded_file($_FILES["uploadImage"]["tmp_name"], $folderPath . $_FILES["uploadImage"]["name"])) {
        echo '<img src="' .BASEPATH. $folderPath1 . "" . $_FILES["uploadImage"]["name"] . '">';
        exit();
    }

?>