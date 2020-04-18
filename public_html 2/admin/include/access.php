<?php
if(!empty($_SESSION[SESSION_USER]) && !empty($_SESSION[PASSWORD]) )
{
 $user_name = $_SESSION[SESSION_USER];
 $pwd = $_SESSION[PASSWORD];
 $sql_access= "select log.* from ".LOG_TABLE." as log where BINARY log.username='".$user_name."' and binary log.password='".$pwd."'" ;
	$row_acc=mysql_query($sql_access);
	if(mysql_num_rows($row_acc)>0)
	{
	  	$row_access=mysql_fetch_object($row_acc);		
	}
	else
	{
	 header('location:'.ADMINPATH."/index/");
	 }
	
}
else
{
	$msg1 = "Login First";
	?>
    <script type="application/ecmascript">
	window.location.href='<?=ADMINPATH?>/index/';
	alert("Please Log In First");
	
	</script>
    
    <?php
//header('location:index.php?msg1='.$msg1);
}

?>
