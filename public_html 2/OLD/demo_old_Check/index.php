<?php include('admin_path.php'); ?>
<!DOCTYPE html>
<html>
<head>
 <title><?=$sql_web->page_title?></title>
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
