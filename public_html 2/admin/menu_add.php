<?php include('configure.php');
include('include/access.php');
$page_title = "Add Menu";
$table_name = "menu";

$table_id=  $table_name."_id";

$add_page = ADMINPATH."/".$table_name."_add.php";
$view_page = ADMINPATH."/".$table_name."_view.php";



if($_REQUEST[mode] == "add")
{
  $menu_type = $_REQUEST[menu_type];
  if($menu_type==1)
  {
    $sql = "select max(order_status) s from menu where menu_type=1";
	$sql_category = $db_query->fetch_object($sql);
	$_REQUEST[order_status] = $sql_category->s+1;
  }
  else
   $_REQUEST[order_status] =0;
   if( $db->insertDataArray($table_name,$_REQUEST))
  {
  header('location:'.$add_page."?msg=1");
  }

}


if($_GET[msg]==1)
{
$msg = "Added Successfully";
$error_type = "success";
	$sign = "fa-check";
 }

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php include('titlebar.php');?>
<script type="application/javascript">
function checkMenuCategory(){
	var status = document.getElementById("menustatus");
	var u = document.getElementById("menu_type").value;
	if(u != ""){
		status.innerHTML = 'checking...';
		var hr = new XMLHttpRequest();
		hr.open("POST", "<?=ADMINPATH?>/file_menu.php", true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.onreadystatechange = function() {
			if(hr.readyState == 4 && hr.status == 200) {
				status.innerHTML = hr.responseText;
			}
		}
    var v = "menu2check="+u;
    hr.send(v);
	}
}


</script>
</head>

<body>
<?php
include('include/header.php');
?>
<div id="cl-wrapper" class="fixed-menu">
<?php
include('include/menubar.php');
?>
<div id="pcont" class="container-fluid">
<div class="page-head">
               <h2><?=$page_title?></h2>
               <ol class="breadcrumb">
                  <li><a href="<?=ADMINPATH?>/dashboard/">Home</a></li>
                  <li class="active"><a href="#"><?=$page_title?></a></li>
                 
               </ol>
            </div>

<div class="cl-mcont">
          
    <div class="row">
                  <div class="col-md-12">
                     <div class="block-flat">
                     <?php if($msg) { ?>
                       <div class="alert alert-<?=$error_type?>"><button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button><i class="fa <?=$sign?> sign"></i><?=$msg?></div><?php } ?>
                        <div class="content">
                           <form  action="<?=$_SERVER['REQUEST_URI']?>"  method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group ">
                              <label  class="col-sm-2">Type</label>
                             <div class="col-sm-7">  
                             
                              <select name="menu_type" id="menu_type" parsley-trigger="change" required=""  class="form-control " onchange="checkMenuCategory(this.value);">
                                          <option value="">--Select--</option>
                                          <option value="1" <?php if($_REQUEST[menu_type]==1) {?> selected="selected"<?php } ?> >Category</option>
                                          <option value="2" <?php if($_REQUEST[menu_type]==2) {?> selected="selected"<?php } ?>>Sub Category</option>
                                          </select>
                                          
                             </div>
                            </div>
                            <span id="menustatus"> </span>
                            
                            
                            <div class="form-group ">
                              <label  class="col-sm-2">Menu Name</label>
                             <div class="col-sm-7">  
                             <input type="text" name="name" parsley-trigger="change" required="" class="form-control " value="<?=$_REQUEST[name]?>">
                             </div>
                            </div>
                            
                             <div class="form-group ">
                              <label  class="col-sm-2">Menu Link</label>
                             <div class="col-sm-7">  
                             <input type="text" name="link" parsley-trigger="change" required=""  class="form-control "   value="<?=$_REQUEST[link]?>">
                             </div>
                            </div>
                             <div class="form-group ">
                              <label  class="col-sm-2">Icon</label>
                             <div class="col-sm-7">  
                             <input type="text" name="icon" parsley-trigger="change"   class="form-control "   value="<?=$_REQUEST[icon]?>">
                             </div>
                            </div>
                             
                              
                              <input type="hidden" name="mode" value="add" />
                              <button type="submit" class="btn btn-primary">Submit</button>
                     <!--    <button type="reset" class="btn btn-default">Reset</button>-->
                           </form>
                        </div>
                     </div>
                  </div>     
               
         </div>     
 </div>
</div>

</div>

<?php
include('footer_js.php');


?>

<script src="<?=ADMINPATH?>/assets/lib/jquery.parsley/dist/parsley.min.js" type="text/javascript"></script>
<script src="<?=ADMINPATH?>/assets/lib/jquery.parsley/src/extra/dateiso.js" type="text/javascript"></script>
	  
	  <script type="text/javascript">$(document).ready(function(){
         //initialize the javascript
         App.init();
         $('form').parsley();
         });
      </script>
</body>
</html>
