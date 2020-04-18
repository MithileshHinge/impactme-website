<?php
$id = sc_mysql_escape($_REQUEST['id']); // selected record id to delete
if(!isset($_SESSION['is_admin'])){
	header('Location:login.php?msg='.base64_encode('Please Login...'));
	exit();
}

$dbObj->dbQuery="select * from ".PREFIX."tier order by id DESC"; // for listing of records
$dbData = $dbObj->SelectQuery('slider.php','slider_images()');



//print_r($dbCycle);
?>

<div class="container-fluid"> 
  <!-- ============================================================== --> 
  <!-- Bread crumb and right sidebar toggle --> 
  <!-- ============================================================== -->
  <div class="row page-titles">
    <div class="col-6 align-self-center">
      <h3>Admin Users</h3>
    </div>
    <div class="col-6 text-right font-12"> <a href="index.php">Admin</a> &gt; Manage Tier</div>
  </div>
  
  <!-- ============================================================== --> 
  <!-- Start Page Content --> 
  <!-- ============================================================== -->
  <div class="row">
    
    <div class="col-lg-12 col-md-12">
      <div class="card ">
        <div class="card-body">
          <h4 class="card-title text-uppercase mb-20 pull-left"> Manage Tier</h4>
          <div class="table-responsive mt-40">
            <table id="example23" class="display nowrap table table-hover table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tier Name</th>
                  <th>Tier Price</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
               for($i=0;$i<count($dbData);$i++){
                ?>
                <tr>
                  <td class="text-dark font-semibold"><?=($i+1)?></td>
                  <td>
                    <?=$dbData[$i]['tiername']?>
                   </td>
                   <td>
                    <?=$dbData[$i]['tier_price']?>
                   </td>
                  <td align="center">
                    <input type="checkbox" id="s<?=$i+1?>"  <?=($dbData[$i]['status']==1)?'checked':''?> onclick="code_status(<?=$dbData[$i]['id']?>,this.value,this.checked)" value="<?=$dbData[$i]['id']?>">
                    </td>
                  <td style="width: 50px;" class="jsgrid-cell jsgrid-control-field jsgrid-align-center"><a href="javascript:void()" onClick="deleteRecoed('<?=$dbData[$i]['id']?>')" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></a>
                    <input class="jsgrid-button jsgrid-edit-button" onClick="getEdit('<?=$dbData[$i]['id']?>')" type="button" title="Edit"></td>
                </tr>
                <? }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function getEdit(id){
	window.location.href = "index.php?mo=add-new-tier&id="+id;	
}

function code_status(id,value,is_check){

	var setval=(is_check==true)?1:0;
	$.ajax({
		url:'tierController.php?mode=changeStatus',
		data:'id='+value+'&setval='+setval+'&page=<?=$page?>&set=<?=$set?>',
		success:function(response){
		//alert(response);
		if(response==1){
			alert("Status Successfully Activated.");
		} else {
			alert("Status Successfully Inactivated.");
		}
		location.reload(true);	
			
	}
});
}

function deleteRecoed(recordId){
	
	var r = confirm("Do you really want to remove this record?");
	if (r == true) {
		window.location.href = "tierController.php?mode=delete_tirer&id="+recordId;
	} 
}
</script>