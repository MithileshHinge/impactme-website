<style>
span.notify {
      position: absolute;
    top: -10px;
    right: -12px;
    font-size: 12px;
    background-color: #ff6624;
    color: #fff;
    border-radius: 50%;
    /* margin: 3px 0 0 -1px; */
    padding-right: 8px;
    padding-left: 8px;
    padding-top: 0px;
    padding-bottom: 0px;
}
.load-more{
    width: 99%; 
    text-align: center;
    color: #3a9cb5;
    padding: 0px 0px 10px 0;
    cursor: pointer;
}

.load-more1{
    width: 99%; 
    text-align: center;
    color: #3a9cb5;
    padding: 0px 0px 10px 0;
}

.load-more1:hover{
    cursor: pointer;
}

/* more link */
.more{
    color: blue;
    text-decoration: none;
    letter-spacing: 1px;
    font-size: 16px;
}
</style>
<?php $notify = $db_query->notification_msg($row_user->email_id); 
  $ids = $db_query->get_ids_sql($row_user->user_id);
?>
<header id="header">
  <div class=" col-md-12 wrap-top-menu" style="display:none;">
      <div class="container_12 clearfix" style="height:48px;">
          <div class="">
              <div class="top-message clearfix">
                  <i class="icon iFolder"></i>
                  <span class="txt-message">&nbsp;</span>
                  <i class="icon iX"></i>
                  <div class="clear"></div>
              </div>
              <i id="sys_btn_toggle_search" class="material-icons make-right" style="margin-top:3px !important;">menu</i>
          </div>
      </div>
  </div> 
  <div class="container_12 clearfix">
    <div class=" header-content">
      
      <div id="sys_header_right" class="header-right"> 
          
        <div class="main-nav clearfix">
          <div class="form-search">
            <form action="<?=BASEPATH?>/search/" method="get">
              <label for="sys_txt_keyword"  class="label-serach">
                <input id="sys_txt_keyword" class="active creater-search" type="text" placeholder="Search... "/ style="    margin: 6px 0 0 9px;width:180px;padding: 0 0 0 10px;position: relative;top: 1px;" name="s" value="<?=$_REQUEST[s]?>" autocomplete="false">
              </label>
              <button class="btn-search respon-search" type="reset" >
                <i class="material-icons" style="font-size:18px;">search</i>
              </button>
              <button class="btn-reset-keyword" type="reset" id="reset_search"	>
                <!--<i class="icon iXHover"></i>-->
                <i class="material-icons" style="font-size: 13px;    color: #89949c;">close</i>
              </button>
            </form>
            <div class="search-div">
                <ul class="link-creater" id="searchResult">
                    
                     
                <!-- <li ><a href="#" class=""><div class="see-result">See all Result</div></a></li>-->
                       
                </ul>
              </div>
          </div>
        </div>
        
        <style>

        .active_notify {
          background-color: #f2f5fa;
          border-bottom: 1px solid #ccc;
          padding-bottom:12px;
        }
        .inactive_notify
        {
          background-color: #fff;
          border-bottom: 1px solid #ccc;
          padding-bottom:12px;
        }
        .all_notification
        {
          background-color:#f2f5fa;
          border-top: 1px solid #ccc;
          padding-bottom:12px;
        }
        </style>          

