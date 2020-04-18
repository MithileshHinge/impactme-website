<?php include('admin_path.php'); 
include('include/access.php');
?>
<?php
$image_save_folder = "user";
$page_title = "Statistics | ".PROJECT_TITLE;
if(strlen($row_user->cover_image_path)>0)
 $cover_image = IMAGEPATH.$row_user->cover_image_path;
else
 $cover_image = IMAGEPATH.'background.jpg'; 


if(strlen($row_user->image_path)>0)
 $user_image = IMAGEPATH.$row_user->image_path;
else
 $user_image = IMAGEPATH.'icon_man.png'; 
 
 if($_REQUEST['mode']=="profile")
 {
  	

 $db->updateArray("impact_user",$_REQUEST,"user_id=".$row_user->user_id);
 header('location:'.BASEPATH.'/edit/payment/');
 
 
 }
 
 

?>

<!DOCTYPE html>
<html>
<head>
 <title><?=$page_title?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=$sql_web->meta_description?>" /> 
    <meta name="title" content="<?=$sql_web->meta_title?>" />
    
    
    
    <meta name="keywords" content="<?=$sql_web->meta_keyword?>" />

<meta name="author" content="<?=PROJECT_TITLE?>" />
<meta name="copyright" content="<?=PROJECT_TITLE?>" />
<meta name="application-name" content="<?=PROJECT_TITLE?>" />

<!-- For Facebook -->
<meta property="og:title" content="<?=$sql_web->meta_title?>" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?=IMAGEPATH.$row_user->image_path?>" />
<meta property="og:url" content="<?=$_SERVER['REQUEST_URI']?>" />
<meta property="og:description" content="<?=$sql_web->meta_description?>" />

<!-- For Twitter -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="<?=$sql_web->meta_title?>" />
<meta name="twitter:description" content="<?=$sql_web->meta_description?>" />
<meta name="twitter:image" content="<?=IMAGEPATH.$row_user->image_path?>" />


    <?php include('include/titlebar.php'); ?>
    <style>
	.active {
    border: 0px solid;
    margin: 6px 0 20% 0px;
}
	
	
	</style>
<style type="text/css">
			#chart-container {
				width: 640px;
				height: auto;
			}
		</style>

</head>

<body>
<div id="wrapper" style="background-image:url(<?=BASEPATH?>/images/setting-back.jpg); ">
<?php include('include/header.php'); ?>

<div class="layout-2cols">
  <div class="content grid_12">
    <div class="project-detail">
      <div class="project-tab-detail tabbable accordion edit-about">
        <?php include('include/user_menu.php');?>
        
        
        
        <div class="tab-content">
          <div>
            <h3 class="rs alternate-tab accordion-label">Payment</h3>
            <div class="tab-pane accordion-content active">
             
              <div class="form form-profile" style="left:48px;">
                
                <div id="chart-container">
			                    <canvas id="mycanvas"></canvas>
		</div>
        
        <h2>List Of Supporter</h2>
        
          <div id="chart-container">
			                    <canvas id="mycanvas2"></canvas>
		</div>


		<!-- javascript -->
		<script type="text/javascript" src="<?=BASEPATH?>/graph/jquery.min.js"></script>
		<script type="text/javascript" src="<?=BASEPATH?>/graph/Chart.min.js"></script>
		<script type="text/javascript">
        
        $(document).ready(function(){
	$.ajax({
		url: "<?=BASEPATH?>/data.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var paid_date = [];
			var paid_amount = [];

			for(var i in data) {
				paid_date.push(data[i].paid_date);
				paid_amount.push(data[i].paid_amount);
			}

			var chartdata = {
				labels: paid_date,
				datasets : [
					{
						label: 'Earning Before Tax',
						backgroundColor: 'rgba(200, 200, 200, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: paid_amount
					}
				]
			};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});
        
        
        </script>            

           <script type="text/javascript">
        
        $(document).ready(function(){
	$.ajax({
		url: "<?=BASEPATH?>/data_user.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var paid_date = [];
			var paid_amount = [];

			for(var i in data) {
				paid_date.push(data[i].paid_date);
				paid_amount.push(data[i].paid_amount);
			}

			var chartdata = {
				labels: paid_date,
				datasets : [
					{
						label: 'List Of Supporter',
						backgroundColor: 'rgba(30, 114, 156, 1)',
						borderColor: 'rgba(30, 114, 156, 0.5)',
						hoverBackgroundColor: 'rgba(30, 114, 156, 0.5)',
						hoverBorderColor: 'rgba(30, 114, 156, 1)',
						data: paid_amount
					}
				]
			};

			var ctx = $("#mycanvas2");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});
        
        
        </script>     
                
              </div>
            </div>
            <!--end: .tab-pane --> 
          </div>
         
        </div>
      </div>
      <!--end: .project-tab-detail --> 
    </div>
  </div>
  <!--end: .content -->
  
  <div class="clear"></div>
</div>


</div>
<?php include('include/footer.php');
include('include/footer_js.php');?>


</div>
<script type="text/javascript">
  $(document).ready(function() {
   setTimeout(function(){ $("#err_msg").fadeOut(); }, 3000);
  });
 
</script>




</body>
</html>
