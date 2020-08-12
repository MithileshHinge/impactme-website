<?php include('admin_path.php');
if(isset($_SESSION['is_user_login'])==1){
	include('include/access.php');
	if ($db_query->creator($row_user->email_id))
		header("location:".BASEPATH."/user-creator/");
	else
		header("location:".BASEPATH."/home/");

}?>
<!DOCTYPE html>
<html>
<head>
 <title><?=$sql_web->page_title?></title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=$sql_web->meta_description?>" /> 
    <meta name="title" content="<?=$sql_web->meta_title?>" />
    <?php include('include/titlebar.php'); ?>
</head>

<body>
<div id="wrapper">
<?php include('include/header.php'); ?>
<?php include('include/slider.php');
include('include/why_impact.php');
include('include/who_uses.php'); 
include('include/how_impact.php');
include('include/structure.php');?>

<?php include('include/footer.php');
include('include/footer_js.php');?>


</div>
</body>
</html>