<?php
        if(isset($_SESSION['is_user_login'])==0) { ?>
          <div class="header-right-menu" style="display:contents;">
            <div class="account-panel"> 
              <a href="<?=BASEPATH?>/login/?ut=create&type=<?=md5(rand())?>"  class="login">Login</a> 
              <a href="<?=BASEPATH?>/sign-up/?ut=create&type=<?=md5(rand())?>" class="sign login">Sign Up</a> 
            </div>
            <div class="form-search"> 
              <a href="<?=BASEPATH?>/sign-up/?ut=create&t=start&type=<?=md5(rand())?>" class="login">Start My Page</a> 
              <a href="<?=BASEPATH?>/explore/" class="login explore">Explore Creator</a>
            </div>
          </div>
<?php
        } else {
      		if(strlen($row_user->image_path)>0) {
      		  $Path_name_image = BASEPATH.'/images/'.$row_user->image_path;
        		if (@file_get_contents($Path_name_image, 0, NULL, 0, 1)) {
        		  $user_image = IMAGEPATH.$row_user->image_path;
        		}
        		else {
        		  $user_image = IMAGEPATH.'icon_man.png'; 
        		}
      		}
      		else
      		  $user_image = IMAGEPATH.'icon_man.png'; 
?>
          <span class="chat-icon">
            <a href="<?=BASEPATH?>/message/">
              <img src="<?=BASEPATH?>/images/comment-multiple-outline.svg" style="width: 23px;">
              <!--<i class="fa fa-comments"></i>-->
<?php
              if($notify>0) { 
?>
                <span class="notify"><?=$notify?></span>
<?php 
              }
?>
            </a>
          </span>
<?php
          $sql_notification = $db_query->fetch_object("select count(*) c from impact_notification where user_id in $ids and not from_user_id in $ids and notification_status=0");
?> 

           <!--========notification=========-->
          <span class="chat-icon" style="left:-14px" >
            <i class="material-icons"  >notifications_none</i>
<?php 
            if($sql_notification->c>0){
?>
              <span id="notify_count">
                <span class="notify"><?=$sql_notification->c?></span>
              </span>
<?php
            }
?>
          </span>
<?php
          //if($sql_notification->c>0){
?>
          <div class="hover-notification" id="imp_notification">
            <div class="drop-notification">
              <span>
                <ul class="link-creater" style="padding:0 0 0 0;" id="notif">
<?php
                  $sql_notification_d = $db_query->runQuery("select * from impact_notification where user_id in $ids and not from_user_id in $ids order by notification_id desc limit 10");
                  
                  foreach($sql_notification_d as $row_notification_d) {
                  
                    $notify_link = $db_query->get_notification_link($row_notification_d['notification_id']);
                    if($row_notification_d['read_status']==1){
                      $class= "inactive_notify";
                    }
                    else {
                      $class= "active_notify";
                    }
?>
                    <li class="<?=$class?>" id="note<?=$row_notification_d['notification_id']?>" >
                      <a href="#" onclick="javascript:  $.ajax({
                        url: '<?=BASEPATH?>/ajax/search_notification.php',
                        type: 'post',
                        data: {notify_id:<?=$row_notification_d['notification_id']?>},
                        dataType: 'json',
                        success:function(response){
              	
                        if($('#notif #note<?=$row_notification_d['notification_id']?>').hasClass('active_notify'))
                        {
                            $('#notif #note<?=$row_notification_d['notification_id']?>').addClass('inactive_notify').removeClass('active_notify');
                        }
                        else
                        {
                           $('#notif #note<?=$row_notification_d['notification_id']?>').addClass('inactive_notify').removeClass('active_notify');
                        }
                      setTimeout(function(){ window.location= '<?=$notify_link?>' ;  }, 1000);

                         // $('#notif #note<?=$row_notification_d['notification_id']?>').removeClass('active_notify').addClass('inactive_notify');
                        
                          
                        }
                      });"><?=$row_notification_d['description']?></a>
                      <span  style="float: right;
                        color:#aaa;
                        font-size: 11px;
                        margin-right: 13px;
                        margin-top: -3%;"><?=$db_query->facebook_time_ago($row_notification_d['notify_date'])?>
                        <? //=date('d M, Y h:i a', strtotime($row_notification_d['notify_date']))?>
                      </span>
                    </li>
<?php
                  }
?>
                  <!--<li class="all_notification" ><a href="<?=BASEPATH?>/notification/" >All Notification</a></li>-->
                </ul>
              </span>
              <a href="<?=BASEPATH?>/notification/" style="position: fixed;
                top:362px;
                background-color: white;
                border-top: 1px solid #ccc;
                box-shadow: -1px 7px 10px 5px #0000001a;display: block;
                text-align: center;color:#3a9cb5;font-weight:400;    padding: 3px 0 3px 0;">
                <span>See All</span>
              </a>
            </div>
          </div>
