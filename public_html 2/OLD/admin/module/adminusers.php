<?php
$id = sc_mysql_escape($_REQUEST['id']); // selected record id to delete
if(!isset($_SESSION['is_admin'])){
	header('Location:login.php?msg='.base64_encode('Please Login...'));
	exit();
}

$dbObj->dbQuery="select * from ".PREFIX."adminuser order by id DESC"; // for listing of records
$dbData = $dbObj->SelectQuery('slider.php','slider_images()');


//to get categories
$dbObj->dbQuery = "SELECT * FROM ".PREFIX."adminuser where id='".$id."'";
$dbCycle = $dbObj->SelectQuery('edithome.php','aboutEdit()');

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
    <div class="col-6 text-right font-12"> <a href="index.php">Admin</a> &gt;  Admin Users</div>
  </div>
  
  <!-- ============================================================== --> 
  <!-- Start Page Content --> 
  <!-- ============================================================== -->
  <div class="row">
    <div class="col-lg-4 col-md-4">
      <div class="card ">
        <div class="card-body">
          <h4 class="card-title text-uppercase mb-20 pull-left"> Admin Users</h4>
          <div class="table-responsive mt-40">
            <div class="form-wrap">
              <form action="loginController.php" method="post" onSubmit="return ckhform()">
                <input type="hidden" name="mode" value="add_admin" />
                <input type="hidden" name="id" value="<?=$id?>" />
                <? if(!empty($_REQUEST['msg'])){?>
                <div class="form-group" style="color:#F00; text-align:center;">
                  <?=base64_decode($_REQUEST['msg'])?>
                </div>
                <? }?>
                <div class="form-group">
                  <label class="control-label mb-5" >Full Name:</label>
                  <input type="text" class="form-control" name="info[name]" id="name" value="<?=$dbCycle[0]['name']?>"  placeholder="Alex Wora" >
                </div>
                <div class="form-group">
                  <label class="control-label mb-5" >email:</label>
                  <input type="text" name="info[email]" id="email" value="<?=$dbCycle[0]['email']?>" class="form-control" placeholder="example@email.com" >
                </div>
                <div class="form-group">
                  <label class="control-label mb-5" >Mobile:</label>
                  <input type="text" class="form-control" name="info[mnumber]" id="mnumber" value="<?=$dbCycle[0]['mnumber']?>" placeholder="895623124578" >
                </div>
                <div class="form-group">
                  <label class="control-label mb-5" >User Name:</label>
                  <input type="text" class="form-control" name="info[username]" id="username" value="<?=$dbCycle[0]['username']?>"placeholder="User Name" >
                </div>
                <div class="form-group">
                  <label class="control-label mb-5" >Password:</label>
                  <input type="password" class="form-control" value="" name="password" id="password" >
                </div>
                <div class="form-group">
                  <label class="control-label mb-5" >Confirm Password:</label>
                  <input type="password" class="form-control" name="rpassword" id="rpwd" value="" >
                </div>
                <div class="col-md-12 pa-0">
                  <div class="form-group">
                    <label class="control-label block mb-10 text-left">Admin Type</label>
                    <div class="radio mb-0 mr-20 inline-block radio-primary">
                      <input type="radio" name="info[admin_type]" id="radio1" value="super_admin" <?=($dbCycle[0]['admin_type']=='super_admin')?'checked':''?>>
                      <label for="radio1"> Super Admin </label>
                    </div>
                    <div class="radio mb-0 mr-20 inline-block  radio-primary">
                      <input type="radio" name="info[admin_type]" id="radio3" value="admin" <?=($dbCycle[0]['admin_type']=='admin')?'checked':''?>>
                      <label for="radio3"> Admin </label>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group mb-30">
                  <button type="submit" class="btn btn-primary btn-anim"><i class="fa fa-paper-plane"></i><span class="btn-text text-uppercase">submit</span></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8 col-md-8">
      <div class="card ">
        <div class="card-body">
          <h4 class="card-title text-uppercase mb-20 pull-left"> Admin Users</h4>
          <div class="table-responsive mt-40">
            <table id="example23" class="display nowrap table table-hover table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Admin Detail</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
               for($i=0;$i<count($dbData);$i++){
                ?>
                <tr>
                  <td class="text-dark font-semibold"><?=$dbData[$i]['userId']?></td>
                  <td>Name:
                    <?=$dbData[$i]['name']?>
                    <br>
                    User Name:
                    <?=$dbData[$i]['username']?>
                    <br/>
                    Admin Type:
                    <?=($dbData[$i]['admin_type']=='super_admin')?'Super Admin':$dbData[$i]['admin_type']?>
                    <br/>
                    Created On:
                    <?=(!empty($dbData[$i]['created']))?date('d-m-Y',strtotime($dbData[$i]['created'])):''?>
                    <br>
                    Last Login:
                    <?=(!empty($dbData[$i]['last_login']))?date('d-m-Y h:i:s A',strtotime($dbData[$i]['last_login'])):'Not logged in yet!'?></td>
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