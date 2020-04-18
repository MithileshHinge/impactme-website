<?php
$id = sc_mysql_escape($_REQUEST['id']); // selected record id to delete
if(!isset($_SESSION['is_admin'])){
	header('Location:login.php?msg='.base64_encode('Please Login...'));
	exit();
}



//to get categories
$dbObj->dbQuery = "SELECT * FROM ".PREFIX."tier where id='".$id."'";
$dbCycle = $dbObj->SelectQuery('edithome.php','aboutEdit()');

//print_r($dbCycle);
?>
<div class="container-fluid"> 
  <!-- ============================================================== --> 
  <!-- Bread crumb and right sidebar toggle --> 
  <!-- ============================================================== -->
  <div class="row page-titles">
    <div class="col-6 align-self-center">
      <h3>Add/Edit Tier</h3>
    </div>
    <div class="col-6 text-right font-12"> <a href="index.php">Admin</a> &gt; Add/Edit Tier</div>
  </div>
  
  <!-- ============================================================== --> 
  <!-- Start Page Content --> 
  <!-- ============================================================== -->
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="form-wrap">
              <form action="tierController.php" method="post" onSubmit="return ckhform()" enctype="multipart/form-data">
                <input type="hidden" name="mode" value="add_tier" />
                <input type="hidden" name="id" value="<?=$id?>" />
                <? if(!empty($_REQUEST['msg'])){?>
                <div class="form-group" style="color:#F00; text-align:center;">
                  <?=base64_decode($_REQUEST['msg'])?>
                </div>
                <? }?>
                <div class="row" style="margin-top:10px;">
                  <div class="col-sm-4">
                    <label class="control-label mb-5" >Tier Name:</label>
                    <input type="text" name="info[tiername]" id="tiername" value="<?=$dbCycle[0]['tiername']?>" class="form-control" placeholder="Tier Name" >
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label mb-5" >Tier Price:</label>
                      <input type="text" name="info[tier_price]" id="tier_price" value="<?=$dbCycle[0]['tier_price']?>" class="form-control" placeholder="Tier Price" >
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label mb-5" >Tier Type:</label>
                      <select class="form-control" name="info[tier_type]" id="tier_type"  >
                        <option value="0">Select Type</option>
                        <option value="monthly" <?=($dbCycle[0]['tier_type']=="monthly")?'selected':''?>> Monthly </option>
                        <option value="yearly" <?=($dbCycle[0]['tier_type']=="yearly")?'selected':''?>> Yearly </option>
                      </select>
                    </div>
                  </div>
                  
                </div>
                <div class="row" style="margin-top:10px;">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label class="control-label mb-5" >Tier Details:</label>
                      <?php
				$ckeditor = new CKEditor();
				$ckeditor->config['toolbar'] = 'MyTool';
				$ckeditor->basePath = 'editor/ckeditor/';
				$ckfinder = new CKFinder();
				$ckfinder->BasePath = 'editor/ckfinder/'; // Note: the BasePath property in the CKFinder class starts with a capital letter.
				$ckfinder->SetupCKEditorObject($ckeditor);
				$ckeditor->editor('info[tier_details]',html_entity_decode($dbCycle[0]['tier_details']));
				?>
                    </div>
                  </div>
                  
                </div>
              
                <div class="clearfix"></div>
                <div class="form-group mb-30" >
                  <button type="submit"  class="btn btn-primary btn-anim"><i class="fa fa-paper-plane"></i><span class="btn-text text-uppercase">Save</span></button>
                  
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
function ckhform(){
	if(isEmpty("Tier Name",document.getElementById("tiername").value)){
		document.getElementById("tiername").focus();
		return false;
	}
	if(isEmpty("Tier Price",document.getElementById("tier_price").value)){
		document.getElementById("tier_price").focus();
		return false;
	}
	if(isEmpty("Tier Type",document.getElementById("tier_type").value)){
		document.getElementById("tier_type").focus();
		return false;
	}
	
	checkdescription();
	
	return true;
}
</script>
