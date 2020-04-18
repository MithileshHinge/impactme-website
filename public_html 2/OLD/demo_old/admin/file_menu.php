<?php
include('configure.php') ;
if(isset($_POST["menu2check"]) && $_POST["menu2check"] != ""){
$menu_id =$_POST['menu2check'];
if($menu_id==2)
{
?>
<span id="menustatus">
  <div class="form-group ">
    <label  class="col-sm-2">Catgeory Name</label>
      <div class="col-sm-7"> 
 <?php
 $sql_category = "select menu_id,name from menu where menu_type=1 order by name";
 $row_category = $db_query->runQuery($sql_category);
 ?>
<select name="sub_menu_id" id="sub_menu_id" title="Choose Category" parsley-trigger="change" required=""  class="form-control ">
<option value="">--Select--</option>
 <?php 
 if(!empty($row_category)) { 
 foreach($row_category as $menu) {?>
 <option value="<?=$menu[menu_id]?>"><?=$menu[name]?></option>
 <?php } ?>
 <?php } ?>
</select>
 </div>
</div>
</span>
<?php } ?>

<?php } ?>
