<header id="header">
        <div class=" col-md-12 wrap-top-menu hidden-lg">
            <div class="container_12 clearfix" style="height:48px;">
                <div class="">
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
            <div class=" header-content">
            
                <div id="sys_header_right" class="header-right"> 
                <?php if(isset($_SESSION['is_user_login'])==0) { ?>
                    <div class="account-panel"> 
                      <a href="<?=BASEPATH?>/login/?ut=create&type=<?=md5(rand())?>"  class="login">Login</a> 
                      <a href="<?=BASEPATH?>/sign-up/?ut=create&type=<?=md5(rand())?>" class="sign login">Sign Up</a> 
                    </div>
                    <div class="form-search"> 
                      <a href="<?=BASEPATH?>/login/?ut=ucreate&type=<?=md5(rand())?>" class="login">Start My Page</a> 
                      <a href="<?=BASEPATH?>/sign-up/?ut=ucreate&type=<?=md5(rand())?>" class="login explore">Explore Creator</a> 
                    </div>
                    <?php } else {
					if(strlen($row_user->image_path)>0)
				    {
					 $Path_name_image = BASEPATH.'/images/'.$row_user->image_path;
					if (@file_get_contents($Path_name_image, 0, NULL, 0, 1)) 
					 {
					 $user_image = IMAGEPATH.$row_user->image_path;
					 }
					 else
					 {
					   $user_image = IMAGEPATH.'icon_man.png'; 
					 }
					 }
					else
					 $user_image = IMAGEPATH.'icon_man.png'; 
 
					 ?>
     <!-- <span class="chat-icon"><i class="fa fa-comments"></i></span>-->
        <div class="photo-nav" style="background-image:url(<?=$user_image?>); background-size:cover;">
          <div class="drop">
          
            <ul class="link-creater">
             <?php if(isset($_SESSION['is_user_login'])==1 &&  $_SESSION['user_type'] == 1) { ?>
              <li><a href="<?=BASEPATH?>/edit/about/"><?php if($row_user->review_status==0){?>Finish Page<?php } else {?>Page Settings<?php } ?></a></li>
              <li><a href="<?=BASEPATH?>/home/">Post from creator</a></li>
              
              <!-- URL CHANGE -->
              <?php 
			  if(strlen($row_user->slug)>0)
			  { $url_slug = BASEPATH.'/creator/'.$row_user->slug.'/';}
			  else
			  {
			   $url_slug = BASEPATH.'/user-creator/';}
			
			  ?>
              <li><a href="<?=$url_slug?>">My Profile</a></li>
              <li><a href="<?=BASEPATH?>/explore/">Explore Creator</a></li>
              
              <?php } else { ?>
              <li><a href="<?=BASEPATH?>/home/">Post from creator</a></li>
               <li><a href="<?=BASEPATH?>/post-creator/">My Profile</a></li>
                <li><a href="<?=BASEPATH?>/create/">Become An Impact</a></li>
              <?php } ?>
              
              <li><a href="#">My Membership</a></li>
              <li><a href="<?=BASEPATH?>/settings/">My Profile Setting</a></li>
              <!-- <li><a href="<?=BASEPATH?>/change-password/">Change Password</a></li>-->
              <li><a href="#">Help Center and Faq</a></li>
              <li><a href="<?=BASEPATH?>/logout/">Log Out</a></li>
                          </ul>
          </div>
        </div><?php } ?>
      </div>
      
      
      
                <div class="header-left">
                    <h1 id="logo">
                     <?php if(isset($_SESSION['is_user_login'])==1) 
					    { 
							if( $_SESSION['user_type'] == 0)
							{
							$loggedPath = POST_CREATOR_PATH;
							}
							else
							{
							 $loggedPath= BASEPATH.'/user-creator/';
							}
						}
						else
						  $loggedPath= BASEPATH.'/';
					 ?>
                        <a href="<?=$loggedPath?>"><img src="<?=IMAGEPATH?><?=$sql_web->image_path?>" alt="<?=PROJECT_TITLE?>"/></a>
                       
                    </h1>
                    <div class="main-nav clearfix">
                        <div class="form-search">
                        <form action="<?=BASEPATH?>/search/" method="get">
                            <label for="sys_txt_keyword"  class="label-serach">
                                <input id="sys_txt_keyword" class="active creater-search" type="text" placeholder="Search... "/ style="    margin: 6px 0 0 9px;width:205px;padding: 0 0 0 17px;position: relative;bottom: 2px;" name="s" value="<?=$_REQUEST[s]?>" autocomplete="false">
                            </label>
                            <button class="btn-search" type="reset" >
                               <i class="material-icons" style="font-size:18px;">search</i>
                                </button>
                            <button class="btn-reset-keyword" type="reset" id="reset_search"	>
                                <!--<i class="icon iXHover"></i>-->
                                <i class="material-icons" style="font-size: 13px;    color: #89949c;">
close
</i>
                                </button>
                            
                           <div class="search-div">
                            <ul class="link-creater" id="searchResult">
                              
                               
                               <!-- <li ><a href="#" class=""><div class="see-result">See all Result</div></a></li>-->
                                 
                            </ul>
                       </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </header>