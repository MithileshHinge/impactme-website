<?php
$id = sc_mysql_escape($_REQUEST['id']); // selected record id to delete
if(!isset($_SESSION['is_admin'])){
	header('Location:login.php?msg='.base64_encode('Please Login...'));
	exit();
}

$dbObj->dbQuery="select * from ".PREFIX."users  order by id DESC"; // for listing of records
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
    <div class="col-6 text-right font-12"> <a href="index.php">Admin</a> &gt; Manage Users</div>
  </div>
  
  <!-- ============================================================== --> 
  <!-- Start Page Content --> 
  <!-- ============================================================== -->
  <div class="row">
    
    <div class="col-lg-12 col-md-12">
      <div class="card ">
        <div class="card-body">
          <h4 class="card-title text-uppercase mb-20 pull-left"> Manage Creator</h4>
          <div class="table-responsive mt-40">
            <table id="example23" class="display nowrap table table-hover table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>User Detail</th>
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
                  <td>Name:
                    <?=$dbData[$i]['name']?>
                    <br>
                    User Name:
                    <?=$dbData[$i]['username']?>
                    
                    Registered On:
                    <?=(!empty($dbData[$i]['rdate']))?date('d-m-Y',strtotime($dbData[$i]['rdate'])):''?>
                    <br>
                    Last Login:
                    <?=(!empty($dbData[$i]['llogin']))?date('d-m-Y h:i:s A',strtotime($dbData[$i]['llogin'])):'Not logged in yet!'?></td>
                  <td align="center"><? if($dbData[$i]['id']!=1){?>
                    <input type="checkbox" id="s<?=$i+1?>"  <?=($dbData[$i]['status']==1)?'checked':''?> onclick="code_status(<?=$dbData[$i]['id']?>,this.value,this.checked)" value="<?=$dbData[$i]['id']?>">
                    <? }?></td>
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
	window.location.href = "index.php?mo=adminusers&id="+id;	
}

function code_status(id,value,is_check){

	var setval=(is_check==true)?1:0;
	$.ajax({
		url:'loginController.php?mode=changeStatus',
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
function ckhform(){
	if(isEmpty("Name",document.getElementById("name").value)){
		document.getElementById("name").focus();
		return false;
	}
	if(isEmpty("User Name",document.getElementById("username").value)){
		document.getElementById("username").focus();
		return false;
	}
	if(document.getElementById("mnumber").value!=''){ 
		  var phoneno = /^\d{10}$/; 
		  var i;
		  var inputtxt = document.getElementById("mnumber").value;  
		  if(document.getElementById("mnumber").value.match(phoneno)) {  
			  i = 1;
		  } else {
			  i = 2;  
				
		  }	
		  
		  if(i==2){
				alert("Please enter only 10 digits mobile number.");  
				document.getElementById("mnumber").value='';
				document.getElementById("mnumber").focus();
				return false;    
		  }
	}
	<? if(empty($id)){?>
	if(isEmpty("Password",document.getElementById("password").value)){
		document.getElementById("password").focus();
		return false;
	}
	if(isEmpty("Re-Type Password",document.getElementById("rpwd").value)){
		document.getElementById("rpwd").focus();
		return false;
	}
	
	<? }?>
	if((document.getElementById("password").value!='') && (document.getElementById("rpwd").value!='')){
		if(document.getElementById("password").value!=document.getElementById("rpwd").value){
			alert("Passwords donot match.");
			document.getElementById("password").focus();
			return false;
		}
	}
	
	
	return true;
}
function deleteRecoed(recordId){
	
	var r = confirm("Do you really want to remove this record?");
	if (r == true) {
		window.location.href = "loginController.php?mode=delete_admin&id="+recordId;
	} 
}
</script>