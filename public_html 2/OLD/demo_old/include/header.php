<header id="header">
        <div class=" col-md-12 wrap-top-menu hidden-lg">
            <div class="container_12 clearfix">
                <div class="grid_12">
                    <div class="top-message clearfix">
                        <i class="icon iFolder"></i>
                        <span class="txt-message">&nbsp;</span>
                        <i class="icon iX"></i>
                        <div class="clear"></div>
                    </div>
                    <i id="sys_btn_toggle_search" class="icon iBtnRed make-right"></i>
                </div>
            </div>
        </div> 
        <div class="container_12 clearfix">
            <div class="grid_12 header-content">
            
                <div id="sys_header_right" class="header-right"> 
                <?php if(isset($_SESSION['is_user_login'])==0) { ?>
                    <div class="account-panel"> 
                      <a href="<?=BASEPATH?>/login/?ut=ucreate&type=<?=md5(rand())?>"  class="login">Login</a> 
                      <a href="<?=BASEPATH?>/sign-up/?ut=ucreate&type=<?=md5(rand())?>" class="sign login">Sign Up</a> 
                    </div>
                    <div class="form-search"> 
                      <a href="<?=BASEPATH?>/login/?ut=create&type=<?=md5(rand())?>" class="login">Start My Page</a> 
                      <a href="<?=BASEPATH?>/sign-up/?ut=create&type=<?=md5(rand())?>" class="login explore">Explore Creator</a> 
                    </div>
                    <?php } else { ?>
      <span class="chat-icon"><i class="fa fa-comments"></i></span>
        <div class="photo-nav" style="background-image:url(images/icon_man.png); background-size:cover;">
          <div class="drop">
            <ul class="link-creater">
              <li><a href="edit.php">Finish Page</a></li>
              <li><a href="creater.php">Post from creater</a></li>
              <li><a href="usercreater.php">My Profile</a></li>
              <li><a href="explore-creator.php">Explore Creater</a></li>
              <li><a href="#">My Membership</a></li>
              <li><a href="#">My Profile setting</a></li>
              <li><a href="#">Help center and Faq</a></li>
              <li><a href="<?=BASEPATH?>/logout/">logout</a></li>
                          </ul>
          </div>
        </div><?php } ?>
      </div>
      
      
      
                <div class="header-left">
                    <h1 id="logo">
                        <a href="<?=BASEPATH?>"><img src="<?=IMAGEPATH?><?=$sql_web->image_path?>" alt="<?=PROJECT_TITLE?>"/></a>
                    </h1>
                    <div class="main-nav clearfix">
                        <div class="form-search">
                        <form action="<?=BASEPATH?>/search/" method="post">
                            <label for="sys_txt_keyword" style="border-bottom: 1px solid #dfe1e2;">
                                <input id="sys_txt_keyword" class="active" type="text" placeholder="Search Creators... "/ style="    margin: 6px 0 0 40px;" name="s">
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