<div id="head-nav" class="navbar navbar-default navbar-fixed-top">
         <div class="container-fluid">
            <div class="navbar-header">
            <button type="button" data-toggle="collapse" data-target=".navbar-collapse" class="navbar-toggle">
            <span class="fa fa-gear"></span>
            </button>
            <a href="<?=ADMINPATH?>/dashboard/" class="navbar-brand"><span>Admin Zone</span></a>
            </div>
            <div class="navbar-collapse collapse">
               <ul class="nav navbar-nav">
                  <li class="active"><a href="<?=ADMINPATH?>/dashboard/">Home</a></li>
                  <li><a href="<?=BASEPATH?>/" target="_blank">View Web Site</a></li>
                 
               </ul>
               <ul class="nav navbar-nav navbar-right user-nav">
                  <li class="dropdown profile_menu">
                     <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                    <?php 
					$avatar_image= IMAGEPATH.$row_access->thumb_image; 
					if(getimagesize($avatar_image)>0) {  ?>
                     <img alt="<?=$row_access->name?>" src="<?=$avatar_image?>"> <?php } ?>
                     Welcome <?=$row_access->name?></span>
                     <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                        <li><a href="<?=ADMINPATH?>/admin-profile/">My Profile</a></li>
                       
                        <li><a href="<?=ADMINPATH?>/company-profile/">Company Settings</a></li>
                        <li><a href="<?=ADMINPATH?>/change-password/">Change Password</a></li>
                        <li class="divider"></li>
                        <li><a href="<?=ADMINPATH?>/logout/">Sign Out</a></li>
                     </ul>
                  </li>
               </ul>
               
            </div>
         </div>
      </div>