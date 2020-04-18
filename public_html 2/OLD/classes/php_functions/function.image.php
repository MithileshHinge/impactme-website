<?php

function resize_img($pathimage, $new_size, $dest_file="") {
//echo $pathimage;
   $VAR_versiongd = 2;

   if(file_exists($pathimage)) {
    	$pic = imagecreatefromjpeg($pathimage);
    	$sizex = imagesx($pic);
    	$sizey = imagesy($pic);
    	if( ($sizex > $new_size) || ($sizey > $new_size) ) {

      		if($sizex>$sizey) {     
			$s0x = $new_size ;
			$s0y = (($new_size * $sizey)/$sizex);
			settype ($s0y, "integer");
      		} else if($sizex<$sizey){
			$s0y = $new_size;
			$s0x = (($new_size * $sizex)/$sizey);
			settype ($s0x, "integer");
      		} else {
			$s0x = $new_size;
			$s0y = $new_size;
      		}

      		if($VAR_versiongd == "2") {
			$out = imagecreatetruecolor( $s0x, $s0y);
			imagecopyresampled ($out, $pic, 0, 0, 0, 0, $s0x, $s0y, $sizex, $sizey);
      		} else {
			$out = imagecreate( $s0x, $s0y);
			imagecopyresized($out, $pic, 0, 0, 0, 0, $s0x, $s0y, $sizex, $sizey);
      		}

      		if($dest_file != "") {
			imagejpeg($out, $dest_file);
      		} else {
			imagejpeg($out, $pathimage);
      		}

      		imagedestroy($pic);
      		imagedestroy($out);
      		return 1;
    	} else {
      		if($dest_file != "") {
			copy($pathimage, $dest_file);
      		} else {
			copy($pathimage, $pathimage);
      		}
      		return 1;
    	}

  } else {

    return 0;

  }
}

function resize_img_new($uploadedfile, $new_size,$dest_file="",$extension){
	
	if($extension=="jpg" || $extension=="jpeg" || $extension=="JPG" || $extension=="JPEG" ){
		$uploadedfile = $uploadedfile;
		$src = imagecreatefromjpeg($uploadedfile);
	} else if($extension=="png" || $extension=="PNG"){
		$uploadedfile = $uploadedfile;
		$src = imagecreatefrompng($uploadedfile);
	} else {
		$src = imagecreatefromgif($uploadedfile);
	}
	list($width,$height) = getimagesize($uploadedfile);
	
	/*if( ($width > $new_size) || ($height > $new_size) ) {
		
		if($width>$height) {     
			$newwidth = $new_size ;
			$newheight = (($new_size * $height)/$width);
		} else if($width<$height){
			$newwidth = $new_size;
			$newheight = (($new_size * $width)/$height);
		} else {
			$newwidth = $new_size;
			$newheight = $new_size;
      	}
	} else{
		$newwidth = $new_size;
		$newheight=($height/$width)*$newwidth;
	}*/
	$newwidth = $new_size;
	$newheight=($height/$width)*$newwidth;
	
	$tmp=imagecreatetruecolor($newwidth,$newheight);
	
	imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
	imagejpeg($tmp,$dest_file,100);
	imagedestroy($src);
	imagedestroy($tmp);
}
?>