<?php
          //}
?>

<!--========End notification=========-->


<!--================its for desktop view==========================-->
          <div class="photo-nav impact-photores" style="background-image:url(<?=$user_image?>); background-size:cover;"></div>
          <div class="clr"></div>
          <div class="hover-pic impact-photores" style="height: 48px; width: 48; bottom">
            <div class="drop">
            
              <ul class="link-creater" style="padding:0 0 0 0;">
<?php
                if(isset($_SESSION['is_user_login'])==1 &&  $_SESSION['user_type'] == 1) {
?>
               
<?php 
                  if(strlen($row_user->slug)>0) { 
                    $url_slug = BASEPATH.'/creator/'.$row_user->slug.'/';
                  }
                  else {
                    $url_slug = BASEPATH.'/user-creator/';
                  }
?>
               
                  <li><a href="<?=$url_slug?>" style="background-color:#f2f5fa"><?=html_entity_decode($row_user->impact_name)?></a></li>
                  <li><a href="<?=BASEPATH?>/edit/about/"><?php if($row_user->review_status==0){?>Finish Page<?php } else {?>Manage Page<?php } ?></a></li>
                  <li><a href="<?=BASEPATH?>/home/">Posts from my creators</a></li>
                
                  <!-- URL CHANGE -->
<?php 
                  if(strlen($row_user->slug)>0){ 
                    $url_slug = BASEPATH.'/creator/'.$row_user->slug.'/';
                  }
                  else {
                    $url_slug = BASEPATH.'/user-creator/';
                  }
?>
               
                  <!--<li><a href="<?=$url_slug?>">My Profile</a></li>-->
<?php 
                } else {
?>
                  <li><a href="<?=BASEPATH?>/home/" style="background-color:#f2f5fa"><?=html_entity_decode($row_user->full_name)?></a></li>
                  <!--<li><a href="<?=BASEPATH?>/post-creator/">Akshay Bhoyar</a></li>-->
                  <!--<li><a href="<?=BASEPATH?>/home/">Posts from my creators</a></li>-->
                  <li><a href="<?=BASEPATH?>/create/">Become a Creator</a></li>
<?php
                }
?>
                <li><a href="<?=BASEPATH?>/explore/">Explore Creators</a></li>
                <li><a href="<?=BASEPATH?>/my-pacts/">My Pacts</a></li>
                <li><a href="<?=BASEPATH?>/payments-history/">Payment History</a></li>
                <li><a href="<?=BASEPATH?>/settings/">Profile Settings</a></li>
                <!-- <li><a href="<?=BASEPATH?>/change-password/">Change Password</a></li>-->
                <li><a href="<?=BASEPATH?>/help/">Help and FAQ</a></li>
                <li><a href="<?=BASEPATH?>/logout/">Log out</a></li>
              </ul>
            </div>
          </div>
<?php 
        }
?>
      </div>
<!--================end its for desktop view==========================-->


      <div class="header-left">
        <h1 id="logo">
<?php
          if(isset($_SESSION['is_user_login'])==1) {
            if( $_SESSION['user_type'] == 0){
				      $loggedPath = POST_CREATOR_PATH;
				    } else {
				      $loggedPath= BASEPATH.'/user-creator/';
				    }
			    } else
      			$loggedPath= BASEPATH.'/';
?>
          <a href="<?=$loggedPath?>"><img src="<?=IMAGEPATH?><?=$sql_web->image_path?>" alt="<?=PROJECT_TITLE?>"/ class="logo-impact"></a>
                 
        </h1>
