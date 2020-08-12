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
 
 

?>

<!DOCTYPE html>
<html>
<head>
 <title><?=$page_title?></title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
				width: 80%;
				height: auto;
				margin: auto;
			}
		</style>

</head>

<body class="body-bg">
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
        <h3>Earnings</h3>
        <br><br>
                <div id="chart-container">
			                    <canvas id="mycanvas"></canvas>
		</div>
        
        <h3>Supporters</h3>
        <br><br>
          <div id="chart-container">
			                    <canvas id="mycanvas2"></canvas>
		</div>

		<br><br><br>

		<h3>List of Pact Members</h3>
		<p>This is a list of all your monthly supporters (Pact Members)</p>

		<br><br>

		<?php
              $ids = $db_query->get_ids_sql($row_user->user_id);
              //$all_payments = $db_query->fetch_object("SELECT a.*, 'monthly' AS table_type FROM impact_payment a UNION ALL SELECT b.*, 'onetime' AS table_type FROM impact_pay_onetime b WHERE (a.creator_id IN '$ids' AND (a.status='authenticated' OR a.status='active')) OR (b.creator_id IN '$ids' AND b.status='success')");
              $pact_members = $db_query->runQuery("SELECT * FROM impact_payment WHERE creator_id IN $ids AND (status='authenticated' OR status='active') GROUP BY transaction_id ORDER BY paid_timestamp DESC");
              ?>
              <table>
                <style type="text/css">
                td {
                  border: 1px solid #ddd;
                  padding: 18px;
                  word-break: break-word;
                }

                th{
                  border: 1px solid #ddd;
                  padding: 10px;
                }
              </style>
              <tr>
                <th><h5>Supporter Name</h5></th>
                <th><h5>Pact</h5></th>
                <th><h5>Amount (₹)</h5></th>
                <th><h5>Join Date</h5></th>
                <th><h5>Transaction ID</h5></th>
                <!--th style="text-align: center;"><h3>Cancel</h3></th-->
              </tr>
              <?php foreach ($pact_members as $row_payment) {
              	$join_date = $db_query->fetch_object("select min(paid_timestamp) t from impact_payment where user_id='".$row_payment['user_id']."' and (status='authenticated' OR status='active' OR status='completed')");
                $supporter = $db_query->fetch_object("select full_name name from impact_user where user_id='".$row_payment['user_id']."'");
                $pact_title = $db_query->fetch_object("select tier_name title from impact_tier where tier_id='".$row_payment['tier_id']."'");

                if (empty($supporter->name)) $supporter->name="Deleted User";
                if (empty($pact_title->title)) $pact_title->title="Deleted Pact";
              ?>
                <tr>
                  <td><?=$supporter->name?></td>
                  <td><?=$pact_title->title?></td>
                  <td><?=$row_payment['paid_amount']?></td>
                  <td><?=$join_date->t?></td>
                  <td><?=$row_payment['transaction_id']?></td>
                  <!--td style="text-align: center;"><a class="join_btn cancel" id="<?=$row_subscription['tier_id']?>" style="cursor:pointer">Cancel</a></td-->
                </tr>
              <?php } ?>
              </table>

		<!-- javascript -->
		<script type="text/javascript" src="<?=BASEPATH?>/graph/jquery.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
		<script type="text/javascript">
        
        $(document).ready(function(){

	$.ajax({
		url: "<?=BASEPATH?>/data.php",
		method: "GET",
		dataType: 'json',
		success: function(data) {
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
						label: 'Earnings Before Platform Fee',
						backgroundColor: 'rgba(61, 155, 180, 0.2)',
						borderColor: 'rgb(61, 155, 180)',
						hoverBackgroundColor: 'rgba(61, 155, 180, 0.5)',
						borderWidth: 1,
						maxBarThickness: 80,
						data: paid_amount
					}
				]
			};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata,
				options: {
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true,
								precision: 0,
								suggestedMax: 100
							}
						}]
					}
				}
			});
		},
		error: function(xhr, textStatus, error) {
			console.log("Error:");
			console.log(xhr);
			console.log(textStatus);
			console.log(error);
		}
	});
});
        
        
        </script>            

           <script type="text/javascript">
        
        $(document).ready(function(){
	$.ajax({
		url: "<?=BASEPATH?>/data_user.php",
		method: "GET",
		dataType: 'json',
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
						label: 'No. of Supporters',
						//backgroundColor: 'rgba(30, 114, 156, 0.2)',
						backgroundColor: 'rgba(61, 155, 180, 0.2)',
						borderColor: 'rgb(61, 155, 180)',
						hoverBackgroundColor: 'rgba(61, 155, 180, 0.5)',
						borderWidth: 1,
						maxBarThickness: 80,
						data: paid_amount
					}
				]
			};

			var ctx = $("#mycanvas2");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata,
				options: {
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true,
								suggestedMax:10
							}
						}]
					}
				}
			});
		},
		error: function(xhr, textStatus, error) {
			console.log("Error:");
			console.log(xhr);
			console.log(textStatus);
			console.log(error);
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
