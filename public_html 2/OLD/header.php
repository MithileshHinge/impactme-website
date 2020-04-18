<?php
//*121*02#


if( !isset($_SESSION['user_id'])){
?>

<header id="header">
    <div class=" col-md-12 wrap-top-menu hidden-lg">
      <div class="container_12 clearfix">
        <div class="grid_12">
          <div class="top-message clearfix"> <i class="icon iFolder"></i> <span class="txt-message">Nulla egestas nulla ac diam ultricies id viverra nisi adipiscing.</span> <i class="icon iX"></i>
            <div class="clear"></div>
          </div>
          <i id="sys_btn_toggle_search" class="icon iBtnRed make-right"></i> </div>
      </div>
    </div>
    <!-- end: .wrap-top-menu -->
    <div class="container_12 clearfix">
      <div class="grid_12 header-content">
        <div id="sys_header_right" class="header-right">
          <div class="account-panel"> <a href="login.php"  class="login">Login</a> <a href="sign.php" class="sign login">Sign Up</a> </div>
          <div class="form-search"> <a href="login.php" class="login">Start My Page</a> <a href="login.php" class="login explore">Explore Creater</a> </div>
        </div>
        <div class="header-left">
          <h1 id="logo"> <a href="index.php"><img src="images/logo-3.png" alt="$SITE_NAME"/></a> </h1>
          <div class="main-nav clearfix">
            <div class="form-search">
              <form action="#">
                <label for="sys_txt_keyword" style="border-bottom: 1px solid #dfe1e2;">
                  <input id="sys_txt_keyword" class="active" type="text" placeholder="Search Creators... "/ style="    margin: 6px 0 0 40px;">
                </label>
                <button class="btn-search" type="reset"><i class="icon iMagnifier"></i></button>
                <button class="btn-reset-keyword" type="reset"><i class="icon iXHover"></i></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
 <? } else {?>
 
 <?php
 
 $dbObj->dbQuery = "SELECT * FROM ".PREFIX."users WHERE id='".sc_mysql_escape($_SESSION['user_id'])."'"; 
$dbUserProfileImage = $dbObj->SelectQuery('edithome.php','aboutEdit()');

 if(!empty($dbUserProfileImage[0]['pimage']) && $dbUserProfileImage[0]['user_type']=='web'){ 
  		$imageurl = "background-image:url(cms_images/user/original/".$dbUserProfileImage[0]['pimage'].")";
		 
	} else if($dbUserProfileImage[0]['oauth_provider']=='facebook'){
		if(!empty($dbUserProfileImage[0]['pimage']))
		$imageurl = "background-image:url(cms_images/user/original/".$dbUserProfileImage[0]['pimage'].")";
		else
		$imageurl = 	"background-image:url(".$dbUserProfileImage[0]['fbimage'].")";
	} else {
		$imageurl = "";
	}
 
 ?>
 <header id="header">
  <div class="container_12 clearfix">
    <div class="grid_12 header-content">
      <div id="sys_header_right" class="header-right"> <span class="chat-icon"><i class="fa fa-comments"></i></span>
        <div class="photo-nav" style="<?=$imageurl?>; background-size:cover;">
          <div class="drop">
            <ul class="link-creater">
              <li><a href="edit.php">Finish Page</a></li>
              <li><a href="creater.php">Post from creater</a></li>
              <li><a href="usercreater.php">My Profile</a></li>
              <li><a href="explore-creator.php">Explore Creater</a></li>
              <li><a href="#">My Membership</a></li>
              <li><a href="#">My Profile setting</a></li>
              <li><a href="#">Help center and Faq</a></li>
              
              <? if(isset($_SESSION['userData']['oauth_uid'])){?>
              <li><a href="loginController.php?mode=fblogout">logout</a></li>
              <? } else {?>
              <li><a href="loginController.php?mode=logout">logout</a></li>
              <? }?>
            </ul>
          </div>
        </div>
      </div>
      <div class="header-left">
        <h1 id="logo"> <a href="usercreater.php"><img src="images/logo-3.png" alt="$SITE_NAME"/></a> </h1>
        <div class="main-nav clearfix">
          <div class="form-search">
            <form action="#">
              <label for="sys_txt_keyword">
                <input id="sys_txt_keyword" class="active" type="text" placeholder="Search Creators... "/ style="    margin: 6px 0 0 40px;">
              </label>
              <button class="btn-search" type="reset"><i class="icon iMagnifier"></i></button>
              <button class="btn-reset-keyword" type="reset"><i class="icon iXHover"></i></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
 
 <? } ?>