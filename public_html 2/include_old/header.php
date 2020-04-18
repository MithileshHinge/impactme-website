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
      <span class="chat-icon">
          <a href="<?=BASEPATH?>/message/">
            <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                <path fill="#000000" d="M12,23A1,1 0 0,1 11,22V19H7A2,2 0 0,1 5,17V7C5,5.89 5.9,5 7,5H21A2,2 0 0,1 23,7V17A2,2 0 0,1 21,19H16.9L13.2,22.71C13,22.9 12.75,23 12.5,23V23H12M13,17V20.08L16.08,17H21V7H7V17H13M3,15H1V3A2,2 0 0,1 3,1H19V3H3V15Z" />
            </svg>
          </a>
          </span>
        <div class="photo-nav">
        <div class="photo-nav-2" style="background-image:url(<?=$user_image?>); background-size:cover;">
          <div class="drop">
          
            <ul class="link-creater">
                <?php 
			  if(strlen($row_user->slug)>0)
			  { $url_slug = BASEPATH.'/creator/'.$row_user->slug.'/';}
			  else
			  {
			   $url_slug = BASEPATH.'/user-creator/';}
			
			  ?>
                <li style="background-color:#f2f5fa">
                     <a href="<?=$url_slug?>" style="color:#455058">Akshay bhoyar</a>
                </li>
                
             <?php if(isset($_SESSION['is_user_login'])==1 &&  $_SESSION['user_type'] == 1) { ?>
              <li><a href="<?=BASEPATH?>/edit/about/"><?php if($row_user->review_status==0){?>Finish Page<?php } else {?>Page settings<?php } ?></a></li>
              <li><a href="<?=BASEPATH?>/home/">Post from my creators</a></li>
              
              <!-- URL CHANGE -->
              <?php 
			  if(strlen($row_user->slug)>0)
			  { $url_slug = BASEPATH.'/creator/'.$row_user->slug.'/';}
			  else
			  {
			   $url_slug = BASEPATH.'/user-creator/';}
			
			  ?>
			  
              <!--<li><a href="<?=$url_slug?>">My Profile</a></li>-->
              <li><a href="<?=BASEPATH?>/explore/">Explore creators</a></li>
              
              <?php } else { ?>
              <li style="background-color:#f2f5fa"><a href="<?=BASEPATH?>/post-creator/" style="color:#455058">Akshay Bhoyar</a></li>
              
              <li><a href="<?=BASEPATH?>/home/">Post from my creators</a></li>
               <!--<li><a href="<?=BASEPATH?>/post-creator/">My Profile</a></li>-->
                <li><a href="<?=BASEPATH?>/create/">Become a creator</a></li>
              <?php } ?>
              
              <li><a href="#">My Subscriptions</a></li>
              <li><a href="<?=BASEPATH?>/settings/">Profile settings</a></li>
              <!-- <li><a href="<?=BASEPATH?>/change-password/">Change Password</a></li>-->
              <li><a href="#">Help and FAQ</a></li>
              <li><a href="<?=BASEPATH?>/logout/">Log out</a></li>
                          </ul>
          </div>
        </div><?php } ?>
        </div>
      </div>
      
      
      
                <div class="header-left" style="margin:0 0 0 0;padding:0 0 0 0;">
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
                       </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </header>