<!--                    <div class="main-nav clearfix">-->
<!--                        <div class="form-search">-->
<!--                        <form action="<?=BASEPATH?>/search/" method="get">-->
<!--                            <label for="sys_txt_keyword"  class="label-serach">-->
<!--                                <input id="sys_txt_keyword" class="active creater-search" type="text" placeholder="Search... "/ style="    margin: 6px 0 0 9px;width:205px;padding: 0 0 0 17px;position: relative;bottom: 2px;" name="s" value="<?=$_REQUEST[s]?>" autocomplete="false">-->
<!--                            </label>-->
<!--                            <button class="btn-search respon-search" type="reset" >-->
<!--                               <i class="material-icons" style="font-size:18px;">search</i>-->
<!--                                </button>-->
<!--                            <button class="btn-reset-keyword" type="reset" id="reset_search"	>-->
                          <!--<i class="icon iXHover"></i>-->
<!--                                <i class="material-icons" style="font-size: 13px;    color: #89949c;">-->
<!--close-->
<!--</i>-->
<!--                                </button>-->
                      
<!--                           <div class="search-div">-->
<!--                            <ul class="link-creater" id="searchResult">-->
                        
                         
                         <!-- <li ><a href="#" class=""><div class="see-result">See all Result</div></a></li>-->
                           
<!--                            </ul>-->
<!--                       </div>-->
<!--                        </form>-->
<!--                    </div>-->
<!--                    </div>-->


      <!--======================its is for mobile===============================-->
<?php 
        if(isset($_SESSION['is_user_login'])==1) {
?>
          <div class="photo-nav  impact-desktop" style="background-image:url(<?=$user_image?>); background-size:cover;"></div>
          <div class="clr"></div>
          <div class="hover-pic impact-desktop" style="height: 48px; width: 48; bottom">
            <div class="drop">
                  
              <ul class="link-creater" style="padding:0 0 0 0;">
<?php
                if(isset($_SESSION['is_user_login'])==1 &&  $_SESSION['user_type'] == 1) {
?>
                   
                   <!-- URL CHANGE -->
<?php 
                  if(strlen($row_user->slug)>0) {
                    $url_slug = BASEPATH.'/creator/'.$row_user->slug.'/';
                  } else {
                    $url_slug = BASEPATH.'/user-creator/';
                  }
?>
                <li><a href="<?=$url_slug?>" style="background-color:#f2f5fa"><?=html_entity_decode($row_user->impact_name)?></a></li>
                <li><a href="<?=BASEPATH?>/edit/about/"><?php if($row_user->review_status==0){?>Finish Page<?php } else {?>Manage Page<?php } ?></a></li>
                <li><a href="<?=BASEPATH?>/home/">Posts from my creators</a></li>
                    
                <!-- URL CHANGE -->
<?php
                if(strlen($row_user->slug)>0) {
                  $url_slug = BASEPATH.'/creator/'.$row_user->slug.'/';
                } else {
                  $url_slug = BASEPATH.'/user-creator/';
                }
?>
                <!--<li><a href="<?=$url_slug?>">My Profile</a></li>-->
<?php
                } else {
?>
                  <!--<li><a href="<?=BASEPATH?>/post-creator/">Akshay Bhoyar</a></li>-->
                  <!--<li><a href="<?=BASEPATH?>/home/">Posts from my creators</a></li>-->
                  <li><a href="<?=BASEPATH?>/home/" style="background-color:#f2f5fa"><?=html_entity_decode($row_user->full_name)?></a></li>
                  <li><a href="<?=BASEPATH?>/create/">Become a Creator</a></li>
<?php 
                }
?>
                <li><a href="<?=BASEPATH?>/explore/">Explore Creators</a></li>
                <li><a href="<?=BASEPATH?>/my-pacts/">My Pacts</a></li>
                <li><a href="<?=BASEPATH?>/settings/">Profile Settings</a></li>
                <!-- <li><a href="<?=BASEPATH?>/change-password/">Change Password</a></li>-->
                <li><a href="<?=BASEPATH?>/help/">Help and FAQ</a></li>
                <li><a href="<?=BASEPATH?>/logout/">Log out</a></li>
              </ul>
            </div>
          </div>
<?php
        }
?>
      </div>
                <!--======================end its is for mobile===============================-->
    </div>
  </div>
</header>

<!-- To make gap where header overlaps body in mobile view -->
<div class="header-body-gap">
</div>
    
    
    
    
 
 