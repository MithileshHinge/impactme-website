<?php
    include("configure.php");
	
	unset($_SESSION[SESSION_USER]);
	unset($_SESSION[SESSION_ID]);
	unset($_SESSION[language_id]);
	session_destroy();

	//session_destroy();
	///$msg="Sucessfully logout";
	header("location:".ADMINPATH."/index/");
	exit();

?>