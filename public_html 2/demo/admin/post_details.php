<?php
include('configure.php');
include('include/access.php');
$page_title = "Manage User Post";
$table_name = "impact_post";

$table_id=  "post_id";
$id = base64_decode($_GET['id']);
$add_page = ADMINPATH."/".$table_name."_add.php";
$view_page = ADMINPATH."/post_details.php?id=".base64_encode($id);
$edit_page = ADMINPATH."/".$table_name."_edit.php";


define("TABLE_ID",$table_id);

$row_post = $db_query->fetch_object("select * from impact_post where post_id='$id'");
$row_user = $db_query->fetch_object("select * from impact_user where user_id='$row_post->user_id'");
?>

<?php
if($_GET['user_id'] && $_GET['status'])
{
  $id=base64_decode($_GET['user_id']);
  $status=base64_decode($_GET['status']);
  if($status=='0')
  {
     $sql_status="UPDATE ".$table_name." SET `review_status`='1' WHERE ".TABLE_ID."='$id'";
     $res_status=mysql_query($sql_status);
     if($res_status)
     { 
	  $msg='Status Updated Successfully';
	  header('location:'.$view_page);
     }
   }
  if($status=='1')
  {
    $sql_status="UPDATE ".$table_name." SET `review_status`='0' WHERE ".TABLE_ID."='$id'";
    $res_status=mysql_query($sql_status);
    if($res_status)
    {
     $msg='Status Updated Successfully';
	  header('location:'.$view_page);
    }
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
 <link rel="stylesheet" type="text/css" href="<?=ADMINPATH?>/assets/lib/jquery.datatables/plugins/bootstrap/3/dataTables.bootstrap.css"/>

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
            <div class="cl-mcont">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="block-flat profile-info">
                        <div class="row">
                           <div class="col-sm-2">
                              <div class="avatar"><img src="<?=IMAGEPATH.$row_user->image_path?>" class="profile-avatar"></div>
                           </div>
                           <div class="col-sm-7">
                              <div class="personal">
                              
            
                                 <h1 class="name"><?=$row_user->full_name?></h1>
                                 <p class="description"><?=$row_user->tag_line?></p>
                               <!--  <p><a data-modal="reply-ticket" class="btn btn-primary btn-flat btn-rad" href="<?=$view_page?>&user_id=<?=base64_encode($row_user->user_id)?>&status=<?=base64_encode($row_user->review_status)?>">
                                 <?php if($row_user->review_status==0) {?><i class="fa fa-ban"></i> Accept<?php } else {?>
                                 <i class="fa fa-check"></i> Accepted
                                 -->
                                 <?php } ?></a></p>
                              </div>
                           </div>
                           
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="tab-container">
                        <ul class="nav nav-tabs">
                           <li class="active"><a data-toggle="tab" href="#home">Information</a></li>
                         <!--  <li><a data-toggle="tab" href="#friends">About</a></li>
                            <li><a data-toggle="tab" href="#video">Intro Video</a></li>
                           <li><a data-toggle="tab" href="#cover">Cover Photo</a></li>-->
                        </ul>
                        <div class="tab-content">
                           <div id="home" class="tab-pane active cont">
                              <table class="table no-border no-strip information">
                                 <tbody class="no-border-x no-border-y">
                                     <?php if($row_post->post_type=="image"){ ?>
            <div > <img src="<?=IMAGEPATH.$row_post->image_path?>" > </div>
                  
             <?php }else {?>
            
            <div > <iframe width="100%" height="315" src="<?=$db_query->getYoutubeEmbedUrl($row_post->video_link)?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> </div>
                  
             <?php }?>
                                    <tr>
                                      
                                       <td>
                                          <p><?=$row_post->post_title?></p>
                                         
                                       </td>
                                    </tr>
                                    <tr>
                                      
                                       <td>
                                          <p><?=$row_post->create_date?></p>
                                         
                                       </td>
                                    </tr>
                                    
                                      <tr>
                                      
                                       <td>
                                          <p><?=$row_post->description?></p>
                                         
                                       </td>
                                    </tr>
                                   
                                 </tbody>
                              </table>
                           </div>
                           <div id="friends" class="tab-pane cont">
                             
                             <table class="table no-border no-strip information">
                                 <tbody class="no-border-x no-border-y">
                                    <tr>
                                       <td style="width:20%;" class="category"><strong>About Page</strong></td>
                                       <td>
                                          <table class="table no-border no-strip skills">
                                             <tbody class="no-border-x no-border-y">
                                              
                                                <tr>
                                                 
                                                   <td><?=$row_user->about_page?></td>
                                                </tr>
                                               
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                    
                                      <tr>
                                       <td style="width:20%;" class="category"><strong>About Creator</strong></td>
                                       <td>
                                          <table class="table no-border no-strip skills">
                                             <tbody class="no-border-x no-border-y">
                                              
                                                <tr>
                                                 
                                                   <td><?=$row_user->about_you?></td>
                                                </tr>
                                               
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                       <td class="category"><strong>Earning Visibility</strong></td>
                                       <td>
                                          <p><?php if($row_user->earning_visibility==1){?> Public <?php }else { ?>Private<?php } ?></p>
                                          
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="category"><strong>Patronage Visibility</strong></td>
                                       <td>
                                         <p><?php if($row_user->patronage_visibility==1){?> Public <?php }else { ?>Private<?php } ?></p>
                                         
                                       </td>
                                    </tr>
                                    <tr>
                                       <td style="width:20%;" class="category"><strong>Thanks Message</strong></td>
                                       <td>
                                          <table class="table no-border no-strip skills">
                                             <tbody class="no-border-x no-border-y">
                                              
                                                <tr>
                                                 
                                                   <td><?=$row_user->thanks_message?></td>
                                                </tr>
                                               
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                    <!--<tr>
                                       <td class="category"><strong>SOCIAL</strong></td>
                                       <td><button type="button" class="btn btn-default btn-flat btn-facebook bg"><i class="fa fa-facebook"></i><span>Facebook</span></button><button type="button" class="btn btn-default btn-flat btn-twitter bg"><i class="fa fa-twitter"></i><span>Twitter</span></button><button type="button" class="btn btn-default btn-flat btn-google-plus bg"><i class="fa fa-google-plus"></i><span>Google+</span></button></td>
                                    </tr>-->
                                 </tbody>
                              </table>
                             
                           </div>
                           <div id="video" class="tab-pane cont">
                             
                              <iframe width="100%" height="315" src="<?=$db_query->getYoutubeEmbedUrl($row_user->intro_video)?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                             
                           </div>
                           <div id="cover" class="tab-pane cont">
                             
                              <img width="100%" height="315" src="<?=IMAGEPATH.$row_user->cover_image_path?>" >                            
                           </div>
                           
                           
                           <div id="settings" class="tab-pane">
                              <form role="form" class="form-horizontal">
                                 <div class="form-group">
                                    <label for="nick" class="col-sm-3 control-label">Avatar</label>
                                    <div class="col-sm-9">
                                       <div class="avatar-upload">
                                          <img src="assets/img/av.jpg" class="profile-avatar img-thumbnail"><input id="fileupload" type="file" name="files[]">
                                          <div id="progress" class="overlay"></div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <label for="nick" class="col-sm-3 control-label">Nick</label>
                                    <div class="col-sm-9"><input id="nick" type="email" placeholder="Your Nickname" class="form-control"></div>
                                 </div>
                                 <div class="form-group">
                                    <label for="name" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-9"><input id="name" type="email" placeholder="Your Name" class="form-control"></div>
                                 </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9"><input id="inputEmail3" type="email" placeholder="Email" class="form-control"></div>
                                 </div>
                                 <div class="form-group spacer2">
                                    <div class="col-sm-3"></div>
                                    <label for="inputPassword3" class="col-sm-9">Change Password</label>
                                 </div>
                                 <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
                                    <div class="col-sm-9"><input id="inputPassword3" type="password" placeholder="Password" class="form-control"></div>
                                 </div>
                                 <div class="form-group">
                                    <label for="inputPassword4" class="col-sm-3 control-label">Repeat Password</label>
                                    <div class="col-sm-9"><input id="inputPassword4" type="password" placeholder="Password" class="form-control"></div>
                                 </div>
                                 <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9"><button type="submit" class="btn btn-primary">Update</button><button class="btn btn-default">Reset</button></div>
                                 </div>
                              </form>
                              <div id="crop-image" class="md-modal colored-header md-effect-1">
                                 <div class="md-content">
                                    <div class="modal-header">
                                       <h3>Crop Image</h3>
                                       <button aria-hidden="true" data-dismiss="modal" type="button" class="close md-close">×</button>
                                    </div>
                                    <div class="modal-body">
                                       <div class="text-center crop-image"></div>
                                       <form action="http://foxythemes.net/preview/products/cleanzone/crop.php" method="post" onsubmit="return checkCoords();"><input id="x" type="hidden" name="x"><input id="y" type="hidden" name="y"><input id="w" type="hidden" name="w"><input id="h" type="hidden" name="h"></form>
                                    </div>
                                    <div class="modal-footer"><button data-dismiss="modal" type="button" class="btn btn-default btn-flat md-close">Cancel</button><button id="save-image" type="button" class="btn btn-primary btn-flat">Save Image</button></div>
                                 </div>
                              </div>
                              <div class="md-overlay"></div>
                           </div>
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


      
  <script src="<?=ADMINPATH?>/assets/lib/jquery.datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="<?=ADMINPATH?>/assets/lib/jquery.datatables/plugins/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script>
  <script type="text/javascript">$(document).ready(function(){
         //initialize the javascript
         App.init();
         App.dataTables();
         });
      </script>
 
 
 
</body>
</html>
